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

    .input-match {
      border-color: green;
    }

    .input-mismatch {
      border-color: red;
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
      <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 p-lg-20">
        <!--begin::Card-->
        <div class="bg-body-secondary d-flex flex-column align-items-stretch flex-center rounded-4 w-md-600px p-20">
          <!--begin::Wrapper-->
          <div class="d-flex flex-center flex-column flex-column-fluid px-lg-10 pb-15 pb-lg-20">
            
            <!--begin::Form-->
            <form method="POST" class="form w-100" action="{{ route('register') }}">
              @csrf
                          
              <!--begin::Heading-->
              <div class="text-center mb-11">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder mb-3">Register</h1>
                <!-- Session Status -->
                <x-auth-session-status :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors :errors="$errors" />
                <!--end::Title-->
              </div>
              <!--end::Heading-->

              <!--begin::Input group=-->
              <div class="fv-row mb-2">
                <!--begin::Name-->
                <x-label for="name" :value="__('Name(s)')" />
                <input class="form-control bg-transparent" id="name" type="text" name="name" value="{{old('name')}}" required autofocus>
                <!--end::Name-->
              </div>
              <!--end::Input group=-->
              <!--begin::Input group=-->
              <div class="fv-row mb-2">
                <!--begin::Email-->
                <x-label for="email" :value="__('Email')" />
                <x-input class="form-control bg-transparent" id="email" type="email" name="email" :value="old('email')" required />
                <!--end::Email-->
              </div>
              <!--end::Input group=-->
              <div class="fv-row mb-3">
                <!--begin::Password-->
                
                <x-label for="password" :value="__('Password')" />
                
                <div class="password-container">
                  <input class="form-control bg-transparent" id="password" type="password" name="password" required
                    autocomplete="new-password">
                </div>
                <!--end::Password-->
              </div>
              <!--end::Input group=-->
              <div class="fv-row mb-3">
                <!--begin::Password Confirm-->
                
                <x-label for="password_confirmation" :value="__('Password Confirm')" />

                <div class="password-container">
                  <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control bg-transparent" autocomplete="off">
                  <i class="material-icons show-password-checkbox" id="toggleIcon" onclick="myFunction()">&#xe8f4;</i>
                </div>
                <!--end::Password Confirm-->
              </div>
              <!--end::Input group=-->
              <!--begin::Wrapper-->
              <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
              </div>
              <!--end::Wrapper-->
              <!--begin::Submit button-->
              <div class="d-grid mb-10">
                <button type="submit" class="btn" style="background-color: #00923f;">
                  <!--begin::Indicator label-->
                  <span class="indicator-label">Register</span>
                  <!--end::Indicator label-->
                  <!--begin::Indicator progress-->
                  <span class="indicator-progress">Checking...
                  <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                  <!--end::Indicator progress-->
                </button>
              </div>
              <!--end::Submit button-->
              <!--begin::Sign up-->
              <div class="text-white-500 text-center fw-semibold fs-6">Already have an account? <a href="{{ route('login') }}" class="link-primary">Sign in</a></div>
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
    function myFunction() {
      var x = document.getElementById("password");
      var y = document.getElementById("password_confirmation");
      var icon = document.getElementById("toggleIcon");

      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }

      if (y.type === "password") {
        y.type = "text";
        icon.innerHTML = "&#xe8f5;"; // Icon for showing the password
      } else {
        y.type = "password";
        icon.innerHTML = "&#xe8f4;"; // Icon for hiding the password
      }
    }

    // Check if passwords match
    document.getElementById('password_confirmation').addEventListener('input', function() {
      var password = document.getElementById('password').value;
      var confirmPassword = document.getElementById('password_confirmation').value;

      if (password === confirmPassword && password !== '') {
        document.getElementById('password').classList.add('input-match');
        document.getElementById('password').classList.remove('input-mismatch');
        document.getElementById('password_confirmation').classList.add('input-match');
        document.getElementById('password_confirmation').classList.remove('input-mismatch');
      } else {
        document.getElementById('password').classList.add('input-mismatch');
        document.getElementById('password').classList.remove('input-match');
        document.getElementById('password_confirmation').classList.add('input-mismatch');
        document.getElementById('password_confirmation').classList.remove('input-match');
      }
    });
  </script>

</x-guest-layout>
