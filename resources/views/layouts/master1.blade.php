<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('appdirection', 'ltr') }}">
	<!--begin::Head-->
	<head><base href=""/>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="Group Burial Association.">
		<meta name="keywords" content="Burial, Associations">
		<meta property="og:locale" content="en_US">
		<meta property="og:type" content="article">
		<meta property="og:title" content="GBA System - Burial, Associations">
		<meta property="og:url" content="{{ secure_url('/') }}">
		<meta property="og:site_name" content="GBA System | Group Burial Association">
		<title>@yield('title', 'GBA System')</title>

		<link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
		<!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

        
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->

        {{-- <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
        {{-- <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}

		<!--end::Global Stylesheets Bundle-->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
		<!-- Styles Start-->
		@stack('styles')
		<!-- Styles End-->
        <!-- Theme Link -->
        <link id="theme" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body">
		<!--begin::Theme mode setup on page load-->
		@yield('themeMode')
		<!--end::Theme mode setup on page load-->
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Aside-->
				@yield('aside')
				<!--end::Aside-->
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper" style="transition: 0.5s ease-out; padding-left: 0px !important; padding-top: 0px !important;">
					<!--begin::Header-->
					@yield('header')
					<!--end::Header-->
					<!--begin::Content-->
					@yield('content')
                    <!-- Theme Selector -->
                    <div class="container mt-5">
                        <div class="alert alert-info">
                            <h1>Bootstrap</h1>
                            <p>This is a demo of the Bootswatch API.</p>
                        </div>
                        <select class="form-select"></select>
                    </div>
					<!--end::Content-->
					<!--begin::Footer-->
					@yield('footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--begin::Drawers-->
		<!--begin::Activities drawer-->
		@stack('drawer')
		<!--end::Activities drawer-->
		<!--end::Drawers-->
		<!--end::Main-->
		<!--begin::Javascript-->
		@stack('scripts')
		<script src="{{ asset('js/custom/auto-logout.js') }}"></script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        {{-- <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script> --}}
        {{-- <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script> --}}
        <!--end::Global Javascript Bundle-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
		<script>
			@if (session('success'))
				toastr.success('{{ session('success') }}');
			@endif
		</script>
        <!--end::Javascript-->

        <!-- Bootswatch Theme Switcher -->
        <script>
            fetch('https://bootswatch.com/api/5.json')
                .then(response => response.json())
                .then(data => load(data));

            function load(data) {
                const themes = data.themes;
                const select = document.querySelector('select');

                themes.forEach((value, index) => {
                    const option = document.createElement('option');
                    option.value = index;
                    option.textContent = value.name;

                    select.append(option);
                });

                // Check if there's a saved theme in localStorage and apply it
                const savedTheme = localStorage.getItem('selectedTheme');
                if (savedTheme) {
                    document.querySelector('#theme').setAttribute('href', savedTheme);
                }

                select.addEventListener('change', (e) => {
                    const theme = themes[e.target.value];
                    document.querySelector('#theme').setAttribute('href', theme.css);
                    document.querySelector('.alert h1').textContent = theme.name;

                    // Save the selected theme in localStorage
                    localStorage.setItem('selectedTheme', theme.css);
                });

                // If there's a saved theme, set the dropdown to that theme
                if (savedTheme) {
                    const selectedIndex = themes.findIndex(theme => theme.css === savedTheme);
                    if (selectedIndex !== -1) {
                        select.selectedIndex = selectedIndex;
                        document.querySelector('.alert h1').textContent = themes[selectedIndex].name;
                    }
                }
            }
        </script>
	</body>
<!--end::Body-->
</html>
