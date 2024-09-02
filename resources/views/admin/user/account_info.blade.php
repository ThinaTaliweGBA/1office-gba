@extends('layouts.app2')

@push('styles')
    <style>
        .custom-col {
            flex: 0 0 calc(50% - 10px);
            /* Adjust the 10px to the total margin you want divided by 2 */
            margin-right: 5px;
            /* Half your total desired margin */
            margin-left: 5px;
            /* Half your total desired margin */
        }

        button .bga {
            background-color: red;
            color: var(--bs-success-inverse);
        }
    </style>
@endpush

@section('row_content')
    <div class="card mb-10 mt-10 pt-4 row shadow">
        <div class="card-header">
            <h1 class="card-title">Account Management</h1>
            <div class="card-toolbar">
                               
                <form action="{{ route('update.current.bu') }}" method="POST" id="buForm" class="p-3 border rounded">
                    @csrf
                    <div class="form-group">
                        <label for="bu_id">Select BU:</label>
                        <select name="bu_id" id="bu_id" class="form-control"
                            onchange="document.getElementById('buForm').submit();">
                            @php
                                $currentBuId = session('current_bu_id');
                            @endphp
                            @foreach (Auth::user()->bus as $bu)
                                <option value="{{ $bu->id }}" {{ $currentBuId == $bu->id ? 'selected' : '' }}>
                                    {{ $bu->bu_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">


        </div>
        <!--begin::Basic info-->
        <div class="row mt-4">
            <div class="card mb-2 mb-xl-10 custom-col border border-secondary">
                <!--begin::User-->
                <div class="d-flex flex-column mt-4">
                    <!--begin::Name-->
                    <div class="d-flex align-items-center mb-2 mx-auto">
                        <a href="#"
                            class="text-dark text-hover-primary fs-2 fw-bold me-1">{{ ucfirst(Auth::user()->name) }}</a>
                        <a href="#">
                            <i class="ki-duotone ki-verify fs-1 text-primary">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                    </div>
                    <!--end::Name-->
                    <!--begin::Info-->
                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2 mx-auto">
                        <a href="#" class="d-flex align-items-center text-dark text-hover-primary me-5 mb-2">
                            <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Role : ----</a>
                        <a href="#" class="d-flex align-items-center text-dark text-hover-primary mb-2">
                            <i class="ki-duotone ki-sms fs-4 me-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Email: {{ ucfirst(Auth::user()->email) }}</a>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User-->
                @if ($errors->account->any())
                    <ul>
                        @foreach ($errors->account->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (session()->has('account_message'))
                    <div>
                        {{ session()->get('account_message') }}
                    </div>
                @endif
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <!--begin::Card body-->
                    <form method="POST" action="{{ route('admin.account.info.store') }}" class="form">
                        @csrf
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6"
                                    for="name">{{ __('Full Name') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input id="name" type="text" name="name"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                placeholder="Names" value="{{ old('name', $user->name) }}" />
                                        </div>
                                        <!--end::Col-->

                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6"
                                    for="email">{{ __('Email') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <input id="email" type="email" name="email"
                                        class="form-control form-control-lg form-control-solid" placeholder="Email"
                                        value="{{ old('email', $user->email) }}" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                            <button type="submit" class="btn bg-gba">{{ __('Update') }}</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>

            <div class="card mb-2 mb-xl-10 custom-col border border-secondary">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                    aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{ __('Change Password') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                @if ($errors->password->any())
                    <ul>
                        @foreach ($errors->password->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (session()->has('password_message'))
                    <div>
                        {{ session()->get('password_message') }}
                    </div>
                @endif
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <!--begin::Card body-->

                    <form method="POST" action="{{ route('admin.account.info.store') }}" class="form">
                        @csrf
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6"
                                    for="old_password">{{ __('Old Password') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input id="old_password" type="password" name="old_password"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label for="new_password"
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('New Password') }}</label>

                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input id="new_password" type="password" name="new_password"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label for="confirm_password"
                                    class="col-lg-4 col-form-label required fw-semibold fs-6">{{ __('Confirm password') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <div class="row">
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input id="confirm_password" type="password" name="confirm_password"
                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                            <button type='submit' class="btn bg-gba">{{ __('Change Password') }}</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
        </div>
        <!--end::Content-->
        <!--end::Basic info-->

        <div class="row">
            <!--begin::Sign-in Method-->
            <div class="card mb-5 mb-xl-10 custom-col border border-secondary">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Two-Factor Authentication</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Notice-->
                        <div class="notice d-flex bg-gba-light rounded border border-secondary border border-dashed p-6">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-shield-tick fs-2tx text-dark me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <!--end::Icon-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                <!--begin::Content-->
                                <div class="mb-3 mb-md-0 fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">Secure Your Account</h4>
                                    <div class="fs-6 text-dark pe-7">Two-factor authentication adds an extra layer of
                                        security
                                        to your account. To log in, in addition you'll need to provide a 6 digit code</div>
                                </div>
                                <!--end::Content-->
                                <!--begin::Action-->
                                <a href="#" class="btn bg-gba px-6 align-self-center text-nowrap"
                                    data-bs-toggle="modal" data-bs-target="#kt_modal_two_factor_authentication">Enable</a>
                                <!--end::Action-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Sign-in Method-->
            <!--begin::Deactivate Account-->
            <div class="card  mb-4 custom-col border border-secondary">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Deactivate Account</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_deactivate" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_deactivate_form" class="form" action="{{ route('login') }}">
                        @csrf
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Notice-->
                            <div
                                class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1">
                                    <!--begin::Content-->
                                    <div class="fw-semibold">
                                        <h4 class="text-gray-900 fw-bold">You Are Deactivating Your Account</h4>
                                        <div class="fs-6 text-gray-700">For extra security, this requires you to confirm
                                            your email
                                            or phone number when you reset yousignr password.
                                            <br />
                                            <a class="fw-bold" href="#">Learn more</a>
                                        </div>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                            <!--begin::Form input row-->
                            <div class="form-check form-check-solid fv-row">
                                <input name="deactivate" class="form-check-input" type="checkbox" value=""
                                    id="deactivate" />
                                <label class="form-check-label fw-semibold ps-2 fs-6 text-dark" for="deactivate">I confirm
                                    my
                                    account
                                    deactivation</label>
                            </div>
                            <!--end::Form input row-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button id="kt_account_deactivate_account_submit" type="submit"
                                class="btn btn-danger fw-semibold">Deactivate Account</button>
                        </div>
                        <!--end::Card footer-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Deactivate Account-->
        </div>
    </div>

@endsection
