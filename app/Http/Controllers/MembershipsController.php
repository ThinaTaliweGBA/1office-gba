<?php
/**
 * PHP version 9
 *
 * @author    Siyabonga Alexander Mnguni <alexmnguni57@gmail.com>
 * @author    Thina Taliwe <thina.taliwe2@gmail.com>
 * @copyright 2023 1Office
 * @license   MIT License
 * @link      https://github.com/alexmnguni57/1Office-GBA
 */

namespace App\Http\Controllers;

use App\Actions\StoreAddress;
use App\Actions\StorePerson;
use App\Http\Requests\StoreMembershipRequest;
use App\Models\Address;
use App\Models\BuMembershipType;
use App\Models\Country;
use App\Models\Dependant;
use App\Models\Membership;
use App\Models\MembershipAddress;
use App\Models\Person;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\PersonRelationship;
use App\Models\Gender;
use App\Models\MarriageStatus;
use App\Models\Language;
use App\Models\Comment;
use App\Models\PersonHasAddress;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembershipsExport;
use App\Models\User;
use App\Notifications\PersonStatusNotification;


class MembershipsController extends Controller
{
   

    public $statuses = [
        1 => 'Active',
        2 => 'Inactive',
        3 => 'Suspended',
        // Add other statuses as needed
    ];

    public function index(Request $request)
    {
        $query = Membership::query();
        //dd($query)

        if ($request->has('search')) {
            $query
                ->where('name', 'like', "%{$request->search}%")
                ->orWhere('surname', 'like', "%{$request->search}%")
                ->orWhere('id_number', 'like', "%{$request->search}%");
        }

        $statuses = [
            1 => 'Active',
            2 => 'Inactive',
            3 => 'Suspended',
            // Add other statuses as needed
        ];
        //$numberOfMemberships = $query->count();

        //$memberships = $query->orderBy('name')->paginate();
        $memberships = Membership::all();


        $memtypes = BuMembershipType::all();
        $countries = Country::all();

        $genders = Gender::all();
        $maritalStatuses = MarriageStatus::all();
        $languages = Language::all();

        //dd($maritalStatuses);

        //ActivityLogger::activity("User just requested Memberships page");

        //dd($memberships);
        return view('memberships', [
            'memberships' => $memberships,
            'statuses' => $statuses,
            'memtypes' => $memtypes, 'countries' => $countries, 'genders' => $genders, 'maritalStatuses' => $maritalStatuses, 'languages' => $languages
        ]);
    }

    public function export(Request $request)
    {
        return Excel::download(new MembershipsExport($this->statuses), 'memberships.xlsx');
    }

    public function create()
    {
        $memtypes = BuMembershipType::all();
        $countries = Country::all();

        $genders = Gender::all();
        $maritalStatuses = MarriageStatus::all();
        $languages = Language::all();

        //dd($maritalStatuses);

        return view('add-member', ['memtypes' => $memtypes, 'countries' => $countries, 'genders' => $genders, 'maritalStatuses' => $maritalStatuses, 'languages' => $languages]);
    }

