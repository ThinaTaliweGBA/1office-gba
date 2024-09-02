<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Actions\StoreAddress;
use App\Actions\StorePerson;
use App\Models\MembershipAddress;
use Carbon\Carbon;

use App\Models\User;
use App\Notifications\PersonStatusNotification;

class AddressController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $address = new Address();
        $address->name = $request->name;
        $address->save();

        return response()->json($address);
    }

    public function data(Request $request)
    {
        // Fetch all addresses from the database
        $addresses = Address::all(); // Make sure you have the Address model created and it is properly linked to your database table

        // Return the addresses as a JSON response
        return response()->json($addresses);
    }

    public function store(Request $request, StoreAddress $storeAddress)
    {
        //Address
        $address = $storeAddress->handle((object) $request->all());

        //Membership Has Address
        $membership_address = new MembershipAddress();
        $membership_address->membership_id = $request->MembershipId;
        $membership_address->address_id = $address->id;
        $membership_address->adress_type_id = 1; //1 = Residential
        $membership_address->start_date = Carbon::today(); //Carbon today

        $membership_address->save();

        $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Address Added', 'A new address has been added.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Membership Address Added Successfully!!!');
    }
}
