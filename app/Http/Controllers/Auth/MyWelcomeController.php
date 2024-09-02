<?php
/**
 * 
 */
namespace App\Http\Controllers\Auth;

use App\Actions\StoreAddress;
use App\Actions\StorePerson;
use App\Http\Requests\StorePersonRequest;
use App\Models\User;
use App\Models\UserHasBu;
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

    public function showAddUserInfoForm(User $user)
    {
        $marriedStatuses = MarriageStatus::all();
        
        $buGenders = BuGender::all();
        $genders = Gender::whereHas('buGenders', function ($query) {
            $query->where('bu_id', 7);
        })->get();
        $countries = Country::all();
    
        return view('auth.onboarding', compact('marriedStatuses',  'genders', 'countries', 'user'));
    }
    


    public function saveUserInfo(Request $request, User $user, StoreAddress $storeAddress)
    {
        try {
            // Use the PersonService to handle the person creation or retrieval
            $person = $this->personService->createPerson($request, '');

            // Address
            $address = $storeAddress->handle((object) $request->all());

            // Associate the user with the person, allowing multiple users per person
            $user->person_id = $person->id;
            $user->save();

            // Check if the user already has a UserHasBu record with bu_id = 7
            $userBuExists = UserHasBu::where('users_id', $user->id)
                                    ->where('bu_id', 7) // GBA hardcoded
                                    ->exists();

            if (!$userBuExists) {
                $userbu = new UserHasBu();
                $userbu->users_id = $user->id;
                $userbu->bu_id = 7; // GBA hardcoded
                $userbu->save();
            }

            return redirect('/home')->with('success', 'User onboarded successfully.');

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