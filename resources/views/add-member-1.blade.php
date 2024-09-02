@extends('layouts.app2')

@push('styles')
    <!-- CSS Files -->
    {{-- <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">  --}}

    <style>
        /* Dark theme */
        [data-bs-theme=dark] input {
            color: beige !important;
        }

        /* Light theme */
        [data-bs-theme=light] input {
            color: Black !important;
        }

        btn-group {
            color: red !important;
        }

        .imputsection {
            border-radius: 10px;
            padding: 1em;
            margin: 1em;
        }

        .text-gba {
            color: #0d8503;
        }

        ::placeholder {
            background-color: white !important;
            color: gray !important;
            /* Change the color of the placeholder text */
            font-style: italic;
            /* Makes the placeholder text italic */
            opacity: 0.4;
            /* Adjust the opacity as needed (1 is fully opaque) */
        }
    </style>

    <style>
        .btn-check+.btn:hover {
            color: white !important;
            background-color: green !important;
        }

        input {
            background-color: white !important;
        }
    </style>
@endpush

@section('row_content')

    {{-- <button id="kt_drawer_example_permanent_toggle" class="btn btn-secondary">Add Comments</button> --}}

    <!--begin:: Comments Drawer-->
    <div id="kt_drawer_example_permanent" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
        data-kt-drawer-toggle="#kt_drawer_example_permanent_toggle" data-kt-drawer-close="#kt_drawer_example_permanent_close"
        data-kt-drawer-overlay="true" data-kt-drawer-permanent="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}">
        <!--begin::Card-->
        <div class="card rounded-0 w-100">
            <!--begin::Card header-->
            <div class="card-header pe-5">
                <!--begin::Title-->
                <div class="card-title">
                    Comments Drawer
                </div>
                <!--end::Title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_example_permanent_close">
                        <span class="svg-icon fs-1">
                            X </span>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body hover-scroll-overlay-y">
                ...
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end:: Comments Drawer-->

    <!--begin::Card-->
    <div class="card bg-gba-light rounded mb-4 border-gba-light shadow-lg">
        <div class="card-title pt-4 -0 mt-4 border-gba bg-gba">
            <h1 class="text-center">Add New Member</h1>
        </div>
        <!--begin::Form-->
        <div class="mx-2">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>


        <form method="POST" action="{{ route('add-member.store') }}" autocomplete="off">
            @csrf
            <div class="imputsection bg-gba-subtle border-gba shadow-lg">
                <div>
                    <!--begin::Title-->
                    <h1 class="fw-bold d-flex align-items-center text-gba">Personal Info
                        <span class="ms-1" data-bs-toggle="tooltip"
                            title="Fill all required information about the membership your adding.">
                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            {{--                                    </span> --}}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Notice-->
                    <div class="fw-semibold fs-6">Mandatory information</div>
                    <!--end::Notice-->
                </div>
                <div>
                    {{-- <div class="row">
                        <div class="col-12 col-sm-6 mx-auto ">
                            <div
                                class="form-check form-switch col d-flex justify-content-center align-items-center mt-5 mb-0">
                                <label class="fw-semibold fs-2 form-label">Select Language : </label>
                                <div class="btn-group rounded-top border border-primary-subtle" role="group"
                                    aria-label="Language selection">
                                    <input type="radio" class="btn-check bg-gba" name="language" id="2"
                                        autocomplete="off">
                                    <label class="btn btn-outline-success bg-gba-light" for="2">English</label>

                                    <input type="radio" class="btn-check" name="language" id="1"
                                        autocomplete="off">
                                    <label class="btn btn-outline-success bg-gba-light" for="1">Afrikaans</label>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div
                                class="input-group input-group-outline  @error('Name') is-invalid focused is-focused  @enderror mt-3 mb-0 bold-placeholder">

                                <input type="text" class="multisteps-form__input form-control" name="Name"
                                    id="Name" value="{{ old('Name') }}" placeholder="Enter Name(s)">
                            </div>
                            @error('Name')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <div
                                class="input-group input-group-outline  @error('Surname') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                <input type="text" class="multisteps-form__input form-control" name="Surname"
                                    id="Surname" value="{{ old('Surname') }}" placeholder="Enter Surname">
                            </div>
                            @error('Surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div id="IDNumber"
                                class="input-group input-group-outline  @error('IDNumber') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                <input type="text" class="multisteps-form__input form-control" name="IDNumber"
                                    id="IDNumber" value="{{ old('IDNumber') }}" placeholder="Enter ID Number"
                                    maxlength="13" size="13" onchange="getDOB(this.value)">
                            </div>
                            <span class="invalid-feedback" role="alert" id="error"></span>
                            @error('IDNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6" style="
											padding-top: 0.18rem;
										">
                            <div class="py-2 col d-flex justify-content-center align-items-center mx-auto">
                                <!-- <div style="white-space:nowrap;" class="px-4">
                                                             <label class="form-label">Date Of Birth</label>

                                                            </div> -->
                                <div id="inputDayDiv"
                                    class="input-group input-group-outline @error('inputDay') is-invalid @enderror">

                                    <input type="text" onkeypress="return isNumberKey(event)"
                                        class="multisteps-form__input form-control" name="inputDay" id="inputDay"
                                        value="{{ old('inputDay') }}" placeholder="DD" maxlength="2" size="2">
                                    @error('inputDay')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <span class="px-2"></span>
                                <div id="inputMonthDiv"
                                    class="input-group input-group-outline @error('inputMonth') is-invalid @enderror">

                                    <input type="text" onkeypress="return isNumberKey(event)"
                                        class="multisteps-form__input form-control" name="inputMonth" id="inputMonth"
                                        value="{{ old('inputMonth') }}" placeholder="MM" maxlength="2" size="2">

                                </div>
                                {{-- @error('inputMonth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="color: red;">{{ $message }}</strong>
                                                </span>
                                            @enderror --}}
                                <span class="px-2"></span>
                                <div id="inputYearDiv"
                                    class="input-group input-group-outline @error('inputYear') is-invalid @enderror">

                                    <input type="text" onkeypress="return isNumberKey(event)"
                                        class="multisteps-form__input form-control" name="inputYear" id="inputYear"
                                        value="{{ old('inputYear') }}" placeholder="YYYY" maxlength="4"
                                        size="4">
                                    @error('inputYear')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-6 mt-3 mt-sm-0">
                            <div class="pb-2">
                                <!-- <label class="form-label col d-flex justify-content-center mx-auto">Marital status</label> -->
                                {{-- <div class="btn-group  col d-flex justify-content-center align-items-center mx-auto"
                                    style="padding-top: 0.75rem;">
                                    <input type="radio" class="btn-check form-check-input" name="marital_status"
                                        id="Married" value="1" />
                                    <label class="btn bg-gba-light btn-outline-success" for="Married">Married</label>

                                    <input type="radio" class="btn-check form-check-input" name="marital_status"
                                        id="Single" value="2" />
                                    <label class="btn bg-gba-light btn-outline-success" for="Single">Single</label>

                                    <input type="radio" class="btn-check form-check-input" name="marital_status"
                                        id="Widowed" value="3" />
                                    <label class="btn bg-gba-light btn-outline-success" for="Widowed">Widowed</label>

                                    <input type="radio" class="btn-check form-check-input" name="marital_status"
                                        id="Divorced" value="4" />
                                    <label class="btn bg-gba-light btn-outline-success" for="Divorced">Divorced</label>
                                </div> --}}

                                <div class="btn-group col d-flex justify-content-center align-items-center mx-auto"
                                    style="padding-top: 0.75rem;">
                                    <select class="form-control form-control-solid" id="marital_status" name="marital_status">
                                        <option value="">Select Marital Status</option>
                                        @foreach ($maritalStatuses as $status)
                                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="col-4 pt-3 mt-sm-0" style="margin-top: 25px;">
                            {{-- <div class="btn-group  col d-flex justify-content-center align-items-center mx-auto">

                                <input type="radio" class="btn-check form-check-input " name="radioGender"
                                    id="Male" value="M" />
                                <label class="btn bg-gba-light btn-outline-success" for="Male">Male</label>

                                <input type="radio" class="btn-check form-check-input " name="radioGender"
                                    id="Female" value="F" />
                                <label class="btn bg-gba-light btn-outline-success" for="Female">Female</label>

                            </div> --}}
                            
                            <div class="btn-group col d-flex justify-content-center align-items-center mx-auto">
                                <select class="form-control form-control-solid" id="radioGender" name="radioGender">
                                    <option value="">Select Gender</option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->id }}">{{ $gender->id }} - {{ $gender->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            {{-- <div class="btn-group col d-flex justify-content-center align-items-center mx-auto"
                                style="padding-top: 0.75rem;">
                                <input type="radio" class="btn-check form-check-input" name="language" id="2"
                                    autocomplete="off">
                                <label class="btn bg-gba-light btn-outline-success" for="2">English</label>

                                <input type="radio" class="btn-check form-check-input" name="language" id="1"
                                    autocomplete="off">
                                <label class="btn bg-gba-light btn-outline-success" for="1">Afrikaans</label>
                            </div> --}}
                            <div class="btn-group col d-flex justify-content-center align-items-center mx-auto"
                                style="padding-top: 0.75rem;">
                                <select class="form-control form-control-solid" id="language" name="language">
                                    <option value="">Select Language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                    </div>
                    <div class="button-row d-flex mt-4">

                    </div>
                </div>
            </div>

            <div class="imputsection bg-gba-subtle border-gba shadow-lg">
                <div>
                    <!--begin::Title-->
                    <h1 class="fw-bold d-flex align-items-center text-gba">Location
                        <span class="ms-1" data-bs-toggle="tooltip" title="">
                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                    </h1>
                    <!--end::Title-->
                    <!--begin::Notice-->
                    <div class=" fw-semibold fs-6">Tell us where you live</div>
                    <!--end::Notice-->
                </div>
                <div>
                    <div class="row mt-3">
                        <div class="col">
                            <div
                                class="input-group input-group-outline  @error('Line1') is-invalid focused is-focused  @enderror  mb-0">
                                <input type="text" class="multisteps-form__input form-control" name="Line1"
                                    id="Line1" value="{{ old('Line1') }}">
                            </div>
                            @error('Line1')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6 col-sm-6">
                            <div
                                class="input-group input-group-outline  @error('Line2') is-invalid focused is-focused  @enderror  mb-0">

                                <input type="text" class="multisteps-form__input form-control" name="Line2"
                                    id="Line2" value="{{ old('Line2') }}" placeholder="Add Line 2">
                            </div>
                            @error('Line2')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 col-sm-6">
                            <div
                                class="input-group input-group-outline  @error('TownSuburb') is-invalid focused is-focused  @enderror  mb-0">

                                <input type="text" autocomplete="off" class="multisteps-form__input form-control"
                                    name="TownSuburb" id="TownSuburb" value="{{ old('TownSuburb') }}"
                                    placeholder="Town/Suburb">
                            </div>
                            @error('TownSuburb')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-sm-6">
                            <div
                                class="input-group input-group-outline  @error('City') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                <input type="text" class="multisteps-form__input form-control" name="City"
                                    id="City" value="{{ old('City') }}" placeholder="City">
                            </div>
                            @error('City')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                            <div
                                class="input-group input-group-outline  @error('Province') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                <input type="text" class="form-control" name="Province" id="Province"
                                    value="{{ old('Province') }}" placeholder="Province">
                            </div>
                            @error('Province')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                            <div
                                class="input-group input-group-outline  @error('PostalCode') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                <input type="text" class="multisteps-form__input form-control" name="PostalCode"
                                    id="PostalCode" value="{{ old('PostalCode') }}" placeholder="Postal Code">
                            </div>
                            @error('PostalCode')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-6 col-sm-4 mt-3 mt-sm-0 mx-auto">
                            <div
                                class="input-group input-group-outline  @error('Country') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                <input type="text" class="form-control" name="Country" id="Country"
                                    value="{{ old('Province') }}" placeholder="Country">
                            </div>
                            @error('Country')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="button-row d-flex mt-4">


                </div>
            </div>

            <div class="imputsection bg-bs-color bg-gba-subtle shadow-lg border-gba">
                <div>
                    <!--begin::Title-->
                    <h1 class="fw-bold d-flex align-items-center text-gba">Contact Details
                        <!-- <span class="ms-1" data-bs-toggle="tooltip" title="Billing is issued based on your selected account typ"> -->
                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                        </span>
                        </h2>
                        <!--end::Title-->
                        <!--begin::Notice-->
                        <div class=" fw-semibold fs-6">Please provide at least one</div>
                        <!--end::Notice-->
                </div>
                <div class="multisteps-form__content">
                    <div class="row mt-3">
                        <div class="col-3">
                            <div
                                class="input-group input-group-outline @error('Telephone') is-invalid focused is-focused @enderror mt-3 mb-0">
                                <input type="tel" class="form-control" name="Telephone" id="Telephone"
                                    value="{{ old('Telephone') }}" placeholder="Add Telephone (Cell)" maxlength="10"
                                    pattern="0[0-9]{9}">
                            </div>
                            @error('Telephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-3">
                            <div
                                class="input-group input-group-outline @error('WorkTelephone') is-invalid focused is-focused @enderror mt-3 mb-0">
                                <input type="tel" class="form-control" name="WorkTelephone" id="WorkTelephone"
                                    value="{{ old('WorkTelephone') }}" placeholder="Add Telephone (Work)" maxlength="10"
                                    pattern="0[0-9]{9}">
                            </div>
                            @error('WorkTelephone')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="col-6">
                            <div
                                class="input-group input-group-outline  @error('Email') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                <input type="email" class="form-control" name="Email" id="Email"
                                    value="{{ old('Email') }}" placeholder="Enter Email Address">
                            </div>
                            @error('Email')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red;">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row">
                        <div class="button-row d-flex mt-4 col-12">


                        </div>
                    </div>
                </div>
            </div>

            <div class="imputsection bg-bs-color bg-gba-subtle border-gba shadow-lg">
                <!--begin::Title-->
                <h1 class="fw-bold d-flex align-items-center text-gba">Membership Type
                    <span class="ms-1" data-bs-toggle="tooltip" title="">
                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </span>
                </h1>
                <!--end::Title-->
                <!--begin::Notice-->
                <div class="fw-semibold fs-6">Please select one</div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="dropdown">
                                    <select id="memtype" name="memtype"
                                        class="btn btn-success shadow-dark dropdown-toggle w-100 my-4 @error('memtype') is-invalid @enderror text-black border-primary"
                                        style="height: 80px;" aria-label="Select Membership Type">
                                        <option selected value="0" disabled> Select Membership Type
                                        </option>
                                        @foreach ($memtypes as $memtype)
                                            {{-- <option value="{{ $memtype->id }}">{{ $memtype->id }}. {{ $memtype->name }} - {{
                                                            $memtype->description }} - R{{ round($memtype->membership_fee,2) }}</option> --}}
                                            @if (old('memtype') == $memtype->id)
                                                <option value="{{ $memtype->id }}" selected>
                                                    {{ $memtype->id }}.
                                                    {{ $memtype->name }} - {{ $memtype->description }} -
                                                    R{{ round($memtype->membership_fee, 2) }}</option>
                                            @else
                                                <option value="{{ $memtype->id }}">{{ $memtype->id }}.
                                                    {{ $memtype->name }} - {{ $memtype->description }} -
                                                    R{{ round($memtype->membership_fee, 2) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('memtype')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="button-row d-flex mt-4">

                        <button class="btn btn-xl ms-auto mb-0" type="submit" title="Add a Membership"
                            id="kt_docs_sweetalert_basic" text="Add" style="background-color: #00923f;">Add</button>
                    </div>
                </div>

            </div>

        </form>

        <!--end::Form-->

    </div>
    <!--end::Card-->
@endsection

@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 library --> --}}
   
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
        });
    </script>

   <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Check if there's a success message in the session
            @if (Session::has('success'))
                // Trigger the SweetAlert
                Swal.fire({
                    text: "{{ Session::get('success') }}",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            @endif
        });
    </script>
@endpush
