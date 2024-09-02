<?php

namespace App\Http\Controllers;

use App\Models\MembershipHasAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembershipHasAddressController extends Controller
{

     public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $address = MembershipHasAddress::findOrFail($id);
            // Optionally, ensure the address belongs to the correct membership before deleting
            // if ($address->membership_id !== $desiredMembershipId) {
            //     abort(403, 'Unauthorized action.');
            // }

            // Delete the address record
            $address->delete();

            // Add any additional business logic here if necessary
            // For example, logging the deletion, sending notifications, etc.
        });

        // Redirect back with success message
        return back()->withSuccess('Address has been removed successfully!');
    }
}
