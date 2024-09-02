@extends('layouts.app2')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        .inner-card {
            margin-bottom: 15px;
        }
    </style>

    <style>
        .action-buttons {
            text-align: right;
            padding-top: 10px;
            /* Space between record info and buttons */
        }
    </style>

    <style>
        .json-key {
            color: #a52a2a;
            /* Brown */
        }

        .json-value {
            color: #008000;
            /* Green */
        }

        .json-string {
            color: #d14;
            /* Red */
        }

        .special-link {
            display: inline-block;
            background-color: #007bff;
            /* Bootstrap primary color */
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .special-link:hover,
        .special-link:focus {
            background-color: #white;
            /* Darker blue */
            color: white;
            text-decoration: none;
        }
    </style>

    <style>
        input::placeholder,
        textarea::placeholder {
            color: #fefefe;
            /* Change the color as needed */
        }
    </style>

    <style>
        /* Custom CSS classes for SweetAlert */
        .swal2-title {
            color: black !important;
            /* Change title text color */
        }

        .swal2-content {
            color: black !important;
            /* Change content text color */
        }
    </style>

    {{-- This is for accordion -- SIYA --}}

    <style>
        /* Adjusting the accordion header/button background color */
        .accordion-button {
            background-color: #448C74 !important;
            /* #b7cebe Your specified green color */
            color: white !important;
            /* #343a40 Ensuring text color is readable against the green background */
        }

        /* Style for accordion button when accordion is open */
        .accordion-button:not(.collapsed) {
            background-color: #448C74 !important;
            /* #9fb3aa A slightly darker shade of green for contrast */
            color: white !important;
            /* #343a40 Keeping text color consistent; change as desired */
        }

        /* Hover effect for accordion button */
        .accordion-button:hover {
            background-color: #a5c1b2 !important;
            /* A lighter/different shade for hover effect */
            color: #343a40 !important;
            /* Ensuring text color is readable on hover; adjust as needed */
        }

        /* Adjusting icon colors */
        .accordion-button .fas,
        .accordion-button .far,
        .accordion-button .arrow-indicator::before {
            /* Targeting the arrow indicator if it's a pseudo-element */
            color: #FFFFFF !important;
            /* White */
        }

        /* Style for accordion button when input is missing */
        .accordion-button.missing-input {
            background-color: #c71f3f !important;
            /*#e57373 #f20d20b7 A nice, complementing red */
            color: #FFFFFF !important;
            /* White text for readability */
        }
    </style>

    <style>
        input:required,
        select:required {
            border: 2px solid #ced4da;
            /* Bootstrap's default border color for form inputs */
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            /* Smooth transition for visual feedback */
        }

        input:invalid,
        select:invalid {
            border-color: #e57373 !important;
            /* A complementing red for missing required inputs */
            box-shadow: 0 0 0 .2rem rgba(229, 115, 115, .25);
            /* Optional: add a subtle shadow to further highlight the field */
        }


    </style>

    <style>
        .form-control {
            background-color: white !important;
        }

        .select2-container--bootstrap5 .select2-dropdown {
            background-color: white !important; 
        }

        .select2-container--bootstrap5 .select2-dropdown .select2-search .select2-search__field {
            background-color: #E7EEEA !important;
        }

        .pac-container {
            z-index: 9999 !important; /* This is for my Google Maps in modal Bootstrap modals usually have a z-index of 1050 */
        }


    </style>

<script>
    function calculateTotal() {
        const costs = document.querySelectorAll('.cost-input');
        let total = 0;
        costs.forEach((cost) => {
            if(cost.value) total += parseFloat(cost.value);
        });
        document.getElementById('totalCost').innerText = total.toFixed(2);
        document.getElementById('totalCost2').innerText = total.toFixed(2);
        document.getElementById('totalCostHeader').innerText = total.toFixed(2);
    }
</script>

<style>
    /* Center table header (thead) and footer (tfoot) text */
    #kt_datatable_footer_callback th,
    #kt_datatable_benefit_footer_callback  th {
        text-align: center; /* Horizontally center the text in table headers */
        vertical-align: middle; /* Vertically center the text in table headers */
    }

    /* Center table body (tbody) content */
    #kt_datatable_footer_callback td,
    #kt_datatable_benefit_footer_callback  td {
        text-align: center; /* Horizontally center the text in table cells */
        vertical-align: middle; /* Vertically center the text in table cells */
    }

    /* Adjust input fields to be centered if needed, this might depend on your specific design */
    .form-control.cost-input {
        width: auto; /* Adjust width as needed */
        margin: 0 auto; /* Horizontally center the input fields in their table cells */
        display: block;
    }

    /* Ensure the table itself is centered in its container */
    /* #kt_datatable_footer_callback
    #kt_datatable_benefit_footer_callback  {
        margin-left: auto;
        margin-right: auto;
    } */
</style>
<style>
    #kt_datatable_footer_callback .input-group-text,
    #kt_datatable_benefit_footer_callback  .input-group-text {
        padding-top: 10% !important;
        padding-bottom: 10% !important;
    }

    #kt_datatable_footer_callback .input-group,
    #kt_datatable_benefit_footer_callback  .input-group {
        width: 80% !important;
    }
</style>
<style>
    #requiredAlert {
        display: none !important; /* Initially hidden */
        opacity: 0 !important; /* Start fully transparent */
        transition: opacity 0.5s ease-in-out; /* Smooth transition for opacity */
    }

    #requiredAlert.show {
        display: flex !important; /* Make sure it’s flex when visible */
        opacity: 1 !important; /* Fully visible */
    }
</style>

<style>
    .top-align {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    align-content: start;
}

</style>

@endpush

