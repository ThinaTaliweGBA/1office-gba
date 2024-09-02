@extends('layouts.app2')

@push('styles')
    <!-- CSS Files -->
    {{-- <link id="pagestyle" href="{{ asset('css/material-dashboard.css?v=3.0.4') }}" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css') }}">  --}}

    {{-- Start Commented Box Styling --}}
    <style>
        .containerC {}

        .form {
            background-color: #eee;
            border-radius: 6px;
            padding: 5px;
            display: flex;
            align-items: center;
        }

        .input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            flex: 1;
        }

        .input:focus,
        .add:focus {
            outline: none;
        }

        .add {
            border: none;
            background-color: #f44336;
            color: white;
            padding: 10px;
            border-radius: 6px;
            margin-left: 10px;
            cursor: pointer;
        }

        .tasks {
            background-color: #eee;
            margin-top: 20px;
            border-radius: 6px;
            padding: 20px;
        }

        .tasks .task {
            background-color: white;
            padding: 10px;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
            cursor: pointer;
            border: 1px solid #ccc;
        }

        .tasks .task:not(:last-child) {
            margin-bottom: 15px;
        }

        .tasks .task:hover {
            background-color: #f7f7f7;
        }

        .tasks .task.done {
            opacity: 0.5;
            position: relative;
        }

        .task.done::after {
            position: absolute;
            content: "";
        }

        .tasks .task span {
            font-weight: bold;
            font-size: 10px;
            background-color: red;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-all {
            width: calc(100% - 45px);
            margin: auto;
            padding: 12px;
            text-align: center;
            font-size: 14px;
            color: white;
            background-color: #f44336;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
    {{-- End Commented Box Styling --}}

    <style>
        /* Dark theme */
        [data-bs-theme=dark] input {
            color: Black !important;
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
            border: 1px solid var(--bs-secondary);
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

    {{-- Start Comments Box Styling --}}
    <style>
        #commentsBox {
            position: relative;
        }

        #commentsBox>#commentContainer {
            position: absolute;
            top: 0;
        }

        #commentsBox i {
            font-size: 32px;
        }

        #commentsBox a {
            position: absolute;
            bottom: 15px;
        }

        #commentsBox #addComment {
            right: 20px;
            font-weight: bold;
        }

        #commentsBox #removeComment {
            left: 20px;
            font-weight: bold;
        }
    </style>
    {{-- Start Comments Box Styling --}}

    <style>
    #AddMemberBox  {
        position:relative;
    }
    #AddMemberBox > AddMemberButton {
        position:absolute;
        width: 50%;
    }
    </style>
@endpush

