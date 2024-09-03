@extends('layouts.app2')

@push('styles')
    <!-- CSS Files -->
    {{-- <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .nav-link.active i {
            color: forestgreen;
            text-decoration: underline;
            position: relative;
        }

        .nav-link.active i::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid forestgreen;
            opacity: 0;
            transition: opacity 0.3s, bottom 0.3s;
        }

        .nav-link.active i:hover::after {
            bottom: -15px;
            opacity: 1;
        }
    </style>

    <style>
        .custom-hover-button:hover {
            background-color: #faa456;
            /* Replace with your desired hover background color */
        }
    </style>

    <!-- /*
    |--------------------------------------------------------------------------
    | Laravel Logger Web Routes
    |--------------------------------------------------------------------------
    |
    */ -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        .comment {
            display: grid;
            gap: 14px;

            .user-banner {
                display: flex;
                justify-content: space-between;
                align-items: center;

                .user {
                    gap: 8px;
                    align-items: center;
                    display: flex;

                    .avatar {
                        height: 32px;
                        width: 32px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border: 1px solid transparent;
                        position: relative;
                        border-radius: 100px;
                        font-weight: 500;
                        font-size: 13px;
                        line-height: 20px;

                        img {
                            max-width: 100%;
                            border-radius: 50%;
                        }

                        .stat {
                            display: flex;
                            position: absolute;
                            right: -2px;
                            bottom: -2px;
                            display: block;
                            width: 12px;
                            height: 12px;
                            z-index: 9;
                            border: 2px solid #ffffff;
                            border-radius: 100px;

                            &.green {
                                background: #00ba34;
                            }

                            &.grey {
                                background: #969696;
                            }
                        }
                    }
                }
            }

            .footer {
                gap: 12px;
                display: flex;
                align-items: center;

                .reactions {
                    display: flex;
                    align-items: center;
                    gap: 8px;
                }

                .divider {
                    height: 12px;
                    width: 1px;
                    background: #e8e8e8;
                }
            }

            &:not(.comment:first-child) {
                padding-bottom: 12px;
                margin-bottom: 12px;
                border-bottom: 1px solid #e8e8e8;
            }

            &+& {
                padding-top: 12px;
            }

            &.reply {

                .user-banner,
                .content,
                .footer {
                    margin-left: 32px;
                }
            }
        }
    </style>
    <!-- /*
    |--------------------------------------------------------------------------
    | Laravel Logger Web Routes
    |--------------------------------------------------------------------------
    |
    */ -->
@endpush

@section('row_content')

    <div class="card mb-4 shadow">
        <!--begin::Card body-->
        <div class="card-body row">
            <!--begin::Stepper-->
            <div class="stepper stepper-links d-flex flex-column col-9">
                <div class="mt-2 text-center">

                    <div class="card-header p-0 position-relative mt-n4 z-index-1">
                        {{-- <a href="javascript:history.back()" class="my-auto text-decoration-none btn"> <i class="bi bi-backspace fs-2 text-dark"> Back </i> </a> --}}
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-3 pb-2 mx-auto ">
                            <div class="nav-wrapper position-relative end-0 mx-2 mx-auto">
                                <ul class="nav nav-pills nav-fill p-1 " id="myTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="membership-tab" data-bs-toggle="tab"
                                            href="#membership" role="tab" aria-controls="membership"
                                            aria-selected="false">
                                            <span class="material-icons align-middle mb-1">
                                                assignment
                                            </span>
                                            Membership
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="dependants-tab" data-bs-toggle="tab" href="#dependants"
                                            role="tab" aria-controls="dependants" aria-selected="true">
                                            <span class="material-icons align-middle mb-1">
                                                people
                                            </span>
                                            Dependants
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="addresses-tab" data-bs-toggle="tab" href="#addresses"
                                            role="tab" aria-controls="addresses" aria-selected="false">
                                            <span class="material-icons align-middle mb-1">
                                                business
                                            </span>
                                            Addresses
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="payments-tab" data-bs-toggle="tab" href="#payments"
                                            role="tab" aria-controls="payments" aria-selected="false">
                                            <span class="material-icons align-middle mb-1">
                                                paid
                                            </span>
                                            Payment History
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="membership" role="tabpanel"
                            aria-labelledby="membership-tab">
                            {{-- <h2>Membership Content</h2> --}}
                            <div class="py-3">
                                <!--begin::Notice-->
                                <p class="text-dark fw-semibold fs-6 fst-italic text-capitalize">Edit and update main
                                    membership details</p>
                                <!--end::Notice-->
                            </div>

                            <div class='row'>

                                <div class="card-body g-3 rounded col-12 p-3 border border-body shadow">

                                    <form action="{{ route('update-member', $membership->id) }}" method="POST"
                                        {{ $dis }} role="form" id="membershipForm" name="membershipForm"
                                        class="row g-2">
                                        @csrf
                                        @method('PUT')
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
                                        <div id="feedback" class="my-2"></div>
                                        {{-- <div class="row mw-500px mb-5 d-flex justify-content-center align-items-center mt-5 mb-0" data-kt-buttons="true"> --}}

                                        {{--                                        <div class="col d-flex justify-content-center align-items-center"> --}}
                                        {{--                                            <label class="form-check form-check-custom form-check-solid me-10"> --}}
                                        {{--                                                <input type="radio" class="btn-check" name="language" id="btnradio1" autocomplete="off" {{ $membership->language_id == '1' ? 'checked' : '' }}> --}}
                                        {{--                                                <label class="btn btn-outline-primary form-check-label" for="btnradio1">English</label> --}}
                                        {{--                                            </label> --}}
                                        {{--                                        </div> --}}

                                        {{--                                        <div class="col d-flex justify-content-center align-items-center"> --}}
                                        {{--                                            <label class="form-check form-check-custom form-check-solid me-10"> --}}
                                        {{--                                                <input type="radio" class="btn-check" name="language" id="btnradio2" autocomplete="off" {{ $membership->language_id == '2' ? 'checked' : '' }}> --}}
                                        {{--                                                <label class="btn btn-outline-primary form-check-label" for="btnradio2">Afrikaans</label> --}}
                                        {{--                                            </label> --}}
                                        {{--                                        </div> --}}
                                        {{--                                    </div> --}}
                                        {{-- @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li style="color: white">{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                                @endif --}}

                                        {{-- <hr class="light horizontal mt-2 mb-0"> --}}
                                        {{-- <div class="col-6">
                                                                <div
                                                                    class="form-floating @error('Line1') is-invalid focused is-focused  @enderror  mb-0">
                                                                    <input type="text" class="form-control" name="Line1" id="Line1"
                                                                        value="{{ old('Line1') }}" placeholder="">
                                                                    <label for="Line1" class="fs-4 text-gray-600">Address Line 1<span
                                                                            class="text-danger">*</span></label>
                                                                </div>
                                                                @error('Line1')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong style="color: red;">{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div> --}}

                                        <div class="card-header">
                                            <h1 class="text-center mx-auto text-dark my-auto">Edit Membership</h1>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-floating mt-3 mb-0">

                                                <input type="text" class="form-control bg-light text-dark" name="Name"
                                                    id="Name" value="{{ $membership->name }}" placeholder="" required>
                                                <label for="Name" class="fs-4 text-gray-600">Name<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            @error('Name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="color: red;">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-4">
                                            <div class="form-floating  mt-3 mb-0">

                                                <input type="text" class="form-control bg-light text-dark" name="Surname"
                                                    id="Surname" value="{{ $membership->surname }}" placeholder=""
                                                    required>
                                                <label for="Surname" class="fs-4 text-gray-600">Surname<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            @error('Surname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="col-4">
                                            <div class="form-floating   mt-3 mb-0">

                                                <input type="text" class="form-control bg-light text-dark"
                                                    name="IDNumber" id="IDNumber" value="{{ $membership->id_number }}"
                                                    placeholder="Identity Number" maxlength="13" size="13" required>
                                                <label for="IDNumber" class="fs-4 text-gray-600">Identity Number<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            @error('IDNumber')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-4">
                                            <div class="form-floating mb-0 mt-1">

                                                <input type="email" class="form-control bg-light text-dark"
                                                    name="Email" id="Email"
                                                    value="{{ $membership->primary_e_mail_address }}" placeholder="Email"
                                                    required>

                                                <label for="Email" class="fs-4 text-gray-600">Email Address<span
                                                        class="text-danger">*</span></label>
                                            </div>
                                            {{-- @error('Email')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                        @enderror --}}
                                        </div>

                                        <div class="col-4">
                                            <div class="form-floating mb-0">

                                                <input type="number" class="form-control bg-light text-dark"
                                                    name="Telephone" id="Telephone"
                                                    value="{{ $membership->primary_contact_number }}" placeholder=""
                                                    maxlength="10">
                                                <label for="Telephone" class="fs-4 text-gray-600">Telephone (Cell)</label>
                                            </div>
                                            {{-- @error('Telephone')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                        @enderror --}}
                                        </div>

                                        <div class="col-4">
                                            <div class="form-floating mb-0">

                                                <input type="number" class="form-control bg-light text-dark"
                                                    name="WorkTelephone" id="WorkTelephone"
                                                    value="{{ $membership->secondary_contact_number }}" placeholder="">
                                                <label for="WorkTelephone" class="fs-4 text-gray-600">Telephone
                                                    (Work)</label>
                                            </div>
                                            {{-- @error('WorkTelephone')
                                                                                                        <span class="invalid-feedback" role="alert">
                                                                                                        <strong>{{ $message }}</strong>
                                                                                                        </span>
                                                                                                        @enderror --}}
                                        </div>

                                        {{-- <hr class="dark horizontal mt-2 mb-0"> --}}
                                        <div class="col-3 d-flex align-items-center">
                                            <!-- <div style="white-space:nowrap;" class="px-4">                                                                                                                                                <label for="inputAddress" class="form-label">Date Of Birth</label>
                                                                                                                                                                                                                                                                                                </div> -->
                                            <div class="form-floating">

                                                <input type="text" onkeypress="return isNumberKey(event)"
                                                    class="form-control bg-light text-dark" name="inputDay"
                                                    id="inputDay"
                                                    value="{{ optional(dobBreakdown(optional($membership->person)->birth_date))->day ?? 'N/A' }}"
                                                    {{-- value="{{ $membership->person->birth_date ? dobBreakdown($membership->person->birth_date)->day : 'N/A' }}" --}} placeholder="DD" maxlength="2" size="2"
                                                    required>
                                                <label for="inputDay" class="fs-4 text-gray-600">Day<span
                                                        class="text-danger">*</span></label>
                                                {{-- @error('inputDay')
                                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                                <strong>{{ $message }}</strong>
                                                                                                                </span>
                                                                                                                @enderror --}}
                                            </div>
                                            <span class="px-2"></span>
                                            <div class="form-floating ">

                                                <input type="text" onkeypress="return isNumberKey(event)"
                                                    class="form-control bg-light text-dark" name="inputMonth"
                                                    id="inputMonth"
                                                    value="{{ optional(dobBreakdown(optional($membership->person)->birth_date))->month ?? 'N/A' }}"
                                                    placeholder="MM" maxlength="2" size="2" required>
                                                <label for="inputMonth" class="fs-4 text-gray-600">MM<span
                                                        class="text-danger">*</span></label>
                                                {{-- @error('inputMonth')
                                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                                <strong>{{ $message }}</strong>
                                                                                                                </span>
                                                                                                                @enderror --}}
                                            </div>
                                            <span class="px-2"></span>
                                            <div class="form-floating ">
                                                <input type="text" onkeypress="return isNumberKey(event)"
                                                    class="form-control bg-light text-dark required" name="inputYear"
                                                    id="inputYear"
                                                    value="{{ optional(dobBreakdown(optional($membership->person)->birth_date))->year ?? 'N/A' }}"
                                                    placeholder="YYYY" maxlength="4" size="4" required>
                                                <label for="inputYear" class="fs-4 text-gray-600">Year<span
                                                        class="text-danger">*</span></label>
                                                {{-- @error('inputYear')
                                                                                                                <span class="invalid-feedback" role="alert">
                                                                                                                <strong>{{ $message }}</strong>
                                                                                                                </span>
                                                                                                                @enderror --}}
                                            </div>
                                        </div>

                                        <div class="col-2 pt-4">
                                            {{-- <label class="form-check-label mb-0 me-2 text-lg text-dark" for="language">Gender: </label> --}}

                                            <div class="form-group">
                                                {{-- <label for="genderSelect" class="form-label">Gender</label> --}}
                                                {{-- <select class="form-select" name="radioGender" id="genderSelect">
                                                                    <option value="M"
                                                                        {{ $membership->gender_id == 'M' ? 'selected' : '' }}>Male
                                                                    </option>
                                                                    <option value="F"
                                                                        {{ $membership->gender_id == 'F' ? 'selected' : '' }}>Female
                                                                    </option>
                                                                </select> --}}



                                                <select class="form-select bg-light text-dark" name="radioGender"
                                                    id="genderSelect" required>
                                                    <option value="">Select Gender</option>
                                                    @foreach ($genders as $option)
                                                        <option value="{{ $option->id }}"
                                                            {{ $membership->gender_id == $option->id ? 'selected' : '' }}>
                                                            {{ $option->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="dropdown">
                                                <select name="memtype" id="memtype"
                                                    class="btn bg-light text-dark dropdown-toggle w-100 my-4 @error('Select Membership Type') is-invalid @enderror"
                                                    aria-label="Select Membership Type">
                                                    <option disabled>Select Membership Type</span> </option>
                                                    @foreach ($memtypes as $memtype)
                                                        <option
                                                            {{ $membership->bu_membership_type_id == $memtype->id ? 'selected' : '' }}
                                                            value="{{ $memtype->id }}">{{ $memtype->id }}.
                                                            {{ $memtype->name }} - {{ $memtype->description }} -
                                                            R{{ round($memtype->membership_fee, 2) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3" style="margin-bottom: 1rem;">
                                            <div class="form-group" style="padding-top: 1rem; text-align: center;">
                                                {{-- <label for="maritalStatusSelect" class="form-label">Marital Status</label> --}}
                                                {{-- <label class="form-check-label mb-0 me-2 text-dark" for="marital_status">Maritial Status: </label> --}}

                                                {{-- <select class="form-select pb-3" name="marital_status"
                                                                    id="maritalStatusSelect">
                                                                    <option value="1"
                                                                        {{ $membership->person->married_status == '1' ? 'selected' : '' }}>
                                                                        Married</option>
                                                                    <option value="2"
                                                                        {{ $membership->person->married_status == '2' ? 'selected' : '' }}>
                                                                        Single</option>
                                                                    <option value="3"
                                                                        {{ $membership->person->married_status == '3' ? 'selected' : '' }}>
                                                                        Widowed</option>
                                                                    <option value="4"
                                                                        {{ $membership->person->married_status == '4' ? 'selected' : '' }}>
                                                                        Divorced</option>
                                                                </select> --}}

                                                {{-- <select class="form-select pb-3 bg-light text-dark" name="marital_status"
                                                                        id="maritalStatusSelect">
                                                                        <option value="">Select Marital Status</option>
                                                                        @foreach ($marriages as $status)
                                                                            <option value="{{ $status->id }}"
                                                                                {{ $membership->person->married_status == $status->id ? 'selected' : '' }}>
                                                                                {{ $status->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select> --}}
                                                <select class="form-select pb-3 bg-light text-dark" name="marital_status"
                                                    id="maritalStatusSelect" required>
                                                    <option value="">Select Marital Status</option>
                                                    @foreach ($marriages as $status)
                                                        <option value="{{ $status->id }}"
                                                            {{ optional($membership->person)->married_status == $status->id ? 'selected' : '' }}>
                                                            {{ $status->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                        {{-- <hr class="dark horizontal mt-2 mb-0"> --}}

                                        <div class="col-12">
                                            <div class="text-center  d-flex justify-content-center align-items-center ">
                                                <button type="submit" text="Update"
                                                    class="btn btn-success w-150 my-4 mb-4" id="btnUpdate"><i class="ki-duotone ki-cloud-download fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    </i>
                                                    {{-- <i class="fa fa-save" style="font-size:20px;"></i> --}}
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="rounded bg-gba-light col-5">

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="dependants" role="tabpanel" aria-labelledby="dependants-tab">

                            <div class="py-3">
                                <!--begin::Notice-->
                                <p class="text-dark fw-semibold fs-6 fst-italic text-capitalize">manage dependant list and
                                    add a new dependant</p>
                                <!--end::Notice-->
                            </div>

                            <div class="card-body rounded">
                                <div class="table-responsive p-0">
                                    <h1>Dependants List</h1>

                                    <div class="table-responsive p-0">
                                        @if ($dependants->isEmpty())
                                            <div class="alert alert-warning" role="alert">
                                                <p class="text-center">No data available.</p>
                                            </div>
                                        @else
                                            <table class="table table-rounded table-row-dashed fs-6 g-5 gs-5">
                                                <thead>
                                                    <tr
                                                        class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                                                        <th class="text-center">Manage</th>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">ID Number</th>
                                                        <th class="text-center">Gender</th>
                                                        <th class="text-center">Relationship</th>
                                                        <th class="text-center">Date Of Birth</th>
                                                        <th>Age</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($dependants as $dependant)
                                                        @php
                                                            $age = ageFromDOB($dependant->personDep->birth_date); // Ensure you have a method to calculate age from DOB
                                                        @endphp
                                                        <tr>
                                                            {{-- <td class="text-m font-weight-normal pt-3 text-center">
                                                                <a class="btn btn-link text-danger text-gradient p-0 custom-hover-button"
                                                                    href="/remove-dependant/{{ $dependant->secondary_person_id }}"
                                                                    disabled>
                                                                    <i class="material-icons text-sm">highlight_off</i>Remove
                                                                </a>
                                                            </td> --}}
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                <button
                                                                    class="btn btn-link text-danger text-gradient p-0 custom-hover-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#confirmRemoveModal"
                                                                    data-id="{{ $dependant->secondary_person_id }}">
                                                                    <i
                                                                        class="material-icons text-sm">highlight_off</i>Remove
                                                                </button>
                                                            </td>


                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                <p class="text-sm font-weight-normal mb-0">
                                                                    {{ $dependant->personDep->screen_name ?? 'N/A' }}
                                                                </p>
                                                            </td>
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                <p class="text-sm font-weight-normal mb-0">
                                                                    {{ $dependant->personDep->id_number ?? 'N/A' }}</p>
                                                            </td>
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                <p class="text-sm font-weight-normal mb-0">
                                                                    {{ $genderMap[$dependant->personDep->gender_id] ?? 'Unknown' }}
                                                                </p>
                                                            </td>
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                <p class="text-sm font-weight-normal mb-0">
                                                                    {{ $relationshipMap[$dependant->person_relationship_id] ?? 'Unknown Relationship' }}
                                                                </p>
                                                            </td>
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                <p class="text-sm font-weight-normal mb-0">
                                                                    {{ substr($dependant->personDep->birth_date, 0, 10) ?? 'N/A' }}
                                                                </p>
                                                            </td>
                                                            <td
                                                                class="text-center text-sm fw-bolder mx-auto my-1 pt-2 px-2 badge badge-sm {{ changeAgeBackground($age) }}">
                                                                {{ $age ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr
                                                        class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                                                        <th class="text-center">Manage</th>
                                                        <th class="text-center">Name</th>
                                                        <th class="text-center">ID Number</th>
                                                        <th class="text-center">Gender</th>
                                                        <th class="text-center">Relationship</th>
                                                        <th class="text-center">Date of Birth</th>
                                                        <th>Age</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        @endif
                                    </div>

                                </div>
                            </div>


                            <!-- Add Dependant Block -->
                            <div class="card mt-5 mb-2 rounded shadow" id="add-dependant">
                                <div class="card-header">
                                    <h1 class="text-center mx-auto my-auto text-dark">Add Dependants</h1>
                                </div>

                                <form id="addDependant" method="POST" action="{{ route('add-dependant.store') }}"
                                    autocomplete="off">
                                    @csrf

                                    <div class="card-body rounded">
                                        {{-- <h3 class="mt-6">Add Dependant</h3> --}}

                                        <div class="row">
                                            <div class="col-4">
                                                <div
                                                    class="input-group input-group-outline  @error('Name') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                    <input type="text" class="form-control bg-light text-dark"
                                                        name="Name" id="Name" value="{{ old('Name') }}"
                                                        placeholder="Name" required>
                                                </div>
                                                @error('DepName')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <div
                                                    class="input-group input-group-outline  @error('Surname') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                    <input type="text" class="form-control bg-light text-dark"
                                                        name="Surname" id="Surname" value="{{ old('Surname') }}"
                                                        placeholder="Surname" required>
                                                </div>
                                                @error('DepSurname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <div id="IDNumberDepDiv"
                                                    class="input-group input-group-outline  @error('IDNumberDep') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                    <input type="text" class="form-control bg-light text-dark"
                                                        name="IDNumberDep" id="IDNumberDep"
                                                        value="{{ old('IDNumberDep') }}" placeholder="Identity Number"
                                                        maxlength="13" size="13" onchange="getDOBDep(this.value)"
                                                        required>
                                                </div>
                                                <span class="invalid-feedback" role="alert" id="error"></span>
                                                @error('IDNumberDep')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row ">
                                            <div class="col-4">
                                                <div
                                                    class="py-2 pt-4 col d-flex justify-content-center align-items-center mx-auto">
                                                    <div id="inputDayDepDiv"
                                                        class="input-group input-group-outline @error('inputDayDep') is-invalid @enderror">

                                                        <input type="text" onkeypress="return isNumberKey(event)"
                                                            class="form-control bg-light text-dark" name="inputDayDep"
                                                            id="inputDayDep" value="{{ old('inputDayDep') }}"
                                                            placeholder="DD" maxlength="2" size="2" required>
                                                        @error('inputDayDep')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <span class="px-2">/</span>
                                                    <div id="inputMonthDepDiv"
                                                        class="input-group input-group-outline @error('inputMonthDep') is-invalid @enderror">

                                                        <input type="text" onkeypress="return isNumberKey(event)"
                                                            class="form-control bg-light text-dark" name="inputMonthDep"
                                                            id="inputMonthDep" value="{{ old('inputMonthDep') }}"
                                                            placeholder="MM" maxlength="2" size="2" required>
                                                        @error('inputMonthDep')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <span class="px-2">/</span>
                                                    <div id="inputYearDepDiv"
                                                        class="input-group input-group-outline @error('inputYearDep') is-invalid @enderror">

                                                        <input type="text" onkeypress="return isNumberKey(event)"
                                                            class="form-control bg-light text-dark" name="inputYearDep"
                                                            id="inputYearDep" value="{{ old('inputYearDep') }}"
                                                            placeholder="YYYY" maxlength="4" size="4" required>
                                                        @error('inputYearDep')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <input hidden type="text" class="form-control" name="mainMemberId"
                                                        id="mainMemberId" value="{{ $membership->person_id }}">
                                                </div>
                                            </div>


                                            <div class="col-4" style="margin-top: 15px; text-align: center;">
                                                <select class="form-select bg-light text-dark" name="radioRelationCode"
                                                    id="relationCodeSelect" required>
                                                    <option value="">Select relationship</option>
                                                    @foreach ($relationships as $relationship)
                                                        <option value="{{ $relationship->id }}">{{ $relationship->id }} -
                                                            {{ $relationship->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4" style="margin-top: 15px; text-align: center;">
                                                <select class="form-select bg-light text-dark" name="radioGenderDep"
                                                    id="genderDepSelect" required>
                                                    <option value="">Select gender</option>
                                                    @foreach ($genders as $gender)
                                                        <option value="{{ $gender->id }}">{{ $gender->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <div class="row mt-0">


                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-6 mx-auto">
                                                <div
                                                    class="text-center  d-flex justify-content-center align-items-center ">
                                                    <button type="submit" class="btn btn-success w-40 my-4 mb-4"><i
                                                            class="material-icons">add</i> Add
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <!-- End Add Dependant Block -->
                        </div>
                        <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                            <div class="py-3">
                                <!--begin::Notice-->
                                <p class="text-dark fw-semibold fs-6 fst-italic text-capitalize">manage address list and
                                    append more addresses</p>
                                <!--end::Notice-->
                            </div>

                            <div class="row">

                                <div class="mt-4 mb-4">
                                    <div class="card">

                                        <div class="card-body pt-4">
                                            <ul class="list-group">
                                                <h1>Membership Addresses</h1>
                                                <div class="table-responsive p-0">
                                                    @if ($addresses->isEmpty())
                                                        <div class="alert alert-warning" role="alert">
                                                            <p class="text-center">No data available.</p>
                                                        </div>
                                                    @else
                                                        <table
                                                            class="table table-rounded table-row-dashed fs-6 g-5 gs-5 mt-4 bg-light bg-blend-lighten rounded-3"
                                                            id="addressesTable">
                                                            <thead>
                                                                <tr
                                                                    class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                                                                    <th class="text-center">ID</th>
                                                                    <th class="text-center">Street</th>
                                                                    <th class="text-center">Suburb</th>
                                                                    <th class="text-center">City</th>
                                                                    <th class="text-center">ZIP</th>
                                                                    <th class="text-center">District</th>
                                                                    <th class="text-center">Province</th>
                                                                    <th class="text-center">Created</th>
                                                                    <th class="text-center">Manage</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($addresses as $address)
                                                                    <tr>
                                                                        <td
                                                                            class="text-m font-weight-normal pt-3 text-center">
                                                                            {{ $address->id ?? 'N/A' }}</td>
                                                                        <td
                                                                            class="text-m font-weight-normal pt-3 text-center">
                                                                            {{ $address->line1 ?? 'N/A' }}</td>
                                                                        <td
                                                                            class="text-m font-weight-normal pt-3 text-center">
                                                                            {{ $address->suburb ?? 'N/A' }}</td>
                                                                        <td
                                                                            class="text-m font-weight-normal pt-3 text-center">
                                                                            {{ $address->city ?? 'N/A' }}</td>
                                                                        <td
                                                                            class="text-m font-weight-normal pt-3 text-center">
                                                                            {{ $address->ZIP ?? 'N/A' }}</td>
                                                                        <td
                                                                            class="text-m font-weight-normal pt-3 text-center">
                                                                            {{ $address->district ?? 'N/A' }}</td>
                                                                        <td
                                                                            class="text-m font-weight-normal pt-3 text-center">
                                                                            {{ $address->province ?? 'N/A' }}</td>
                                                                        <td
                                                                            class="text-m font-weight-normal pt-3 text-center">
                                                                            {{ $address->created_at ?? 'N/A' }}</td>
                                                                        {{-- <td class="text-center">
                                                                            <form id="delete-address-form"
                                                                                action="/delete-address/{{ $address->id }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    onclick="return confirm('Are you sure you want to delete this address?')">Delete</button>
                                                                                    
                                                                            </form>
                                                                        </td> --}}
                                                                        <td class="text-center">
                                                                            <form id="delete-address-form"
                                                                                action="/delete-address/{{ $address->id }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-danger"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#confirmDeleteAddressModal"
                                                                                    data-address-id="{{ $address->id }}">
                                                                                    Delete
                                                                                </button>
                                                                            </form>
                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr
                                                                    class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                                                                    <th class="text-center">ID</th>
                                                                    <th class="text-center">Street</th>
                                                                    <th class="text-center">Suburb</th>
                                                                    <th class="text-center">City</th>
                                                                    <th class="text-center">ZIP</th>
                                                                    <th class="text-center">District</th>
                                                                    <th class="text-center">Province</th>
                                                                    <th class="text-center">Created</th>
                                                                    <th class="text-center">Manage</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    @endif
                                                </div>
                                            </ul>
                                        </div>

                                    </div>
                                </div>

                                <div class="mt-4 mb-4 pb-4">

                                    <div class="card h-100 mb-4 rounded shadow">
                                        <div class="card-header">
                                            <h1 class="text-center mx-auto my-auto text-dark">Add New Address</h1>
                                        </div>

                                        <form id="addAddress" method="POST" action="{{ route('address.store') }}"
                                            autocomplete="off">
                                            @csrf
                                            <div class="card-body pt-4 p-3">

                                                <div class="row mt-3">
                                                    <div class="col">
                                                        <div
                                                            class="input-group input-group-outline @error('Line1') is-invalid focused is-focused  @enderror  mb-0">

                                                            <input type="text" class="form-control bg-light text-dark"
                                                                name="Line1" id="Line1"
                                                                value="{{ old('Line1') }}" placeholder="Address Line 1"
                                                                required>
                                                        </div>
                                                        @error('Line1')
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

                                                            <input type="text" class="form-control bg-light text-dark"
                                                                name="Line2" id="Line2"
                                                                value="{{ old('Line2') }}" placeholder="Address Line 2"
                                                                required>
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

                                                            <input type="text" class="form-control bg-light text-dark"
                                                                name="TownSuburb" id="TownSuburb"
                                                                value="{{ old('TownSuburb') }}" placeholder="Town/Suburb"
                                                                required>
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

                                                            <input type="text" class="form-control bg-light text-dark"
                                                                name="City" id="City"
                                                                value="{{ old('City') }}" placeholder="City" required>
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

                                                            <input type="text" class="form-control bg-light text-dark"
                                                                name="Province" id="Province"
                                                                value="{{ old('Province') }}" placeholder="Province"
                                                                required>
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

                                                            <input type="text" class="form-control bg-light text-dark"
                                                                name="PostalCode" id="PostalCode"
                                                                value="{{ old('PostalCode') }}" placeholder="Postal Code"
                                                                required>
                                                        </div>
                                                        @error('PostalCode')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-6 col-sm-4 mt-3 mt-sm-0 mx-auto">
                                                        <div
                                                            class="input-group input-group-outline  @error('Country') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                                            <input type="text" class="form-control bg-light text-dark"
                                                                name="Country" id="Country"
                                                                value="{{ old('Province') }}" placeholder="Country"
                                                                required>
                                                        </div>
                                                        @error('Country')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <input hidden type="text" class="form-control" name="MembershipId"
                                                    id="MembershipId" value="{{ $membership->id }}">

                                                <div class="button-row d-flex mt-4">
                                                    <button id="btnAddAddr" class="btn btn-success mx-auto mb-0 w-40"
                                                        type="submit" title="Add New Address" text="Add"><i
                                                            class="material-icons">add</i>Add
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                            {{-- <h2>Payments Content</h2> --}}
                            {{-- <div class="pb-10 pb-lg-15"> --}}

                            <!-- Payment Details Modal Start -->

                            {{-- <h2 class="text-center">Payments Content</h2> --}}
                            <p class="text-dark fw-semibold fs-6 text-center my-3 fst-italic text-capitalize">View all
                                prevoius billings and make a new payment</p>

                            <div class="card-body pt-4 p-3">

                                <h1>Billing History</h1>
                                @if (collect($billings)->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <div class="alert alert-danger" role="alert">
                                                This membership does not have any billing history.
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <div class="table-responsive p-0">
                                        <table
                                            class="table table-rounded table-row-dashed fs-6 g-5 gs-5 mt-4 bg-light bg-blend-lighten border border-dark rounded-3"
                                            id="datatable-billing">
                                            <thead>
                                                <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                                                    <th class="text-center">Bill ID</th>
                                                    <th class="text-center">Date Issued</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Due Date</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($billings as $billing)
                                                    @if ($billing->membership_id == $membership->id)
                                                        <tr>
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                {{ $billing->id }}</td>
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                {{ $billing->transaction_date }}</td>
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                {{ number_format($billing->receipt_value, 2) }}</td>
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                <span
                                                                    class="badge {{ $billing->transaction_description == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                                                    {{ ucfirst($billing->transaction_description) }}
                                                                </span>
                                                            </td>
                                                            <td class="text-m font-weight-normal pt-3 text-center">
                                                                {{ $billing->created_at }}</td>
                                                            <td class="text-center">
                                                                <form id="delete-billing-form"
                                                                    action="/delete-billing/{{ $billing->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Are you sure you want to delete this billing?')">
                                                                        <i
                                                                            class="material-icons text-sm">delete_outline</i>Remove
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="text-start text-dark fw-bold fs-7 text-uppercase bg-gray-300">
                                                    <th class="text-center">Bill ID</th>
                                                    <th class="text-center">Date Issued</th>
                                                    <th class="text-center">Amount</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Due Date</th>
                                                    <th class="text-center">Actions</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                @endif
                            </div>

                            <div class="p-3 bg-secondary-gradient">
                                <a href="/payments" class="btn btn-sm btn-success" title="Add Payment">
                                    <i class="ki-duotone ki-abstract-10">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Make A Payment
                                </a>
                            </div>
                            
                            <!-- Payment Details Modal End -->
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="mt-2 text-center">

                    <div class="card-header p-0 position-relative mt-n4 mx-auto z-index-1">
                        <div class="bg-gradient-success shadow-success border-radius-lg pt-3 pb-2 mx-auto">
                            <div class="nav-wrapper position-relative end-0 mx-2">
                                <ul class="nav nav-pills nav-fill p-1 " id="myTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="comments-tab" data-bs-toggle="tab"
                                            href="#comments" role="tab" aria-controls="comments"
                                            aria-selected="false">
                                            <span class="material-icons align-middle mb-1">
                                                chat
                                            </span>
                                            Comments
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>



                    <div class="tab-content mt-2" id="myTabContent">
                        <div class="tab-pane active fade show" id="comments">
                            {{-- <h3>Comments Details</h3> --}}
                            <div class="mt-2">
                                <!-- Payment Details Modal Start -->

                                {{-- <h2 class="text-center">Payments Content</h2> --}}
                                <p class="text-dark fw-semibold fs-6 mb-12 fst-italic text-capitalize">All comments about
                                    this membership.</p>

                                <div class="tab-content mt-2">
                                    <!--end::Nav-->
                                    <!-- /*
                                                |--------------------------------------------------------------------------
                                                | Laravel Logger Web Routes
                                                |--------------------------------------------------------------------------
                                                |
                                                */ -->

                                    @foreach ($comments as $comment)
                                        <div class="block bg-body p-2 mb-2 border border-light rounded shadow-sm">
                                            @if (!is_array($comment->text))
                                                <div class="comment">
                                                    <div class="user-banner">
                                                        <div class="user">
                                                            <div class="avatar">
                                                                <img src="{{ asset('assets/media/avatars/blank.png') }}">
                                                                <!-- <span class="stat grey"></span> -->
                                                            </div>
                                                            <h5>{{ $comment->author }}</h5>
                                                        </div>
                                                        @if ($comment->created_at == $comment->updated_at)
                                                            <p class="text-muted fs-6 p-0 m-0">
                                                                {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}
                                                            </p>
                                                        @else
                                                            <p class="text-muted fs-6 p-0 m-0">
                                                                {{ \Carbon\Carbon::parse($comment->updated_at)->diffForHumans() }}
                                                            </p>
                                                        @endif

                                                        <!-- <button class="btn dropdown"><i class="ri-more-line"></i></button> -->
                                                    </div>
                                                    <div class="content p-0">
                                                        <!-- Check if $comment->text is a string that needs to be decoded or already an object/array -->
                                                        @php
                                                            if (is_string($comment->text)) {
                                                                // Decode if it's a string
    $commentText = json_decode($comment->text, true);
} else {
    // Use it directly if it's already an object/array
                                                                $commentText = $comment->text;
                                                            }
                                                        @endphp

                                                        <!-- Display the decoded or direct data -->
                                                        @if (is_array($commentText) || is_object($commentText))
                                                            @foreach ($commentText as $key => $value)
                                                                @if ($key === 'title')
                                                                    <!-- Display only the value of the 'title' key -->
                                                                    <div><strong>{{ $value }}</strong></div>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <!-- If it's not an array/object, display it directly -->
                                                            {{ $commentText }}
                                                        @endif
                                                    </div>
                                                    <div class="footer d-flex justify-content-between">

                                                        @if ($comment->created_at == $comment->updated_at)
                                                            <p class="text-muted fs-6 p-0 m-0">Created :
                                                                {{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}
                                                            </p>
                                                        @else
                                                            <p class="text-muted fs-6 p-0 m-0">Updated :
                                                                {{ \Carbon\Carbon::parse($comment->updated_at)->format('Y-m-d') }}
                                                            </p>
                                                        @endif

                                                        <!-- <p>Created Date: {{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</p>
                                                        <p>Created Time: {{ \Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</p> -->

                                                        <!-- Code for updated Comments by Author -->
                                                        <!-- <p>Updated Date: {{ \Carbon\Carbon::parse($comment->updated_at)->format('Y-m-d') }}</p>
                                                        <p>Updated Time: {{ \Carbon\Carbon::parse($comment->updated_at)->diffForHumans() }}</p> -->

                                                        <div class="reactions">
                                                            <!-- Button trigger modal -->
                                                            @if (Auth::id() === $comment->users_id)
                                                            <a href="#" class="btn btn-sm btn-icon btn-warning"
                                                                title="Edit" data-bs-toggle="modal"
                                                                data-bs-target="#editCommentModal"
                                                                onclick="openEditModal({{ $comment->id }})">
                                                                <i class="bi bi-pencil-fill fs-4 me-0"></i>
                                                            </a>
                                                            @else
                                                            <!-- Button with class instead of id -->
                                                            <button class="AuthorDeleteEdit btn btn-sm btn-icon btn-warning"
                                                                data-bs-toggle="tooltip" title="Edit">
                                                                <i class="bi bi-pencil-fill fs-4 me-0"></i>
                                                            </button>
                                                            <p id="unauthorizedMessageEdit" hidden>You are not authorized
                                                                to edit this comment. Only {{ $comment->author }}
                                                                can edit this comment.</p>
                                                        @endif

                                                            <!-- <form method="POST" action="{{ url('comments/' . $comment->id) }}"
                                                                                                        style="display:inline">
                                                                                                        @csrf
                                                                                                        @method('DELETE')
                                                                                                        <button type="submit" class="btn btn-sm btn-icon btn-danger"
                                                                                                            data-bs-toggle="tooltip" title="Remove"><i
                                                                                                                class="bi bi-trash3 fs-4 me-0"></i></button>
                                                                                                    </form> -->

                                                            @if (Auth::id() === $comment->users_id)
                                                                <!-- Check if the logged-in user is the author -->
                                                                <!-- <form method="POST" action="{{ url('comments/' . $comment->id) }}" style="display:inline" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-icon btn-danger" data-bs-toggle="tooltip" title="Remove">
                                                            <i class="bi bi-trash3 fs-4 me-0"></i>
                                                        </button>
                                                    </form> -->

                                                                <form method="POST"
                                                                    action="{{ url('comments/' . $comment->id) }}"
                                                                    style="display:inline"
                                                                    onsubmit="confirmDelete(event)">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-icon btn-danger"
                                                                        data-bs-toggle="tooltip" title="Remove">
                                                                        <i class="bi bi-trash3 fs-4 me-0"></i>
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <!-- Button with class instead of id -->
                                                                <button class="AuthorDelete btn btn-sm btn-icon btn-danger"
                                                                    data-bs-toggle="tooltip" title="Remove">
                                                                    <i class="bi bi-trash3 fs-4 me-0"></i>
                                                                </button>
                                                                <p id="unauthorizedMessage" hidden>You are not authorized
                                                                    to delete this comment. Only {{ $comment->author }}
                                                                    can delete this comment.</p>
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <label
                                                    class="bg-danger btn btn-outline btn-outline-dashed p-4 d-flex align-items-center m-2"
                                                    for="kt_radio_buttons_2_option_2">
                                                    <i class="ki-duotone ki-message-text-2 fs-4x me-4"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span></i>

                                                    <span class="d-block fw-semibold text-start">
                                                        <span> {{-- class="text-gray-900 fw-bold d-block fs-3">{{ $ct->id }}</span>  <span class="text-light fw-semibold fs-6"> --}}
                                                            No Comments</span>
                                                    </span>
                                                </label>
                                            @endif
                                        </div>
                                    @endforeach
                                    <div class="mt-4"><button class="btn btn-sm btn-success" title="Add Comment"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="ki-duotone ki-abstract-10">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Add New Comment</i>
                                        </button></div>

                                    <!-- <div class="block bg-body shadow-sm">
                                                    <div class="comment">
                                                        <div class="user-banner">
                                                            <div class="user">
                                                                <div class="avatar">
                                                                    <img src="https://randomuser.me/api/portraits/men/86.jpg">
                                                                    <span class="stat grey"></span>
                                                                </div>
                                                                <h5>Floyd Miles</h5>
                                                            </div>
                                                            <button class="btn dropdown"><i class="ri-more-line"></i></button>
                                                        </div>
                                                        <div class="content p-0">
                                                            Actually, now that I try out the links on my message, above, none of them take me to the secure site. Only my shortcut on my desktop, which I created years ago.
                                                        </div>
                                                        <div class="footer">
                                                            
                                                        <span class="text-gray-400">6 hour ago</span>
                                                            <div class="reactions">
                                                                <button class="btn react"><img src="https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/160/apple/325/thumbs-up_1f44d.png" alt="">Edit</button>
                                                                <button class="btn react"><img src="https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/160/apple/325/angry-face-with-horns_1f47f.png" alt="">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div> -->
                                    <!-- /*
                                                |--------------------------------------------------------------------------
                                                | Laravel Logger Web Routes
                                                |--------------------------------------------------------------------------
                                                |
                                                */ -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Comment Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Comment</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf <!-- CSRF token for security -->
                            <div class="modal-body">

                                <!--begin::Input group-->

                                <div class="form-floating">

                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Comment:</label>
                                        <textarea class="form-control" name="text"id="message-text"></textarea>
                                    </div>

                                    <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                                    <!-- Example value -->
                                    <input type="hidden" name="link"
                                        value="{{ route('view-member', $membership->id) }}">
                                    <!-- Example value -->
                                    <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="model_name" value="Membership"> <!-- Example value -->
                                    <input type="hidden" name="model_record" value="{{ $membership->id }}">
                                    <!-- Example, should be dynamically set -->
                                    {{-- <button type="submit" class="btn btn-success mt-2">Add</button> --}}

                                    <!--end::Input group-->
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Comment Modal -->
            <div class="modal fade" id="editCommentModal" tabindex="-1" aria-labelledby="editCommentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editCommentModalLabel">Edit Comment</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="POST" id="editCommentForm" action="#">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit-comment-text" class="col-form-label">Comment:</label>
                                    <textarea class="form-control" name="text" id="edit-comment-text"></textarea>
                                </div>
                                <input type="hidden" name="comment_id" id="edit-comment-id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Delete Address Confirmation Modal -->
            <div class="modal fade" id="confirmDeleteAddressModal" tabindex="-1"
                aria-labelledby="confirmDeleteAddressModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteAddressModalLabel">Confirm Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this address?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteAddressButton">Delete</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Confirmation Modal -->
            <div class="modal fade" id="confirmRemoveModal" tabindex="-1" aria-labelledby="confirmRemoveModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmRemoveModalLabel">Confirm Removal</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to remove this dependant?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a class="btn btn-danger" id="confirmRemoveButton">Remove</a>
                        </div>
                    </div>
                </div>
            </div>





            <!--end::Card-->
            <link rel="stylesheet"
                href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

        @endsection

        @push('scripts')
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Show the tab based on the URL hash
                    var hash = window.location.hash;
                    if (hash) {
                        var tabElement = document.querySelector(`a[href="${hash}"]`);
                        if (tabElement) {
                            var tab = new bootstrap.Tab(tabElement);
                            tab.show();
                        }
                    } else {
                        // Default to the first tab if no hash is present
                        var firstTab = document.querySelector('a[data-bs-toggle="tab"]');
                        if (firstTab) {
                            var tab = new bootstrap.Tab(firstTab);
                            tab.show();
                        }
                    }

                    // Update the URL hash when a tab is shown
                    var tabLinks = document.querySelectorAll('a[data-bs-toggle="tab"]');
                    tabLinks.forEach(function(tabLink) {
                        tabLink.addEventListener('shown.bs.tab', function(event) {
                            window.location.hash = event.target.getAttribute('href');
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var removeButtons = document.querySelectorAll('.custom-hover-button');

                    removeButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var dependantId = button.getAttribute('data-id');
                            var confirmButton = document.getElementById('confirmRemoveButton');
                            confirmButton.href = `/remove-dependant/${dependantId}`;
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var deleteButtons = document.querySelectorAll('[data-bs-target="#confirmDeleteAddressModal"]');

                    deleteButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var addressId = button.getAttribute('data-address-id');
                            var form = document.getElementById('delete-address-form');
                            form.action = `/delete-address/${addressId}`;

                            document.getElementById('confirmDeleteAddressButton').onclick = function() {
                                form.submit();
                            };
                        });
                    });
                });
            </script>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
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
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Listener for when a new tab is shown
                    $('#myTabs a').on('shown.bs.tab', function(event) {
                        var activeTab = $(event.target).attr('href'); // Get the href of the active tab
                        localStorage.setItem('activeTab', activeTab); // Store it in localStorage
                        console.log("Tab changed to: " + activeTab); // Debugging: log the active tab
                    });

                    // Retrieve the active tab from localStorage on page load
                    var activeTab = localStorage.getItem('activeTab');
                    console.log("Loaded activeTab from storage: " + activeTab); // Debugging: log the loaded tab
                    if (activeTab && $('#myTabs a[href="' + activeTab + '"]').length > 0) {
                        $('#myTabs a[href="' + activeTab + '"]').tab('show'); // Show the active tab
                    } else {
                        var membershipTab = $('#myTabs a[href="#membership"]'); // Target the #membership tab
                        if (membershipTab.length > 0) {
                            membershipTab.tab('show'); // Show the membership tab if it exists
                            console.log("Defaulting to membership tab"); // Debugging: log the default tab
                        } else {
                            var firstTab = $('#myTabs a').first(); // Find the first tab as a fallback
                            firstTab.tab('show'); // Show the first tab if no membership tab is found
                            console.log("Fallback to first tab: " + firstTab.attr(
                                'href')); // Debugging: log the fallback tab
                        }
                    }

                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchInput');
                    const tableRows = document.querySelectorAll('#datatable-dependant tbody tr');

                    searchInput.addEventListener('keyup', function() {
                        const searchQuery = searchInput.value.toLowerCase();

                        tableRows.forEach(row => {
                            const rowText = row.textContent.toLowerCase();
                            const isVisible = rowText.includes(searchQuery);
                            row.style.display = isVisible ? '' : 'none';
                        });
                    });
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const rowsPerPage = 5;
                    const rows = document.querySelectorAll('#datatable-dependant tbody tr');
                    const rowsCount = rows.length;
                    const pageCount = Math.ceil(rowsCount / rowsPerPage);
                    const pagination = document.getElementById('pagination');

                    function setPage(page) {
                        rows.forEach((row, index) => {
                            row.style.display = (index >= page * rowsPerPage && index < (page + 1) * rowsPerPage) ?
                                '' : 'none';
                        });
                    }

                    for (let i = 0; i < pageCount; i++) {
                        const btn = document.createElement('button');
                        btn.innerText = i + 1;
                        btn.addEventListener('click', () => setPage(i));
                        pagination.appendChild(btn);
                    }

                    setPage(0); // Set initial page
                });
            </script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    document.querySelectorAll('.edit-comment-button').forEach(button => {
                        button.addEventListener('click', function() {
                            const commentId = this.dataset.commentId;
                            fetch(`/comments/${commentId}/edit`)
                                .then(response => response.json())
                                .then(data => {
                                    // Populate the modal with the comment data
                                    document.getElementById('commentText').value = data
                                        .text; // Assuming 'text' is the field name
                                    document.getElementById('editCommentForm').action =
                                        `/comments/${commentId}/update`; // Update form action URL

                                    // Show the modal
                                    var editCommentModal = new bootstrap.Modal(document.getElementById(
                                        'editCommentModal'));
                                    editCommentModal.show();
                                })
                                .catch(error => console.error('Error:', error));
                        });
                    });
                });
            </script>

            {{-- <script>
        var membershipId = {{ $membership->id }};
        var deletedRecords = []; // Array to store IDs of deleted records

        $(document).ready(function() {
            $.ajax({
                url: '', // Adjust this if your URL is different
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var tableBody = $('#addressesTable tbody');
                    $.each(data, function(index, item) {
                        if (membershipId == item.membership_id) {
                            var row = $('<tr>').append(
                                $('<td>').text(item.id),
                                $('<td>').text(item.membership_id),
                                $('<td>').text(item.address_id),
                                $('<td>').text(item.start_date),
                                $('<td>').text(item.created_at),
                                $('<td>').append(
                                    $('<button>').text('Delete').addClass(
                                        'btn-sm bg-danger m-1 p-1 delete-button').click(
                                        function() {
                                            if (confirm(
                                                    "Are you sure you want to delete this record?"
                                                )) {
                                                var itemId = $(this).closest('tr').find('td:first').text(); // Get the ID of the record to delete
                                                deletedRecords.push(itemId); // Store the deleted record ID
                                                console.log("Deleted record ID: " + itemId); // Log the ID of the deleted record
                                                $(this).closest('tr').remove();
                                                // Add AJAX call to delete the record from the server here if needed
                                                $.ajax({
                                                    url: ,
                                                    type: 'DELETE',
                                                    headers: {
                                                        'X-CSRF-TOKEN': $(
                                                            'meta[name="csrf-token"]'
                                                        ).attr(
                                                            'content'
                                                        ) // CSRF token needed if using web middleware
                                                    },
                                                    success: function(result) {
                                                        console.log(
                                                            "Record deleted successfully: " +
                                                            itemId);
                                                    },
                                                    error: function(jqXHR,
                                                        textStatus, errorThrown
                                                    ) {
                                                        console.log(
                                                            "Failed to delete record... " + "Status: " +
                                                            textStatus +
                                                            ", " +
                                                            errorThrown);
                                                    }
                                                });
                                            }
                                        })
                                )
                            );
                            tableBody.append(row);
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX call failed: " + textStatus + ", " + errorThrown);
                }
            });
        });
    </> --}}

            {{-- Start script to populate they table for billing --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var paymentModal = document.getElementById('kt_modal_stacked_4');

                    paymentModal.addEventListener('shown.bs.modal', function() {
                        fetch('/dependantsData') // Adjust the API endpoint as needed
                            .then(response => response.json())
                            .then(data => {
                                const tbody = document.getElementById('billingHistoryBody');
                                tbody.innerHTML = ''; // Clear existing rows
                                if (data && data.length > 0) {
                                    data.forEach(payment => {
                                        const row = `<tr>
                            <td>${payment.date}</td>
                            <td>${payment.description}</td>
                            <td>${payment.amount}</td>
                            <td><a href="#" target="_blank">View</a></td>
                        </tr>`;
                                        tbody.innerHTML += row;
                                    });
                                } else {
                                    tbody.innerHTML =
                                        '<tr><td colspan="4" class="text-center">No payment details available</td></tr>';
                                }
                            })
                            .catch(error => {
                                console.error('Error loading the payment data:', error);
                                const tbody = document.getElementById('billingHistoryBody');
                                tbody.innerHTML =
                                    '<tr><td colspan="4" class="text-center">Failed to load data</td></tr>';
                            });
                    });
                });
            </script>
            {{-- End script to populate they table for billing --}}

            <script>
                function openEditModal(commentId) {
                    // Fetch comment data
                    fetch('/comments/' + commentId + '/edit')
                        .then(response => response.json())
                        .then(comment => {
                            // Populate the modal fields with comment data
                            document.getElementById('edit-comment-id').value = comment.id;
                            document.getElementById('edit-comment-text').value = JSON.parse(comment.text).title;
                            document.getElementById('editCommentForm').action = '/comments/' + commentId;
                        })
                        .catch(error => console.error('Error fetching comment:', error));
                }
            </script>

            <script>
                function confirmDelete(event) {
                    // Prevent the form from submitting immediately
                    event.preventDefault();

                    // Use SweetAlert to show the confirmation dialog
                    Swal.fire({
                        icon: 'warning',
                        title: 'Are you sure?',
                        text: 'Do you really want to delete this comment?',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If the user confirms, submit the form
                            event.target.submit();
                        }
                    });
                }
            </script>

            <script>
                // Select all elements with the class 'AuthorDelete'
                var deleteButtons = document.querySelectorAll('.AuthorDelete');

                // Add a click event listener to each button
                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        // Prevent the default action of the button
                        event.preventDefault();
                        // Get the hidden paragraph text
                        var message = document.getElementById('unauthorizedMessage').innerText;
                        // Show the message using SweetAlert
                        Swal.fire({
                            icon: 'error', // or 'warning' depending on the style you want
                            title: 'Unauthorized Action',
                            text: message,
                            confirmButtonText: 'OK'
                        });
                    });
                });

                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();

                        // Check if user is authorized
                        var message = document.getElementById('unauthorizedMessage').innerText;
                        if (message) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Unauthorized Action',
                                text: message,
                                confirmButtonText: 'OK'
                            });
                        } else {
                            // Use SweetAlert for delete confirmation
                            Swal.fire({
                                icon: 'warning',
                                title: 'Are you sure?',
                                text: 'Do you really want to delete this comment?',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Submit the form if confirmed
                                    button.closest('form').submit();
                                }
                            });
                        }
                    });
                });
            </script>

            <script>
                // Select all elements with the class 'AuthorDeleteEdit'
                var deleteButtons = document.querySelectorAll('.AuthorDeleteEdit');

                // Add a click event listener to each button
                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        // Prevent the default action of the button
                        event.preventDefault();
                        // Get the hidden paragraph text
                        var message = document.getElementById('unauthorizedMessageEdit').innerText;
                        // Show the message using SweetAlert
                        Swal.fire({
                            icon: 'error', // or 'warning' depending on the style you want
                            title: 'Unauthorized Action',
                            text: message,
                            confirmButtonText: 'OK'
                        });
                    });
                });

                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();

                        // Check if user is authorized
                        var message = document.getElementById('unauthorizedMessageEdit').innerText;
                        if (message) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Unauthorized Action',
                                text: message,
                                confirmButtonText: 'OK'
                            });
                        } else {
                            // Use SweetAlert for delete confirmation
                            Swal.fire({
                                icon: 'warning',
                                title: 'Are you sure?',
                                text: 'Do you really want to delete this comment?',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Submit the form if confirmed
                                    button.closest('form').submit();
                                }
                            });
                        }
                    });
                });
            </script>
@endpush
