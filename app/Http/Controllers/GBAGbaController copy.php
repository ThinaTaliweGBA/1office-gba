<?php

namespace App\Http\Controllers;

use App\Models\Gba;
use App\Models\GbaMembership; // Assuming Gba model is replaced by GbaMembership

use App\Models\GbaDependent;
use App\Models\GbaDuplicateLog;
use App\Models\GbaDeaths;

use App\Models\GbaMembershipDuplicate;
use App\Models\GbaDependentDuplicate;
use App\Models\GbaMembershipError;
use App\Models\GbaDependentError;
use App\Models\GbaErrorLog;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Membership;
use App\Models\Dependent;
use App\Models\Person;
use App\Models\PersonHasPerson;
use App\Models\BuMembershipRegion;
use App\Models\BuMembershipStatus;
use App\Models\BuMembershipType;
// use App\Actions\StorePerson;
use App\Actions\StoreAddress;
use App\Models\MembershipAddress;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GbaController extends Controller
{

    public function showGroupedRecords(Request $request)
{
    $perPage = 1; // Display one membership record per page.
    $page = $request->input('page', 1);
    $search = $request->input('search', null); // Get the search parameter
    $sort = $request->input('sort', 'membership_id_asc'); // Get sort parameter with a default value

    // Adjust the method to filter by the search parameter if provided and apply sorting
    $uniqueMembershipIds = $this->fetchOrRetrieveMembershipIds($search, $sort);

    // Calculate pagination offsets.
    $total = $uniqueMembershipIds->count();

    // Use Collection's slice for pagination since $uniqueMembershipIds is a Collection.
    $currentPageData = $uniqueMembershipIds->slice(($page - 1) * $perPage, $perPage);

    // Fetch detailed records for the current page's membership IDs.
    $groupedRecords = $currentPageData->map(function ($item) {
        return $this->fetchGroupedRecordsForMembershipId($item['membership_id'], $item['previous_membership_code']);
    })->all();

    // Manually create a paginator.
    $paginatedItems = new LengthAwarePaginator(array_values($groupedRecords), $total, $perPage, $page, [
        'path' => $request->url(),
        'query' => $request->query(),
    ]);

    // Additional data fetching for the view
    $dropdownBuMemReg = BuMembershipRegion::all();
    $dropdownBuMemSta = BuMembershipStatus::all();
    $dropdownBuMemTyp = BuMembershipType::all();
    $dropdownGender = DB::table('gender')->get();
    $banks = DB::connection('mysql')->table('bank')->get();
    $branchCodes = DB::connection('mysql')->table('bank_branch')->get();
    $accountTypes = DB::connection('mysql')->table('bank_account_type')->get();
    $paymentmethods = DB::connection('mysql')->table('payment_method')->where('bu_id', 7)->get();

    return view('resolutionhub', compact('paginatedItems', 'search', 'dropdownBuMemReg', 'dropdownBuMemSta', 'dropdownBuMemTyp', 'dropdownGender', 'paymentmethods', 'banks', 'accountTypes', 'branchCodes'));
}

private function fetchOrRetrieveMembershipIds($search = null, $sort = null)
{
    $query = GbaMembership::where(function ($query) {
                $query->where('record_discarded', '=', null)
                      ->where('record_completed', '=', null);
            })
            ->select('membership_id', 'previous_membership_code', 'join_date') // Retrieve both fields
            ->distinct();

    if ($search) {
        $query->where('membership_id', 'like', '%' . $search . '%');
    }

    // Apply sorting based on the 'sort' parameter
    switch ($sort) {
        case 'membership_id_asc':
            $query->orderBy('membership_id', 'asc');
            break;
        case 'membership_id_desc':
            $query->orderBy('membership_id', 'desc');
            break;
        case 'join_date_asc':
            $query->orderBy('join_date', 'asc');
            break;
        case 'join_date_desc':
            $query->orderBy('join_date', 'desc');
            break;
        default:
            $query->orderBy('membership_id', 'asc'); // Default sorting
            break;
    }

    return $query->get()->map(function ($item) {
        return [
            'membership_id' => $item->membership_id,
            'previous_membership_code' => $item->previous_membership_code
        ];
    });
}



    private function fetchGroupedRecordsForMembershipId($membershipId, $previousMembershipCode)
    {
        $mainRecord = GbaMembership::where('membership_id', $membershipId)
        ->where(function ($query) {
            $query->where('record_discarded', 0)
                ->where('record_completed', 0)
                ->orWhere(function($q) {
                    $q->whereNull('record_discarded')
                      ->whereNull('record_completed');
                });
        })->first();

        if ($mainRecord) {
            // Adjusted to fetch duplicates, excluding discarded duplicates
            $membershipDuplicates = GbaMembershipDuplicate::where('membership_id', $membershipId)
                ->where(function ($query) {
                    $query->where('record_discarded', 0)
                        ->orWhereNull('record_discarded');
                })
                ->get();

            $dependentDuplicates = GbaDependentDuplicate::where('membership_id', $membershipId)
                ->where(function ($query) {
                    $query->where('record_discarded', 0)
                        ->orWhereNull('record_discarded');
                })
                ->get();

            // Adjusted to fetch errors, excluding 'used' and 'discarded' errors
            $membershipErrors = GbaMembershipError::where('membership_id', $membershipId)
                ->where('record_used', 0)
                ->where(function ($query) {
                    $query->where('record_discarded', 0)
                        ->orWhereNull('record_discarded');
                })
                ->get();

            $dependentErrors = GbaDependentError::where('membership_id', $membershipId)
                ->where('record_used', 0)
                ->where(function ($query) {
                    $query->where('record_discarded', 0)
                        ->orWhereNull('record_discarded');
                })
                ->get();

            // Adjusted to fetch dependents, excluding 'discarded' dependents
            $dependents = GbaDependent::where('membership_id', $membershipId)
                ->where(function ($query) {
                    $query->where('record_discarded', 0)
                        ->orWhereNull('record_discarded');
                })
                ->get();


            $deaths = GbaDeaths::where('membership_id', $membershipId)
                ->where(function ($query) {
                    $query->where('record_discarded', 0)
                        ->orWhereNull('record_discarded');
                })
                ->get();

            $previousdeaths = GbaDeaths::where('membership_id', $previousMembershipCode)
                ->where(function ($query) {
                    $query->where('record_discarded', 0)
                        ->orWhereNull('record_discarded');
                })
                ->get();


            // Combine duplicates and errors
            $combinedDuplicates = $membershipDuplicates->merge($dependentDuplicates);
            $combinedErrors = $membershipErrors->merge($dependentErrors);

            return [
                'membershipId' => $membershipId,
                'main' => $mainRecord,
                'duplicates' => $combinedDuplicates,
                'errors' => $combinedErrors,
                'dependents' => $dependents,
                'deaths' => $deaths,
                'previousdeaths' => $previousdeaths,
            ];
        }
        return null; // If no main record is found
    }


    public function handleMainRecordAction(Request $request, StoreAddress $storeAddress)
    {
        if ($request->action == 'submitActionOne') {
            return $this->submitActionOne($request,$storeAddress);
        } elseif ($request->action == 'submitActionTwo') {
            return $this->submitActionTwo($request);
        }
        // Handle other actions or default case
    }

    protected function submitActionOne(Request $request, StoreAddress $storeAddress)
    {
        Log::info('Memory Usage at Start: ' . memory_get_usage());

        DB::beginTransaction(); // Start the transaction

        try {

        // Address Action Method injection
        $address = $storeAddress->handle($request);

        // Save Main Person
        $main_person = new Person();
        $main_person->first_name = $request->first_name;
        $main_person->initials = $request->initials;
        $main_person->last_name = $request->last_name;
        $main_person->screen_name = $request->screen_name;
        $main_person->id_number = $request->id_number;
        $main_person->birth_date = $request->birth_date;
        $main_person->married_status = $request->married_status;
        $main_person->gender_id  = $request->gender_id;
        $main_person->residence_country_id  = 197; // Assuming this is static

        $main_person->save(); // Save the main person
        Log::info('Main person saved', ['id' => $main_person->id]);
        Log::info('Memory Usage After Saving Main Person: ' . memory_get_usage());

        // Create Membership for Main Person
        $membership = new Membership();
        $membership->membership_code = $request->membership_id; // Adjust according to actual field
        $membership->name = $main_person->first_name; // Assuming you want to use the main person's name
        $membership->initials = $main_person->initials;
        $membership->surname = $main_person->last_name;
        $membership->id_number = $main_person->id_number;
        $membership->gender_id = $main_person->gender_id;
        $membership->bu_id = 7;
        $membership->language_id  = 1;
        $membership->bu_membership_type_id = 1;
        $membership->bu_membership_region_id = 1; // Assuming static
        $membership->bu_membership_status_id = 1; // This should be changed
        $membership->person_id = $main_person->id;
        $membership->primary_contact_number = $request->primary_contact_number;
        $membership->secondary_contact_number = $request->secondary_contact_number;
        $membership->primary_e_mail_address = $request->primary_e_mail_address;
        $membership->fee_currency_id = 149; // Assuming static
        $membership->preferred_payment_method_id = 2; //Set to cash

        $membership->save();
        Log::info('Membership saved', ['id' => $membership->id]);
        Log::info('Memory Usage After Saving Membership: ' . memory_get_usage());

         // Membership Has Address
         $membershipAddress = new MembershipAddress([
            'membership_id' => $membership->id,
            'address_id' => $address->id,
            'adress_type_id' => 1, // 1 = Residential
            'start_date' => Carbon::today(), // Carbon today
        ]);

        $membershipAddress->save();

        Log::info('Memory Usage After Committing Main Person and Membership: ' . memory_get_usage());

        $errors = []; // Initialize an array to store potential errors

        // Check if there is at least one dependent's membership ID provided
        if (!empty($request->dependent_membership_id)) {
            $dependentMembershipIds = is_array($request->dependent_membership_id) ? $request->dependent_membership_id : [$request->dependent_membership_id];
            foreach ($request->dependent_membership_id as $index => $membershipId) {
                if (!empty($membershipId)) { // Additional check to ensure we have a membership ID to process


            // Assuming dependent_* arrays are indexed and match with each dependent person
            foreach ($request->dependent_first_name as $index => $firstName) {

                try {
                // Save each dependent Person
                $dependent_person = new Person();
                $dependent_person->first_name = $firstName;
                $dependent_person->initials = $request->dependent_initials[$index];
                $dependent_person->last_name = $request->dependent_last_name[$index];
                $dependent_person->screen_name = $request->dependent_screen_name[$index];
                $dependent_person->id_number = $request->dependent_id_number[$index];
                $dependent_person->birth_date = $request->dependent_birth_date[$index];
                // $dependent_person->married_status = $request-> something [$index];
                $dependent_person->gender_id = $request->dependent_gender_id[$index];
                $dependent_person->residence_country_id = 197;

                $dependent_person->save(); // Save the dependent person

                // Link dependent to the main person in PersonHasPerson
                $person_has_person = new PersonHasPerson();
                $person_has_person->primary_person_id = $main_person->id;
                $person_has_person->secondary_person_id = $dependent_person->id;
                $person_has_person->person_relationship_id = 1 ; // use this when there is data : $request->dependent_person_relationship_id[$index]
                $person_has_person->save(); // Save the relationship

                // Create Dependent record
                $dependent = new Dependent();
                $dependent->membership_id = $membership->id; // Link to the main person's membership
                $dependent->person_has_person_id = $person_has_person->id; // Link to the relationship record
                $dependent->bu_id  = 7; //GBA in 1Office bu 
                $dependent->membership_code = $membership->membership_code; 
                $dependent->name = $firstName;
                $dependent->initials = $request->dependent_initials[$index];
                $dependent->surname = $request->dependent_last_name[$index];
                $dependent->id_number = $request->dependent_id_number[$index];
                $dependent->start_date = $request->dependent_join_date[$index];

                $dependent->save(); // Save the dependent record
                Log::info("Dependent record saved", ['id' => $dependent->id]);

            } catch (\Exception $e) {
                Log::error("Error saving dependent $index: " . $e->getMessage());
                $errors[] = "Error saving dependent $index: " . $e->getMessage();
                // Consider how to handle partial successes here
                // I might want to continue, or break and roll back
            }
                    }
                }
            }
        }
        
        // Check if there are any death records provided
        if (!empty($request->death_record_id)) {
            // Loop through each death record by its ID
            foreach ($request->death_record_id as $recordId) {
                if (!empty($recordId)) { // Ensure the record ID isn't null or empty
                    try {
                        // Fetch the death record from the GbaDeaths model
                        $gbaDeath = GbaDeaths::find($recordId);

                        if ($gbaDeath) {
                            // Create and save each death Person based on the fetched data
                            $death_person = new Person();
                            $death_person->first_name = $gbaDeath->first_name;
                            $death_person->initials = $gbaDeath->initials;
                            $death_person->last_name = $gbaDeath->last_name;
                            $death_person->screen_name = $gbaDeath->screen_name;
                            $death_person->id_number = $gbaDeath->id_number;
                            $death_person->birth_date = $gbaDeath->birth_date;
                            $death_person->gender_id = $gbaDeath->gender_id;
                            $death_person->residence_country_id = 197; // Assuming static

                            $death_person->save(); // Save the death person

                            // Log the creation of the death person
                            Log::info("Death record saved", ['id' => $death_person->id]);
                        } else {
                            Log::warning("No GbaDeath record found with ID: $recordId");
                        }
                        
                    } catch (\Exception $e) {
                        Log::error("Error saving death record for ID $recordId: " . $e->getMessage());
                        $errors[] = "Error saving death record for ID $recordId: " . $e->getMessage();
                        // Handle the error based on your business rules, possibly breaking or continuing
                    }
                }
            }
        }


        if (!empty($errors)) {
            // If there are errors, roll back transaction and return with errors
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['custom_error' => $errors]);
        }

        DB::commit(); // If everything went well, commit the transaction
        
        // Mark the main record as completed
        $mainMembership = GbaMembership::where('membership_id', $request->membership_id)->first();
        if ($mainMembership) {
            $mainMembership->record_completed = 1;
            $mainMembership->save();
        }

        //Mark each dependent as completed
        $dependents = GbaDependent::where('membership_id', $request->membership_id)->get();
        foreach ($dependents as $dependent) {
            $dependent->record_completed = 1;
            $dependent->save();
        }

        Log::info('All data processed.');
        return redirect()->route('resolutionhub')->with('success', 'Membership and dependents have been successfully saved.');
    } catch (\Exception $e) {
        DB::rollBack(); // Roll back on any error
        Log::error('Error in submitActionOne: ' . $e->getMessage());
        return redirect()->back()->withInput()->withErrors('Error while saving membership and dependents: ' . $e->getMessage());
    }

    }
    

    protected function submitActionTwo(Request $request)
    {
        dd('Handling Submit Action Two', $request->all());
    }


    public function processRecordAction(Request $request)
    {
        $actionType = $request->actionType;
        $recordId = $request->recordId;
        $membershipId = $request->membershipId; // Extract membershipId from the request
        $details = $request->input('details', []);
    
        Log::info("Processing action: $actionType for record ID: $recordId and Membership ID: $membershipId");
    
        switch ($actionType) {
            case 'makeDependentError':
                $result = $this->processMakeDependentError($recordId, $membershipId, $details); // Pass membershipId to the method
                $message = 'Dependent created successfully.';
                break;
            case 'discardError':
                $result = $this->discardError($recordId, $membershipId); // Pass membershipId to the method
                $message = 'Error record discarded successfully.';
                break;
            case 'discardDuplicate':
                $result = $this->discardDuplicate($recordId, $membershipId); // Pass membershipId to the method
                $message = 'Duplicate record discarded successfully.';
                break;
            default:
                $result = false;
                $message = 'No action taken.';
                break;
        }
    
        if ($result) {
            Log::info("$actionType action processed successfully for record ID: $recordId and Membership ID: $membershipId");
            return response()->json(['success' => true, 'message' => $message]);
        }
    
        Log::error("Action $actionType failed for record ID: $recordId and Membership ID: $membershipId");
        return response()->json(['success' => false, 'message' => 'Action failed.'], 422);
    }
    


    protected function processMakeDependentError($recordId, $membershipId, $details)
    {
        $models = [GbaDependentError::class, GbaMembershipError::class];
        $record = null;
    
        foreach ($models as $model) {
            Log::debug("Searching $model for record ID: $recordId and Membership ID: $membershipId");
    
            // Adjust the query to match both recordId and membershipId
            $record = $model::where('id', $recordId)
                            ->where('membership_id', $membershipId)
                            ->first(); // Use first() to get the first record matching the conditions
    
            if ($record) {
                break; // Stop the loop if a record is found
            }
        }
    
        // If no record found or the record is already used, log and return false
        if (!$record || $record->record_used) {
            Log::info("Record already processed or doesn't exist for ID: $recordId and Membership ID: $membershipId");
            return false; // Record already processed or doesn't exist
        }
    
        $record->record_used = 1;
        $record->save(); // Mark the error record as used
    
        // Create GbaDependent assuming details are valid
        $newRecord = new GbaDependent();
        foreach ($details as $key => $value) {
            $newRecord->$key = $value;
        }
        $newRecord->save(); // Save the new GbaDependent record
    
        Log::info("New GbaDependent record saved for error record ID: $recordId and Membership ID: $membershipId");
        return true;
    }
    

    protected function discardError($recordId, $membershipId)
    {
        $models = [GbaDependentError::class, GbaMembershipError::class];
        foreach ($models as $model) {
            $record = $model::where('id', $recordId)
                            ->where('membership_id', $membershipId)
                            ->first();
    
            if ($record) {
                $record->record_discarded = 1;
                $record->save();
                Log::info("Error record discarded successfully for ID: $recordId and Membership ID: $membershipId in model " . $model);
                return true;
            }
        }
        return false;
    }
    
    
    protected function discardDuplicate($recordId, $membershipId)
    {
        $models = [GbaDependentDuplicate::class, GbaMembershipDuplicate::class];
        foreach ($models as $model) {
            $record = $model::where('id', $recordId)
                            ->where('membership_id', $membershipId)
                            ->first();
    
            if ($record) {
                $record->record_discarded = 1;
                $record->save();
                Log::info("Duplicate record discarded successfully for ID: $recordId and Membership ID: $membershipId in model " . $model);
                return true;
            }
        }
        return false;
    }
    

    // Dependents Section
    // public function markAsComplete(Request $request, $dependentId)
    // {
    //     $dependent = GbaDependent::findOrFail($dependentId);
    //     $dependent->record_completed = 1;
    //     $dependent->save();

    //     return response()->json(['success' => true, 'message' => 'Dependent marked as complete.']);
    // }

    public function removeDependent(Request $request, $dependentId)
    {
        $dependent = GbaDependent::findOrFail($dependentId);
        $dependent->record_discarded = 1;
        $dependent->save();

        return response()->json(['success' => true, 'message' => 'Dependent removed.']);
    }
}