@section('row_content')



    <div class="card rounded mb-16" style="background-color: #E9F0EC">
                <!--begin::Card-->
                <div class="card mt-8 m-4 bg-light text-center ">
                    <!--begin::Body-->
                    <div class="card-body py-8">
                        <div class="">
                            <h3>
                                Deceased: 
                                {{ $deceased_person->first_name .' | '. $deceased_person->initials .' | '. $deceased_person->last_name .' | DOB: '. \Carbon\Carbon::parse($deceased_person->birth_date)->format('Y-m-d') .' | ID: '. $deceased_person->id_number.' | DOD: '. \Carbon\Carbon::parse($deceased_person->deceased_date)->format('Y-m-d') }}
                            </h3>
                                
                        </div>              
                    </div>
                    <!--end::Body-->     
                </div>
                <!--end::Card-->   
        {{-- <h1 class="my-4" style="margin-left: auto; margin-right: auto; width: fit-content;">Funeral</h1> --}}
        {{-- <h2>Grouped Records by Membership ID</h2> --}}
        <div class="card mb-3 mt-4 bg-light">
            <div class="card-header" style="background-color: #448C74">
                <h3 class="card-title text-white">Funeral Checklist</h3>
                <button type="button" class="btn btn-dark btn-sm my-4 ml-2">
                    + 
                </button>
            </div>
            <div class="card-body">



                <div class="py-0">
                    <div class="table-responsive">
                        <table class="table border rounded table-row-bordered fs-6 g-5 gs-5" style="width:100%; background-color: #ffffff">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th style="text-align: center;">Checklist Item</th>
                                    <th style="text-align: center;">Completed</th>
                                    <th style="text-align: center;">Notes</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checklist_items as $item)
                                    <tr>
                                        <td style="text-align: center; padding-top:10px !important; padding-bottom:10px !important;">
                                            <input type="hidden" name="funeral_id" value="{{ $item->funeral_id }}">
                                            <input type="hidden" name="funeral_checklist_id" value="{{ $item->funeral_checklist_id }}">
                                            <input type="hidden" name="bu_id" value="{{ $item->bu_id }}">
                                            {{ $item->name }}
                                        </td>
                                        <td style="text-align: center; padding-top:10px !important; padding-bottom:10px !important;">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="{{ $item->id }}_completed_date" class="form-label">Completed Date:</label>
                                                    <input type="date" class="form-control" id="{{ $item->id }}_completed_date" name="completed_date" value="{{ $item->completed_date }}">
                                                </div>
                                                <div class="col">
                                                    <label for="{{ $item->id }}_completed_time" class="form-label">Time:</label>
                                                    <input type="time" class="form-control" id="{{ $item->id }}_completed_time" name="completed_time" value="{{ $item->completed_time }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center; padding-top:10px !important; padding-bottom:10px !important;">
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <label for="{{ $item->id }}_note" class="form-label">Description/Note:</label>
                                                    <textarea class="form-control" id="{{ $item->id }}_note" name="note" rows="1">{{ $item->note }}</textarea>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="text-align: center; padding-top:10px !important; padding-bottom:10px !important;">
                                            <button class="btn btn-primary save-btn" data-id="{{ $item->id }}">Save</button>
                                            <button class="btn btn-secondary cancel-btn" data-id="{{ $item->id }}">Cancel</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if ($checklist_items->isEmpty())
                            <h4>No Checklist items available</h4>
                        @endif
                    </div>
                </div>
                
                
                
                


                
                {{-- <div class="row">
                    <div class="col">
                        <label for="checklist_notes" class="form-label">Checklist notes:</label>
                        <textarea class="form-control" id="checklist_notes" name="checklist_notes" rows="3"></textarea>
                    </div>
                </div> --}}


            </div>
        </div>
        <div class="separator border-light my-8"></div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                    @if ($errors->has('custom_error'))
                        @foreach ($errors->get('custom_error') as $customErrors)
                            @foreach ($customErrors as $customError)
                                <li>{{ $customError }}</li>
                            @endforeach
                        @endforeach
                    @endif
                </ul>
            </div>
        @endif


                <form id="funeralForm" method="POST" action="{{ route('handleFuneralAction') }}">
                    @csrf {{-- CSRF token for form submission --}}
                    <div class="card inner-card mb-2 bg-light">
                        {{-- <div class="card-header bg-light" >
                            <h3 class="card-title" >Main Record ID: </h3>
                        </div> --}}
                        <div class="card-body">

                            <input type="text" id="person_id" name="person_id" value="{{ $deceased_person->id }}" hidden>
                            <input type="text" id="person_name" name="person_name" value="{{ $deceased_person->first_name }}" hidden>
                            {{-- <input type="text" id="funeral_id" name="funeral_id" value="{{ $deceased_person->funerals() }}" hidden> --}}


                            <!--begin::Accordion-->
                            <div class="accordion mb-3" id="kt_accordion_funeral">
                                    <!-- Accordion Item for Membership Details -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="kt_accordion_header_1">
                                            <button class="accordion-button fs-4 fw-semibold collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#kt_accordion_body_1"
                                                    aria-expanded="true"
                                                    aria-controls="kt_accordion_body_1">
                                                Church & Cemetery Details
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_body_1"
                                            class="accordion-collapse collapse show"
                                            aria-labelledby="kt_accordion_header_1"
                                            data-bs-parent="#kt_accordion_funeral">
                                            <div class="accordion-body" style="background-color: #E9F0EC">
                                                <!-- Accordion content for Membership Details -->
                                                <h2>Church Information</h2>
                                                <div class="pt-4" style="display: flex; align-items: center;" > 
                                                    <select id="churchSelect" name="churchSelect" class="form-select bg-white form-select-solid" data-control="select2" data-placeholder="Select Church" data-allow-clear="true" style="margin-right: 10px;">
                                                        <option></option> <!-- Placeholder option for user prompt -->
                                                        @foreach ($churches as $church)
                                                            <option value="{{ $church->id }}">
                                                                {{ $church->name }} ({{ $church->line1 }} - {{ $church->suburb }}, {{ $church->city }}, {{ $church->ZIP }})
                                                            </option>
                                                        @endforeach
                                                        @if ($churches->isEmpty())
                                                            <option disabled>No churches available</option>
                                                        @endif

                                                    </select>
                                                    
                                                
                                                    <button type="button" class="btn btn-dark btn-sm my-2 ml-2" data-bs-toggle="modal" data-bs-target="#kt_modal_1" data-location-type="Church">
                                                        +
                                                    </button>
                                                </div>
                                                
                                              {{-- Display this (remove hidden from div) only when viewing funeral details, not when creating new funeral --}}   

                                                {{-- <div id="church_location" class="pt-4 p-3" hidden>


                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div
                                                                class="input-group input-group-outline  @error('ChurchLine1') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control" name="ChurchLine1"
                                                                    id="ChurchLine1" value="{{ old('ChurchLine1') }}" readonly  placeholder="Church Line 1">
                                                            </div>
                                                            @error('ChurchLine1')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-6 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('ChurchLine2') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control" name="ChurchLine2"
                                                                    id="ChurchLine2" value="{{ old('ChurchLine2') }}"
                                                                    placeholder="Address Line 2" readonly>
                                                            </div>
                                                            @error('ChurchLine2')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('ChurchTownSuburb') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="ChurchTownSuburb" id="ChurchTownSuburb"
                                                                    value="{{ old('ChurchTownSuburb') }}"
                                                                    placeholder="Town/Suburb" readonly>
                                                            </div>
                                                            @error('ChurchTownSuburb')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('ChurchCity') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control" name="ChurchCity"
                                                                    id="ChurchCity" value="{{ old('ChurchCity') }}"
                                                                    placeholder="City" readonly>
                                                            </div>
                                                            @error('ChurchCity')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                            <div
                                                                class="input-group input-group-outline  @error('ChurchProvince') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="ChurchProvince" id="ChurchProvince"
                                                                    value="{{ old('ChurchProvince') }}" placeholder="Province" readonly>
                                                            </div>
                                                            @error('ChurchProvince')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                                                            <div
                                                                class="input-group input-group-outline  @error('ChurchPostalCode') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="ChurchPostalCode" id="ChurchPostalCode"
                                                                    value="{{ old('ChurchPostalCode') }}"
                                                                    placeholder="Postal Code" readonly>
                                                            </div>
                                                            @error('ChurchPostalCode')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row ">

                                                        <div class="col-6 col-sm-4 mt-3 mt-sm-0 mx-auto">
                                                            <div
                                                                class="input-group input-group-outline  @error('ChurchCountry') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control" name="ChurchCountry"
                                                                    id="ChurchCountry" value="{{ old('ChurchProvince') }}"
                                                                    placeholder="Country" readonly>
                                                            </div>
                                                            @error('ChurchCountry')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                    </div>



                                                </div> --}}
                                                
                                                {{-- End Church Section --}}


                                                <div class="separator border-light my-8"></div>


                                                {{-- Start Graveyard Section --}}

                                                <h2>Graveyard Information</h2>
                                                <div style="display: flex; align-items: center;">
                                                    <select id="graveyardSelect" name="graveyardSelect" class="form-select bg-white form-select-solid" data-control="select2" data-placeholder="Select Cemetery" data-allow-clear="true" style="margin-right: 10px;">
                                                        <option></option> <!-- Keep this for the placeholder functionality -->
                                                        @foreach ($graveyards as $graveyard)
                                                            <option value="{{ $graveyard->id }}">
                                                                {{ $graveyard->name }} ({{$graveyard->line1 }} - {{ $graveyard->suburb }}, {{ $graveyard->city }}, {{ $graveyard->ZIP }})
                                                            </option>
                                                        @endforeach
                                                        @if ($graveyards->isEmpty())
                                                            <option disabled>No graveyards available</option>
                                                        @endif

                                                    </select>
                                                    
                                                
                                                    <button type="button" class="btn btn-dark btn-sm my-2 ml-2" data-bs-toggle="modal" data-bs-target="#kt_modal_1" data-location-type="Graveyard">
                                                        +
                                                    </button>
                                                </div>
                                                
                                                {{-- Display this (remove hidden from div) only when viewing funeral details, not when creating new funeral --}}

                                                {{-- <div id="Cemetery_location" class="pt-4 p-3" hidden>


                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div
                                                                class="input-group input-group-outline  @error('CemeteryLine1') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control" name="CemeteryLine1"
                                                                    id="CemeteryLine1" value="{{ old('CemeteryLine1') }}" readonly placeholder="Cemetery Line 1">
                                                            </div>
                                                            @error('CemeteryLine1')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-6 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('CemeteryLine2') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control" name="CemeteryLine2"
                                                                    id="CemeteryLine2" value="{{ old('CemeteryLine2') }}"
                                                                    placeholder="Address Line 2" readonly>
                                                            </div>
                                                            @error('CemeteryLine2')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('CemeteryTownSuburb') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="CemeteryTownSuburb" id="CemeteryTownSuburb"
                                                                    value="{{ old('CemeteryTownSuburb') }}"
                                                                    placeholder="Town/Suburb" readonly>
                                                            </div>
                                                            @error('CemeteryTownSuburb')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('CemeteryCity') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control" name="CemeteryCity"
                                                                    id="CemeteryCity" value="{{ old('CemeteryCity') }}"
                                                                    placeholder="City" readonly>
                                                            </div>
                                                            @error('CemeteryCity')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                            <div
                                                                class="input-group input-group-outline  @error('CemeteryProvince') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="CemeteryProvince" id="CemeteryProvince"
                                                                    value="{{ old('CemeteryProvince') }}" placeholder="Province" readonly>
                                                            </div>
                                                            @error('CemeteryProvince')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                                                            <div
                                                                class="input-group input-group-outline  @error('CemeteryPostalCode') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="CemeteryPostalCode" id="CemeteryPostalCode"
                                                                    value="{{ old('CemeteryPostalCode') }}"
                                                                    placeholder="Postal Code" readonly>
                                                            </div>
                                                            @error('CemeteryPostalCode')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">

                                                        <div class="col-6 col-sm-4 mt-3 mt-sm-0 mx-auto">
                                                            <div
                                                                class="input-group input-group-outline  @error('CemeteryCountry') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control" name="CemeteryCountry"
                                                                    id="CemeteryCountry" value="{{ old('CemeteryProvince') }}"
                                                                    placeholder="Country" readonly>
                                                            </div>
                                                            @error('CemeteryCountry')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                    </div>

                                                    

                                                </div> --}}

                                                {{-- End Graveyard Section --}}





                                            </div>
                                        </div>
                                    </div>
                                


                                <!-- Second Accordion Item for Funeral Details -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="kt_accordion_header_2">
                                        <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#kt_accordion_body_2"
                                            aria-expanded="false"
                                            aria-controls="kt_accordion_body_2">
                                            Funeral Details
                                        </button>
                                    </h2>
                                    <div id="kt_accordion_body_2" class="accordion-collapse collapse"
                                        aria-labelledby="kt_accordion_header_2"
                                        data-bs-parent="#kt_accordion_funeral">
                                        <div class="accordion-body" style="background-color: #E9F0EC">
                                            <div class="row">
                                            <!-- Accordion content for Funeral Details -->


                                                <div class="card-body pt-4 p-3">

                                                    <div class="container mt-5">
                                                        <h2>Graveyard Information Form</h2>
                                                        
                                                            <!-- Row 1 -->
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <label for="graveyard_section" class="form-label">Graveyard section:</label>
                                                                    <input type="text" class="form-control" id="graveyard_section" name="graveyard_section">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="grave_number" class="form-label">Grave number:</label>
                                                                    <input type="text" class="form-control" id="grave_number" name="grave_number" required>
                                                                </div>
                                                            </div>

                                                            <!-- Row 2 -->
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <label for="burial_date" class="form-label">Burial Date:</label>
                                                                    <input type="date" class="form-control" id="burial_date" name="burial_date">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="burial_time" class="form-label">Burial Time:</label>
                                                                    <input type="time" class="form-control" id="burial_time" name="burial_time">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="coffin" class="form-label">Coffin:</label>
                                                                    <input type="text" class="form-control" id="coffin" name="coffin">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="viewing_time" class="form-label">Viewing Time:</label>
                                                                    <input type="datetime-local" class="form-control" id="viewing_time" name="viewing_time">
                                                                </div>s
                                                            </div>

                                                            <!-- Row 2.5 -->
                                                            <div class="row mb-3">

                                                                
                                                                <div class="col">
                                                                    <label for="viewing_location" class="form-label">Viewing Location:</label>
                                                                    
                                                                    <div style="display: flex; align-items: center;">
                                                                        <select id="viewing_location" name="viewing_location" class="form-select bg-white form-select-solid" data-control="select2" data-placeholder="Select Viewing Location" data-allow-clear="true" style="margin-right: 10px;">
                                                                            <option></option> <!-- Keep this for the placeholder functionality -->
                                                                            @foreach ($viewinglocations as $viewinglocation)
                                                                                <option value="{{ $viewinglocation->id }}">
                                                                                    {{ $viewinglocation->name }} ({{$viewinglocation->line1 }} - {{ $viewinglocation->suburb }}, {{ $viewinglocation->city }}, {{ $viewinglocation->ZIP }})
                                                                                </option>
                                                                            @endforeach
                                                                            @if ($viewinglocations->isEmpty())
                                                                                <option disabled>No viewing locations available</option>
                                                                            @endif
                    
                                                                        </select>
                                                                        
                                                                    
                                                                        <button type="button" class="btn btn-dark btn-sm my-2 ml-2" data-bs-toggle="modal" data-bs-target="#kt_modal_1" data-location-type="Viewing">
                                                                            +
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Row 3 -->
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <label for="church_office" class="form-label">Church office:</label>
                                                                    <input type="text" class="form-control" id="church_office" name="church_office">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="church_caretaker" class="form-label">Church caretaker:</label>
                                                                    <input type="text" class="form-control" id="church_caretaker" name="church_caretaker">
                                                                </div>
                                                            </div>

                                                            <!-- Row 4 -->
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <label for="burial_person" class="form-label">Burial person (preacher):</label>
                                                                    <input type="text" class="form-control" id="burial_person" name="burial_person">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="contact_number" class="form-label">Contact Number:</label>
                                                                    <input type="tel" class="form-control" id="contact_number" name="contact_number">
                                                                </div>
                                                                <div class="col">
                                                                    <label for="organist" class="form-label">Organist:</label>
                                                                    <input type="text" class="form-control" id="organist" name="organist">
                                                                </div>
                                                            </div>

                                                            <!-- Row 5 -->
                                                            <div class="row mb-3">
                                                                <div class="col">
                                                                    <label for="funeral_notices" class="form-label">Notices:</label>
                                                                    <textarea class="form-control" id="funeral_notices" name="funeral_notices" rows="3"></textarea>
                                                                </div>
                                                            </div>

                                                       
                                                    </div>

                                                </div>

                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Third Accordion Item for Funeral Costs -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="kt_accordion_header_3">
                                        <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#kt_accordion_body_3"
                                            aria-expanded="false"
                                            aria-controls="kt_accordion_body_3">
                                            Funeral Costs  (R <span id="totalCostHeader">0.00</span> ) & Benefits (R2000)
                                        </button>
                                    </h2>
                                    <div id="kt_accordion_body_3" class="accordion-collapse collapse"
                                        aria-labelledby="kt_accordion_header_3"
                                        data-bs-parent="#kt_accordion_funeral">
                                        <div class="accordion-body d-flex justify-content-center align-items-start" style="background-color: #E9F0EC; min-height: 100vh;">


                                            <!-- Accordion content for Funeral Costs -->

                                            

                                            {{-- Start Cost Calculator --}}
                                            <div class="col-12 col-md-6">
                                                <h2 style="text-align: center">Cost Calculator</h2>
                                                <table id="kt_datatable_footer_callback" class="table table-striped table-row-bordered gy-5 gs-7 border rounded mx-auto">
                                                    <thead style="background-color: #ffffff">
                                                        <tr class="fw-bold fs-6">
                                                            <th>Product/Service</th>
                                                            <th>Amount ( R <span class="text-danger" id="totalCost2">0.00</span> )</th>
                                                             
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Grave</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="grave" name="grave" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cremation</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="cremation" name="cremation" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Casket</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="casket" name="casket" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Notices</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="notice" name="notices" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Brochure</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="brochure" name="brochure" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>1st Doctor</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="firstDoctor" name="firstDoctor" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2nd Doctor</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="secondDoctor" name="secondDoctor" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3rd Doctor</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="thirdDoctor" name="thirdDoctor" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Burial person (preacher)</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="burialPerson" name="burialPerson" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Organist</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="organist" name="organist" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sound person</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="soundPerson" name="soundPerson" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Communication</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="communication" name="communication" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ash Case</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="ashCase" name="ashCase" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Outsourced costs</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="outsourcedCosts" name="outsourcedCosts" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Other</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="other" name="other" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Transport</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control cost-input" id="transport" name="transport" oninput="calculateTotal()">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                    <tfoot style="background-color: #f7f7f7">
                                                        <tr class="fw-bold fs-6">
                                                            <th colspan="1" class="text-nowrap align-end">Total:</th>
                                                            <th colspan="1" class="text-danger fs-3">R<span id="totalCost">0.00</span></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            {{-- End Cost Calculator--}}

                                            {{-- Start Benefits Calculator --}}
                                            <div class="col-12 col-md-6">
                                                <h2 style="text-align: center">Membership Type: Temp </h2> {{-- {{$deceased_person->membership[0]->bu_membership_type_id}} --}}
                                                <table id="kt_datatable_benefit_footer_callback" class="table table-striped table-row-bordered gy-5 gs-7 border rounded mx-auto">
                                                    <thead style="background-color: #ffffff">
                                                        <tr class="fw-bold fs-6">
                                                            <th>Benefits</th>
                                                            <th>Amount ( R <span class="text-danger" id="totalBenefits2">2000.00</span> )</th>
                                                                
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>GBA Benefit</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control " id="benefit" value="2000" name="benefit" oninput="" disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Other</td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">R</span>
                                                                    </div>
                                                                    <input type="number" class="form-control " id="benefit_other" value="0" name="benefit_other" oninput="" disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                    <tfoot style="background-color: #f7f7f7">
                                                        <tr class="fw-bold fs-6">
                                                            <th colspan="1" class="text-nowrap align-end">Total:</th>
                                                            <th colspan="1" class="text-danger fs-3">R<span id="totalBenefits">2000.00</span></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            {{-- End Benefits Calculator--}}








                                        </div>
                                    </div>
                                </div>


                                <!-- Fourth Accordion Item for Funeral Costs -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="kt_accordion_header_4">
                                            <button class="accordion-button fs-4 fw-semibold collapsed"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#kt_accordion_body_4"
                                                    aria-expanded="false"
                                                    aria-controls="kt_accordion_body_4">
                                                Shortfall / Payouts
                                            </button>
                                        </h2>
                                        <div id="kt_accordion_body_4"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="kt_accordion_header_4"
                                            data-bs-parent="#kt_accordion_funeral">
                                            <div class="accordion-body" style="background-color: #E9F0EC">

                                                    
                                                    {{-- @if (!$item['']->isEmpty()) --}}
                                                        <div class="card inner-card my-8 bg-light">
                                                            <div class="card-header" style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Shortfall Transactions</h3>
                                                                
                                                                    <button type="button" class="btn btn-dark btn-sm my-6 ml-2" data-bs-toggle="modal" data-bs-target="#kt_modal_payment">
                                                                        + New Payment
                                                                    </button>
                                                                
                                                            </div>
                                                           
                                                            <div class="card-body">
                                                                    
                                                                {{-- Start Shortfalls --}}
                                    
                                                                    <table id="kt_datatable_footer_callback" class="table table-striped table-row-bordered gy-5 gs-7 border rounded mx-auto">
                                                                        <thead style="background-color: #ffffff">
                                                                            <tr class="fw-bold fs-6">
                                                                                <th>Details</th>
                                                                                <th>Amount</th>
                                                                                <th>Payment Method</th>  
                                                                                <th>Account Number</th>
                                                                                <th>Bank</th>
                                                                                <th>Ref. #</th>
                                                                                <th>Actions</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    John Doe      
                                                                                </td>
                                                                                <td>
                                                                                    R950
                                                                                </td>
                                                                                <td>
                                                                                    Cash
                                                                                </td>
                                                                                <td>
                                                                                    N/A
                                                                                </td>
                                                                                <td>
                                                                                    N/A
                                                                                </td>
                                                                                <td>
                                                                                    N/A
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" class="btn btn-danger btn-sm my-2 ml-2" data-bs-toggle="modal" data-bs-target="#kt_modal_1" data-location-type="Postal">
                                                                                        Remove
                                                                                    </button> 
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                        </tbody>
                                                                        
                                                        
                                                                    </table>
                                                                
                                                                {{-- End Shortfalls--}}
                                                               
                                                            </div>


                                                        </div>
                                                    {{-- @else
                                                        <div class="card inner-card border border-secondary mt-4">
                                                            <div class="card-header"style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Title</h3>
                                                            </div>
                                                            <div class="card-body bg-light">
                                                                <p>No records found.</p>
                                                            </div>
                                                        </div>
                                                    @endif --}}


                                            
                                 
                                                              
                                                    {{-- @if (!$item['']->isEmpty()) --}}
                                                        <div class="card inner-card my-8 bg-light">
                                                            <div class="card-header" style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Payouts</h3>
                                                             
                                                                    <button type="button" class="btn btn-dark btn-sm my-6 ml-2" data-bs-toggle="modal" data-bs-target="#kt_modal_beneficiary" data-location-type="Postal">
                                                                        + New Beneficiary
                                                                    </button>
                                                                
                                                            </div>
                                                           
                                                            <div class="card-body">
                                                              
                                                                
                                                                {{-- Start Payouts --}}
                                                                
                                                        
                                                                
                                                                    <table id="kt_datatable_footer_callback" class="table table-striped table-row-bordered gy-5 gs-7 border rounded mx-auto">
                                                                        <thead style="background-color: #ffffff">
                                                                            <tr class="fw-bold fs-6">
                                                                                <th>Beneficiary</th>
                                                                                <th>Amount</th>
                                                                                <th>Beneficiary - Postal Address</th>  
                                                                                <th>Account Number</th>
                                                                                <th>Bank</th>
                                                                                <th>Actions</th>

                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    Jane Doe        
                                                                                </td>
                                                                                <td>
                                                                                    R1800
                                                                                </td>
                                                                                <td>
                                                                                    line 1 </br>
                                                                                    suburb </br>
                                                                                    town </br>
                                                                                    postal code
                                                                                </td>
                                                                                <td>
                                                                                    1534850245
                                                                                </td>
                                                                                <td>
                                                                                    Capitec Bank
                                                                                </td>
                                                                                <td>
                                                                                    <button type="button" class="btn btn-dark btn-sm my-2 ml-2" data-bs-toggle="modal" data-bs-target="#kt_modal_1" data-location-type="Postal">
                                                                                        Edit
                                                                                    </button> 
                                                                                    <button type="button" class="btn btn-danger btn-sm my-2 ml-2" data-bs-toggle="modal" data-bs-target="#kt_modal_1" data-location-type="Postal">
                                                                                        Remove
                                                                                    </button> 
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                        </tbody>
                                                                        
                                                        
                                                                    </table>
                                                                
                                                                {{-- End Payouts--}}
                                                               
                                                            </div>


                                                        </div>
                                                    {{-- @else
                                                        <div class="card inner-card border border-secondary mt-4">
                                                            <div class="card-header"style="background-color: #448C74;">
                                                                <h3 class="card-title" style="color: white">Title</h3>
                                                            </div>
                                                            <div class="card-body bg-light">
                                                                <p>No records found.</p>
                                                            </div>
                                                        </div>
                                                    @endif --}}

                     






                                        </div>
                                    </div>
                                </div>
                        </div>
                            <!--end::Accordion-->





                        <!--begin::Alert (initially hidden)-->
                        <div id="requiredAlert" class="alert alert-danger bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10" style="display: none !important;">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-information-5 fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                            <!--end::Icon-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                <h4 class="fw-semibold  text-danger">Incomplete Form</h4>
                                <!--end::Title-->

                                <!--begin::Content-->
                                <span>All Tabs Need to be completed ('Green') before you can save.</span>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->

                        </div>
                        <!--end::Alert-->


                        </div>
                        <!-- Add more accordion cards as needed following the structure above -->

                        
                    </div>

                    <!-- Hidden Button for Submit Action 1 -->
                    <button type="submit" name="action" value="submitActionOne" style="display:none;">Save
                        Funeral</button>
                    <!-- Hidden Button for Submit Action 2 -->
                    <button type="submit" name="action" value="submitActionTwo" style="display:none;">Test
                        Output</button>
            </form>







                <!-- Something Card -->



          


                {{-- Action Buttons for Main Record --}}
                <div class="form-group text-center d-flex justify-content-around  mt-8 mb-8">
                    <!-- External Button for Submit Action 1 -->
                    <button id="externalSubmitActionOne" class="btn btn-success">Save Funeral</button>
                    <!-- External Button for Submit Action 2 -->
                    <button id="externalSubmitActionTwo" class="btn btn-dark">Test Output</button>





                </div>
    

                                <!-- Start Shortfall Payment Modal -->
                                <div class="modal fade" tabindex="-1" id="kt_modal_payment">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content" style="background-color: #448C74">
                                            <div class="modal-header">
                                                <h3 class="modal-title text-white">Add Payment</h3>
                                
                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-dark ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            <form id="shortfallPaymentForm" method="POST" action="{{ route('StoreFuneralBeneficiary') }}">
                                                @csrf
                                            <div class="modal-body">
                                                
                                                



                                                <div  class="pt-4 p-3">
                                                


                                                     <!-- Row 1 -->
                                                     <div class="row my-3">
                                                        <div class="col">
                                                            <label for="shortfall_payment_name" class="form-label text-white">Name:</label>
                                                            <input type="text" class="form-control" id="shortfall_payment_name" name="shortfall_payment_name">
                                                        </div>
                                                        <div class="col">
                                                            <label for="shortfall_payment_surname" class="form-label text-white">Surname:</label>
                                                            <input type="tel" class="form-control" id="shortfall_payment_surname" name="shortfall_payment_surname">
                                                        </div>
                                                        <div class="col">
                                                            <label for="payout_amount" class="form-label text-white">Amount:</label>
                                                            <div class="input-group mx-auto">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" style="padding-top: 10% !important; padding-bottom: 10% !important;">R</span>
                                                                </div>
                                                                <input type="number" class="form-control cost-input" id="payout_amount" name="payout_amount" >
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="separator border-light my-8"></div>


                                                    <div class="pt-4" style="display: flex; align-items: center;" > 
                                                        <label for="ShortfallPaymentMethodSelect" class="form-label text-white">Payment Method:</label>
                                                        <select id="ShortfallPaymentMethodSelect" name="ShortfallPaymentMethodSelect" class="form-select bg-white form-select-solid" data-control="select2" data-placeholder="Select Payment Method" data-allow-clear="true" style="margin-right: 10px;">
                                                        
                                                            <option value="2">Cash</option>
                                                            <option value="5">EFT/Bank Payment</option>
    
                                                        </select>
                                                        
                                                    
                
                                                    </div>

                                                    <div class="separator border-light my-8"></div>

                                                     <!-- Payout Payment Details -->
                                                     <div class="row my-3">
                                                        <div class="col">
                                                            <label for="payout_acc_number" class="form-label text-white">Account number:</label>
                                                            <input type="number" class="form-control" id="payout_acc_number" name="payout_acc_number">
                                                        </div>
                                                        <div class="col">
                                                            <label for="ShortfallbankSelect" class="form-label text-white">Bank:</label>
                                                            <select id="ShortfallbankSelect" name="ShortfallbankSelect" class="form-select bg-white form-select-solid" data-control="select2" data-placeholder="Select Bank" data-allow-clear="true" style="margin-right: 10px;">
                                                                <option></option> <!-- Placeholder option for user prompt -->
                                                                @foreach ($banks as $bank)
                                                                    <option value="{{ $bank->id }}">
                                                                        {{ $bank->name }} 
                                                                    </option>
                                                                @endforeach
                                                           
        
                                                            </select>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="separator border-light my-8"></div> --}}






                                                    </div>
                                                





                                            </div>
                                    
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-dark" id="savePaymentBtn">Save Payment</button>
                                                </div>
                                        </form>    
                                        </div>
                                    </div>
                                </div>
                            <!-- END Shortfall Payment Modal -->
                
                                <!-- Start Beneficiary Modal -->
                                <div class="modal fade" tabindex="-1" id="kt_modal_beneficiary">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content" style="background-color: #448C74">
                                            <div class="modal-header">
                                                <h3 class="modal-title text-white">Add Beneficiary</h3>
                                
                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-dark ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            <form id="beneficiaryAddressForm" method="POST" action="{{ route('StoreFuneralBeneficiary') }}">
                                                @csrf
                                            <div class="modal-body">
                                                
                                                



                                                <div  class="pt-4 p-3">
                                                


                                                     <!-- Row 1 -->
                                                     <div class="row my-3">
                                                        <div class="col">
                                                            <label for="beneficiary_name" class="form-label text-white">Name:</label>
                                                            <input type="text" class="form-control" id="beneficiary_name" name="beneficiary_name">
                                                        </div>
                                                        <div class="col">
                                                            <label for="beneficiary_surname" class="form-label text-white">Surname:</label>
                                                            <input type="tel" class="form-control" id="beneficiary_surname" name="beneficiary_surname">
                                                        </div>
                                                        <div class="col">
                                                            <label for="payout_amount" class="form-label text-white">Amount:</label>
                                                            <div class="input-group mx-auto">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" style="padding-top: 10% !important; padding-bottom: 10% !important;">R</span>
                                                                </div>
                                                                <input type="number" class="form-control cost-input" id="payout_amount" name="payout_amount" >
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="separator border-light my-8"></div>



                                                    <select id="addressType" name="addressType" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Location Type" data-hide-search="true">
                                                        <option></option>
                                                        <option value="1">Residential</option>
                                                        <option value="2">Postal</option>
                                                    </select>
                                                    


                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div
                                                                class="input-group input-group-outline  @error('Line1_beneficiary') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control" name="Line1_beneficiary"
                                                                    id="Line1_beneficiary" value="{{ old('Line1_beneficiary') }}" required>
                                                            </div>
                                                            @error('Line1_beneficiary')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-6 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('Line2_beneficiary') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control" name="Line2_beneficiary"
                                                                    id="Line2_beneficiary" value="{{ old('Line2_beneficiary') }}"
                                                                    placeholder="Address Line 2">
                                                            </div>
                                                            @error('Line2')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('TownSuburb_beneficiary') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="TownSuburb_beneficiary" id="TownSuburb_beneficiary"
                                                                    value="{{ old('TownSuburb_beneficiary') }}"
                                                                    placeholder="Town/Suburb_beneficiary">
                                                            </div>
                                                            @error('TownSuburb_beneficiary')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('City_beneficiary') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control" name="City_beneficiary"
                                                                    id="City_beneficiary" value="{{ old('City_beneficiary') }}"
                                                                    placeholder="City">
                                                            </div>
                                                            @error('City')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                            <div
                                                                class="input-group input-group-outline  @error('Province_beneficiary') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="Province_beneficiary" id="Province_beneficiary"
                                                                    value="{{ old('Province_beneficiary') }}" placeholder="Province">
                                                            </div>
                                                            @error('Province')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                                                            <div
                                                                class="input-group input-group-outline  @error('PostalCode_beneficiary') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="PostalCode_beneficiary" id="PostalCode_beneficiary"
                                                                    value="{{ old('PostalCode_beneficiary') }}"
                                                                    placeholder="Postal Code">
                                                            </div>
                                                            @error('PostalCode')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">

                                                        <div class="col-6 col-sm-4 mt-3 mt-sm-0 mx-auto">
                                                            <div
                                                                class="input-group input-group-outline  @error('Country_beneficiary') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control" name="Country_beneficiary"
                                                                    id="Country_beneficiary" value="{{ old('Province_beneficiary') }}"
                                                                    placeholder="Country">
                                                            </div>
                                                            @error('Country')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                    </div>



                                                        <div
                                                            style="text-align: center; display: flex; justify-content: center; align-items: center; ">
                                                            <span style="color: white; margin-right: 10px;">Powered by</span>
                                                            <img src="{{ asset('img/google.png') }}" alt="Google Logo"
                                                                style="width: 50px; height: auto;">
                                                        </div>


                                                        <div class="separator border-light my-8"></div>


                                                     <!-- Payout Payment Details -->
                                                     <div class="row my-3">
                                                        <div class="col">
                                                            <label for="payout_acc_number" class="form-label text-white">Account number:</label>
                                                            <input type="number" class="form-control" id="payout_acc_number" name="payout_acc_number">
                                                        </div>
                                                        <div class="col">
                                                            <label for="bankSelect" class="form-label text-white">Bank:</label>
                                                            <select id="bankSelect" name="bankSelect" class="form-select bg-white form-select-solid" data-control="select2" data-placeholder="Select Bank" data-allow-clear="true" style="margin-right: 10px;">
                                                                <option></option> <!-- Placeholder option for user prompt -->
                                                                @foreach ($banks as $bank)
                                                                    <option value="{{ $bank->id }}">
                                                                        {{ $bank->name }} 
                                                                    </option>
                                                                @endforeach
                                                           
        
                                                            </select>
                                                        </div>
                                                    </div>



                                                    </div>
                                                





                                            </div>
                                    
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-dark" id="saveBeneficiaryBtn">Save Beneficiary</button>
                                                </div>
                                        </form>    
                                        </div>
                                    </div>
                                </div>
                            <!-- END Beneficiary Modal -->



                                <!-- Start Location Address Modal -->
                                <div class="modal fade" tabindex="-1" id="kt_modal_1">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Add Location</h3>
                                
                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>
                                            <form id="addressForm" method="POST" action="{{ route('StoreFuneralAddress') }}">
                                                @csrf
                                            <div class="modal-body">
                                                
                                                
                                               
                                


                                                <div  class="pt-4 p-3">
                                                
                                                    <select id="addressType" name="addressType" class="form-select form-select-solid" data-control="select2" data-placeholder="Select Location Type" data-hide-search="true">
                                                        <option></option>
                                                        <option value="{{ $churchTypeId }}">Church</option>
                                                        <option value="{{ $graveyardTypeId}}">Graveyard</option>
                                                        <option value="21">Viewing Location</option>
                                                    </select>

        
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div
                                                                class="input-group input-group-outline  @error('Line1') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control" id="Line1" name="Line1"
                                                                     value="{{ old('Line1') }}" required>
                                                            </div>
                                                            @error('Line1')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col">
                                                            <div class="input-group input-group-outline  @error('PlaceName') is-invalid focused is-focused  @enderror  mb-0">
                                                                <input type="text" class="form-control" name="PlaceName"
                                                                    id="PlaceName" value="{{ old('PlaceName') }}" placeholder="Location Name" required>
                                                            </div>
                                                            @error('PlaceName')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-6 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('Line2') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control" name="Line2"
                                                                    id="Line2" value="{{ old('Line2') }}"
                                                                    placeholder="Address Line 2">
                                                            </div>
                                                            @error('Line2')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('TownSuburb') is-invalid focused is-focused  @enderror  mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="TownSuburb" id="TownSuburb"
                                                                    value="{{ old('TownSuburb') }}"
                                                                    placeholder="Town/Suburb">
                                                            </div>
                                                            @error('TownSuburb')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12 col-sm-6">
                                                            <div
                                                                class="input-group input-group-outline  @error('City') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control" name="City"
                                                                    id="City" value="{{ old('City') }}"
                                                                    placeholder="City">
                                                            </div>
                                                            @error('City')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                            <div
                                                                class="input-group input-group-outline  @error('Province') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="Province" id="Province"
                                                                    value="{{ old('Province') }}" placeholder="Province">
                                                            </div>
                                                            @error('Province')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                                                            <div
                                                                class="input-group input-group-outline  @error('PostalCode') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control"
                                                                    name="PostalCode" id="PostalCode"
                                                                    value="{{ old('PostalCode') }}"
                                                                    placeholder="Postal Code">
                                                            </div>
                                                            @error('PostalCode')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">

                                                        <div class="col-6 col-sm-4 mt-3 mt-sm-0 mx-auto">
                                                            <div
                                                                class="input-group input-group-outline  @error('Country') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                                <input type="text" class="form-control" name="Country"
                                                                    id="Country" value="{{ old('Province') }}"
                                                                    placeholder="Country">
                                                            </div>
                                                            @error('Country')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                    </div>



                                                        <div
                                                            style="text-align: center; display: flex; justify-content: center; align-items: center; ">
                                                            <span style="color: white; margin-right: 10px;">Powered by</span>
                                                            <img src="{{ asset('img/google.png') }}" alt="Google Logo"
                                                                style="width: 50px; height: auto;">
                                                        </div>


                                                    </div>
                                                





                                            </div>
                                    
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-dark" id="saveLocationBtn">Save Location</button>
                                                </div>
                                        </form>    
                                        </div>
                                    </div>
                                </div>
                            <!-- END Church Address Modal -->




