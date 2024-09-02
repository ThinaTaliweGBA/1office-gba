<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Membership;
use App\Models\Dependent;
use App\Models\Dependents;
use App\Models\Person;
use App\Models\Gender;
use App\Models\MarriageStatus;
use App\Models\Language;
use App\Models\MembershipPaymentReceipt;

class DataController extends Controller
{
    public function getRowDetails(Request $request)
    {
        $memberships = Membership::all(); // Assuming you have a Membership model

        $query = MembershipPaymentReceipt::query();

        if ($request->filled('membership_id')) {
            $query->where('membership_id', $request->input('membership_id'));
        }

        if ($request->filled('start_date')) {
            $query->where('transaction_date', '>=', $request->input('start_date'));
        }

        if ($request->filled('end_date')) {
            $query->where('transaction_date', '<=', $request->input('end_date'));
        }

        // Paginate the results
        $payments = $query->paginate(10); // Adjust the number per page as necessary

        return view('rowDetails', [
            'payments' => $payments,
            'membership_id' => $request->input('membership_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'memberships' => $memberships,
        ]);
    }
}
