<x-guest-layout>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
.password-container {
    position: relative;
}

.form-control {
    padding-right: 30px; /* Adjust padding to make space for the icon */
}

.show-password-checkbox {
    position: absolute;
    right: 10px; /* Adjust as necessary */
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
}
</style>
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page bg image-->
        @include('components.auth.BgImg')
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <!--begin::Logo-->
                    <a class="mb-7">
                        <x-application-logo />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0">Group Burial Association</h2>
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div
                class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
                <!--begin::Card-->
                <div
                    class="bg-body-secondary d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">

                        <!--begin::Form-->
                        <form class="form w-100" method="POST" action="{{ route('login') }}">
                            @csrf

                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
                                <!-- Validation Errors -->
                                <x-auth-validation-errors :errors="$errors" />
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <x-label for="email" :value="__('Email')" />
                                <x-input class="form-control bg-transparent" id="email" type="email"
                                    name="email" :value="old('email')" required />
                                <!--end::Email-->
                            </div>
                            <!--end::Input group=-->
                            {{-- <div class="fv-row mb-3">
                                <!--begin::Password-->

                                <x-label for="password" :value="__('Password')" />
                                <input type="checkbox" onclick="myFunction()">Show Password
                                <x-input id="password" type="password" name="password" required
                                    autocomplete="current-password" class="form-control bg-transparent" />

                                <!--end::Password-->
                            </div> --}}




                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <x-label for="password" :value="__('Password')" />
    <div class="password-container">
        <x-input id="password" type="password" name="password" required autocomplete="current-password" class="form-control bg-transparent" />
        <i class="material-icons show-password-checkbox" id="toggleIcon" onclick="myFunction()">&#xe8f4;</i>
    </div>
                                <!--end::Password-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div>
                                    <label for="remember_me">
                                        <input id="remember_me" type="checkbox" name="remember" checked>
                                        <span>{{ __('Remember me') }}</span>
                                    </label>
                                </div>
                                <!--begin::Link-->
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="link-primary">Forgot Password ?</a>
                                @endif
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn" style="background-color: #00923f;">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Sign In</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->

                            <div class="text-white-500 text-center fw-semibold fs-6">Not a Member yet?
                                <a href="{{ route('register') }}" class="link-primary">Sign up</a>
                            </div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Footer-->

                    <!--end::Footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Main-->

    <!--   Core JS Files   -->
    <script src="/js/core/popper.min.js"></script>
    <script src="/js/core/bootstrap.min.js"></script>
    <script src="/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/js/material-dashboard.min.js?v=3.0.4"></script>

<script>
    function myFunction() {
        var x = document.getElementById("password");
        var icon = document.getElementById("toggleIcon");
        if (x.type === "password") {
            x.type = "text";
            icon.innerHTML = "&#xe8f5;"; // Icon for showing the password
        } else {
            x.type = "password";
            icon.innerHTML = "&#xe8f4;"; // Icon for hiding the password
        }
    }
</script>
</x-guest-layout>