</div>
@endsection

@push('scripts')

 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- Bootstrap Bundle JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 <!-- DataTables JS -->
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>


 <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Google places setup
        initAutocomplete('Line1', {
            Line1: 'Line1',
            Line2: 'Line2',
            PostalCode: 'PostalCode',
            City: 'City',
            TownSuburb: 'TownSuburb',
            Province: 'Province',
            Country: 'Country',
            PlaceName: 'PlaceName'
        });

        // Google places setup for beneficiary
        initAutocomplete('Line1_beneficiary', {
            Line1: 'Line1_beneficiary',
            Line2: 'Line2_beneficiary',
            PostalCode: 'PostalCode_beneficiary',
            City: 'City_beneficiary',
            TownSuburb: 'TownSuburb_beneficiary',
            Province: 'Province_beneficiary',
            Country: 'Country_beneficiary',
        });
    });
</script>

{{-- This is used for the checklist --}}
<script>
   $(document).ready(function() {
    $('.save-btn').click(function() {
        var itemId = $(this).data('id');
        var completedDate = $('#' + itemId + '_completed_date').val();
        var completedTime = $('#' + itemId + '_completed_time').val();
        var note = $('#' + itemId + '_note').val();
        var funeralId = $('input[name="funeral_id"]').val();
        var funeralChecklistId = $('input[name="funeral_checklist_id"]').val();
        var buId = $('input[name="bu_id"]').val();

        $.ajax({
            url: '/funeral/checklist/' + itemId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                funeral_id: funeralId,
                funeral_checklist_id: funeralChecklistId,
                bu_id: buId,
                completed_date: completedDate,
                completed_time: completedTime,
                note: note
            },
            success: function(response) {
                alert('Item saved/updated successfully!');
            },
            error: function(response) {
                alert('Error saving/updating item.');
            }
        });
    });

    $('.cancel-btn').click(function() {
        location.reload();
    });
});

