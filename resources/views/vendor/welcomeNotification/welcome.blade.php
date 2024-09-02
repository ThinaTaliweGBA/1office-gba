<x-guest-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <main class="main-content mt-0">

        <div class="page-header align-items-start min-vh-100 pb-8 opacity-10 position-relative" style="background-image: url('https://images.unsplash.com/photo-1627850991511-fd5640f0b472?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1951&q=80');">
            {{-- <span class="mask bg-gradient-dark opacity-6"></span> --}}
            <div class="container position-absolute top-50 start-50 translate-middle">
                <div class="d-flex align-items-center mb-6">
                    {{-- <img src="/img/GBA-LOGO-white.png"  alt="GBA Logo"  class="col-lg-2 col-md-4 col-4 mx-auto"> --}}
                    <x-application-logo class="col-lg-2 col-md-4 col-4 mx-auto" />
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom bg-body">
                                    <div class="row mt-3">

                                        <!-- Session Status -->
                                        <x-auth-session-status class="text-light mt-2 text-sm text-center"
                                            :status="session('status')" />


                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="text-light mt-2 text-sm text-center"
                                            :errors="$errors" />

                                    </div>


                            <div class="row px-2">
                                    <h4 class="font-weight-bolder text-center mt-2 mb-0">Set Password</h4>
                                    
                            </div>

                            <div class="card-body">
                                <form method="POST">
                                    @csrf

                                    <input type="hidden" name="email" value="{{ $user->email }}" />



                                    <!-- Password -->
                                    <div class="input-group input-group-dynamic mb-3">

                                        <input id="password" type="password" name="password" class="form-control"
                                            required autocomplete="new-password" placeholder="Password"
                                            aria-label="Password">
                                        

                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="input-group input-group-dynamic mb-3">

                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                            class="form-control" placeholder="Confirm Password" required
                                            autocomplete="new-password">

                                        {{-- <i class="material-icons position-absolute top-50 end-0 translate-middle-y" style="cursor: pointer;" onclick="togglePassword()">&#xe8f4;</i> --}}

                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn bg-success w-100 my-4 mb-2 text-white">Save password and
                                            login</button>
                                    </div>



                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="/js/core/popper.min.js"></script>
    <script src="/js/core/bootstrap.min.js"></script>
    <script src="/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/js/plugins/smooth-scrollbar.min.js"></script>
        
</x-guest-layout>
