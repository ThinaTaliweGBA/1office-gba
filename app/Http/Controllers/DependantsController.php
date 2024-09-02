<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDependantRequest;
use App\Models\Dependant;
use App\Models\Membership;
use App\Models\MembershipPaymentReceipt;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\PersonRelationship;

use App\Models\User;
use App\Notifications\PersonStatusNotification;

/**
 * Dependants Controller
 *
 * This controller handles the creation, deletion and listing of dependants.
 *
 * @category Controller
 * @package  App\Http\Controllers
 */
class DependantsController extends Controller
{
    /**
     * Display a listing of the dependants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependants = Dependant::all();
        
        $relationships = PersonRelationship::all(); // Fetch all relationships
        //$memberships = Membership::all();

        return view('dependants', ['dependants' => $dependants, 'relationships' => $relationships]);
    }
    
    public function indexx()
    {
        $payments = MembershipPaymentReceipt::all(); // Make sure you have the Address model created and it is properly linked to your database table
        return response()->json($payments);
    }

    /**
     * Store a newly created dependant in storage.
     *
     * @param  \App\Http\Requests\StoreDependantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDependantRequest $request)
    {
        // Get the first letter of the first name and surname for initials
        $initials = ucfirst(substr($request->Name, 0, 1)) . '.' . ucfirst(substr($request->Surname, 0, 1));

        // Create a new person object
        $person = new Person();

        // Set the person's attributes
        $person->first_name = ucfirst($request->Name);
        $person->initials = $initials;
        $person->last_name = ucfirst($request->Surname);
        $person->screen_name = $request->Name . ' ' . ucfirst($request->Surname);
        $person->id_number = $request->IDNumberDep;
        $person->birth_date = $request->inputYearDep . '-' . $request->inputMonthDep . '-' . $request->inputDayDep;
        $person->gender_id = $request->radioGenderDep;
        $person->residence_country_id = 197;
        \Log::info('Memory usage before operation: ' . memory_get_usage());
        // Save the person
        $person->save();
        \Log::info('Memory usage after operation: ' . memory_get_usage());

        // Create a new dependant object (Person_has_person)
        $dependant = new Dependant();

        // Set the dependant's attributes
        $dependant->primary_person_id = $request->mainMemberId;
        $dependant->secondary_person_id = $person->id;
        $dependant->person_relationship_id = $request->radioRelationCode;

        // Save the dependant
        $dependant->save();

        $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Added', 'A dependant has been Added.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Dependant Added Successfully!!!');
    }

    /**
     * Remove the specified dependant from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Delete the dependent on the Person_has_person table
        Dependant::where('secondary_person_id', $id)->delete();
        
        // Delete the dependant on the person table
        Person::where('id', $id)->delete();

        $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Removed', 'A Dependant has been Deleted.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }
        
        // Redirect back with success message
        return redirect()->back()->withSuccess('Dependant Has Been Removed!');
    }

    /**
     * Display the main member for a given dependant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mainMember($id)
    {
        // Fetch the dependant along with the main person and their memberships
        $dependant = Dependant::with(['personMain.membership'])->findOrFail($id);

        // Check if main person and their membership exist
        if ($dependant->personMain && $dependant->personMain->membership) {
            // Assuming we want the first membership's ID
            $mainMemberId = $dependant->personMain->membership->first()->id;

            // You can redirect or perform other actions based on the main member's ID
            // Redirect to a specific route, for example
            return redirect()->route('edit-member', ['id' => $mainMemberId]);
        } else {
            // Handle cases where the main person or their memberships do not exist
            return redirect()->back()->with('error', 'No main member found for this dependant.');
        }
    }
}