</script>

 <script>
$("#kt_datatable_footer_callback").DataTable({
    "searching": false, // Disables the search box
    "lengthChange": false, // Hides the 'show entries' dropdown
    "footerCallback": function(row, data, start, end, display) {
        var api = this.api(),
            data;

        // Remove the formatting to get integer data for summation
        var intVal = function(i) {
            return typeof i === "string" ?
                i.replace(/[\$,]/g, "") * 1 :
                typeof i === "number" ?
                i : 0;
        };

        // Total over all pages
        var total = api
            .column(4)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Total over this page
        var pageTotal = api
            .column(4, {
                page: "current"
            })
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(4).footer()).html(
            "$" + pageTotal + " ( $" + total + " total)"
        );
    }
});
 </script>


  <script>
$("#kt_datatable_benefit_footer_callback").DataTable({
    "searching": false, // Disables the search box
    "lengthChange": false, // Hides the 'show entries' dropdown
    "footerCallback": function(row, data, start, end, display) {
        var api = this.api(),
            data;

        // Remove the formatting to get integer data for summation
        var intVal = function(i) {
            return typeof i === "string" ?
                i.replace(/[\$,]/g, "") * 1 :
                typeof i === "number" ?
                i : 0;
        };

        // Total over all pages
        var total = api
            .column(4)
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Total over this page
        var pageTotal = api
            .column(4, {
                page: "current"
            })
            .data()
            .reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(4).footer()).html(
            "$" + pageTotal + " ( $" + total + " total)"
        );
    }
});
 </script>


    {{-- <!-- Include jQuery first -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Then include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function toggleDetails(selector) {
            $(selector).slideToggle('slow');
        }
    </script>





    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Listen for the modal showing up
            $('#kt_modal_1').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var locationType = button.data('location-type'); // Extract info from data-* attributes
                var modal = $(this);

                // Determine which option to select based on the clicked button
                if(locationType === 'Church') {
                    modal.find('#addressType').val('{{ $churchTypeId }}').trigger('change');
                } else if(locationType === 'Graveyard') {
                    modal.find('#addressType').val('{{ $graveyardTypeId}}').trigger('change');
                }
            });
        });
    </script> --}}

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Listen for the modal showing up
        $('#kt_modal_beneficiary').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var locationType = button.data('location-type'); // Extract info from data-* attributes
            var modal = $(this);

            // Determine which option to select based on the clicked button
            if(locationType === 'Postal') {
                modal.find('#addressType').val('2').trigger('change');
            } else if(locationType === 'Residential') {
                modal.find('#addressType').val('1').trigger('change');
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Listen for the modal showing up
        $('#kt_modal_payment').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            
            var modal = $(this);
        });
    });
