<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Notifications\PersonStatusNotification;

class PaymentController extends Controller
{
    //
    public function index(Request $request)
    {
        $banks = DB::connection('mysql')->table('bank')->where('blocked', false)->orderBy('name')->get();
        //dd($banks);
        $branchCodes = DB::connection('mysql')->table('bank_branch')->get();
        //dd($branchCodes);
        $accountTypes = DB::connection('mysql')->table('bank_account_type')->get();
        $searchTerm = $request->search;
        $memberships = Membership::where('membership_code', 'LIKE', "%{$searchTerm}%")
            ->orWhere('id_number', 'LIKE', "%{$searchTerm}%")
            ->orWhere('name', 'LIKE', "%{$searchTerm}%")
            ->get();

        // Fetch memberships and their payments. Assuming each membership is linked to a subscription payment via `subscription_invoice_id`
        $membershipsBillings = DB::connection('mysql')->table('subscription_payments')->select('id', 'subscription_invoice_id', 'amount_paid', 'payment_date')->orderBy('payment_date', 'desc')->get();

        return view('payments.index', compact('banks', 'accountTypes', 'branchCodes', 'memberships', 'membershipsBillings'));
    }

    //
    public function search(Request $request)
    {
        $banks = DB::connection('mysql')->table('bank')->get();
        $branchCodes = DB::connection('mysql')->table('bank_branch')->get();
        $accountTypes = DB::connection('mysql')->table('bank_account_type')->get();

        $searchTerm = $request->search;

        $memberships = Membership::where('membership_code', 'LIKE', "%{$searchTerm}%")
            ->orWhere('id_number', 'LIKE', "%{$searchTerm}%")
            ->orWhere('name', 'LIKE', "%{$searchTerm}%")
            ->get();

        // Fetch memberships and their payments. Assuming each membership is linked to a subscription payment via `subscription_invoice_id`
        $membershipsBillings = DB::connection('mysql')->table('subscription_payments')->select('id', 'subscription_invoice_id', 'amount_paid', 'payment_date')->orderBy('payment_date', 'desc')->get();

        return view('payments.index', compact('banks', 'accountTypes', 'branchCodes', 'memberships', 'membershipsBillings'));
    }
}
