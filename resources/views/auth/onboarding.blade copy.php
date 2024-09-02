@extends('layouts.app2')

@push('styles')
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #toggleDrawerButton, #kt_header {
            display: none;
            
        }

        .confetti-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            /* Ensure confetti doesn't interfere with page interaction */
            z-index: 9999;
            /* Ensure confetti is displayed above other content */
        }

        .confetti {
            position: absolute;
            font-size: var(--size);
            /* Set size of the emoji */
            animation: confetti-fall var(--duration) linear infinite, confetti-fade var(--duration) ease-out forwards;
        }

        @keyframes confetti-fall {
            0% {
                transform: translate(0, -10vh) rotate(0deg);
            }

            100% {
                transform: translate(calc(100vw * var(--x)), calc(100vh * var(--y))) rotate(360deg);
            }
        }

        @keyframes confetti-fade {
            0% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
@endpush

@section('row_content')
    <div class="content d-flex flex-column flex-column-fluid mb-10" id="kt_content">
        <div class="container-fluid" id="kt_content_container">
            <div class="confetti-container">
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#10024;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#129395;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
                <div class="confetti">&#127881;</div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                        <div class="stepper-nav mb-5">
                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Welcome</h3>
                            </div>
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">{{ Auth::user()->name }}'s Info</h3>
                            </div>
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Residential Address</h3>
                            </div>
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <h3 class="stepper-title">Completed</h3>
                            </div>
                        </div>
                        {{-- <form class="mx-auto mw-600px w-100 pt-15 pb-10"
                            action="{{ route('save-user-info', Auth::user()) }}" method="POST" novalidate="novalidate"
                            id="kt_create_account_form"> --}}
                        <form class="mx-auto mw-600px w-100 pt-15 pb-10"
                            action="/home" method="POST" novalidate="novalidate"
                            id="kt_create_account_form">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="current" data-kt-stepper-element="content">
                                <div class="d-flex flex-column flex-center text-center p-10">
                                    <div class="mb-7">
                                        <a href="#" class="">
                                            <img alt="Logo" src="{{ asset('img/GBA-LOGO-white.png') }}"
                                                class="h-90px logo ">
                                        </a>
                                    </div>
                                    <h1 class="fw-bolder text-gray-900 mb-5">
                                        Welcome, {{ Auth::user()->name }}
                                    </h1>
                                    <div class="fw-semibold fs-6 text-gray-500 mt-2 mb-7">
                                        We'd like to know a bit about you before you proceed to the system.
                                    </div>
                                    <div id="confetti-wrapper"></div> <!-- Confetti animation will go here -->
                                    <div class="mb-0">
                                        <img src="{{ asset('img/Welcomeimg.png') }}"
                                            class="mw-100 mh-300px theme-light-show" alt="" />
                                        <img src="{{ asset('img/Welcomeimg.png') }}" class="mw-100 mh-300px theme-dark-show"
                                            alt="" />
                                    </div>
                                    <div class="mb-0">
                                        <div class="fw-semibold fs-8 text-gray-500 mb-7">
                                            Powered By
                                        </div>
                                        <img alt="1officeLogo" src="{{ asset('img/1-OFFICE LOGO.png') }}"
                                            class="h-50px logo ">
                                    </div>
                                </div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-12">
                                        <h2 class="fw-bold text-gray-900">Personal Details</h2>
                                        <div class="text-muted fw-semibold fs-6">
                                            Just a few details then we're good to go...
                                        </div>
                                    </div>
                                    <div class="row mb-10">
                                        <div class="col-md-6">
                                            <label class="form-label required">First Name</label>
                                            <input name="first_name" class="form-control form-control-lg form-control-solid border border-secondary"
                                                value="{{ old('first_name') }}" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">Last Name</label>
                                            <input name="last_name"
                                                class="form-control form-control-lg form-control-solid border border-secondary"
                                                value="{{ old('last_name') }}" required />
                                        </div>
                                    </div>
                                    <div class="row mb-10">
                                        <div class="col-md-6">
                                            <label class="form-label required">Initials</label>
                                            <input name="initials" class="form-control form-control-lg form-control-solid border border-secondary"
                                                value="{{ old('initials') }}" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">Screen Name</label>
                                            <input name="screen_name"
                                                class="form-control form-control-lg form-control-solid border border-secondary"
                                                value="{{ old('screen_name') }}" required />
                                        </div>
                                    </div>
                                    <div class="row mb-10">
                                        <div class="col-md-6">
                                            <label class="form-label required">ID Number</label>
                                            <input name="id_number"
                                                class="form-control form-control-lg form-control-solid border border-secondary"
                                                value="{{ old('id_number') }}" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">Birth Date</label>
                                            <input type="date" name="birth_date"
                                                class="form-control form-control-lg form-control-solid border border-secondary"
                                                value="{{ old('birth_date') }}" required />
                                        </div>
                                    </div>
                                    <div class="row mb-10">
                                        <div class="col-md-6">
                                            <label class="form-label required">Married Status</label>
                                            <select name="married_status"
                                                class="form-select form-select-lg form-select-solid select2-married-status"
                                                required>
                                                <option disabled selected value="">Select...</option>
                                                @foreach ($marriedStatuses as $status)
                                                    <option value="{{ $status->id }}"
                                                        {{ old('married_status') == $status->id ? 'selected' : '' }}>
                                                        {{ $status->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-10">
                                        <div class="col-md-6">
                                            <label class="form-label required">Gender</label>
                                            <select name="gender_id"
                                                class="form-select form-select-lg form-select-solid select2-gender"
                                                required>
                                                <option disabled selected value="">Select...</option>
                                                @foreach ($genders as $gender)
                                                    <option value="{{ $gender->id }}"
                                                        {{ old('gender_id') == $gender->id ? 'selected' : '' }}>
                                                        {{ $gender->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label required">Residence Country</label>
                                            <select name="residence_country_id"
                                                class="form-select form-select-lg form-select-solid select2-country"
                                                required>
                                                <option disabled selected value="">Select...</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        {{ old('residence_country_id') == $country->id ? 'selected' : '' }}>
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-12">
                                        <h2 class="fw-bold text-gray-900">Residential Address</h2>
                                        <div class="text-muted fw-semibold fs-6">
                                            Please provide your residential address details.
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 p-3">

                                        <div class="row mt-3">
                                            <div class="col">
                                                <div
                                                    class="input-group input-group-outline @error('Line1') is-invalid focused is-focused @enderror mb-0">
                                                    <input type="text" class="form-control" name="Line1"
                                                        id="Line1" value="{{ old('Line1') }}"
                                                        placeholder="Address Line 1">
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
                                                    class="input-group input-group-outline @error('Line2') is-invalid focused is-focused @enderror mb-0">
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
                                                    class="input-group input-group-outline @error('TownSuburb') is-invalid focused is-focused @enderror mb-0">
                                                    <input type="text" class="form-control" name="TownSuburb"
                                                        id="TownSuburb" value="{{ old('TownSuburb') }}"
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
                                                    class="input-group input-group-outline @error('City') is-invalid focused is-focused @enderror mt-3 mb-0">
                                                    <input type="text" class="form-control" name="City"
                                                        id="City" value="{{ old('City') }}" placeholder="City">
                                                </div>
                                                @error('City')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                <div
                                                    class="input-group input-group-outline @error('Province') is-invalid focused is-focused @enderror mt-3 mb-0">
                                                    <input type="text" class="form-control" name="Province"
                                                        id="Province" value="{{ old('Province') }}"
                                                        placeholder="Province">
                                                </div>
                                                @error('Province')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                                                <div
                                                    class="input-group input-group-outline @error('PostalCode') is-invalid focused is-focused @enderror mt-3 mb-0">
                                                    <input type="text" class="form-control" name="PostalCode"
                                                        id="PostalCode" value="{{ old('PostalCode') }}"
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
                                                    class="input-group input-group-outline @error('Country') is-invalid focused is-focused @enderror mt-3 mb-0">
                                                    <input type="text" class="form-control" name="Country"
                                                        id="Country" value="{{ old('Country') }}"
                                                        placeholder="Country">
                                                </div>
                                                @error('Country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-8 pb-lg-10">
                                        <h2 class="fw-bold text-gray-900">You Are Done!</h2>
                                    </div>
                                    <div class="mb-0">
                                        <div
                                            class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                                            <i class="ki-duotone ki-information fs-2tx text-warning me-4"><span
                                                    class="path1"></span><span class="path2"></span><span
                                                    class="path3"></span></i>
                                                    <h3>Congratulations, you have successfully created your account!</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-stack pt-15">
                                <div class="mr-2">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3"
                                        data-kt-stepper-action="previous">
                                        <i class="ki-duotone ki-arrow-left fs-4 me-1"><span class="path1"></span><span
                                                class="path2"></span></i> Back
                                    </button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-lg btn-primary me-3"
                                        data-kt-stepper-action="submit">
                                        <span class="indicator-label">
                                            Submit
                                            <i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next"
                                        id="btn-next" onclick="startConfetti()">
                                        Continue
                                        <i class="ki-duotone ki-arrow-right fs-4 ms-1 me-0"><span
                                                class="path1"></span><span class="path2"></span></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!--begin::Javascript-->
    {{-- <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-account.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
        $(document).ready(function() {
            $('.select2-married-status').select2();
            $('.select2-gender').select2();
            $('.select2-country').select2();

            var stepper = document.querySelector('#kt_create_account_stepper');
            var stepperObj = KTStepper.getInstance(stepper);
            if (!stepperObj) {
                stepperObj = new KTStepper(stepper);
            }

            $('#btn-next').click(function() {
                var currentStep = $('.current[data-kt-stepper-element="content"]');
                var hasRequiredFields = currentStep.find('input[required], select[required]').length > 0;
                var valid = true;

                console.log("Validating current step fields...");
                currentStep.find('input[required], select[required]').each(function() {
                    console.log($(this).attr('name') + " value: " + $(this).val());
                    if ($(this).val() === '') {
                        valid = false;
                        return false;
                    }
                });

                if (!valid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please fill in all required fields before continuing!',
                    });
                } else {
                    console.log('Current step:', stepperObj.getCurrentStepIndex());
                    console.log('Going to the next step...');
                    stepperObj.goNext();
                    currentStep.removeClass('current');
                    currentStep.next().addClass('current');
                    console.log('Next step:', stepperObj.getCurrentStepIndex());
                    logStepperState(stepperObj);
                }
            });

            $('#kt_create_account_form').on('submit', function(event) {
                var lastStep = $('[data-kt-stepper-element="content"]').last();
                var valid = true;

                console.log("Validating final step fields...");
                lastStep.find('input[required], select[required]').each(function() {
                    console.log($(this).attr('name') + " value: " + $(this).val());
                    if ($(this).val() === '') {
                        valid = false;
                        return false;
                    }
                });

                if (!valid) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please fill in all required fields before submitting!',
                    });
                }
            });

            $('[data-kt-stepper-action="previous"]').click(function() {
                var currentStep = $('.current[data-kt-stepper-element="content"]');
                console.log('Current step:', stepperObj.getCurrentStepIndex());
                console.log('Going to the previous step...');
                stepperObj.goPrevious();
                currentStep.removeClass('current');
                currentStep.prev().addClass('current');
                console.log('Previous step:', stepperObj.getCurrentStepIndex());
                logStepperState(stepperObj);
            });

            function logStepperState(stepperObj) {
                var steps = stepperObj._steps;
                steps.forEach(function(step, index) {
                    console.log('Step ' + index + ':', step.classList.contains('current'));
                });
            }

            logStepperState(stepperObj);
        });

        function startConfetti() {
            const confettiCount = 100;
            const confettiWrapper = document.getElementById('confetti-wrapper');

            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.animationDuration = 0.5 + Math.random() * 1 + 's';
                confettiWrapper.appendChild(confetti);
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const confettiElements = document.querySelectorAll('.confetti');

            confettiElements.forEach(function(confetti) {
                confetti.style.setProperty('--x', Math.random()); // Random horizontal position
                confetti.style.setProperty('--y', Math.random()); // Random vertical position
                confetti.style.setProperty('--duration', Math.random() * 3 + 2 +
                's'); // Random falling duration (between 2 and 5 seconds)
                confetti.style.setProperty('--size', Math.random() * 24 + 16 +
                'px'); // Random font size (between 16 and 40 pixels)
            });

            // Find the maximum duration among confetti animations
            let maxDuration = 0;
            confettiElements.forEach(function(confetti) {
                const duration = parseFloat(getComputedStyle(confetti).getPropertyValue('--duration'));
                if (duration > maxDuration) {
                    maxDuration = duration;
                }
            });

            // Remove confetti after the maximum duration
            setTimeout(function() {
                confettiElements.forEach(function(confetti) {
                    confetti.remove();
                });
            }, maxDuration * 2000); // Convert seconds to milliseconds
        });
    </script>
@endpush
