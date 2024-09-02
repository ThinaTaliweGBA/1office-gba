<?php
namespace App\Services\GBA;

use Illuminate\Http\Request; 
use App\Models\Membership;
use App\Models\MembershipAddress;
use Carbon\Carbon;
use Log;

class MembershipService
{
    public function createMembership(Request $request, $personId, $addressId)
    {
        $membership = new Membership();
        $membership->membership_code = $request->membership_id; // Adjust according to actual field
        $membership->name = $request->first_name; // Assuming you want to use the main person's name
        $membership->initials = $request->initials;
        $membership->surname = $request->last_name;
        $membership->id_number = $request->id_number;

        $membership->join_date = $request->join_date;
        $membership->end_date = $request->end_date;
        // $membership->end_reason = $request->xxx;

        $membership->gender_id = $request->gender_id;
        $membership->bu_id = 7;
        $membership->language_id  = 1;
        $membership->bu_membership_type_id = $request->bu_membership_type_id;
        $membership->bu_membership_region_id = $request->bu_membership_region_id;
        $membership->bu_membership_status_id = $request->bu_membership_status_id; 
        $membership->person_id = $personId;

        // $membership->previous_membership_id = $request->xxx;
        
        $membership->primary_contact_number = $request->primary_contact_number;
        $membership->secondary_contact_number = $request->secondary_contact_number;
        $membership->tertiary_contact_number = $request->tertiary_contact_number;

        $membership->primary_e_mail_address = $request->primary_e_mail_address;
        $membership->secondary_e_mail_address = $request->secondary_e_mail_address;
        $membership->preferred_payment_method_id = $request->payment_method_id;

        // $membership->membership_fee = $request->membership_fee;

        $membership->fee_currency_id = 149; // Assuming static
        $membership->last_payment_date = $request->last_payment_date;
        $membership->paid_till_date = $request->paid_till_date;
        
        $membership->save();
        Log::info("Membership created: {$membership->id}");

        // Create a MembershipAddress association (Membership Has Address)
        $this->createMembershipAddress($membership->id, $addressId);

        return $membership;
    }

    private function createMembershipAddress($membershipId, $addressId)
    {
        // Membership Has Address
        $membershipAddress = new MembershipAddress([
            'membership_id' => $membershipId,
            'address_id' => $addressId,
            'adress_type_id' => 1, // 1 = Residential
            'start_date' => Carbon::today(), // Carbon today
        ]);
        $membershipAddress->save();
        Log::info("Membership address created for membership ID {$membershipId}");
    }
}