</script>




   

    {{-- This is for accordion header validation colour change --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAccordionButtons = () => {
                document.querySelectorAll('.accordion-item').forEach((accordionItem) => {
                    if (accordionItem.style.display === 'none' || getComputedStyle(accordionItem)
                        .display === 'none') {
                        return; // Skip if the accordion item itself is not visible.
                    }

                    const accordionBody = accordionItem.querySelector('.accordion-collapse');
                    let allFilled = true;

                    accordionBody.querySelectorAll(
                        'input[required], textarea[required], select[required]').forEach((
                    input) => {
                        if (!input.value.trim()) {
                            allFilled = false;
                        }
                    });

                    const accordionButton = accordionItem.querySelector('.accordion-button');
                    if (allFilled) {
                        accordionButton.classList.remove('missing-input');
                    } else {
                        accordionButton.classList.add('missing-input');
                    }
                });
            };

            window.updateRequiredAttributes = () => {
                document.querySelectorAll('.payment-section').forEach(section => {
                    const isVisible = section.style.display !== 'none' && getComputedStyle(section)
                        .display !== 'none';

                    section.querySelectorAll('input, textarea, select').forEach(input => {
                        // Set inputs as required if their section is visible, not required otherwise.
                        input.required = isVisible;

                        // Disable inputs if their section is not visible, enable them otherwise.
                        input.disabled = !isVisible;
                    });
                });
            };


            // Handling the payment method selection
            const paymentMethodSelect = document.getElementById('paymentMethod');


            document.querySelectorAll('.accordion').forEach(accordion => {
                accordion.addEventListener('shown.bs.collapse', checkAccordionButtons);
                accordion.addEventListener('hidden.bs.collapse', checkAccordionButtons);
            });

            document.querySelectorAll('.accordion-item .accordion-collapse').forEach(accordionBody => {
                accordionBody.querySelectorAll('input[required], textarea[required], select[required]')
                    .forEach(input => {
                        input.addEventListener('input', checkAccordionButtons);
                    });
            });

            // Initial setup to ensure correct state based on default or previously selected payment method
            if (paymentMethodSelect) {
                paymentMethodSelect.dispatchEvent(new Event('change'));
            } else {
                window.updateRequiredAttributes();
                checkAccordionButtons();
            }
        });
    </script>



    {{-- This is for the submit buttons for MAIN because they are outside the form tags --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to check for empty required fields within a specific form
            function areRequiredFieldsFilled() {
                // Select only required inputs within the specified form
                const requiredInputs = document.querySelectorAll('#funeralForm input[required], #funeralForm textarea[required], #funeralForm select[required]');
                return Array.from(requiredInputs).every(input => input.value.trim() !== '');
            }
        
            // Function to display the alert
            function showAlert() {
                const alert = document.getElementById('requiredAlert');
                alert.style.setProperty('display', 'flex', 'important');
                alert.style.setProperty('opacity', '1', 'important'); // Make it fully visible
        
                setTimeout(() => {
                    alert.style.setProperty('opacity', '0', 'important'); // Start fading out after 4 seconds
                    setTimeout(() => {
                        alert.style.setProperty('display', 'none', 'important'); // Hide completely after fade-out completes
                    }, 500); // Wait for the transition to finish
                }, 4000);
            }
        
            function handleClick(actionValue) {
                if (window.updateRequiredAttributes) {
                    window.updateRequiredAttributes();
                }
                if (!areRequiredFieldsFilled()) {
                    showAlert();
                    return; // Stop the action if required fields are not filled
                }
                // Trigger the corresponding hidden submit button
                document.querySelector(`button[name="action"][value="${actionValue}"]`).click();
            }
        
            document.getElementById('externalSubmitActionOne').addEventListener('click', function() {
                handleClick('submitActionOne');
            });
        
            document.getElementById('externalSubmitActionTwo').addEventListener('click', function() {
                handleClick('submitActionTwo');
            });
        });
        </script>
        

        {{-- This is for address modal submission --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#saveLocationBtn').on('click', function(event) {
                    event.preventDefault();  // Prevent the default form submission behavior
        
                    var formData = new FormData(document.getElementById('addressForm'));  // Create FormData object from the form
        
                    $.ajax({
                        url: '{{ route("StoreFuneralAddress") }}',  // Use the route name as the endpoint
                        type: 'POST',  // Method type POST
                        data: formData,
                        processData: false,  // Tells jQuery not to convert the data into a string
                        contentType: false,  // Tells jQuery not to set the content type header
                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Address has been saved successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#kt_modal_1').modal('hide'); // Hide the modal on success
        
                                    // Clear all input fields in the form
                                    $('#addressForm').find('input[type=text], input[type=number], textarea, select').val('');
        
                                    // Append the new address to the correct dropdown based on the type and select it
                                    var newOption = new Option(response.name + ' (' + response.line1 + ' - ' + response.suburb + ', ' + response.city + ', ' + response.ZIP + ')', response.id, true, true); // true for selected and defaultSelected
                                    if (response.type === 'Church') {
                                        $('#churchSelect').append(newOption).trigger('change');
                                    } else if (response.type === 'Graveyard') {
                                        $('#graveyardSelect').append(newOption).trigger('change');
                                    } else if (response.type === 'Viewing') {
                                        $('#viewing_location').append(newOption).trigger('change');
                                    }
        
                                    // Check and remove modal backdrop if still present
                                    setTimeout(function() { 
                                        if ($('.modal-backdrop').length) {
                                            $('.modal-backdrop').remove();
                                            $('body').removeClass('modal-open');
                                        }
                                    }, 200); // Wait a bit to ensure modal has closed
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to save the address. Please check the form for errors.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            console.error('Error:', error);
                        }
                    });
                });
        
                $('#kt_modal_1').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var locationType = button.data('location-type'); // Extract info from data-* attributes
                    var modal = $(this);
        
                    // Determine which option to select based on the clicked button
                    if(locationType === 'Church') {
                        modal.find('#addressType').val('{{ $churchTypeId }}').trigger('change');
                    } else if(locationType === 'Graveyard') {
                        modal.find('#addressType').val('{{ $graveyardTypeId}}').trigger('change');
                    } else if(locationType === 'Viewing') {
                        modal.find('#addressType').val('{{ $viewingTypeId}}').trigger('change');
                    }
                });
            });
        </script>
        
            
            
            
            

            <script>
                $(document).ready(function() {
                    $('#churchSelect').select2({
                        placeholder: "Select Church",
                        allowClear: true
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $('#graveyardSelect').select2({
                        placeholder: "Select Cemetery",
                        allowClear: true
                    });
                });
            </script>
                

@endpush
