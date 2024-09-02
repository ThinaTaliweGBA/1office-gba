<?php
namespace App\Services\GBA;

use Illuminate\Http\Request; 
use App\Models\Person;
use App\Models\PersonHasPerson;
use App\Models\GbaDeaths;
use App\Models\Dependent;
use Log;

class PersonService
{
    public function createPerson(Request $request, $prefix, $index = null, $addressId = null)
    {
        $person = new Person();
        // Using ternary operator to handle both array and non-array data
        $person->first_name = is_null($index) ? $request->input($prefix . 'first_name') : ($request->input($prefix . 'first_name')[$index] ?? null);
        $person->initials = is_null($index) ? $request->input($prefix . 'initials') : ($request->input($prefix . 'initials')[$index] ?? null);
        $person->last_name = is_null($index) ? $request->input($prefix . 'last_name') : ($request->input($prefix . 'last_name')[$index] ?? null);
        $person->screen_name = is_null($index) ? $request->input($prefix . 'screen_name') : ($request->input($prefix . 'screen_name')[$index] ?? null);
        $person->id_number = is_null($index) ? $request->input($prefix . 'id_number') : ($request->input($prefix . 'id_number')[$index] ?? null);
        $person->birth_date = is_null($index) ? $request->input($prefix . 'birth_date') : ($request->input($prefix . 'birth_date')[$index] ?? null);
        $person->married_status = is_null($index) ? $request->input($prefix . 'married_status') : ($request->input($prefix . 'married_status')[$index] ?? null);
        $person->gender_id = is_null($index) ? $request->input($prefix . 'gender_id') : ($request->input($prefix . 'gender_id')[$index] ?? null);
        $person->residence_country_id = is_null($index) ? $request->input($prefix . 'residence_country_id') : ($request->input($prefix . 'residence_country_id')[$index] ?? null);
        $person->save();

        Log::info('Person saved', ['id' => $person->id, 'type' => $prefix, 'index' => $index ?? 'N/A']);
        return $person;
    }
    
    
    public function handleDependents(Request $request, $mainPersonId, $membership)
    {
        if (!empty($request->dependent_record_id)) {
            foreach ($request->dependent_record_id as $index => $recordId) {
                if (!empty($recordId)) { // Ensure the record ID isn't null or empty
                    try {
                        // Create each dependent person based on the record index
                        $dependentPerson = $this->createPerson($request, 'dependent_', $index);
    
                        // Create a relationship record in PersonHasPerson
                        $relationship = new PersonHasPerson();
                        $relationship->primary_person_id = $mainPersonId;
                        $relationship->secondary_person_id = $dependentPerson->id;
                        $relationship->person_relationship_id = $request->input('dependent_person_relationship_id')[$index] ?? null;
                        $relationship->save();
    
                        Log::info("Relationship created", ['primary' => $mainPersonId, 'secondary' => $dependentPerson->id]);
    
                        // Create Dependent record
                        $dependent = new Dependent();
                        $dependent->membership_id = $membership->id; // Link to the main person's membership
                        $dependent->person_has_person_id = $relationship->id; // Link to the relationship record
                        $dependent->bu_id = 7; // GBA in 1Office bu
                        $dependent->membership_code = $membership->membership_code; 
                        $dependent->name = $request->input('dependent_first_name')[$index] ?? null;
                        $dependent->initials = $request->input('dependent_initials')[$index] ?? null;
                        $dependent->surname = $request->input('dependent_last_name')[$index] ?? null;
                        $dependent->id_number = $request->input('dependent_id_number')[$index] ?? null;
                        $dependent->start_date = $request->input('dependent_join_date')[$index] ?? null;
    
                        $dependent->save(); // Save the dependent record
                        Log::info("Dependent record saved", ['id' => $dependent->id]);
    
                    } catch (\Exception $e) {
                        Log::error("Error saving dependent $index for record ID $recordId: " . $e->getMessage());
                        throw $e; // Rethrow to manage rollback in the calling method
                    }
                }
            }
        }
    }
    
    
    

    public function handleDeathRecords(Request $request, $prefix)
    {
        if (!empty($request->{$prefix . 'record_id'})) {
            foreach ($request->{$prefix . 'record_id'} as $index => $recordId) {
                if (!empty($recordId)) {
                    try {
                        // Fetching the death record from the database
                        $gbaDeath = GbaDeaths::find($recordId);
                        if (!$gbaDeath) {
                            Log::error("No GbaDeath record found for ID $recordId");
                            continue; // Skip this iteration if no record is found
                        }
    
                        // Creating or updating the person record from death details
                        $death_person = $this->createDeathRecord($request, $prefix, $index, $gbaDeath);
                        
                        // Handle additional transaction details
                        
                        // $this->storeDeathTransactionDetails($gbaDeath, $death_person->id);

                    } catch (\Exception $e) {
                        Log::error("Error processing {$prefix}death record for ID $recordId: " . $e->getMessage());
                        throw $e;
                    }
                }
            }
        }
    }
    
    private function createDeathRecord(Request $request, $prefix, $index, $gbaDeath)
    {
        $death_person = new Person();
        // Assigning values from the request or the GbaDeaths record
        $death_person->first_name = $request->{$prefix . 'first_name'}[$index] ?? $gbaDeath->first_name;
        $death_person->initials = $request->{$prefix . 'initials'}[$index] ?? $gbaDeath->initials;
        $death_person->last_name = $request->{$prefix . 'last_name'}[$index] ?? $gbaDeath->last_name;
        $death_person->screen_name = $request->{$prefix . 'screen_name'}[$index] ?? $gbaDeath->screen_name;
        $death_person->id_number = $request->{$prefix . 'id_number'}[$index] ?? $gbaDeath->id_number;
        $death_person->birth_date = $request->{$prefix . 'birth_date'}[$index] ?? $gbaDeath->birth_date;
        $death_person->gender_id = $request->{$prefix . 'gender_id'}[$index] ?? $gbaDeath->gender_id;
        $death_person->deceased = 1;
        $death_person->deceased_date = $request->{$prefix . 'deceased_date'}[$index] ?? $gbaDeath->deceased_date;
        $death_person->save();
        
        Log::info("{$prefix}Death record processed for person: {$death_person->id}");
        return $death_person;
    }
    
    private function storeDeathTransactionDetails($gbaDeath, $personId)
    {
        $transaction = new Transaction();
        $transaction->person_id = $personId;
        $transaction->grave = $gbaDeath->grave;
        $transaction->transport = $gbaDeath->transport;

        // Add all the other transactions
        
        $transaction->save();
    
        Log::info("Transaction record saved for person: {$personId}", [
            'grave' => $gbaDeath->grave,
            'transport' => $gbaDeath->transport
        ]);
    }
    
    
    
}