@section('row_content')

    {{-- <button id="kt_drawer_example_permanent_toggle" class="btn btn-secondary">Add Comments</button> --}}

    <!--begin:: Comments Drawer-->
    {{-- <div id="kt_drawer_example_permanent" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
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
    </div> --}}
    <!--end:: Comments Drawer-->

    <!--begin::Card-->

        <form method="POST" action="{{ route('add-member.store') }}" autocomplete="off" id="memberForm" class="card boarder border-secondary m-10 shadow">
            @csrf
            <div class="card-title  mt-4 bg-body rounded-2">
                <h1 class="text-center heading-color">Add New Member</h1>
            <!--begin::Form-->
            <div class="mx-0">
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

            <div class="row" id="AddMemberBox">
                <div class="col-9">

                    <div class="card-body imputsection shadow">
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
                                <div class="col-6 col-sm-6">

                                    <div
                                        class="form-floating @error('Name') is-invalid focused is-focused  @enderror mt-3 mb-0 bold-placeholder">

                                        <input type="text" class="form-control text-black" name="Name" id="Name"
                                            value="{{ old('Name') }}" placeholder="" required>
                                        <label for="Name" class="fs-4 text-gray-600">Name<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-6 col-sm-6">
                                    <div
                                        class="form-floating  @error('Surname') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                        <input type="text" class="form-control text-black" name="Surname" id="Surname"
                                            value="{{ old('Surname') }}" placeholder="">
                                        <label for="Surname" class="fs-4 text-gray-600">Surname<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('Surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 col-sm-3">
                                    <div id="IDNumber"
                                        class="form-floating  @error('IDNumber') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                        <input type="text" class="form-control" name="IDNumber" id="IDNumber"
                                            value="{{ old('IDNumber') }}" placeholder="" maxlength="13" size="13"
                                            onchange="getDOB(this.value)">
                                        <label for="IDNumber" class="fs-4 text-gray-600">ID Number<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <span class="invalid-feedback" role="alert" id="error"></span>
                                    @error('IDNumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-3 col-sm-3"
                                    style="
                                                padding-top: 0.18rem;
                                            ">
                                    <div class="py-2 col d-flex justify-content-center align-items-center mx-auto">
                                        <!-- <div style="white-space:nowrap;" class="px-4">
                                                                                                                                <label class="form-label">Date Of Birth</label>

                                                                                                                                </div> -->
                                        <div id="inputDayDiv" class="form-floating @error('inputDay') is-invalid @enderror">

                                            <input type="text" onkeypress="return isNumberKey(event)"
                                                class="form-control" name="inputDay" id="inputDay"
                                                value="{{ old('inputDay') }}" placeholder="" maxlength="2" size="2">
                                            <label for="inputDay" class="fs-4 text-gray-600">Day<span
                                                    class="text-danger">*</span></label>
                                            @error('inputDay')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="color: red;">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <span class="px-2"></span>
                                        <div id="inputMonthDiv"
                                            class="form-floating @error('inputMonth') is-invalid @enderror">

                                            <input type="text" onkeypress="return isNumberKey(event)"
                                                class="form-control" name="inputMonth" id="inputMonth"
                                                value="{{ old('inputMonth') }}" placeholder="" maxlength="2"
                                                size="2">
                                            <label for="inputMonth" class="fs-4 text-gray-600"><span
                                                    class="text-danger">*</span>Month</label>

                                        </div>
                                        {{-- @error('inputMonth')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong style="color: red;">{{ $message }}</strong>
                                                    </span>
                                                @enderror --}}
                                        <span class="px-2"></span>
                                        <div id="inputYearDiv"
                                            class="form-floating @error('inputYear') is-invalid @enderror">

                                            <input type="text" onkeypress="return isNumberKey(event)"
                                                class="form-control" name="inputYear" id="inputYear"
                                                value="{{ old('inputYear') }}" placeholder="" maxlength="4"
                                                size="4">
                                            <label for="inputYear" class="fs-4 text-gray-600">Year<span
                                                    class="text-danger">*</span></label>
                                            @error('inputYear')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong style="color: red;">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-2 pt-3 mt-sm-0" style="margin-top: 25px;">
                                    {{-- <div class="btn-group  col d-flex justify-content-center align-items-center mx-auto">

                                    <input type="radio" class="btn-check form-check-input " name="radioGender"
                                        id="Male" value="M" />
                                    <label class="btn bg-gba-light btn-outline-success" for="Male">Male</label>

                                    <input type="radio" class="btn-check form-check-input " name="radioGender"
                                        id="Female" value="F" />
                                    <label class="btn bg-gba-light btn-outline-success" for="Female">Female</label>

                                </div> --}}
                                    <div
                                        class="btn-group col d-flex justify-content-center align-items-center mx-auto my-auto @error('radioGender') is-invalid @enderror">
                                        <select class="form-select form-select-solid text-dark bg-light" id="radioGender"
                                            name="radioGender" required>
                                            <option value="">Select Gender<span class="text-danger">*</span>
                                            </option>
                                            @foreach ($genders as $gender)
                                                <option value="{{ $gender->id }}"
                                                    {{ old('radioGender') == $gender->id ? 'selected' : '' }}>
                                                    {{ $gender->id }} - {{ $gender->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('radioGender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong style="color: red;">{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                    <div class="btn-group col d-flex" style="padding-top: 0.75rem;">
                                        <select class="form-select form-select-solid text-dark bg-light" id="language"
                                            name="language" required>
                                            <option value="">Select Language*</option>
                                            @foreach ($languages as $language)
                                                <option value="{{ $language->id }}"
                                                    {{ old('language') == $language->id ? 'selected' : '' }}>
                                                    {{ $language->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-2 mt-3 mt-sm-0">
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
                                            <select class="form-select form-select-solid text-dark bg-light"
                                                id="marital_status" name="marital_status" required>
                                                <option value="">Select Marital Status*</option>
                                                @foreach ($maritalStatuses as $status)
                                                    <option value="{{ $status->id }}"
                                                        {{ old('marital_status') == $status->id ? 'selected' : '' }}>
                                                        {{ $status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div class="card-body imputsection shadow">
                        <div>
                            <!--begin::Title-->
                            <h1 class="fw-bold d-flex align-items-center text-gba">Location
                                <span class="ms-1" data-bs-toggle="tooltip" title="Were is your physical address?">
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
                                <div class="col-6">
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
                                </div>
                                <div class="col-6 col-sm-6">
                                    <div
                                        class="form-floating  @error('Line2') is-invalid focused is-focused  @enderror  mb-0">

                                        <input type="text" class="form-control" name="Line2" id="Line2"
                                            value="{{ old('Line2') }}" placeholder="">
                                        <label for="Line2" class="fs-4 text-gray-600">Address Line 2<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('Line2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3 col-sm-3 ">
                                    <div
                                        class="form-floating  @error('Province') is-invalid focused is-focused  @enderror ">

                                        <input type="text" class="form-control" name="Province" id="Province"
                                            value="{{ old('Province') }}" placeholder="">
                                        <label for="Province" class="fs-4 text-gray-600">Province<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('Province')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-3 col-sm-3">
                                    <div
                                        class="form-floating  @error('TownSuburb') is-invalid focused is-focused  @enderror ">

                                        <input type="text" autocomplete="off" class="form-control" name="TownSuburb"
                                            id="TownSuburb" value="{{ old('TownSuburb') }}" placeholder="">
                                        <label for="TownSuburb" class="fs-4 text-gray-600">Town/Suburb<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('TownSuburb')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-3 col-sm-3">
                                    <div class="form-floating  @error('City') is-invalid focused is-focused  @enderror ">

                                        <input type="text" class="form-control" name="City" id="City"
                                            value="{{ old('City') }}" placeholder="">
                                        <label for="City" class="fs-4 text-gray-600">City<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('City')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-2 col-sm-2">
                                    <div
                                        class="form-floating  @error('Country') is-invalid focused is-focused  @enderror ">

                                        <input type="text" class="form-control" name="Country" id="Country"
                                            value="{{ old('Province') }}" placeholder="">
                                        <label for="Country" class="fs-4 text-gray-600">Country<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('Country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-1 col-sm-1">
                                    <div
                                        class="form-floating  @error('PostalCode') is-invalid focused is-focused  @enderror ">

                                        <input type="text" class="form-control" name="PostalCode" id="PostalCode"
                                            value="{{ old('PostalCode') }}" placeholder="">
                                        <label for="PostalCode" class="fs-4 text-gray-600">Zip<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('PostalCode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card-body imputsection shadow ">
                        <div>
                            <!--begin::Title-->
                            <h1 class="fw-bold d-flex align-items-center text-gba">Contact Details
                                <span class="ms-1" data-bs-toggle="tooltip" title="How do we keep in contact with this member?">
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
                                        class="form-floating @error('Telephone') is-invalid focused is-focused @enderror mt-3 mb-0">
                                        <input type="tel" class="form-control" name="Telephone" id="Telephone"
                                            value="{{ old('Telephone') }}" placeholder="" >
                                        <label for="Telephone" class="fs-4 text-gray-600">Add Telephone (Cell)</label>
                                    </div>
                                    @error('Telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-3">
                                    <div
                                        class="form-floating @error('WorkTelephone') is-invalid focused is-focused @enderror mt-3 mb-0">
                                        <input type="tel" class="form-control" name="WorkTelephone"
                                            id="WorkTelephone" value="{{ old('WorkTelephone') }}" placeholder=""
                                            >
                                        <label for="WorkTelephone" class="fs-4 text-gray-600">Add Telephone (Work)</label>
                                    </div>
                                    @error('WorkTelephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red;">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="col-6">
                                    <div
                                        class="form-floating  @error('Email') is-invalid focused is-focused  @enderror mt-3 mb-0">

                                        <input type="email" class="form-control" name="Email" id="Email"
                                            value="{{ old('Email') }}" placeholder="">
                                        <label for="Email" class="fs-4 text-gray-600">Enter Email Address<span
                                                class="text-danger">*</span></label>
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

                </div>
                <div class="col-3">
                    <div class="card-body imputsection shadow">
                        <!--begin::Title-->
                        <h1 class="fw-bold d-flex align-items-center text-gba">Membership Type
                            <span class="ms-1" data-bs-toggle="tooltip" title="Choose your membership type">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </h1>
                        <!--end::Title-->
                        <!--begin::Notice-->
                        <div class="fw-semibold fs-6">Please select one<span class="text-danger">*</span></div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <div class="dropdown">
                                            <select id="memtype" name="memtype"
                                                class="btn bg-light shadow-dark dropdown-toggle w-100 my-4 @error('memtype') is-invalid @enderror text-dark border border-secondary"
                                                style="height: 38px;" aria-label="Select Membership Type">
                                                <option selected value="0" disabled> Select Membership Type
                                                </option>
                                                @foreach ($memtypes as $memtype)
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
                            <div class="button-row d-flex mt-4"></div>
                        </div>
                    </div>

                    <div class="card-body imputsection shadow" id="commentsBox">
                        <h1 class="fw-bold d-flex align-items-center text-gba">Comments
                        <span class="ms-1" data-bs-toggle="tooltip" title="Add Comments (optional)">
                                <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </h1>
                        <!--begin::Input group-->
                        <div class="fw-semibold fs-6 pb-4">Membership Comments</div>

                        {{-- <form method="POST" action="{{ route('comments.store') }}"> --}}
                        @csrf <!-- CSRF token for security -->

                        <div class="form-floating">
                            {{-- <textarea class="form-control bg-light text-dark" placeholder="" id="floatingTextarea2"
                              name="text"   style="height:690px"></textarea> --}}
                            <div class="containerC px-0" id="commentContainer">
                                <div class="form">
                                    <input type="text" name="text" class="input form-control text-light bg-white"
                                        {{ old('text') }} />
                                    <input type="button" class="add bg-success" value="Add" />
                                </div>
                                <div class="tasks"></div>
                                {{-- <div class="delete-all wrap">Delete all</div> --}}
                            </div>
                            {{-- <label for="floatingTextarea2">Insert your comment here.</label> --}}
                            {{-- @error('floatingTextarea2')
                                <span class="invalid-feedback" role="alert">
                                    <strong style="color: red">{{ $message }}</strong>
                                </span>
                            @enderror --}}
                        </div>
                        {{-- <a id="addComment"><i class="bi bi-check-circle text-success"></i></a>
                        <a id="removeComment"><i class="bi bi-x-circle text-danger"></i></a> --}}
                        <input type="hidden" name="tasksData" id="tasksDataField">
                        <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                        <!-- Example value -->
                        <input type="hidden" name="link" value="{{ route('view-member', 0) }}">
                        <!-- Example value -->
                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="model_name" value="Membership"> <!-- Example value -->
                        <input type="hidden" name="model_record" value="0">
                        <!-- Example, should be dynamically set -->
                        {{-- <button type="submit" class="btn btn-success mt-2">Add</button> --}}
                        {{-- </form> --}}

                        <!--end::Input group-->
                    </div>


                </div>

                <button class="btn btn-xl mb-4 w-50 text-white mx-auto" type="submit" title="Add a Membership"
                id="AddMemberButton" text="Add" style="background-color: #00923f;">Add Membership</button>
                <!-- Ensuring button takes full width but with proper spacing -->

            </div>
            <!--end::Form-->

        </form>

    <!--end::Card-->
@endsection

@push('scripts')


    <script>
        let inputEle = document.querySelector(".input");
        let submitEle = document.querySelector(".add");
        let tasksDiv = document.querySelector(".tasks")
        let containerDiv = document.querySelector(".containerC")
        let deleteAll = document.querySelector(".delete-all");
        let arrayOfTasks = [];
        var commentsData;

        if (window.localStorage.getItem("tasks")) {
            arrayOfTasks = JSON.parse(window.localStorage.getItem("tasks"))
        }

        getTaskFromLocalStorage();

        submitEle.onclick = function() {
            if (inputEle.value !== "") {
                addTaskToArray(inputEle.value);
                inputEle.value = "";
            }
        }

        function addTaskToArray(taskText) {
            const task = {
                id: Date.now(),
                title: taskText,
            };
            arrayOfTasks.push(task);
            console.log(arrayOfTasks);
            addTaskToPage(arrayOfTasks);

            addTaskToLocalStorage(arrayOfTasks);
        }

        function addTaskToPage(arrayOfTasks) {
            tasksDiv.innerHTML = "";

            arrayOfTasks.forEach((task) => {
                let div = document.createElement("div");
                div.className = "task text-black";
                if (task.complated) {
                    div.className = "task done";
                }
                div.setAttribute("data-id", task.id);
                div.appendChild(document.createTextNode(task.title));
                let span = document.createElement("span");
                span.className = "del";
                span.appendChild(document.createTextNode("Delete"));
                div.appendChild(span);
                tasksDiv.appendChild(div);
                console.log(div);
            });
        }


        function addTaskToLocalStorage(arrayOfTasks) {
            window.localStorage.setItem("tasks", JSON.stringify(arrayOfTasks));
            commentsData = JSON.stringify(arrayOfTasks);
            sendCommentsToServer(commentsData);
        }

        //Functions add last to save to databse
        function sendCommentsToServer(data) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/add-member", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            xhr.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    console.log('Comments received on server');
                }
            };

            xhr.send(data);
        }

        function getTaskFromLocalStorage() {
            let data = window.localStorage.getItem("tasks")
            if (data) {
                let tasks = JSON.parse(data);
                // console.log(tasks)
                addTaskToPage(tasks);
            }
        }

        function addElementsToPageFrom(arrayOfTasks) {
            // Empty Tasks Div
            tasksDiv.innerHTML = "";
            // Looping On Array Of Tasks
            arrayOfTasks.forEach((task) => {
                // Create Main Div
                let div = document.createElement("div");
                div.className = "task";
                // Check If Task is Done
                if (task.completed) {
                    div.className = "task done";
                }
                div.setAttribute("data-id", task.id);
                div.appendChild(document.createTextNode(task.title));
                // Create Delete Button
                let span = document.createElement("span");
                span.className = "del";
                span.appendChild(document.createTextNode("Delete"));
                // Append Button To Main Div
                div.appendChild(span);
                // Add Task Div To Tasks Container
                tasksDiv.appendChild(div);
            });
        }

        // Click On Task Element
        tasksDiv.onclick = ((e) => {
            if (e.target.classList.contains("del")) {
                // e.target.parentElement.remove();
                e.target.parentElement.remove();
                deleteTaskFromLocalStorage(e.target.parentElement.getAttribute("data-id"));
            }
            if (e.target.classList.contains("task")) {
                e.target.classList.toggle("done");
                updateStatusInLocalStorage(e.target.getAttribute("data-id"));
            }
        })


        function deleteTaskFromLocalStorage(taskId) {
            arrayOfTasks = arrayOfTasks.filter((task) => task.id != taskId);
            addTaskToLocalStorage(arrayOfTasks);
        }

        function updateStatusInLocalStorage(taskId) {
            arrayOfTasks.forEach((task) => {
                if (task.id == taskId)
                    task.complated == false ? task.complated = true : task.complated = false;
            });

            addTaskToLocalStorage(arrayOfTasks);
        }

        deleteAll.onclick = function(e) {
            tasksDiv.innerHTML = "";
            window.localStorage.removeItem("tasks")
        }
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Include SweetAlert2 library --> --}}

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

    {{-- Start Appending/Removing Comments --}}
    <script>
        document.getElementById('addComment').addEventListener('click', function() {
            const textarea = document.getElementById('floatingTextarea2');
            const text = textarea.value.trim();

            if (text) {
                // Add comment to array (you might want to have this array globally available)
                comments.push(text);

                // Clear the textarea for new comment
                textarea.value = '';
                textarea.focus();

                // Display comment
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('saved-comment');
                commentDiv.textContent = text;
                textarea.parentNode.insertBefore(commentDiv, textarea);

                // Optionally, create a new textarea below each comment
                //const newTextArea = document.createElement('textarea');
                //newTextArea.classList.add('form-control', 'bg-light', 'text-dark');
                //newTextArea.style.height = '100px';
                //commentDiv.parentNode.insertBefore(newTextArea, commentDiv.nextSibling);
            } else {
                document.querySelector('.invalid-feedback').style.display = 'block';
                //document.querySelector('.invalid-feedback').textContent = 'Please enter a comment before adding.';
            }
        });

        document.getElementById('removeComment').addEventListener('click', function() {
            if (comments.length > 0) {
                comments.pop(); // Adjust if you want specific deletion behavior
                // Assuming last comment is always removed. Modify as needed for your use case.

                // Remove the last displayed comment
                const savedComments = document.querySelectorAll('.saved-comment');
                if (savedComments.length > 0) {
                    const lastComment = savedComments[savedComments.length - 1];
                    lastComment.parentNode.removeChild(lastComment);
                }
            }
        });

        let comments = []; // Initialize the comments array
    </script>
    {{-- End Appending/Removing Comments --}}

    <script>
        $(document).ready(function() {
            $('#memtype').select2({
                width: '100%', // Ensures the width of the select matches container
                placeholder: 'Select Membership Type', // Placeholder if needed
                allowClear: true // Allows clearing the selection
            });
        });
    </script>

    <script>
    var tasksData, tasks;

    function displayData() {
        // Get data from Local Storage
        tasksData = localStorage.getItem('tasks');
        //console.log(tasksData);
        // Parse the data from JSON format if it exists
        tasks = tasksData ? JSON.parse(tasksData) : [];

        //console.log(tasks);

        // Update hidden form field
        document.getElementById('tasksDataField').value = JSON.stringify(tasks);

    }

    // Attach event listener to the form submit
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('memberForm');
        form.addEventListener('submit', displayData);
    });
    </script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('memberForm');
        form.addEventListener('submit', function(event) {
            localStorage.removeItem('tasks');  // Clear the local storage variable upon form submission
        });
    });
    </script>
@endpush
