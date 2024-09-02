<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Dependent;
use App\Models\Person;
use App\Models\PersonHasPerson;
use App\Models\Gender;
use App\Models\MarriageStatus;
use App\Models\Language;
use App\Models\Address;
use App\Models\PersonDetail;
use App\Models\DeathReporter;
use App\Models\Funeral;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memberships = Membership::with([
            'person.dependants.personDep', 
            'person.dependants.relationshipType', 
            'person'
        ])->whereHas('person', function ($query) {
            $query->where('deceased', 0);
        })->get();
        //dd($memberships);
        $genders = Gender::all();
        $maritalStatuses = MarriageStatus::all();
        $languages = Language::all();

        return view('deaths.index', compact('memberships', 'genders', 'maritalStatuses', 'languages'));
    }



    public function searchPersons(Request $request)
    {
        $search = $request->get('search');
        
        // $persons = Person::where('deceased', 0)
        //     ->where(function ($query) use ($search) {
        //         $query->where('first_name', 'LIKE', "%{$search}%")
        //               ->orWhere('last_name', 'LIKE', "%{$search}%")
        //               ->orWhere('id_number', 'LIKE', "%{$search}%");
        //     })
        //     ->get();

        //Only fetch people that have a membership or belong to one
        $persons = Person::where('deceased', 0)
        ->where(function ($query) use ($search) {
            $query->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('id_number', 'LIKE', "%{$search}%");
        })
        ->where(function ($query) {
            $query->whereHas('membership')  // Persons with their own memberships
                  ->orWhereHas('membershipsAsDependent');  // Persons who are dependents
        })
        ->get();
    
        $results = $persons->map(function ($person) {
            return [
                'id' => $person->id,  // Include the ID in the results
                'first_name' => $person->first_name,
                'last_name' => $person->last_name,
                'id_number' => $person->id_number,
            ];
        });
    
        return response()->json(['results' => $results]);
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         Log::info('Death record store process started', ['request' => $request->all()]);
     
         // Begin a transaction in case you need to rollback if something goes wrong
         DB::beginTransaction();
         try {
             // Find the deceased person
             $deceased_person = Person::findOrFail($request->deceased_id);
             Log::info('Found deceased person', ['deceased_person' => $deceased_person]);
     
             // Store reporting person details
             $reporterPerson = new Person();
             $reporterPerson->first_name = $request->reporter_name;
             $reporterPerson->last_name = $request->reporter_surname;
             $reporterPerson->save();
             Log::info('Reporter person saved', ['reporterPerson' => $reporterPerson]);
     
             // Store reporting person relationship to deceased
             $reporter = new DeathReporter();
             $reporter->dead_person_id = $deceased_person->id;
             $reporter->reporting_person_id = $reporterPerson->id;
             $reporter->contact_detail_1 = $request->reporter_tel;
             $reporter->contact_detail_2 = $request->reporter_whatsapp;
             $reporter->contact_detail_3 = $request->reporter_email;
             $reporter->save();
             Log::info('Death reporter saved', ['reporter' => $reporter]);
     
             // Store/Update deceased Person info
             $deceased_person->first_name = $request->deceased_name;
             $deceased_person->last_name = $request->deceased_surname;
             $deceased_person->initials = $request->deceased_initials;
             $deceased_person->id_number = $request->deceased_id_number;
             $deceased_person->birth_date = $request->deceased_birth_date;
             $deceased_person->married_status = $request->deceased_marital_status;
             $deceased_person->gender_id = $request->deceased_sex;
             $deceased_person->deceased = 1;
             $deceased_person->deceased_date = $request->deceased_date_of_death;
             $deceased_person->save();
             Log::info('Deceased person updated', ['deceased_person' => $deceased_person]);
     
             // Store deceased Person details - Maiden Name, Occupation, Doctor
             $this->storePersonDetail($deceased_person->id, 7, 7, $request->deceased_maiden_name); // Maiden Name
             $this->storePersonDetail($deceased_person->id, 7, 6, $request->deceased_occupation); // Occupation
             $this->storePersonDetail($deceased_person->id, 7, 1, $request->deceased_doctor); // Doctor
     
             // Store deceased last address
             $this->storeAddress(1, $request->deceased_place_of_death_placeName, $request->deceased_address_line1, $request->deceased_address_line2, $request->deceased_address_townSuburb, $request->deceased_address_city, $request->deceased_address_postalCode, $request->deceased_address_province, 197); // Last Address
     
             // Store deceased birth place address
             $this->storeAddress(19, $request->deceased_birth_town_placeName, $request->deceased_birth_town_line1, $request->deceased_birth_town_line2, $request->deceased_birth_town_townSuburb, $request->deceased_birth_town_city, $request->deceased_birth_town_postalCode, $request->deceased_birth_town_province, 197); // Birth Address
     
             // Store deceased death place address
             $this->storeAddress(20, $request->deceased_place_of_death_placeName, $request->deceased_place_of_death_line1, $request->deceased_place_of_death_line2, $request->deceased_place_of_death_townSuburb, $request->deceased_place_of_death_city, $request->deceased_place_of_death_postalCode, $request->deceased_place_of_death_province, 197); // Place of Death
     
             // Fetch all memberships where the deceased person is either a primary member or a dependent
             $memberships = $deceased_person->allMemberships();
     
             // Create funeral records for each membership
             $funeral = new Funeral();
             $funeral->person_id = $deceased_person->id;
             $funeral->bu_id = Auth::user()->currentBu()->id;
             $funeral->person_name = $deceased_person->first_name;
             $funeral->funeral_required = 0;
             $funeral->save();
             
             Log::info('Funeral records created for Person');
     
             // Commit the transaction
             DB::commit();
             Log::info('Death record stored successfully');
             // Return a successful response
             return redirect()->route('funerals.index')->with('success', 'Death record stored successfully');
         } catch (\Exception $e) {
             // Rollback the transaction on error
             DB::rollback();
             Log::error('Failed to store death record', ['error' => $e->getMessage()]);
             // Return an error response, e.g., redirect back with an error message
             return back()->withErrors('Failed to store death record')->withInput();
         }
     }
     
     // Store Person Detail helper function
     private function storePersonDetail($personId, $buId, $detailNameId, $detail)
     {
         if ($detail) {
             $personDetail = new PersonDetail();
             $personDetail->person_id = $personId;
             $personDetail->bu_id = $buId;
             $personDetail->person_detail_name_id = $detailNameId;
             $personDetail->detail = $detail;
             $personDetail->save();
             Log::info('Person detail saved', [
                 'person_id' => $personId,
                 'bu_id' => $buId,
                 'person_detail_name_id' => $detailNameId,
                 'detail' => $detail
             ]);
         }
     }
     
     // Store Address helper function
     private function storeAddress($addressTypeId, $name, $line1, $line2, $suburb, $city, $zip, $province, $countryId)
     {
         $address = new Address();
         $address->adress_type_id = $addressTypeId;
         $address->name = $name ?? '';
         $address->line1 = $line1;
         $address->line2 = $line2;
         $address->suburb = $suburb;
         $address->city = $city;
         $address->ZIP = $zip;
         $address->district = $line2;
         $address->province = $province;
         $address->country_id = $countryId;
         $address->save();
         Log::info('Address saved', [
             'adress_type_id' => $addressTypeId,
             'name' => $name,
             'line1' => $line1,
             'line2' => $line2,
             'suburb' => $suburb,
             'city' => $city,
             'ZIP' => $zip,
             'province' => $province,
             'country_id' => $countryId
         ]);
     }
     
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function calculateAge($birthDate)
    {
        if ($birthDate === null) {
            return null; // Handle cases where birthDate might be null
        }
        $birthDate = new \DateTime($birthDate); // Use the backslash to refer to the global namespace
        $today = new \DateTime('now');
        $interval = $birthDate->diff($today);
        return $interval->y; // Returns the total number of years
    }

    public function getPersonDetails($id)
    {
        // Fetch person details with the possibility of including related data if necessary
        $person = Person::findOrFail($id);

        // Using the function to calculate age
        $age = $this->calculateAge($person->birth_date);

        // Check if the gender_id or married_status is null and set a placeholder value
        $gender_id = is_null($person->gender_id) ? '' : $person->gender_id;
        $married_status = is_null($person->married_status) ? '' : $person->married_status;

        // Prepare the data to send as JSON
        $data = [
            'name' => $person->first_name,
            'initials' => $person->initials,
            'surname' => $person->last_name,
            'id' => $person->id,
            'id_number' => $person->id_number,
            'birth_date' => $person->birth_date,
            'age' => $age,
            'sex' => $person->gender_id,
            'marital_status_id' => $person->married_status,
        ];

        return response()->json($data);
    }
}
