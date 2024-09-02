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
use App\Models\MembershipAddress;
use App\Models\PersonRelationship;
use App\Models\Gender;
use App\Models\MarriageStatus;
use App\Models\PersonHasAddress;

use Illuminate\Support\Facades\Auth;

// use App\Actions\StorePerson;
use App\Actions\StoreAddress;

use App\Services\GBA\PersonService;
use App\Services\GBA\MembershipService;



use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GbaController extends Controller
{
    private $personService;
    private $membershipService;

    public function __construct(PersonService $personService, MembershipService $membershipService)
    {
        $this->personService = $personService;
        $this->membershipService = $membershipService;
    }

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
    $relationships = PersonRelationship::all();
    $genders = Gender::all();
    $marriageStatuses = MarriageStatus::all();
    $banks = DB::connection('mysql')->table('bank')->get();
    $branchCodes = DB::connection('mysql')->table('bank_branch')->get();
    $accountTypes = DB::connection('mysql')->table('bank_account_type')->get();
    $paymentmethods = DB::connection('mysql')->table('payment_method')->where('bu_id', 7)->get();

    return view('resolutionhub', compact('paginatedItems', 'search', 'dropdownBuMemReg', 'dropdownBuMemSta', 'dropdownBuMemTyp', 'paymentmethods', 'banks', 'accountTypes', 'branchCodes','relationships', 'genders', 'marriageStatuses'));
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

    public function submitActionOne(Request $request, StoreAddress $storeAddress)
    {
        Log::info('Memory Usage at Start: ' . memory_get_usage());
        DB::beginTransaction(); // Start the transaction
    
        try {
            $address = $storeAddress->handle($request);
    
            // No prefix is used for the main person, hence ''
            $main_person = $this->personService->createPerson($request, '');
            $membership = $this->membershipService->createMembership($request, $main_person->id, $address->id);
    
            $this->personService->handleDependents($request, $main_person->id, $membership); // Save the dependent person and Link dependent to the main person in PersonHasPerson and also createslink in dependents table
            
            $this->personService->handleDeathRecords($request, 'death_'); // Normal deaths
            $this->personService->handleDeathRecords($request, 'pmp_death_'); // PMP(Previous Main Person) deaths
    
            // Person Has Address
            $personAddress = new PersonHasAddress([
                'person_id' => $main_person->id,
                'address_id' => $address->id,
                'adress_type_id' => 1, // 1 = Residential
                'start_date' => Carbon::today(), // Carbon today
            ]);

            $personAddress->save();

            $membershipAddress->save();

            DB::commit();
            Log::info('All data processed successfully.');
    
            $this->markRecordsAsCompleted($request);
    
            return redirect()->route('resolutionhub')->with('success', 'Membership and dependents have been successfully saved.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in submitActionOne: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors('Error while saving membership and dependents: ' . $e->getMessage());
        }
    }
    
    private function markRecordsAsCompleted(Request $request)
    {
        $mainMembership = GbaMembership::where('membership_id', $request->membership_id)->first();
        if ($mainMembership) {
            $mainMembership->record_completed = 1;
            $mainMembership->save();
        }
    
        $dependents = GbaDependent::where('membership_id', $request->membership_id)->get();
        foreach ($dependents as $dependent) {
            $dependent->record_completed = 1;
            $dependent->save();
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
