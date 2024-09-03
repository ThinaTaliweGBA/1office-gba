@extends('layouts.app2')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font-awesome.min.css" rel="stylesheet">
@endpush
    <!--SIYA:: Block UI if user is not an employee -->
    <x-access-denied-modal />
@section('content')
    <div class="row rounded m-12">

        {{-- Start Search Results --}}
        <div class="card mt-4 p-4">
            {{-- Start Membership Search --}}
                <h1 class="text-center mb-2 p-2 text-dark">Membership Search</h1>
                <form action="{{ route('payments') }}" method="GET">
                    <div class="input-group mb-3">
                        <div class="d-flex flex-row" style="width: 100%;">
                            <div class="p-2 w-100">
                                <input type="text" name="search" class="form-control text-dark"
                                    placeholder="Enter Membership Code or ID number" aria-label="Membership ID or ID number"
                                    required>
                            </div>
                            <div class="p-2">
                                <button class="btn btn-outline-primary bg-success" type="submit">Search</button>
                            </div>
                        </div>
                    </div>

                </form>
            
            {{-- End Membership Search --}}

            @if (request()->has('search') && !empty($memberships))
                <h1 class="text-center mb-2 p-2 text-warning">Results</h1>
                <div class="p-2">
                    @forelse ($memberships as $membership)
                        {{-- Your membership details and billing history layout here --}}
                        <div class="p-2">
                            @foreach ($memberships as $membership)
                                <div class="separator separator-dotted border-secondary my-4"></div>
                                <div class="row mt-1">
                                    <!-- Membership Details (3 columns) -->
                                    <div class="col-3">
                                        <div class="card bg-light">
                                            <div class="card-body">

                                                <!-- Membership Name and Surname -->
                                                <h5 class="card-title text-dark text-center">Membership Code
                                                    : {{ $membership->membership_code }}</h5>


                                                <!--begin::Aside user-->
                                                <div class="aside-user mb-5 mb-lg-10 p-6" id="kt_aside_user">
                                                    <!--begin::User-->
                                                    <x-aside.profile name="{{ $membership->name . $membership->surname }}"
                                                        profileLink="{{ route('admin.account.info') }}"
                                                        profileImg="{{ asset('assets/media/avatars/blank.png') }}"
                                                        description="{{ $membership->primary_e_mail_address }}"
                                                        class="additional-css-classes pt-2" />
                                                    <!--end::User-->
                                                    <div class="mt-2 p-1 text-center">
                                                        <a href="#" class="btn btn-flex bg-success"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#membershipInfoModal{{ $membership->id }}">
                                                            <i class="bi bi-book fs-1 text-dark"></i>
                                                            <span class="d-flex flex-column align-items-start ms-2">
                                                                <span class="fs-3 fw-bold">All Details</span>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!--end::Aside user-->

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="membershipInfoModal{{ $membership->id }}" tabindex="-1"
                                        aria-labelledby="membershipModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <!-- Consider using modal-lg for larger modal -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="membershipModalLabel">Membership Details
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>ID:</strong> {{ $membership->id }}<br>
                                                            <strong>Membership Code:</strong>
                                                            {{ $membership->membership_code }}<br>
                                                            <strong>Name:</strong> {{ $membership->name }}
                                                            {{ $membership->initials }}
                                                            {{ $membership->surname }}
                                                            <br>
                                                            <strong>ID Number:</strong> {{ $membership->id_number }}<br>
                                                            <strong>Join Date:</strong> {{ $membership->join_date }}<br>
                                                            <strong>End Date:</strong> {{ $membership->end_date }}<br>
                                                            <strong>End Reason:</strong> {{ $membership->end_reason }}<br>
                                                            <strong>Gender ID:</strong> {{ $membership->gender_id }}<br>
                                                            <strong>BU ID:</strong> {{ $membership->bu_id }}<br>
                                                            <!-- Add more fields here -->
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>BU Membership Type
                                                                ID:</strong> {{ $membership->bu_membership_type_id }}<br>
                                                            <strong>BU Membership Region
                                                                ID:</strong> {{ $membership->bu_membership_region_id }}<br>
                                                            <strong>BU Membership Status
                                                                ID:</strong> {{ $membership->bu_membership_status_id }}<br>
                                                            <strong>Person ID:</strong> {{ $membership->person_id }}<br>
                                                            <strong>Language ID:</strong>
                                                            {{ $membership->language_id }}<br>
                                                            <strong>Previous Membership
                                                                ID:</strong> {{ $membership->previous_membership_id }}<br>
                                                            <strong>Contact
                                                                Numbers:</strong> {{ $membership->primary_contact_number }}
                                                            , {{ $membership->secondary_contact_number }}
                                                            , {{ $membership->tertiary_contact_number }}<br>
                                                            <strong>SMS Number:</strong> {{ $membership->sms_number }}<br>
                                                            <strong>Email
                                                                Addresses:</strong>
                                                            {{ $membership->primary_e_mail_address }}
                                                            , {{ $membership->secondary_e_mail_address }}<br>
                                                            <strong>Preferred Payment Method
                                                                ID:</strong>
                                                            {{ $membership->preferred_payment_method_id }}<br>
                                                            <!-- Add more fields here -->
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <strong>Membership
                                                            Fee:</strong> {{ $membership->membership_fee }}
                                                        {{ $membership->fee_currency_id }}
                                                        <br>
                                                        <strong>Last Payment Date:</strong>
                                                        {{ $membership->last_payment_date }}<br>
                                                        <strong>Paid Till Date:</strong>
                                                        {{ $membership->paid_till_date }}<br>
                                                        <strong>Account
                                                            Status:</strong>
                                                        {{ $membership->deleted ? 'Deleted' : 'Active' }}<br>
                                                        <strong>Deleted At:</strong> {{ $membership->deleted_at }}<br>
                                                        <strong>Created At:</strong> {{ $membership->created_at }}<br>
                                                        <strong>Updated At:</strong> {{ $membership->updated_at }}<br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Billing History (6 columns) -->
                                    <div class="col-9">
                                        <div class="card mb-4 bg-light">
                                            <div class="card-title rounded p-2 m-4">
                                                <h3 class="card-title m-0 text-center text-dark">Billing History</h3>
                                            </div>

                                            <div class="card-body p-0 m-4">
                                                <div class="table-responsive">
                                                    <table
                                                        class="table align-middle gy-4 gs-9 themed-table border border-solid">
                                                        <thead class="border border-secondary bg-secondary-subtle">
                                                            <tr>
                                                                <th class="min-w-150px">Date</th>
                                                                <th class="min-w-250px">Amount Paid</th>
                                                                <th class="min-w-150px">Balance</th>
                                                                <th class="min-w-150px">Status</th>
                                                                <th class="min-w-150px">Invoice</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="fw-semibold border border-secondary bg-light">
                                                            <tr>
                                                                <td>2023-01-15</td>
                                                                <td>R100.00</td>
                                                                <td>R200.00</td>
                                                                <td>Owing</td>
                                                                <td>
                                                                    <a href="#"
                                                                        class="btn btn-sm btn-active-light-primary bg-success"
                                                                        style="border-radius: 5px;">PDF</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>2023-02-15</td>
                                                                <td>R150.00</td>
                                                                <td>R50.00</td>
                                                                <td>Owing</td>
                                                                <td>
                                                                    <a href="#"
                                                                        class="btn btn-sm btn-active-light-primary bg-success"
                                                                        style="border-radius: 5px;">PDF</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @empty
                        <h3 class="text-center fw-bold text-danger">No memberships found for your search criteria.</h3>
                    @endforelse
                </div>
            @endif
        </div>
        {{-- End Search Results --}}

        {{-- Start Payment Method --}}
        <div class="card mt-4">
            <div class="accordion my-4" id="paymentMethodsAccordion">
                <h1 class="text-center my-4">Payments Methods</h1>

                <!-- Cash Payment Method -->
                <div class="accordion-item m-1">
                    <h2 class="accordion-header mx-auto" id="headingCash">
                        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseCash" aria-expanded="false" aria-controls="collapseCash">
                            Cash Payment
                        </button>
                    </h2>
                    <div id="collapseCash" class="accordion-collapse collapse" aria-labelledby="headingCash"
                        data-bs-parent="#paymentMethodsAccordion">
                        <div class="accordion-body bg-light">
                            <form id="cashPaymentForm" action="{{ route('saveCashPaymentDetails') }}" method="POST"
                                class="payment-section card p-0 m-0">

                                @csrf <!-- CSRF token for Laravel -->
                                <div class="container-fluid mt-6">
                                    <div class="row">
                                        <!-- Membership ID -->
                                        <div class="col-2 mb-7 fv-row">
                                            <label class="required fs-6 fw-semibold form-label mb-2">Membership ID</label>
                                            <select class="form-control form-control-solid srchable border border-secondary" name="membership_id"
                                                required>
                                                <option value="">Select Membership</option>
                                                @foreach ($memberships as $membership)
                                                    <option value="{{ $membership->id }}">
                                                        {{ $membership->membership_code . ' ' . $membership->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Transaction Date -->
                                        {{-- <div class="col-md-6 mb-7 fv-row">
                                            <label class="required fs-6 fw-semibold form-label mb-2">Transaction Date</label>
                                            <input type="date" class="form-control form-control-solid" name="transaction_date"
                                                value="0" required>
                                        </div> --}}
                                        <!-- Transaction Date -->
                                        <div class="col-md-3 mb-7 fv-row">
                                            <label class="required fs-6 fw-semibold form-label mb-2">Transaction
                                                Date</label>
                                            <input type="date" class="form-control form-control-solid border border-secondary"
                                                id="transaction_date" name="transaction_date" required readonly>
                                        </div>
                                        <!-- Receipt Value Amount -->
                                        <div class="col-md-3 mb-7 fv-row">
                                            <label class="required fs-6 fw-semibold form-label mb-2">Receipt Value
                                                Amount</label>
                                            <input type="text" class="form-control form-control-solid border border-secondary"
                                                placeholder="Enter Receipt Value Amount" name="receipt_value" required>
                                        </div>
                                        <!-- Currency ID -->
                                        <div class="col-md-1 mb-7 fv-row">
                                            <label class="required fs-6 fw-semibold form-label mb-2">Currency</label>
                                            <select class="form-control border border-secondary" name="currency_id" required>
                                                <option value="149">ZAR</option>
                                                <!-- Populate with currencies -->
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <!-- Transaction Description -->
                                        <div class="col-5 mb-7 fv-row">
                                            <label class="required fs-6 fw-semibold form-label mb-2">Transaction
                                                Description</label>
                                            <input type="text" class="form-control form-control-solid border border-secondary"
                                                placeholder="Enter Transaction Description" name="transaction_description"
                                                required>
                                        </div>
                                        <!-- Receipt Number -->
                                        <div class="col-3 mb-7 fv-row">
                                            <label class="required fs-6 fw-semibold form-label mb-2">Receipt Number</label>
                                            <input type="text" class="form-control form-control-solid border border-secondary"
                                                placeholder="Enter Receipt Number" name="receipt_number" required>
                                        </div>

                                        <!-- Additional Hidden Inputs for bu_id, transaction_type_id, payment_method_id -->
                                        <!-- Assuming these are managed/known beforehand or through application logic -->
                                        <input type="hidden" name="bu_id" value="7">
                                        <input type="hidden" name="transaction_type_id" value="2">
                                        <input type="hidden" name="payment_method_id" value="2">


                                        <!-- Submission Button -->
                                        <div class="col-3 mb-7 fv-row my-auto">
                                            <button type="submit" class="btn bg-success text-center my-auto mx-auto border border-secondary">Submit
                                                Payment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Debit Order Payment Method -->
                <div class="accordion-item m-1">
                    <h2 class="accordion-header" id="headingDebitOrder">
                        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseDebitOrder" aria-expanded="false"
                            aria-controls="collapseDebitOrder">
                            Debit Order Payment
                        </button>
                    </h2>
                    <div id="collapseDebitOrder" class="accordion-collapse collapse" aria-labelledby="headingDebitOrder"
                        data-bs-parent="#paymentMethodsAccordion">
                        <div class="accordion-body bg-light">
                            <!-- Content for Debit Order Payment Method -->
                            <div class="accordion-body m-0 p-0">
                                <!-- Debit Order Payment Form Content Here -->
                                <form id="membershipRegistrationForm" action="{{ route('saveBankDetails') }}"
                                    method="POST" class="payment-section card p-0 m-0">

                                    @csrf <!-- CSRF token for Laravel -->
                                    <div class="container-fluid mt-6">
                                        <!-- Simplified to focus on required fields for membership_bank_details -->

                                        <!-- Fields for membership_bank_details -->
                                        <div class="row">
                                            <!-- Membership ID -->
                                            {{-- <div class="col-md-6 mb-7 fv-row">
                                    <label class="required fs-6 fw-semibold form-label mb-2">Membership ID</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Enter Membership ID" name="membership_id" required>
                                            </div> --}}
                                            <!-- Membership ID Dropdown -->
                                            <div class="col-md-6 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Membership
                                                    ID</label>
                                                <select class="form-control form-control-solid srchable border border-secondary"
                                                    name="membership_id" required>
                                                    <option value="">Select Membership ID</option>
                                                    @foreach ($memberships as $membership)
                                                        <option value="{{ $membership->id }}">{{ $membership->id }} -
                                                            {{ $membership->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- Bank Branch ID Dropdown -->
                                            <div class="col-md-6 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Bank Branch
                                                    ID</label>
                                                <select class="form-control form-control-solid srchable border border-secondary"
                                                    name="bank_branch_id" required>
                                                    <option value="">Select Bank Branch</option>
                                                    @foreach ($branchCodes as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}
                                                            ({{ $branch->branch_code }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Bank Branch ID -->
                                            {{-- <div class="col-md-6 mb-7 fv-row">
                                    <label class="required fs-6 fw-semibold form-label mb-2">Bank Branch ID</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Enter Bank Branch ID" name="bank_branch_id" required>
                                        </div> --}}
                                        </div>

                                        <div class="row">
                                            <!-- Bank Account Type ID -->
                                            <div class="col-md-6 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Bank Account Type
                                                    ID</label>
                                                <select class="form-control form-select-solid srchable border border-secondary"
                                                    name="bank_account_type_id" required>
                                                    <option value="">Select Account Type</option>
                                                    @foreach ($accountTypes as $type)
                                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" class="form-control form-control-solid"
                                        placeholder="Enter Bank Branch ID" name="bank_account_type_id" required> --}}
                                            </div>
                                            <!-- Account Name -->
                                            <div class="col-md-6 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Account
                                                    Name</label>
                                                <input type="text" class="form-control form-control-solid border border-secondary"
                                                    placeholder="Enter Account Name" name="account_name" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Account Number -->
                                            <div class="col-md-6 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Account
                                                    Number</label>
                                                <input type="text" class="form-control form-control-solid border border-secondary"
                                                    placeholder="Enter Account Number" name="account_number" required>
                                            </div>
                                            <!-- Branch Code (Note: If universal_branch_code is different, add another field for it) -->
                                            <div class="col-md-6 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Branch
                                                    Code</label>
                                                {{-- <input type="text" class="form-control form-control-solid"
                                                    placeholder="Enter Branch Code" name="branch_code" required> --}}
                                                <select class="form-control srchable" name="branch_code" required>
                                                    <option value="">Select Branch Code</option>
                                                    @foreach ($branchCodes as $code)
                                                        <option value="{{ $code->branch_code }}">
                                                            {{ $code->branch_code . ' - ' . $code->bank_short_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Additional fields for created_at and updated_at will be handled automatically by Laravel if using Eloquent -->
                                            <!-- Bank Branch Dropdown -->
                                            <div class="col-md-6 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Bank
                                                    Branch</label>
                                                <select class="form-control srchable" name="bank_branch_id" required>
                                                    <option value="">Select Bank Branch</option>
                                                    @foreach ($branchCodes as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}
                                                            ({{ $branch->branch_code }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- Membership Code -->
                                            {{-- <div class="col-md-6 mb-7 fv-row">
                                                <label class=" fs-6 fw-semibold form-label mb-2">Membership
                                                    Code</label>
                                                <select class="form-control form-control-solid" name="membership_code"
                                                    >
                                                    <option value="">Select Membership Code</option>
                                                    @foreach ($memberships as $membership)
                                                        <option value="{{ $membership->id }}">
                                                            {{ $membership->membership_code }} - {{ $membership->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
 
                                            </div> --}}
                                            <!-- Debit Orders Per Year -->
                                            {{-- <div class="col-md-6 mb-7 fv-row">
                                    <label class="required fs-6 fw-semibold form-label mb-2">Debit Orders Per Year</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="Enter Debit Orders Per Year" name="debit_orders_per_year" required>

                                            </div> --}}
                                            <div class="col-md-4 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Debit Order
                                                    Frequency</label>
                                                <select class="form-control srchable" id="debitOrderFrequency"
                                                    name="debit_orders_per_year" required>
                                                    <option value="">Select Frequency</option>
                                                    <option value="12">Monthly</option>
                                                    <option value="4">Quarterly</option>
                                                    <option value="2">Biannually</option>
                                                    <option value="1">Annually</option>
                                                </select>
                                            </div>

                                            <!-- Submission Button -->
                                            <div class="col-md-2 mb-7 fv-row my-auto">
                                                <button type="submit"
                                                    class="btn bg-success text-center my-auto mx-auto">Submit Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- EFT Payment Method -->
                <div class="accordion-item m-1">
                    <h2 class="accordion-header" id="headingEft">
                        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseEft" aria-expanded="false" aria-controls="collapseEft">
                            EFT Payment
                        </button>
                    </h2>
                    <div id="collapseEft" class="accordion-collapse collapse" aria-labelledby="headingEft"
                        data-bs-parent="#paymentMethodsAccordion">
                        <div class="accordion-body bg-light">
                            <!-- Content for EFT Payment Method -->
                            <div id="eftSection" class="payment-section card p-0 m-0">
                                <!-- Begin Form -->
                                <form id="eftForm" method="POST" action="{{ route('saveEFTDetails') }}">
                                    <!-- Specify the backend route -->
                                    @csrf <!-- CSRF token for Laravel or similar frameworks -->
                                    <div class="container-fluid mt-6">
                                        <!-- Row 1 for Account Holder, Amount, Bank Name, and Branch Code -->
                                        <div class="row">
                                            <!-- Membership ID -->
                                            <div class="col-md-2 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Membership
                                                    ID</label>
                                                <select class="form-control form-control-solid srchable border border-secondary"
                                                    name="membership_id" required>
                                                    <option value="">Select Membership</option>
                                                    @foreach ($memberships as $membership)
                                                        <option value="{{ $membership->id }}">
                                                            {{ $membership->membership_code . ' ' . $membership->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- Receipt Number -->
                                            <div class="col-md-2 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Receipt
                                                    Number</label>
                                                <input type="text" class="form-control form-control-solid border border-secondary"
                                                    placeholder="Enter Receipt Number" name="receipt_number" required>
                                            </div>

                                            <!-- Amount Value -->
                                            <div class="col-md-2 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Amount
                                                    Value</label>
                                                <input type="text" class="form-control form-control-solid border border-secondary"
                                                    placeholder="Enter Amount Value" name="receipt_value" />
                                            </div>

                                            <!-- Bank Name -->
                                            <div class="col-md-2 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Bank Name</label>
                                                <select class="form-control form-control-solid srchable border border-secondary" name="bankName">
                                                    <option value="">Select Bank</option>
                                                    @foreach ($banks as $bank)
                                                        <option value="{{ $bank->id }}">{{ $bank->short_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Transaction Date -->
                                            <div class="col-md-2 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Transaction
                                                    Date</label>
                                                <input type="date" class="form-control form-control-solid border border-secondary"
                                                    id="transaction_date" name="transaction_date" required>
                                            </div>

                                            <!-- Branch Code -->
                                            <div class="col-md-2 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Branch
                                                    Code</label>
                                                <select class="form-control form-control-solid srchable border border-secondary"
                                                    name="branchCode">
                                                    <option value="">Select Branch Code</option>
                                                    @foreach ($branchCodes as $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->branch_code }}
                                                            {{ $branch->bank_short_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <!-- Row 2 for Account Number and Account Type -->
                                        <div class="row mb-4">
                                            <!-- Account Holder -->
                                            <div class="col-md-4 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Account
                                                    Holder</label>
                                                <input type="text" class="form-control form-control-solid border border-secondary"
                                                    placeholder="Enter Account Holder" name="accountHolder" />
                                            </div>
                                            <!-- Account Number -->
                                            <div class="col-md-4 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Account
                                                    Number</label>
                                                <input type="text" class="form-control form-control-solid border border-secondary"
                                                    placeholder="Enter Account Number" name="transaction_description" />
                                            </div>

                                            <!-- Account Type -->
                                            <div class="col-md-2 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Account
                                                    Type</label>
                                                <select class="form-select srchable border border-secondary" name="accountType"
                                                    data-control="select2" data-hide-search="true">
                                                    <option value="">Select Account Type</option>
                                                    <option value="checking">Checking</option>
                                                    <option value="savings">Savings</option>
                                                </select>
                                            </div>

                                            <!-- Additional Hidden Inputs for bu_id, transaction_type_id, payment_method_id -->
                                            <!-- Assuming these are managed/known beforehand or through application logic -->
                                            <input type="hidden" name="bu_id" value="7">
                                            <input type="hidden" name="transaction_type_id" value="2">
                                            <input type="hidden" name="payment_method_id" value="2">
                                            <input type="hidden" name="currency_id" value="149">

                                            <!-- Submit Button -->
                                            <div class="col-md-2">
                                                <button type="submit" class="btn bg-success mt-8">Submit Payment</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Via Payment Method -->
                <div class="accordion-item m-1">
                    <h2 class="accordion-header" id="headingDataVia">
                        <button class="accordion-button collapsed bg-light" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseDataVia" aria-expanded="false" aria-controls="collapseDataVia">
                            Data Via Payment
                        </button>
                    </h2>
                    <div id="collapseDataVia" class="accordion-collapse collapse" aria-labelledby="headingDataVia"
                        data-bs-parent="#paymentMethodsAccordion">
                        <div class="accordion-body bg-light">
                            <!-- Data Via Section -->
                            <div id="dataViaSection" class="payment-section card m-0 p-0">
                                <!-- Assuming 'saveDataViaDetails' is a method in your controller for handling Data Via payments -->
                                <form id="dataViaForm" action="{{ route('saveDataViaDetails') }}" method="POST">
                                    @csrf <!-- CSRF token for Laravel -->
                                    <div class="container-fluid mt-6">
                                        <!-- Similar to the EFT section, fields must correspond to 'membership_payment_receipts' table columns -->

                                        <div class="row">
                                            <!-- Membership ID Selection -->
                                            <div class="col-md-3 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Membership
                                                    ID</label>
                                                <select class="form-control form-control-solid srchable border border-secondary"
                                                    name="membership_id" required>
                                                    <option value="">Select Membership ID</option>
                                                    @foreach ($memberships as $membership)
                                                        <option value="{{ $membership->id }}">{{ $membership->id }} -
                                                            {{ $membership->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <!-- Transaction Description as 'transaction_description' Example -->
                                            <div class="col-8 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Transaction
                                                    Description
                                                </label>
                                                <input type="text" class="form-control form-control-solid border border-secondary"
                                                    name="transaction_description"
                                                    placeholder="Enter Transaction Description" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Receipt Number as 'receipt_number' Example -->
                                            <div class="col-md-3 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Receipt Number
                                                </label>
                                                <input type="text" class="form-control form-control-solid border border-secondary"
                                                    name="receipt_number" placeholder="Enter Receipt Number" required>
                                            </div>

                                            <!-- Amount Value as 'receipt_value' -->
                                            <div class="col-md-3 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Amount
                                                    Value</label>
                                                <input type="number" class="form-control form-control-solid border border-secondary"
                                                    name="receipt_value" placeholder="Enter Amount Value" required>
                                            </div>

                                            <!-- Placeholder for hidden inputs like 'currency_id', 'bu_id', etc. -->
                                            <input type="hidden" name="currency_id" value="149">
                                            <!-- Example Currency ID -->
                                            <!-- Other necessary hidden fields -->
                                            <input type="hidden" name="bu_id" value="7">
                                            <input type="hidden" name="transaction_type_id" value="2">
                                            <input type="hidden" name="payment_method_id" value="1">

                                            <!-- Transaction Date -->
                                            <div class="col-md-2 mb-7 fv-row">
                                                <label class="required fs-6 fw-semibold form-label mb-2">Transaction
                                                    Date</label>
                                                <input type="date" class="form-control form-control-solid border border-secondary"
                                                    name="transaction_date" required>
                                            </div>

                                            <!-- Submission Button -->
                                            <div class="col-3 mx-auto my-auto">
                                                <button type="submit" class="btn bg-success mt-3">Submit Payment</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Payment Metod --}}

    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('paymentMethod').addEventListener('change', function() {
            // Hide all sections
            document.querySelectorAll('.payment-section').forEach(function(section) {
                section.style.display = 'none';
            });

            // Show the selected section
            const selectedPaymentMethod = this.value;
            if (selectedPaymentMethod) {
                const sectionId = selectedPaymentMethod + 'Section';
                document.getElementById(sectionId).style.display = 'block';
            }
        });

        // Example to handle EFT form submission
        document.getElementById('eftForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Collect data
            const eftData = {
                accountHolder: document.getElementById('eftAccountHolder').value,
                accountNumber: document.getElementById('eftAccountNumber').value,
                bankName: document.getElementById('eftBankName').value,
                branchCode: document.getElementById('eftBranchCode').value,
            };
            console.log(eftData); // For demonstration, replace with AJAX call to server
            // Reset form or provide feedback
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Add click event listener to each card
            document.querySelectorAll('.card').forEach(function(card) {
                card.addEventListener('click', function() {
                    // Find the detail div within the clicked card and toggle visibility
                    var detailDiv = card.querySelector('.card-detail');
                    if (detailDiv.style.display === "none") {
                        detailDiv.style.display = "block";
                    } else {
                        detailDiv.style.display = "none";
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const now = new Date();
            console.log(now);
            //const today = new Date(now.getFullYear(), now.getMonth(), now.getDate()).toISOString().split('T')[0];
            //console.log(today); 
            var today = new Date().toISOString().substr(0, 10);
            document.getElementById('transaction_date').value = today;
        });
    </script>
@endpush