    public function store(StoreMembershipRequest $request, StorePerson $storePerson, StoreAddress $storeAddress)
    {
        DB::beginTransaction(); // Start the transaction

        try {
            // Convert request data to object if necessary or directly pass $request
            $requestData = (object) $request->all();

            // Person Action Method injection
            $person = $storePerson->handle($requestData);

            // Address Action Method injection
            $address = $storeAddress->handle($requestData);

            // Assuming you have language logic handled appropriately
            $language = $request->language != null ? 2 : 1;

            // Membership creation

            // Generate unique membership code using the helper function
            $membershipCode = generateUniqueMembershipCode();

            $membership = new Membership();
            $membership->membership_code = $membershipCode;
            $membership->name = ucfirst($request->Name);
            $membership->initials = ucfirst(substr($request->Name, 0, 1)) . '.' . ucfirst(substr($request->Surname, 0, 1));
            $membership->surname = ucfirst($request->Surname);
            $membership->id_number = $request->IDNumber;
            $membership->gender_id = $request->radioGender;
            $membership->join_date = Carbon::today();
            $membership->bu_id = Auth::user()->currentBu()->id;
            $membership->bu_membership_type_id = $request->memtype;
            $membership->bu_membership_region_id = 1;
            $membership->bu_membership_status_id = 1;
            $membership->language_id = $language;
            $membership->person_id = $person->id; // Ensure StorePerson action returns saved Person
            $membership->primary_contact_number = $request->Telephone;
            $membership->secondary_contact_number = $request->WorkTelephone;
            $membership->sms_number = $request->Telephone;
            $membership->primary_e_mail_address = $request->Email;
            $membership->preferred_payment_method_id = 1; //$request->paymentMethod
            $membership->fee_currency_id = 149;
            
            
            //$tasksData = $request->input('tasksData');

            $membership->save();
            Log::info('Saved membership');

            //dd($request);

            //dd($request->all());
            $request->validate([
                'text' => 'nullable|string',
                'author' => 'required|string',
                'link' => 'nullable|string',
                'users_id' => 'required|integer',
                'model_name' => 'required|string',
                'model_record' => 'nullable|integer',
            ]);

            // Generate the URL
            $url = route('view-member', ['id' => $membership->id]);

            // Decode JSON data from the request
            $tasksData = json_decode($request->input('tasksData'), true);
            //localStorage.removeItem('tasks');
            

            // Check if data is an array and not empty
            if (is_array($tasksData) && !empty($tasksData)) {
                foreach ($tasksData as $task) {
                    // Create a new task in the database
                    $Comment = new Comment();
                    //$Comment->users_id = auth()->user()->id;
                    //$Comment->text = $request->input($task);
                    $Comment->users_id = auth()->user()->id;
                    $Comment->text = json_encode($task);                  
                    $Comment->author = $request->author;
                    $Comment->link = $url;
                    $Comment->model_name = 'Membership';
                    $Comment->model_record = $membership->id;

                    $Comment->save();
                }
            }

           // Membership Has Address
            $membershipAddress = new MembershipAddress();
            $membershipAddress->membership_id = $membership->id;
            $membershipAddress->address_id = $address->id;
            $membershipAddress->adress_type_id = 1; // 1 = Residential
            $membershipAddress->start_date = Carbon::today();
            $membershipAddress->save();

            // Person Has Address
            $personAddress = new PersonHasAddress();
            $personAddress->person_id = $person->id;
            $personAddress->address_id = $address->id;
            $personAddress->adress_type_id = 1; // 1 = Residential
            $personAddress->start_date = Carbon::today();
            $personAddress->save();


            DB::commit(); // Commit the transaction

            //return redirect("/edit-member/$membership->id")->with('success', 'Membership Added Successfully!');
            return redirect("/memberships")->with('success', 'Membership Added Successfully!');
        } catch (\Exception $exception) {
            DB::rollBack(); // Rollback the transaction on any error
            Log::error('Error processing membership: ' . $exception->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to process membership: ' . $exception->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('Update method called for membership ID: ' . $id);

        $request->validate([
            'Name' => 'required|string|max:255',
            'Surname' => 'required|string|max:255',
            'IDNumber' => 'required',
            'Telephone' => 'nullable',
            'WorkTelephone' => 'nullable',
            'Email' => 'nullable|email',
            'inputDay' => 'required|numeric|min:1|max:31',
            'inputMonth' => 'required|numeric|min:1|max:12',
            'inputYear' => 'required|numeric|min:1900|max:2100',
            'language' => 'nullable',
            'radioGender' => 'required',
            'marital_status' => 'required',
            'memtype' => 'required',
            // Add other fields and rules as needed
        ]);

        $membership = Membership::findOrFail($id);
        Log::info('Found membership', ['id' => $id]);

        // Assign new values from the request
        $membership->language_id = $request->language;
        $membership->name = $request->Name;
        $membership->surname = $request->Surname;
        $membership->id_number = $request->IDNumber;
        $membership->gender_id = $request->radioGender;
        $membership->primary_contact_number = $request->Telephone;
        $membership->secondary_contact_number = $request->WorkTelephone;
        $membership->primary_e_mail_address = $request->Email;
        $membership->bu_membership_type_id = $request->memtype;

        // Log the old and new values to see what's being attempted to update
        Log::info('Old membership data', $membership->getOriginal());
        Log::info('New membership data', $request->all());

        // Assuming you have a relationship set up for the person details
        $membership->person->birth_date = $request->inputYear . '-' . $request->inputMonth . '-' . $request->inputDay;
        $membership->person->married_status = $request->marital_status;

        // Check if any of the membership or related person model's fields are dirty
        if ($membership->isDirty() || $membership->person->isDirty()) {
            // Save changes if there are any
            $membership->push(); // Saves the model and all of its relationships

            Log::info('Membership and/or related person model was dirty and has been saved.', ['membership_id' => $membership->id]);

            // return redirect("/edit-member/$membership->id")->with('success', 'Membership updated successfully.');

            //$user = User::where('id', $membership->person_id)->first();
            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('updated', 'A membership has been updated.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

            return redirect()->back()->withSuccess('Membership updated successfully!');
             //return response()->json(['success' => 'Membership updated successfully!']);
           
        } else {
            Log::info('No changes detected for membership.', ['membership_id' => $membership->id]);
             return response()->json(['error' => 'Membership not found!'], 404);
        }
        // If no changes were detected
        // return back()->with('info', 'No changes were detected.');
        //redirect()->back()->withInfo('No changes were detected');
         return response(null, 204); // No Content response
    }

    public function show($id, Request $request)
    {
        $membership = Membership::where('id', $id)->first();
        //dd($membership);

        $dependants = Dependant::where('primary_person_id', $membership->person_id)->get();

        $memtypes = DB::select('select * from bu_membership_type');

        $countries = DB::select('select * from country');

        $payments = DB::select('select * from membership_payment_receipts');

        $addresses = $membership->address;

        $disabled = 'inert';

        $billings = DB::select('select * from membership_payment_receipts');

        $statuses = [
            1 => 'Active',
            2 => 'Inactive',
            3 => 'Suspended',
            // Add other statuses as needed
        ];

         $genders = Gender::all();
         $marriageStatuses = MarriageStatus::all();

        // dd($billings);
        // return view('view-member', ['membership' => $membership, 'dis' => $disabled, 'dependants' => $dependants, 'memtypes' => $memtypes, 'countries' => $countries, 'addresses' => $addresses, 'payments' => $payments, 'billings' => $billings, 'statuses' => $statuses]);
        return view('view-member', ['membership' => $membership, 'dis' => $disabled, 'dependants' => $dependants, 'memtypes' => $memtypes, 'countries' => $countries, 'addresses' => $addresses, 'payments' => $payments, 'billings' => $billings, 'statuses' => $statuses, 'genders' => $genders, 'marriageStatuses' => $marriageStatuses]);   
    }


    public function edit($id)
    {
        $membership = Membership::where('id', $id)->first();

        $dependants = Dependant::where('primary_person_id', $membership->person_id)->get();

        $memtypes = DB::select('select * from bu_membership_type');

        $countries = DB::select('select * from country');

        // foreach ($membership->membershipaddress as $memaddress) {
        //     $addresses = Address::where('id', $memaddress->membership_id)->get();
        // }

        $addresses = $membership->address;
        //dd($addresses);

        // Start Comments functionality [Thina]
        // Fetch comments related to the membership
        $comments = Comment::where('model_name', 'Membership')->where('model_record', $id)->get();

        // Decode the JSON data in the 'text' column
        $comments = $comments->map(function ($comment) {
            $comment->text = json_decode($comment->text);
            return $comment;
        });
        // End Comments functionality [Thina]

       try {
    $response = Http::get(env('MEMBER_ADDRESS_URL'));
    if ($response->successful()) {
        $memAdd = $response->json();
    } else {
        // Handle error response
        Log::error('Failed to retrieve member address data', ['response' => $response->body()]);
        // Optionally, you can set a default value or handle the failure accordingly
        $memAdd = [];
    }
} catch (Exception $e) {
    // Handle exceptions
    Log::error('Error occurred while retrieving member address data', ['exception' => $e->getMessage()]);
    // Optionally, you can set a default value or handle the exception accordingly
    $memAdd = [];
}

        //Siya to Thina - Bro why are you using this? Its not good practice

        $disabled = '';

        $genders = DB::select('select * from gender');
        $genderMap = [];
            foreach ($genders as $gender) {
                $genderMap[$gender->id] = $gender->name;
            }

        $marriages = DB::select('select * from marriage_status');

        $billings = DB::select('select * from membership_payment_receipts');



        $relationships = PersonRelationship::all(); // Fetch all relationships
        // Convert relationships to an associative array for easy lookup
        $relationshipMap = [];
        foreach ($relationships as $relationship) {
            $relationshipMap[$relationship->id] = $relationship->name;
        }

        //$genders = Gender::all(); // Fetch all genders

        return view('edit-member', ['membership' => $membership, 'dis' => $disabled, 'dependants' => $dependants, 'memtypes' => $memtypes, 'countries' => $countries, 'addresses' => $addresses, 'memAdd' => $memAdd, 'genders' => $genders, 'marriages' => $marriages, 'billings' => $billings, 'relationships' => $relationships, 'genders' => $genders, 'comments' => $comments, 'genderMap' => $genderMap, 'relationshipMap' => $relationshipMap])->with('success', 'Updated Successfully!');
    }

    /**
     *
     * A delete by id function
     *
     * @param  mixed $id
     * @return void
     *
     */

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            Log::info('Attempting to delete membership with ID: ' . $id);

            $membership = Membership::with(['person.dependants', 'address'])->find($id);

            if (!$membership) {
                Log::warning('Membership not found with ID: ' . $id);
                DB::rollBack();
                return 'Membership not found';
            }

            Log::info('Membership found: ', ['membership' => $membership->toArray()]);

            // Debugging: Inspect the membership
            //  dd($membership);

            // Access the person related to the membership
            $person = $membership->person;

            if ($person) {
                Log::info('Person associated with membership: ', ['person' => $person->toArray()]);

                // Debugging: Inspect the person and their dependants
                //  dd($person->dependants);

                // Delete all dependants
                foreach ($person->dependants as $dependent) {
                    Log::info('Deleting dependant relationship: ', [
                        'primary_person_id' => $person->id,
                        'secondary_person_id' => $dependent->secondary_person_id,
                    ]);

                    // Delete the link in the dependants table
                    Dependant::where('primary_person_id', $person->id)
                        ->where('secondary_person_id', $dependent->secondary_person_id)
                        ->delete();

                    // Soft delete the dependent person
                    $dependentPerson = Person::find($dependent->secondary_person_id);
                    if ($dependentPerson) {
                        Log::info('Soft deleting dependent person: ', ['dependent_person' => $dependentPerson->toArray()]);
                        $dependentPerson->delete();
                    }
                }

                // Soft delete the main person
                Log::info('Soft deleting main person: ', ['person' => $person->toArray()]);
                $person->delete();
            } else {
                Log::warning('Person not found for membership with ID: ' . $id);
            }

            // Explicitly load the MembershipAddress records and delete them
            $membershipAddresses = $membership->membershipAddresses;

            // Debugging: Inspect the membership addresses
            //  dd($membershipAddresses);

            foreach ($membershipAddresses as $membershipAddress) {
                Log::info('Deleting membership address link: ', ['membership_address' => $membershipAddress->toArray()]);
                $membershipAddress->delete();
            }

            // Finally, delete the membership itself
            Log::info('Soft deleting membership: ', ['membership' => $membership->toArray()]);
            $membership->delete();

            // Notify about the deletion
            if ($person) {
                Log::info('Notifying about person deletion: ', ['person' => $person->toArray()]);
                $person->notify(new PersonStatusNotification('deleted', 'A new person has been deleted.'));
            }

            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('deleted', 'A membership has been Deleted/Canceled.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

            Log::info('Membership deletion completed for ID: ' . $id);

            DB::commit();

            return redirect()->back()->withSuccess('Membership Has Been Cancelled!');
        } catch (\Exception $e) {
            Log::error('Error deleting membership: ', ['error' => $e->getMessage()]);
            DB::rollBack();
            return redirect()->back()->withErrors('An error occurred while cancelling the membership.');
        }
    }

    public function getData()
    {
        $memberships = Membership::all()->sortByDesc('created_at')->values();
        return response()->json($memberships);
    }

    public function deleteAddress($id)
    {
        $address = Address::where('id', $id)->first();
        $address->delete();

        return redirect()->back()->withSuccess('Address Has Been deleted!');
    }

    public function deleteBilling($id)
    {
        $billings = DB::table('membership_payment_receipts')->where('id', $id)->delete();
        //          dd($billings);
        //        $address = Address::where('id', $id)->first();

        return redirect()->back()->withSuccess('Billing Has Been deleted!');
    }

    public function deleteNotification($notificationId)
    {
        $notification = auth()->user()->notifications->find($notificationId);
        if ($notification) {
            $notification->delete();
            return response()->json(['status' => 'success', 'message' => 'Notification deleted successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Notification not found'], 404);
    }
}
