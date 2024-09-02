<?php
/**
 * 
 */
namespace App\Http\Controllers\Auth;

use App\Actions\StoreAddress;
use App\Actions\StorePerson;
use App\Http\Requests\StorePersonRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\MarriageStatus;
use App\Models\BuGender;
use App\Models\Gender;
use App\Models\Country;
use Illuminate\Support\Facades\Log; 

use App\Services\GBA\PersonService;

use Spatie\WelcomeNotification\WelcomeController as BaseWelcomeController;
use Symfony\Component\HttpFoundation\Response;

class MyWelcomeController extends BaseWelcomeController
{
    protected $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function showAddUserInfoForm()
    {

        $marriedStatuses = MarriageStatus::all();
        $buGenders = BuGender::all();
        $genders = Gender::all();
        $countries = Country::all();
        
         return view('auth.onboarding', compact('marriedStatuses', 'buGenders', 'genders', 'countries')); 
    }


    public function saveUserInfo(Request $request, User $user, StoreAddress $storeAddress)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'initials' => 'required|string|max:10',
            'screen_name' => 'required|string|max:255',
            'id_number' => 'required|string|max:45',
            'birth_date' => 'required|date',
            'married_status' => 'required|string',
            'gender_id' => 'required',
            'residence_country_id' => 'required|integer',
            'Line1' => 'nullable|string|max:255',
            'Line2' => 'nullable|string|max:255',
            'TownSuburb' => 'nullable|string|max:255',
            'City' => 'nullable|string|max:255',
            'Province' => 'nullable|string|max:255',
            'PostalCode' => 'nullable|string|max:10',
            'Country' => 'nullable|string|max:255',
        ];

        try {
            $validatedData = $request->validate($rules);

            // Use the PersonService to handle the person creation
            $person = $this->personService->createPerson($request, '');

            // Address
            $address = $storeAddress->handle((object) $request->all());

            $user->person_id = $person->id;
            $user->save();

            // Redirect user based on role
            if ($request->user()->hasAnyRole(['super-admin', 'admin'])) {
                return redirect(route('admin.home'));
            }

            return redirect()->intended(RouteServiceProvider::HOME);
        } catch (ValidationException $e) {
            // Log validation errors
            Log::error('Validation failed:', $e->errors());

            // Redirect back with errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Log any other errors
            Log::error('An error occurred:', ['message' => $e->getMessage()]);

            // Redirect back with a general error message
            return redirect()->back()->with('error', 'An error occurred while saving your information. Please try again.');
        }
    }

}