<?php
namespace App\Http\Controllers;

use App\Models\MembershipBankDetail;
use App\Models\MembershipPaymentReceipt;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


use App\Models\User;
use App\Notifications\PersonStatusNotification;

class MembershipBankDetailController extends Controller
{
    public function saveBankDetails(Request $request)
    {
        $memberships = Membership::all();

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'membership_id' => 'required|integer',
            'bank_branch_id' => 'required|integer|exists:bank_branch,id',
            'bank_account_type_id' => 'required|integer',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'branch_code' => 'required|string|max:255',
            'debit_orders_per_year' => 'required|integer',
        ]);

        // Check if the membership_id exists in the membership table
        $membershipExists = Membership::find($request->membership_id);

        if (!$membershipExists) {
            return response()->json(['error' => 'Membership ID does not exist'], 422);
        }

        //dd($validator);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new instance of the model and save the data
        $bankDetail = new MembershipBankDetail([
            'membership_id' => $request->membership_id,
            'bank_branch_id' => $request->bank_branch_id,
            'bank_account_type_id' => $request->bank_account_type_id,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number,
            'branch_code' => $request->branch_code,
            // Add 'universal_branch_code' if your form includes it
            'membership_code' => $request->membership_code,
            'debit_orders_per_year' => $request->debit_orders_per_year,
            // 'created_at' and 'updated_at' will be automatically handled if using Eloquent
        ]);

        // Save the model
        // dd($bankDetail);
        $bankDetail->save();
        $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Debit Order Details', 'Debit order details saved successfully.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        // Return a response
        //return view('emptyPage')->with('success', 'Updated Successfully!!!!!');
        //return response()->json(['message' => 'Bank details saved successfully'], 200)->with('success', 'Updated Successfully!!!!!');
        return redirect()->back()->withSuccess('Bank details saved successfully');
    }

    public function saveCashPaymentDetails(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'membership_id' => 'required|integer',
            'transaction_date' => 'required|date',
            'transaction_description' => 'required|string',
            'receipt_number' => 'required|string',
            'receipt_value' => 'required|numeric',
            'currency_id' => 'required|integer',
            'bu_id' => 'required|integer',
            'transaction_type_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
        ]);

        $paymentReceipt = new MembershipPaymentReceipt($validatedData);
        $paymentReceipt->save();

            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Cash Payment', 'Cash payment made successfully.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }
        
        // Redirect or return a response after saving
        return redirect()->back()->withSuccess('Payment details saved successfully.');
    }

    public function saveDataViaDetails(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_description' => 'required|string|max:255',
            'receipt_number' => 'required|string|max:255',
            'receipt_value' => 'required|numeric',
            'membership_id' => 'required|integer',
            'transaction_date' => 'required|date',
            'currency_id' => 'required|integer',
            'bu_id' => 'required|integer',
            'transaction_type_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
            // Add validation rules for any additional fields
        ]);

         

        $paymentReceipt = new MembershipPaymentReceipt($validatedData);
        $paymentReceipt->save();
        //dd($paymentReceipt);

        $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Data-Via Payment', 'Data Via payment made successfully.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        return redirect()->back()->withSuccess('Data Via Payment Details Submitted Successfully');
    }

    public function saveEFTDetails(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'membership_id' => 'required|integer',
            'accountHolder' => 'required',
            'receipt_value' => 'required|numeric',
            'bankName' => 'required|string',
            'branchCode' => 'required|numeric',
            'transaction_description' => 'required|numeric',
            'bu_id' => 'required|integer',
            'transaction_type_id' => 'required|integer',
            'payment_method_id' => 'required|integer',
            'currency_id' => 'required|integer',
            'accountType' => 'required|string',
            'transaction_date' => 'required|date',
            'receipt_number' => 'required|string|max:255',
        ]);

        $paymentReceipt = new MembershipPaymentReceipt($validated);
        $paymentReceipt->save();
        //dd($paymentReceipt);

        $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('EFT Payment', 'EFT payment made successfully.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        return redirect()->back()->withSuccess('EFT Payment Details Submitted Successfully');
    }
}
