<x-guest-layout>
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
              <form class="form w-100" method="POST" action="{{ route('password.email') }}">
                @csrf
              <!--begin::Heading-->
              <div class="text-center mb-10">
                <!--begin::Title-->
                <h1 class="text-dark fw-bolder mb-3">Forgot Password ?</h1>
                <!--end::Title-->
                <!--begin::Link-->
                <div class="text-gray-500 fw-semibold fs-6">An email with a password reset link will be sent.</div>
                
                <!--end::Link-->
                <div>
                                      <!-- Session Status -->
                                      <x-auth-session-status :status="session('status')" />

                                      <!-- Validation Errors -->
                                      <x-auth-validation-errors :errors="$errors" />
                </div>
              </div>
              <!--begin::Heading-->
              <!--begin::Input group=-->
              <div class="fv-row mb-8">
                <!--begin::Email-->
                  <label>Email</label>
                  <input class="form-control bg-transparent" id="email" type="email" name="email" value="{{old('email')}}">
                <!--end::Email-->
              </div>
              <!--begin::Actions-->
              <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                <button type="submit" class="btn btn-primary me-4">
                  
                  <!--begin::Indicator label-->
                  <span class="indicator-label">Submit</span>
                  <!--end::Indicator label-->
                  <!--begin::Indicator progress-->
                  <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                  <!--end::Indicator progress-->
                </button>
                <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
              </div>
              <!--end::Actions-->
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
</x-guest-layout>