<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Dependent;
use App\Models\Person;
use App\Models\PersonHasPerson;

use App\Actions\StoreAddress;
use App\Models\MembershipAddress;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\Funeral;
use App\Models\PersonHasFuneral;
use App\Models\FuneralChecklistItems;
use Illuminate\Support\Facades\Auth;

use App\Models\Transactions;
use App\Models\TransactionType;
use App\Models\FuneralHasTransactions;
use App\Models\FuneralCosts;
use App\Models\PersonHasAddress;
use App\Models\PersonBankDetails;
use App\Models\BankAccountType;
use App\Models\FuneralHasPayout;



// Copied from Death
use App\Models\Gender;
use App\Models\MarriageStatus;
use App\Models\Language;
use App\Models\PersonDetail;
use App\Models\DeathReporter;


use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FuneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all funerals with related person (deceased)
        $funerals = Funeral::with('person')->get();


        //death recording
        $memberships = Membership::with([
            'person.dependants.personDep', 
            'person.dependants.relationshipType', 
            'person'
        ])->whereHas('person', function ($query) {
            $query->where('deceased', 0);
        })->get();
        //dd($memberships);
        $genders = Gender::whereHas('buGenders', function ($query) {
            $query->where('bu_id', Auth::user()->currentBu()->id ?? 7);
        })->get();
        $maritalStatuses = MarriageStatus::all();
        $languages = Language::all(); 
      
        return view('funerals.index', compact('funerals','memberships', 'genders', 'maritalStatuses', 'languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
     //  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      

        // $funeral_transactions = new FuneralHastansactions();
        // $funeral_transactions->funeral_id = $funeral->id;
        // $funeral_transactions->funeral_id = $funeral->id;
        
        // $funeral_transactions->save();



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //this is how you get the employee id of currently logged in person
        // dd(Auth::user()->person->employee->id);
    
        // Fetch the funeral using the funeral ID
        $funeral = Funeral::findOrFail($id);
    
        // Get the related person (deceased) from the funeral
        $deceased_person = $funeral->person;
    
        //The addresses the person has/had of type (Residential)
        $addresses = $deceased_person->addressesWithType(1);
    
        $bank_account_types = BankAccountType::all();
    
        // Fetch the 'Church' address type ID
        $churchTypeId = AddressType::where('name', 'Church')->first()->id ?? null;
    
        // Fetch the 'Graveyard' address type ID
        $graveyardTypeId = AddressType::where('name', 'Graveyard')->first()->id ?? null;
    
        // Fetch the 'Viewing' address type ID
        $viewingTypeId = AddressType::where('name', 'Viewing')->first()->id ?? null;
    
        // Fetch all addresses with the 'Church' type ID
        $churches = Address::where('adress_type_id', $churchTypeId)->get();
        
        // Fetch all addresses with the 'Graveyard' type ID
        $graveyards = Address::where('adress_type_id', $graveyardTypeId)->get();
    
        // Fetch all addresses with the 'Viewing' type ID
        $viewinglocations = Address::where('adress_type_id', $viewingTypeId)->get();
    
        $banks = DB::connection('mysql')->table('bank')->get();
    
        // Fetch checklist items sorted by the 'sequence' column and filter by 'bu_id'
        $checklist_items = FuneralChecklistItems::where('bu_id', Auth::user()->currentBu()->id)
        ->orderBy('sequence')
        ->get();
    
        // Fetch shortfall transactions with specific transaction type
        $shortfall_transactions = FuneralHasTransactions::where('funeral_id', $id)
            ->where('transaction_type_id', 4) // Assuming 4 is the ID for "Funeral Contribution"
            ->with(['transaction']) // Assuming relationships are defined
            ->get();
    
        // Fetch the funeral payouts with relationships
        $funeral_payouts = FuneralHasPayout::with(['person.bankDetails', 'address.country', 'address.addressType', 'funeralHasTransactions'])
            ->where('funeral_id', $id)
            ->get();
    
        $memberships = Membership::with([
            'person.dependants.personDep', 
            'person.dependants.relationshipType', 
            'person'
        ])->get();
    
        // Fetch the funeral costs with their related transactions
        $funeral_costs = FuneralCosts::where('bu_id', Auth::user()->currentBu()->id)
            ->where('transaction_type_id', 3)
            ->with(['transactions' => function ($query) use ($id) {
                $query->where('funeral_id', $id)->with('transaction');
            }])
            ->get();    
    
        return view('funerals.edit', compact('churches','graveyards','memberships', 'banks', 'deceased_person', 'funeral','checklist_items', 'viewinglocations','churchTypeId','graveyardTypeId', 'viewingTypeId', 'addresses',
        'funeral_costs', 'bank_account_types', 'funeral_payouts', 'shortfall_transactions'));
    }
    

    public function removeFuneralBeneficiary(Request $request)
    {
        try {
            DB::beginTransaction();

            // Find and delete the related records
            $beneficiary = Person::findOrFail($request->beneficiary_id);
            $funeralHasTransaction = FuneralHasTransactions::where('transactions_id', $request->transaction_id)->first();
            $funeralHasPayout = FuneralHasPayout::where('funeral_id', $request->funeral_id)->where('person_id', $request->beneficiary_id)->first();

            if ($funeralHasPayout) {
                $funeralHasPayout->delete();
            }

            if ($funeralHasTransaction) {
                $funeralHasTransaction->delete();
            }

            $beneficiary->delete();

            DB::commit();

            return response()->json(['success' => 'Beneficiary removed successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to remove beneficiary.'], 500);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



    public function handleFuneralAction(Request $request)
    {
        if ($request->action == 'submitActionOne') {
            return $this->submitActionOne($request);
        } elseif ($request->action == 'submitActionTwo') {
            return $this->submitActionTwo($request);
        }
        // Handle other actions or default case
    }


    
    protected function submitActionOne(Request $request)
    {
        Log::info('Starting submitActionOne transaction.');
        Log::info('Received data for submitActionOne:', $request->all());
    
        DB::beginTransaction(); // Start the transaction
    
        try {
            // Create a new instance of Funeral or update an existing one
            $funeral = $request->has('funeral_id') ? Funeral::findOrFail($request->funeral_id) : new Funeral();
    
            // Assign fields from the request to the model
            $funeral->person_id = $request->person_id;
            $funeral->bu_id = Auth::user()->currentBu()->id;
            $funeral->person_name = $request->person_name;
    
            $burialDateTime = $request->burial_date . ' ' . $request->burial_time;
            $funeral->burial_date = \Carbon\Carbon::parse($burialDateTime)->format('Y-m-d H:i:s');
    
            $funeral->church_name = Address::where('id', $request->churchSelect)->first()->name ?? null;
            $funeral->church_address_id = $request->churchSelect;
            $funeral->graveyard_name = Address::where('id', $request->graveyardSelect)->first()->name ?? null;
            $funeral->grave_address_id = $request->graveyardSelect;
            $funeral->grave_number = $request->grave_number;
            $funeral->funeral_notices = $request->funeral_notices;
            $funeral->viewing_time = \Carbon\Carbon::parse($request->viewing_time)->format('Y-m-d H:i:s');
            $funeral->viewing_address_id = $request->viewing_location;
    
            $funeral->arranging_employee_id = $request->arranging_employee_id; // TODO - create a dropdown with all employees in the bu and Get this from the a dropdown to select and prompt user to enter password for the selected user
            $funeral->executing_employee_id = Auth::user()->person->employee->id;
    
            $funeral->checklist_notes = $request->checklist_notes;
            $funeral->preacher = $request->burial_person;
            $funeral->caretaker = $request->church_caretaker;
            $funeral->organist = $request->organist;
            $funeral->graveyard_section = $request->graveyard_section;
            $funeral->coffin = $request->coffin;
    
            // Save the funeral record
            $funeral->save();
    
            DB::commit(); // If everything went well, commit the transaction
    
            Log::info('All data processed.');
            return redirect()->route('funerals.edit', ['id' => $funeral->id])->with('success', 'Funeral details have been added successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back on any error
            Log::error('Error in submitActionOne: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors('Error while saving funeral: ' . $e->getMessage());
        }
    }
    
    
    
    
    

    protected function submitActionTwo(Request $request)
    {
        dd('Handling Submit Action Two', $request->all());
    }


    public function updateFuneralRequired(Request $request)
    {
        $request->validate([
            'funeral_id' => 'required|exists:funeral,id',
            'funeral_required' => 'required|boolean',
        ]);

        try {
            $funeral = Funeral::findOrFail($request->funeral_id);
            $funeral->funeral_required = $request->funeral_required;
            $funeral->save();

            return response()->json(['success' => true, 'message' => 'Funeral required status updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update funeral required status.']);
        }
    }


    public function updateChecklistItem(Request $request, $id)
    {
        $item = FuneralCheck::find($id);
        
        if (!$item) {
            $item = new FuneralCheck;
        }

        $item->funeral_id = $request->funeral_id;
        $item->funeral_checklist_id = $request->input('funeral_checklist_id');
        $item->bu_id = Auth::user()->currentBu()->id;
        $item->completed_date = $request->input('completed_date');
        $item->completed_time = $request->input('completed_time');
        $item->note = $request->input('note');
        $item->save();

        return response()->json(['success' => true]);
    }

    protected function StoreFuneralAddress(Request $request, StoreAddress $storeAddress)
    {
        Log::info('Starting StoreFuneralAddress transaction.');
    
        DB::beginTransaction(); // Start the transaction
    
        try {
            // Log the incoming request data
            Log::info('Received data for StoreFuneralAddress:', $request->all());
    
            // Address Action Method injection
            $address = $storeAddress->handle($request);
            Log::info('Address handle method executed.');
    
            if (!$address) {
                Log::error('Address creation failed, address object is null.');
                throw new \Exception("The address could not be saved.");
            }
    
            // Ensure address type is loaded to include in the response
            $address->load('addressType');
            Log::info('Address type loaded.', ['addressTypeId' => $address->adress_type_id]);
    
            if (!$address->addressType) {
                Log::error('Failed to load address type details.');
                throw new \Exception("Failed to load address type.");
            }
    
            DB::commit(); // Commit the transaction if everything is okay
            Log::info('Transaction committed successfully.');
    
            // Return a detailed response for the frontend
            return response()->json([
                'id' => $address->id,
                'name' => $address->name,
                'suburb' => $address->suburb,
                'city' => $address->city,
                'line1' => $address->line1,
                'ZIP' => $address->ZIP,
                'type' => $address->addressType->name
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction on error
            Log::error('Transaction rolled back due to an error.', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json(['error' => 'Failed to store address', 'message' => $e->getMessage()], 500);
        }
    }

    public function storeFuneralShortfall(Request $request)
    {
        Log::info('Starting storeFuneralShortfall transaction.', ['request' => $request->all()]);
        
        try {
            DB::beginTransaction();
    
            // Check if we are updating an existing transaction or creating a new one
            if ($request->has('shortfall_id') && $request->shortfall_id) {
                $transaction = Transactions::findOrFail($request->shortfall_id);
                Log::info('Updating existing transaction.', ['transaction_id' => $transaction->id]);
            } else {
                // Fetch the transaction_id using the relationship if not provided
                $funeral_has_transaction = FuneralHasTransactions::where('funeral_id', $request->funeral_id)
                    ->where('transactions_id', $request->transaction_id)
                    ->first();
                Log::info('Checked for existing funeral_has_transaction.', ['funeral_has_transaction' => $funeral_has_transaction]);
    
                if ($funeral_has_transaction) {
                    $transaction = $funeral_has_transaction->transaction;
                    Log::info('Found existing transaction via relationship.', ['transaction_id' => $transaction->id]);
                } else {
                    // Create a new transaction if not found
                    $transactionType = TransactionType::where('name', 'Funeral Contribution')->first();
                    if (!$transactionType) {
                        Log::error('Transaction type "Funeral Contribution" not found.');
                        throw new \Exception('Transaction type "Funeral Contribution" not found.');
                    }
    
                    $transaction = new Transactions();
                    $transaction->bu_id = Auth::user()->currentBu()->id;
                    $transaction->transaction_type_id = $transactionType->id;
                    $transaction->transaction_date =  $request->shortfall_time_of_payment;
                    $transaction->transaction_qty = 1;
                    $transaction->created_employee_id = Auth::user()->person->employee->id;
                    Log::info('Creating new transaction.', ['transaction' => $transaction]);
                }
            }
    
            // Update transaction fields
            $transaction->transaction_description = $request->shortfall_payment_name;
            $transaction->transaction_document_reference = $request->shortfall_payment_reference;
            $transaction->transaction_local_value = $request->shortfall_amount;
            //TODO: Asked KVK to add this to table: 
            //$transaction->payment_method_id = $request->ShortfallPaymentMethodSelect;
            $transaction->transaction_date = $request->shortfall_time_of_payment;
            //TODO: Asked KVK to add
            // $transaction->bank_id = $request->ShortfallbankSelect; 
            $transaction->membership_id = $request->membership_id;
            // $transaction->funeral_id = $request->funeral_id;
            $transaction->last_updated_employee_id = Auth::user()->person->employee->id;
            $transaction->save();
            Log::info('Transaction saved.', ['transaction_id' => $transaction->id]);
    
            // Update or create Funeral Has Transaction
            $funeral_has_transaction = FuneralHasTransactions::where('transactions_id', $transaction->id)->first();
            if (!$funeral_has_transaction) {
                $funeral_has_transaction = new FuneralHasTransactions();
                $funeral_has_transaction->bu_id = Auth::user()->currentBu()->id;
                $funeral_has_transaction->funeral_id = $request->funeral_id;
                $funeral_has_transaction->transactions_id = $transaction->id; // Use the saved transaction's ID
                Log::info('Creating new FuneralHasTransactions.', ['funeral_has_transaction' => $funeral_has_transaction]);
            }
            $funeral_has_transaction->transaction_local_value = $request->shortfall_amount;
            $funeral_has_transaction->transaction_name = $request->shortfall_payment_name;
            $funeral_has_transaction->transaction_date = $transaction->transaction_date;
            $funeral_has_transaction->funeral_costs_id = FuneralCosts::where('name', 'Funeral Contribution')->first()->id;
            $funeral_has_transaction->transaction_type_id = $transaction->transaction_type_id;
            $funeral_has_transaction->transaction_qty = 1;
            $funeral_has_transaction->save();
            Log::info('FuneralHasTransactions saved.', ['funeral_has_transaction_id' => $funeral_has_transaction->id]);
    
            DB::commit();
            Log::info('Transaction committed successfully.');
            return redirect()->route('funerals.edit', ['id' => $request->funeral_id])->with('success', 'Payment has been saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaction rolled back due to an error.', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json(['error' => 'Failed to save payment.', 'message' => $e->getMessage()], 500);
        }
    }
    
    
    
    
    
    
    public function removeShortfallPayment(Request $request)
    {
        try {
            $transaction = Transactions::findOrFail($request->transaction_id);
            $funeralHasTransaction = FuneralHasTransactions::where('transactions_id', $transaction->id)->first();
    
            if ($funeralHasTransaction) {
                $funeralHasTransaction->delete();
            }
    
            $transaction->delete();
    
            return response()->json(['success' => 'Payment removed successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to remove payment.', 'message' => $e->getMessage()], 500);
        }
    }
    
    
    
    
    
    
    // protected function StoreFuneralBeneficiary(Request $request, StoreAddress $storeAddress)
    // {
    //     Log::info('Starting StoreFuneralBeneficiary transaction.');

    //     // Log the incoming request data
    //     Log::info('Received data for StoreFuneralBeneficiary:', $request->all());
    

    //     DB::beginTransaction(); // Start the transaction
    
    //     try {
           
    //         //Funeral id here:



    //         //Now we store the beneficiary

    //         //Beneficiary Person
    //         $beneficary_person = new Person();
    //         $beneficary_person->first_name =$request->beneficiary_name;
    //         $beneficary_person->initials =ucfirst(substr($request->beneficiary_name, 0, 1)) . '.' . ucfirst(substr($request->beneficiary_surname, 0, 1));
    //         $beneficary_person->last_name =$request->beneficiary_surname;
    //         $beneficary_person->save();
            
    //         //Beneficiary address
    //         // Address Action Method injection
    //         $beneficary_address = $storeAddress->handle($request);
    //         Log::info('Address handle method executed.');
    
    //         //Person Has Address
    //         if ($beneficary_address){
    //             $beneficary_has_address = new PersonHasAddress();
    //             $beneficary_has_address->person_id = $beneficary_person->id;
    //             $beneficary_has_address->address_id = $beneficary_address->id;
    //             $beneficary_has_address->adress_type_id  = $request->addressType;
    //             $beneficary_has_address->save();
    //         } 
    //         else
    //         {
    //             Log::error('Address creation failed, address object is null.');
    //             throw new \Exception("The address could not be saved.");
    //         }

    //         // Check if the cash_payment checkbox is checked
    //         $isCashPayment = $request->has('cash_payment') && $request->input('cash_payment') === 'on' ? true : false;
    
    //         if(!$isCashPayment){
    //             //If isCashpayment is false save Payment Bank Details
    //             $beneficary_bank_details = new PersonBankDetails();
    //             $beneficary_bank_details->person_id = $beneficary_person->id;
    //             // $beneficary_bank_details->bank_branch_id  =  ;
    //             $beneficary_bank_details->bank_account_type_id = $request->bank_account_type_id;
    //             // $beneficary_bank_details->account_name = $request->;
    //             $beneficary_bank_details->universal_branch_code = $request->universal_branch_code;
    //             $beneficary_bank_details->account_number = $request->payout_acc_number;
    //             $beneficary_bank_details->save();
    //         }   

    //         //Transaction
    //         $payout_transaction = new Transactions();
    //         $payout_transaction->bu_id  = Auth::user()->currentBu()->id;
    //         $payout_transaction->transaction_type_id = TransactionType::where('name', 'Membership Benefit Payment')->first()->id;
    //         $payout_transaction->transaction_date =Carbon::now();
    //         $payout_transaction->transaction_qty = 1;
    //         $payout_transaction->transaction_local_value = $request->payout_amount;
    //         $payout_transaction->created_employee_id  = Auth::user()->person->employee->id;
    //         $payout_transaction->last_updated_employee_id  =Auth::user()->person->employee->id;
    //         $payout_transaction->save();


    //         //Funeral Has Transaction
    //         $payout_funeral_has_transactions = new FuneralHasTransactions();
    //         $payout_funeral_has_transactions->bu_id  = Auth::user()->currentBu()->id;
    //         $payout_funeral_has_transactions->funeral_id  = $request->funeral_id;
    //         $payout_funeral_has_transactions->transactions_id  = $payout_transaction->id; // Use the saved transaction's ID
            
    //         //Todo:: ask KVK to add a funeral cost named 'Payout' 
    //         $payout_funeral_has_transactions->funeral_costs_id = FuneralCosts::where('name', 'Payout')->first()->id;
            
    //         $payout_funeral_has_transactions->transaction_type_id = $payout_transaction->transaction_type_id;
    //         $payout_funeral_has_transactions->transaction_qty = 1; // Assuming 1 as in the previous transaction
    //         $payout_funeral_has_transactions->transaction_name  = $request->beneficiary_name . ' '. $request->beneficiary_surname ?? null;
    //         $payout_funeral_has_transactions->transaction_local_value  = $request->payout_amount;
    //         $payout_funeral_has_transactions->transaction_date  = $payout_transaction->transaction_date;
    //         $payout_funeral_has_transactions->save();



    //         //Funeral_has_payout
    //         $funeral_has_payout = new FuneralHasPayout();
    //         $funeral_has_payout->funeral_id   = $request->funeral_id;
    //         $funeral_has_payout->person_id  = $beneficary_person->id;
    //         $funeral_has_payout->address_id  = $beneficary_address->id;
    //         $funeral_has_payout->funerals_has_transactions_id  = $payout_funeral_has_transactions->id ;
    //         $funeral_has_payout->person_bank_details_id  = $request->has('cash_payment') && $request->input('cash_payment') === 'on' ? $beneficary_bank_details->id : null;
    //         $funeral_has_payout->cash_payout  = $request->has('cash_payment') && $request->input('cash_payment') === 'on' ? 1 : 0;
    //         $funeral_has_payout->transaction_local_value  = $request->payout_amount;
    //         $funeral_has_payout->save();


    
            
    //         DB::commit(); // Commit the transaction if everything is okay
    //         Log::info('Transaction committed successfully.');
    
    //         // Return
    //         return redirect()->route('funerals.edit')->with('success', 'Payout/Beneficiary have been added successfully.');
    //     } catch (\Exception $e) {
    //         DB::rollBack(); // Roll back the transaction on error
    //         Log::error('Transaction rolled back due to an error.', [
    //             'error' => $e->getMessage(),
    //             'file' => $e->getFile(),
    //             'line' => $e->getLine()
    //         ]);
    //         return response()->json(['error' => 'Failed to store FuneralBeneficiary', 'message' => $e->getMessage()], 500);
    //     }
    // }
    
    protected function StoreFuneralBeneficiary(Request $request, StoreAddress $storeAddress)
    {
        // dd($request->all()); // Dump and die to see the request data

        Log::info('Starting StoreFuneralBeneficiary transaction.');
    
        // Log the incoming request data
        Log::info('Received data for StoreFuneralBeneficiary:', $request->all());
    
        DB::beginTransaction(); // Start the transaction
    
        try {
            $beneficary_person = null;
            $beneficary_address = null;
            $beneficary_bank_details = null;
            $payout_transaction = null;
            $payout_funeral_has_transactions = null;
            $funeral_has_payout = null;
    
            // Check if we are updating an existing beneficiary
            if ($request->has('beneficiary_id') && $request->beneficiary_id) {
                $beneficary_person = Person::findOrFail($request->beneficiary_id);
            } else {
                $beneficary_person = new Person();
            }
    
            // Update or create beneficiary person
            $beneficary_person->first_name = $request->beneficiary_name;
            $beneficary_person->initials = ucfirst(substr($request->beneficiary_name, 0, 1)) . '.' . ucfirst(substr($request->beneficiary_surname, 0, 1));
            $beneficary_person->last_name = $request->beneficiary_surname;
            $beneficary_person->save();
    
            // Update or create beneficiary address
            $beneficary_address = $storeAddress->handle($request);
            Log::info('Address handle method executed.');
    
            // Update or create Person Has Address
            $beneficary_has_address = PersonHasAddress::where('person_id', $beneficary_person->id)->first();
            if (!$beneficary_has_address) {
                $beneficary_has_address = new PersonHasAddress();
                $beneficary_has_address->person_id = $beneficary_person->id;
            }
            $beneficary_has_address->address_id = $beneficary_address->id;
            $beneficary_has_address->adress_type_id = $request->addressType;
            $beneficary_has_address->save();
    
            // Check if the cash_payment checkbox is checked
            $isCashPayment = $request->has('cash_payment') && $request->input('cash_payment') === 'on' ? true : false;
    
            if (!$isCashPayment) {
                // Update or create Payment Bank Details
                $beneficary_bank_details = PersonBankDetails::where('person_id', $beneficary_person->id)->first();
                if (!$beneficary_bank_details) {
                    $beneficary_bank_details = new PersonBankDetails();
                    $beneficary_bank_details->person_id = $beneficary_person->id;
                }
                $beneficary_bank_details->bank_account_type_id = $request->bank_account_type_id;
                $beneficary_bank_details->universal_branch_code = $request->universal_branch_code;
                $beneficary_bank_details->account_number = $request->payout_acc_number;
                $beneficary_bank_details->save();
            }
    
            // Check if we are updating an existing transaction or creating a new one
            if ($request->has('transaction_id') && $request->transaction_id) {
                $payout_transaction = Transactions::findOrFail($request->transaction_id);
            } else {
                // Fetch the transaction_id using the relationship if not provided
                $funeral_has_transaction = FuneralHasTransactions::where('funeral_id', $request->funeral_id)
                    ->where('transaction_name', 'LIKE', $request->beneficiary_name . ' ' . $request->beneficiary_surname)
                    ->first();
                if ($funeral_has_transaction) {
                    $payout_transaction = Transactions::findOrFail($funeral_has_transaction->transactions_id);
                } else {
                    // Create a new transaction if not found
                    $payout_transaction = new Transactions();
                    $payout_transaction->bu_id = Auth::user()->currentBu()->id;
                    $payout_transaction->transaction_type_id = TransactionType::where('name', 'Membership Benefit Payment')->first()->id;
                    $payout_transaction->transaction_date = Carbon::now();
                    $payout_transaction->transaction_qty = 1;
                    $payout_transaction->created_employee_id = Auth::user()->person->employee->id;
                }
            }
            $payout_transaction->transaction_local_value = $request->payout_amount;
            $payout_transaction->last_updated_employee_id = Auth::user()->person->employee->id;
            $payout_transaction->save();
    
            // Update or create Funeral Has Transaction
            $payout_funeral_has_transactions = FuneralHasTransactions::where('transactions_id', $payout_transaction->id)->first();
            if (!$payout_funeral_has_transactions) {
                $payout_funeral_has_transactions = new FuneralHasTransactions();
                $payout_funeral_has_transactions->bu_id = Auth::user()->currentBu()->id;
                $payout_funeral_has_transactions->funeral_id = $request->funeral_id;
                $payout_funeral_has_transactions->transactions_id = $payout_transaction->id; // Use the saved transaction's ID
            }
            $payout_funeral_has_transactions->transaction_local_value = $request->payout_amount;
            $payout_funeral_has_transactions->transaction_name = $request->beneficiary_name . ' ' . $request->beneficiary_surname ?? null;
            $payout_funeral_has_transactions->transaction_date = $payout_transaction->transaction_date;
            $payout_funeral_has_transactions->funeral_costs_id = FuneralCosts::where('name', 'Payout')->first()->id;
            $payout_funeral_has_transactions->transaction_type_id = $payout_transaction->transaction_type_id;
            $payout_funeral_has_transactions->transaction_qty = 1;
            $payout_funeral_has_transactions->save();
    
            // Update or create Funeral_has_payout
            $funeral_has_payout = FuneralHasPayout::where('funeral_id', $request->funeral_id)->where('person_id', $beneficary_person->id)->first();
            if (!$funeral_has_payout) {
                $funeral_has_payout = new FuneralHasPayout();
                $funeral_has_payout->funeral_id = $request->funeral_id;
                $funeral_has_payout->person_id = $beneficary_person->id;
            }
            $funeral_has_payout->address_id = $beneficary_address->id;
            $funeral_has_payout->funerals_has_transactions_id = $payout_funeral_has_transactions->id;
            $funeral_has_payout->person_bank_details_id = !$isCashPayment ? $beneficary_bank_details->id : null;
            $funeral_has_payout->cash_payout = $isCashPayment ? 1 : 0;
            $funeral_has_payout->transaction_local_value = $request->payout_amount;
            $funeral_has_payout->save();
    
            DB::commit(); // Commit the transaction if everything is okay
            Log::info('Transaction committed successfully.');
    
            // Return
            return redirect()->route('funerals.edit', ['id' => $request->funeral_id])->with('success', 'Payout/Beneficiary have been saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back the transaction on error
            Log::error('Transaction rolled back due to an error.', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json(['error' => 'Failed to save FuneralBeneficiary', 'message' => $e->getMessage()], 500);
        }
    }
    
    
    
    
    
    
    

    
    protected function StoreFuneralCosts(Request $request)
    {
        Log::info('Starting StoreFuneralCosts transaction.');
        Log::info('Received data for StoreFuneralCosts:', $request->all());
    
        DB::beginTransaction(); // Start the transaction
    
        try {
            $transactionType = TransactionType::where('name', 'Funeral Costs')->first();
            if (!$transactionType) {
                throw new \Exception('Transaction type "Funeral Costs" not found.');
            }
    
            foreach ($request->costs as $costId => $amount) {
                $costName = $request->cost_names[$costId];
    
                // Check if a transaction already exists for this cost
                $funeral_has_transaction = FuneralHasTransactions::where('funeral_id', $request->funeral_id)
                    ->where('funeral_costs_id', $costId)
                    ->first();
    
                if ($funeral_has_transaction) {
                    // Update the existing transaction
                    $transaction = Transactions::find($funeral_has_transaction->transactions_id);
                    $transaction->transaction_local_value = $amount;
                    $transaction->transaction_description = $costName;
                    $transaction->last_updated_employee_id = Auth::user()->person->employee->id;
                    $transaction->save();
    
                    // Update the funeral_has_transactions record
                    $funeral_has_transaction->transaction_local_value = $amount;
                    $funeral_has_transaction->transaction_name = $costName;
                    $funeral_has_transaction->save();
                } else {
                    // Create a new transaction
                    $transaction = new Transactions();
                    $transaction->bu_id = Auth::user()->currentBu()->id;
                    $transaction->transaction_type_id = $transactionType->id;
                    $transaction->transaction_date = Carbon::now();
                    $transaction->transaction_qty = 1;
                    $transaction->transaction_local_value = $amount;
                    $transaction->transaction_description = $costName; // Save cost name as transaction description
                    $transaction->created_employee_id = Auth::user()->person->employee->id;
                    $transaction->last_updated_employee_id = Auth::user()->person->employee->id;
                    $transaction->save();
    
                    // Link each transaction to the funeral
                    $funeral_has_transaction = new FuneralHasTransactions();
                    $funeral_has_transaction->bu_id = Auth::user()->currentBu()->id;
                    $funeral_has_transaction->transactions_id = $transaction->id; // Use the saved transaction's ID
                    $funeral_has_transaction->funeral_id = $request->funeral_id;
                    $funeral_has_transaction->funeral_costs_id = $costId; // Use the cost ID directly
                    $funeral_has_transaction->transaction_type_id = $transactionType->id;
                    $funeral_has_transaction->transaction_date = $transaction->transaction_date;
                    $funeral_has_transaction->transaction_qty = 1;
                    $funeral_has_transaction->transaction_local_value = $amount;
                    $funeral_has_transaction->transaction_name = $costName; // Store the name of the item
                    $funeral_has_transaction->save();
                }
            }
    
            DB::commit(); // If everything went well, commit the transaction
    
            Log::info('All data processed.');
            return redirect()->route('funerals.edit', ['id' => $request->funeral_id])->with('success', 'Funeral Costs have been added successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); // Roll back on any error
            Log::error('Error in StoreFuneralCosts: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors('Error while saving funeral costs: ' . $e->getMessage());
        }
    }
    
    
        /**
     * Fetch the updated checklist items.
     *
     * @param  string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchChecklistItems($id)
    {
        // Fetch checklist items sorted by the 'sequence' column and filter by 'bu_id'
        $checklist_items = FuneralChecklistItems::where('bu_id', Auth::user()->currentBu()->id)
            ->orderBy('sequence')
            ->get();

        // Return the checklist items as a JSON response
        return response()->json($checklist_items);
    }



    public function AddFuneralCost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        $funeralCost = new FuneralCosts();
        $funeralCost->bu_id = auth()->user()->currentBu()->id;
        $funeralCost->transaction_type_id = TransactionType::where('name', 'Funeral Costs')->first()->id;
        $funeralCost->name = $request->input('name');
        $funeralCost->description = $request->input('description');
        $funeralCost->save();

        return response()->json([
            'success' => true,
            'cost' => [
                'name' => $funeralCost->name,
                'description' => $funeralCost->description,
            ],
        ]);
    }
    
    

}
