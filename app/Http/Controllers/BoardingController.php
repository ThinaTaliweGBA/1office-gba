<?php
namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Gender;
use App\Models\MarriageStatus;
use App\Models\Country;

class BoardingController extends Controller
{
    // public function create()
    // {
    //     $genders = Gender::all();
    //     $maritalStatuses = MarriageStatus::all();
    //     $countries = Country::all();
    //     return view('onboarding.create', compact('genders', 'maritalStatuses', 'countries'));
    // }

    // public function store(Request $request)
    // {
    //     //dd($request);
    //     $request->validate([
    //         'first_name' => 'required',
    //         'initials' => 'required',
    //         'last_name' => 'required',
    //         'screen_name' => 'required',
    //         'email' => 'required',
    //         'id_number' => 'required',
    //         'birth_date' => 'required|date',
    //         'married_status' => 'required|exists:marriage_status,id',
    //         'gender_id' => 'required|exists:gender,id',
    //         'residence_country_id' => 'required|exists:country,id',
    //     ]);

    //     $person = Person::create($request->all());

    //     User::create([
    //         'name' => $request->first_name . ' ' . $request->last_name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'person_id' => $person->id,
    //     ]);

    //     return redirect('/home')->with('success', 'User onboarded successfully.');
    // }
}
