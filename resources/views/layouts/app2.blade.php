@extends('layouts.master')
@section('title', 'GBA System')

 @push('styles')

<style>
/* Custom CSS for Toastr notifications in light theme */
[data-bs-theme="light"] .toast {
    color: var(--bs-dark) !important; /* Use the dark color variable for text */
    background-color: var(--bs-light) !important; /* Optional: ensure background is light */
}

[data-bs-theme="light"] .toast-header {
    color: var(--bs-dark) !important; /* Ensure text in the toast header is also visible */
}

[data-bs-theme="light"] .toast-body {
    color: var(--bs-dark) !important; /* Ensure text in the toast body is also visible */
}

    </style>
 
{{--<style>
        // Function to stringify an element's attributes
        function stringifyAttributes(element) {
            const attributes = element.attributes;
            const attrArray = [];
            for (let i = 0; i < attributes.length; i++) {
                const attr = attributes[i];
                attrArray.push(`${attr.name}="${attr.value}"`);
            }
            return attrArray.join(", ");
        }

        // Log details of the click event
        function logClickEvent(event) {
            console.log(`Clicked element: ${event.target.tagName}, Attributes: ${stringifyAttributes(event.target)}`);
        }

        // Initialize click event logging
        document.addEventListener('click', logClickEvent, true);

        // Function to log mutations
        function logMutations(mutations) {
            mutations.forEach(mutation => {
                console.log(`Mutation type: ${mutation.type}`);
                if (mutation.type === 'attributes') {
                    console.log(`Attribute changed: ${mutation.attributeName}, New value: ${mutation.target.getAttribute(mutation.attributeName)}`);
                } else if (mutation.type === 'childList') {
                    console.log(`Changed node: ${mutation.target}, Added nodes: ${mutation.addedNodes.length}, Removed nodes: ${mutation.removedNodes.length}`);
                }
            });
        }

        // Options for the observer (which mutations to observe)
        const config = { attributes: true, childList: true, subtree: true };

        // Create an observer instance linked to the callback function
        const observer = new MutationObserver(logMutations);

        // Start observing the document for configured mutations
        observer.observe(document, config);

        // Ensure observer and event listeners are cleaned up if needed
        window.addEventListener('unload', () => {
            observer.disconnect();
            document.removeEventListener('click', logClickEvent, true);
        });

</style> --}}

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    {{-- <link href="{{ asset('css/dynamic_styles.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/> --}}
    <!--end::Global Stylesheets Bundle-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/intro.js/minified/introjs.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Define the spin animation */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Apply the spin animation only on hover */
        .spin-on-hover:hover {
            animation: spin 2s infinite linear;
        }
    </style>
    <link id="bootstrapCss" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link id="bootswatchCss" rel="stylesheet" href="{{ asset('assets/css/style.bundle.css') }}">
     {{-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> --}}
    

    {{--START Siya: Google auto-complete always on top --}}
    <style>
        .pac-container {
            z-index: 10000 !important; /* Ensure this value is higher than the modal's z-index */
        }

        .custom-tooltip {
        --bs-tooltip-bg: var(--bs-danger);
        --bs-tooltip-color: var(--bs-white);
        }
    </style>
    {{--END Siya: Google auto-complete always on top --}}

            <!-- Google maps auto-complete form -->
            {{-- <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1KOXQsWQgBsFdgoKlPAa38CS0nTzAmM&libraries=places&callback=initAutocomplete">
            </script> --}}
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1KOXQsWQgBsFdgoKlPAa38CS0nTzAmM&libraries=places" async defer></script>
    
        {{--Start- Siya: Trying a modularized version of Google maps auto-complete --}}
        <script>
            "use strict";
        
            function initAutocomplete(inputId, additionalFields) {
                var autocomplete;
                var fields = {
                    address1Field: document.getElementById(additionalFields.Line1),
                    address2Field: additionalFields.Line2 ? document.getElementById(additionalFields.Line2) : null,
                    postalField: additionalFields.PostalCode ? document.getElementById(additionalFields.PostalCode) : null,
                    cityField: additionalFields.City ? document.getElementById(additionalFields.City) : null,
                    townSuburbField: additionalFields.TownSuburb ? document.getElementById(additionalFields.TownSuburb) : null,
                    provinceField: additionalFields.Province ? document.getElementById(additionalFields.Province) : null,
                    countryField: additionalFields.Country ? document.getElementById(additionalFields.Country) : null,
                    placeNameField: additionalFields.PlaceName ? document.getElementById(additionalFields.PlaceName) : null,
                };
        
                autocomplete = new google.maps.places.Autocomplete(document.getElementById(inputId), {
                    componentRestrictions: { country: ["za"] },
                    fields: ["address_components", "geometry", "name"],
                    types: [],
                });
        
                autocomplete.addListener("place_changed", function () {
                    fillInAddress(autocomplete, fields);
                });
            }
        
            function fillInAddress(autocomplete, fields) {
                var place = autocomplete.getPlace();
                var address1 = "";
                var postcode = "";
        
                for (const component of place.address_components) {
                    const componentType = component.types[0];
        
                    switch (componentType) {
                        case "street_number":
                            address1 = `${component.long_name} ${address1}`;
                            break;
                        case "route":
                            address1 += component.short_name;
                            break;
                        case "postal_code":
                            postcode = component.long_name;
                            break;
                        case "postal_code_suffix":
                            postcode += `-${component.long_name}`;
                            break;
                        case "locality":
                            if (fields.cityField) fields.cityField.value = component.long_name;
                            break;
                        case "sublocality_level_1":
                            if (fields.townSuburbField) fields.townSuburbField.value = component.long_name;
                            break;
                        case "administrative_area_level_1":
                            if (fields.provinceField) fields.provinceField.value = component.long_name;
                            break;
                        case "administrative_area_level_2":
                            if (fields.address2Field) fields.address2Field.value = component.long_name;
                            break;
                        case "country":
                            if (fields.countryField) fields.countryField.value = component.long_name.toUpperCase();
                            break;
                    }
                }
        
                if (fields.address1Field) fields.address1Field.value = address1;
                if (fields.postalField) fields.postalField.value = postcode;
                if (fields.placeNameField) fields.placeNameField.value = place.name; // Store the place name
                if (fields.address2Field) fields.address2Field.focus();
            }
        
            window.initAutocomplete = initAutocomplete;
        </script> 
            
        {{--End: Trying a modularized version of Google maps auto-complete --}}
        <style>
            /* Underline active link */
            .menu-link.active .menu-title, 
            .menu-link:active .menu-title,
            .menu-link:visited .menu-title {
                text-decoration: highlight;
                text-size: 8em;
            }

            /* Additional style for the active menu item */
            .menu-link.active {
                color: #0056b3; /* Change the color to blue or any color that suits your design */
                font-weight: bold; /* Make it bold to highlight */
            }
        </style>

    
     <style>
    .table-rounded {
      border-radius: 10px;
      overflow: hidden;
    }
    .table-rounded thead tr:first-child th:first-child {
      border-top-left-radius: 10px;
    }
    .table-rounded thead tr:first-child th:last-child {
      border-top-right-radius: 10px;
    }
    .table-rounded tfoot tr:last-child th:first-child {
      border-bottom-left-radius: 10px;
    }
    .table-rounded tfoot tr:last-child th:last-child {
      border-bottom-right-radius: 10px;
    }
  </style>

    <style>
        select {
            background-color: #e2e2e2 !important;
        }

        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
    </style>

    {{-- Start Testing Border --}}
    <style>
        .border-gba{
            border: 1px solid rgba(0, 146, 63, 1);
            border-radius: 10px;
            color: black !important; /* Add this line to set the text color to white */
        }
        .border-gba-light{
            border: 1px solid rgba(0, 146, 63, 0.21);
            border-radius: 10px;
            color: black !important; /* Add this line to set the text color to white */
        }
        .bg-gba{
            background-color: #f3f4f4;;
            
            color: black !important; /* Add this line to set the text color to white */
        }
        .bg-gba:hover {
            background-color: #fcfcfc; /* Darker shade for hover effect */
        }
        .bg-gba-light{
            background-color: rgba(1, 187, 134, 0.21);
            color: black !important; /* Add this line to set the text color to white */
        }
    </style>
    {{-- End Testing Border --}}

    {{-- Start Toggle Button Transition --}}
    <style>
        #toggleDrawerButton {
            padding: 10px;
            font-size: 24px;
            position: fixed;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            transition: left 0.4s ease-in-out; /* Transition property for smooth movement */
        }

        .hidden {
            display: none;
        }
    </style>
    {{-- End Toggle Button Transition --}}
    
    {{-- Start Hide google translater --}}
    <style>
        .skiptranslate iframe {
            display: none !important; /* Using !important to ensure override of inline styles and other conflicting CSS */
        }

        #\:0\.targetLanguage img {
            display: none !important; /* Hides all <img> elements within the specified div */
        }

        #goog-gt-tt {
            display: none !important; /* Ensures this rule takes precedence over inline styles or other CSS */
        }
    </style>

{{-- Start Script for styling notifications for Activity Log --}}
<style>
#kt_activities_toggle {
    position: relative;
    border: 1px solid #646c9a; /* Border color matching the icon */

}

.notification-badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 5px 10px;
    border-radius: 50%;
    background-color: #f44336; /* Red background for notification count */
    color: white;
    font-size: 0.8rem;
    font-weight: bold;
}

.ki-duotone.ki-notification-bing .path1 {
    fill: #646c9a; /* Primary color */
}

.ki-duotone.ki-notification-bing .path2 {
    fill: #50597b; /* Secondary color */
}

.ki-duotone.ki-notification-bing .path3 {
    fill: #3a4260; /* Tertiary color */
}
</style>
{{-- Start Script for styling notifications for Activity Log --}}


{{-- Start Breadcrums stylings --}}
<style>
.page-title {
    background-color: #f8f9fa; /* Light gray background */
    border-bottom: 1px solid #dee2e6; /* Adds a subtle border */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); /* Soft shadow for depth */
    padding: 20px; /* Adds padding */
    border-radius: 5px; /* Rounded corners */
}

.page-title h2 {
    color: #495057; /* Dark gray text color for better readability */
}

.page-title small {
    color: #6c757d; /* Muted text for less emphasis */
}
</style>
{{-- End Breadcrums stylings --}}

<style>
/* Custom styling for the Google Translate dropdown */
#google_translate_element .goog-te-gadget-simple {
    background-color: var(--bs-body);
    border: 1px solid var(--bs-border-color, #ced4da);
    border-radius: 0.25rem;
    padding: 0.375rem 0.55rem;
    display: inline-block;
    font-size: 1rem;
    line-height: 1.5;
    color: var(--bs-light);
    font-weight: 500;
    text-align: left;
    vertical-align: middle;
    cursor: pointer;
    white-space: wrap;
}

#google_translate_element .goog-te-gadget-simple .VIpgJd-ZVi9od-xl07Ob-lTBxed {
    text-decoration: none;
    color: #495057;
}

#google_translate_element .goog-te-gadget-simple .VIpgJd-ZVi9od-xl07Ob-lTBxed:hover {
    color: #007bff;
}

#google_translate_element .goog-te-gadget-icon {
    display: none;
}

#google_translate_element .goog-te-gadget-simple span {
    display: inline;
}
</style>
<style>

    /* Default active styles */
    .menu-item-active .menu-link , .menu-sub .menu-item-active .menu-link {
        background-color !important: #454545; /* Dark grey background for active items */
        color: red !important; /* White text for active items */
        font-weight: bold !important; /* Bold text */
        border-left: 4px solid green !important; /* Orange left border */
    }

    /* Hover effects for menu links */
    .menu-item .menu-link:hover {
        background-color: var(--bs-light) !important; /* Slightly darker background on hover */
        transition: background-color 0.3s !important; /* Smooth transition for background color */
    }

    :root {
        --menu-active-bg-dark: #454545 !important;
        --menu-active-border-dark: #ff4500 !important;
        --menu-sub-active-bg-dark: #454545 !important;
    }

    /* Dark theme specific overrides */
    .dark-theme .menu-item-active {
        background-color: var(--menu-active-bg-dark) !important;
        border-left: 4px solid var(--menu-active-border-dark) !important;
        color: #fff !important;
        font-weight: bold !important;
    }

    .dark-theme .menu-sub .menu-item-active {
        background-color: var(--menu-sub-active-bg-dark);
        color: #fff !important;
        font-weight: bold !important;
    }

</style>




@endpush

@section('themeMode')
    <x-theme.theme-mode/>
@endsection

@section('aside')

    {{-- Start SidePanel Toggle Button --}}
    {{-- <div id="toggleDrawerButton" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle me-n2"
        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
        data-kt-toggle-name="aside-minimize" style="padding: 5px; font-size: 24px; position: fixed; top: 50%; transform: translateY(-50%);">
        <i class="ki-outline ki-double-left fs-1 rotate-180" style="font-size: 24px;"></i>
    </div> --}}
    {{-- End SidePanel Toggle Button --}}
    <div id="toggleDrawerButton" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle me-n2 overflow-y-auto"
    data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
    data-kt-toggle-name="aside-minimize" style="padding: 5px; font-size: 24px; position: fixed; top: 50%; left: 0; transform: translateY(-50%);">
    <i class="ki-outline ki-double-right fs-1 rotate-180" style="font-size: 34px;"></i>
    </div>

    <!-- Scrollable version of the aside with up and down scroll navigator -->
    <!-- <div id="kt_aside" class="aside pt-7 pb-4 pb-lg-7 pt-lg-17 hidden shadow overflow-auto" data-kt-drawer="true" data-kt-drawer-name="aside"
         data-kt-drawer-activate="{default: true, lg: true}" data-kt-drawer-overlay="true"
         data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
         data-kt-drawer-toggle="#kt_aside_toggle"> -->
    <div id="kt_aside" class="aside pt-7 pb-4 pb-lg-7 pt-lg-17 hidden shadow" data-kt-drawer="true" data-kt-drawer-name="aside"
         data-kt-drawer-activate="{default: true, lg: true}" data-kt-drawer-overlay="true"
         data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
         data-kt-drawer-toggle="#kt_aside_toggle">
        <!--begin::Brand-->
        <div class="d-flex justify-content-center p-4 mb-2">
            <a href="{{ route('home') }}" class="shadow">
                {{-- <h1 class="text-center">{{ __('messages.GBASystem') }}</h1> --}}
                <a href="/">
                    <img alt="Logo" src="{{ asset('img/GBA-LOGO-white.png') }}" class="h-90px logo theme-light-show">
                    <img alt="Logo" src="{{ asset('img/GBA-LOGO-white.png') }}" class="h-90px logo theme-dark-show">
                </a>
            </a>
        </div>
        <!--end::Brand-->

        <!--begin::Aside user-->
        <div class="aside-user mb-5 p-4" id="kt_aside_user">
            <!--begin::User-->
        @auth
            <x-aside.profile name="{{ ucfirst(Auth::user()->name) }}"
                            profileLink="{{ route('admin.account.info') }}"
                            profileImg="{{ asset('assets/media/avatars/blank.png') }}"
                            description="{{ (Auth::user()->email) }}"
                            class="additional-css-classes"/>
            <!--end::User-->
        @else
            <script>window.location.href = "{{ route('login') }}";</script>
        @endauth

        <div id="google_translate_element" class="mx-auto text-center"></div>
            <!--end::User-->
        </div>
        
        <!--end::Aside user-->

        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid ps-3 ps-lg-5 pe-1 mb-9" id="kt_aside_menu">
            <!--begin::Aside Menu-->
            <div class="w-100 pe-2 me-2 overflow-auto" id="kt_aside_menu_wrapper"
                data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" 
                data-kt-scroll-height="auto"
                data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_user, #kt_aside_footer"
                data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper"
                data-kt-scroll-offset="0">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold" id="kt_aside_menu"
                    data-kt-menu="true">
                    <div class="menu-item"><!--begin:Menu link-->
                        <a class="menu-link" href="/memberships">
                            <span class="menu-icon"><i class="bi bi-person-rolodex fs-2"></i></span>
                            <span class="menu-title">Memberships</span>
                        </a><!--end:Menu link-->
                    </div>

                    <div class="menu-item"><!--begin:Menu link-->
                        <a class="menu-link" href="/dependants">
                            <span class="menu-icon"><i class="bi bi-people-fill fs-2"></i></span>
                            <span class="menu-title">Dependants</span>
                        </a><!--end:Menu link-->
                    </div>

                    @canany(['user edit', 'role edit', 'permission edit'])
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover" id="menu-admin-space">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon"><i class="bi bi-briefcase fs-2"></i></span>
                            <span class="menu-title">Admin Space</span>
                            <span class="menu-arrow"></span>
                        </span><!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion" kt-hidden-height="97" style="" id="sub-menu-admin-space">
                            <!-- Submenu items -->
                            <div class="menu-item" id="menu-users">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="/admin/user">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Users</span>
                                </a><!--end:Menu link-->
                            </div>
                            <div class="menu-item" id="menu-roles">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="/admin/role">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Roles</span>
                                </a><!--end:Menu link-->
                            </div>
                            <div class="menu-item" id="menu-permissions">
                                <!--begin:Menu link-->
                                <a class="menu-link" href="/admin/permission">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Permissions</span>
                                </a><!--end:Menu link-->
                            </div>
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion" id="menu-employee-management">
                                <!--begin:Menu link-->
                                <span class="menu-link">
                                    <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                    <span class="menu-title">Employee Management</span>
                                    <span class="menu-arrow"></span>
                                </span><!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion menu-active-bg" id="sub-menu-employee-management">
                                    <!-- Submenu items -->
                                    <div class="menu-item" id="menu-employees">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="/admin/employee">
                                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                            <span class="menu-title">Employees</span>
                                        </a><!--end:Menu link-->
                                    </div>
                                    <div class="menu-item" id="menu-employeeroles">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="/admin/employeerole">
                                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                            <span class="menu-title">Employee Roles</span>
                                        </a><!--end:Menu link-->
                                    </div>
                                    <div class="menu-item" id="menu-jobdescriptions">
                                        <!--begin:Menu link-->
                                        <a class="menu-link" href="/admin/jobdescriptions">
                                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                            <span class="menu-title">Job Descriptions</span>
                                        </a><!--end:Menu link-->
                                    </div>
                                </div><!--end:Menu sub-->
                            </div><!--end:Menu item-->
                        </div><!--end:Menu sub-->
                    </div>
                    @endcanany

                    <div class="menu-item"><!--begin:Menu link-->
                        <a class="menu-link" href="/resolutionhub">
                            <span class="menu-icon"><i class="bi bi-gear-wide-connected fs-2"></i></span>
                            <span class="menu-title">Resolution Hub</span>
                        </a><!--end:Menu link-->
                    </div>

                    <div class="menu-item"><!--begin:Menu link-->
                        <a class="menu-link" href="/payments">
                            <span class="menu-icon"><i class="bi bi-wallet2 fs-2"></i></span>
                            <span class="menu-title">Payments</span>
                        </a><!--end:Menu link-->
                    </div>

                    <div class="menu-item"><!--begin:Menu link-->
                        <a class="menu-link" href="/funerals">
                            <span class="menu-icon"><i class="fa-solid fa-cross fs-2"></i></span>
                            <span class="menu-title">Deaths/Funerals</span>
                        </a><!--end:Menu link-->
                    </div>
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside menu-->




        <!--begin::Footer-->
        {{-- <div class="aside-footer flex-column-auto px-6 px-lg-9 pb-16" id="kt_aside_footer"> --}}
            <!--begin::User panel-->
            {{-- <div class="d-flex flex-stack ms-7"> --}}
                <!--begin::Link-->
                {{-- <x-aside.click-icon link="/logout" class="additional-classes" text="{{ __('messages.LogOut') }}"
                                    icon="ki-duotone ki-entrance-left"/> --}}
                <!--end::Link-->
                <!--begin::User menu-->
                {{-- <x-aside.footer-menu :items="[
                    ['url' => '/admin/edit-account-info', 'title' => __('messages.profile')],
                    ['url' => '/', 'title' => __('messages.Dependants'), 'badge' => '3'],
                    ['url' => '/', 'title' => __('messages.Memberships')],
                    
                ]" classes="additional-classes"/> --}}
                
                <!--end::User menu-->
            {{-- </div> --}}
            <!--end::User panel-->
        {{-- </div> --}}
        <!--end::Footer-->
    </div>

@endsection

@section('header')
    <div id="kt_header" class="header my-1 p-0 shadow bg-body border-secondary rounded-2 w-50 mx-auto" style="height:60px;">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-row flex-wrap justify-content-between text-wrap"
             id="kt_header_container">

            
            
            <!--begin::Page title-->
            <x-header.page-title title="Current Dashboard" subtitle="current page" class="additional-classes"/>
            <!--end::Page title=-->
            
            <div class="d-flex justify-content-center my-auto" hidden>
                <!--begin::Solid input group style-->
                {{-- <div class="dropdown">
                        <form action="{{ route('direction.switch') }}" method="POST">
                            @csrf
                            <select name="direction" class="btn bg-secondary shadow-dark dropdown-toggle border border-secondary" data-control="select2"
                                    data-placeholder="Select a direction" onchange="this.form.submit();">
                                <option value="ltr" {{ session('appdirection') == 'ltr' ? 'selected' : '' }}>LTR</option>
                                <option value="rtl" {{ session('appdirection') == 'rtl' ? 'selected' : '' }}>RTL</option>
                            </select>
                        </form>
                </div> --}}
                <!-- end::Solid input group style-->
 
                <!--begin::Solid input group style-->
                {{-- <div class="dropdown mx-2">
                        <form action="{{ route('language.switch') }}" method="POST" class="w-100">
                            @csrf
                            <select name="language" class="btn bg-secondary shadow-dark dropdown-toggle border border-secondary" data-control="select2"
                                    data-placeholder="Select a Language" onchange="this.form.submit();">
                                <option value="en" {{ session('applocale') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="af" {{ session('applocale') == 'af' ? 'selected' : '' }}>Afrikaans</option>
                            </select>
                        </form>
                </div> --}}
                <!--end::Solid input group style-->


                {{-- <div class="search-container bg-secondary ps-4">
                    <form action="/action_page.php">
                    <input type="text" placeholder="Search.." name="search">
                    <a type="submit" class="btn btn-icon"><i class="fa fa-search"></i></a>
                    </form>
                </div> --}}
            </div>

            {{-- @canany(['user edit', 'role edit', 'permission edit']) --}}
                <!--begin::Solid input group style-->
                {{-- <div class="input-group input-group-solid" style="width: 190px; font-size: 0.8rem;">
                    <div class="overflow-hidden flex-grow-1">
                        <form action="/set-layout" method="POST" class="w-100">
                            @csrf
                            <select name="selectedLayoutIndex" class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select a Layout" onchange="this.form.submit();">
                                @foreach ($layouts as $index => $layout)
                                    <option value="{{ $index }}"
                                        {{ $index == $selectedLayoutIndex ? 'selected' : '' }}>
                                        {{ $layout->name == 'app2' ? 'GBA' : $layout->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div> --}}
                <!--end::Solid input group style-->
            {{-- @endcanany --}}

            <!--begin::Wrapper-->
            <x-header.brand class="my-custom-class" href="{{ route('admin.home') }}" logoSrc="img/GBA-LOGO-white2.png"
                            logoAlt="Logo"/>
            <!--end::Wrapper-->

            <!--begin::Topbar-->
            <div class="d-flex align-items-center flex-shrink-0">
                <!--begin::Activities-->
                <div class="d-flex align-items-center ms-3 ms-lg-4">
                    <!--begin::Drawer toggle-->
                  
                    {{-- <div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline w-40px h-40px bg-gba-light ribbon ribbon-top ribbon-vertical"
                         id="kt_activities_toggle">
                         <div class="ribbon-label bg-transparent">
                             @if(auth()->user() && auth()->user()->unreadNotifications->count() > 0)
                        <div class="mb-3">
                        <span class="badge badge-danger" id="unreadCount"> {{ auth()->user()->unreadNotifications->count() }}</span>
                            
                        </div>
                        @endif
                        </div>
                        <i class="ki-duotone ki-notification-bing" style="font-size: 34px;">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>                      
                    </div> --}}

                    <div class="btn btn-icon btn-active-color-success btn-outline w-40px h-40px bg-body border border-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Notifications"
                        id="kt_activities_toggle">
                        <!-- Notification Icon -->
                            <i class="bi bi-bell-fill fs-1"></i>
                        <!-- Notification Badge -->
                        {{-- @if(auth()->user() && auth()->user()->unreadNotifications->count() > 0)
                        <span class="notification-badge fs-8" id="unreadCount">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                        @endif --}}
                    </div>

                    
                     
                    <!--end::Drawer toggle-->
                    </div>
                    <!--end::Activities-->
                    <!--begin::Theme mode-->
                    <div class="d-flex align-items-center ms-3 ms-lg">
                    <!--begin::Menu toggle-->
                    <a href="#" class="btn btn-icon btn-active-color-success btn-outline w-40px h-40px bg-body border border-secondary"
                       data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                       data-kt-menu-placement="bottom-end">
                        <!-- <i class="ki-duotone ki-night-day theme-light-show fs-1">
                                                                           <span class="path1"></span>
                                                                           <span class="path2"></span>
                                                                           <span class="path3"></span>
                                                                           <span class="path4"></span>
                                                                           <span class="path5"></span>
                                                                           <span class="path6"></span>
                                                                           <span class="path7"></span>
                                                                           <span class="path8"></span>
                                                                           <span class="path9"></span>
                                                                           <span class="path10"></span>
                                                                          </i> -->
                        <!-- <i class="ki-duotone ki-moon theme-dark-show fs-1">
                                                                           <span class="path1"></span>
                                                                           <span class="path2"></span>
                                                                          </i> -->
                        <i class="ki-duotone ki-night-day" style="font-size: 34px;">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                            <span class="path7"></span>
                            <span class="path8"></span>
                            <span class="path9"></span>
                            <span class="path10"></span>
                        </i>
                    </a>
                    <!--begin::Menu toggle-->
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                         data-kt-menu="true" data-kt-element="theme-mode-menu">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.Light') }}</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="bi bi-moon fs-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.Dark') }}</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="graytheme">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.Gray') }}</span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="browntheme">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.Brown') }}</span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="pinktheme">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.Pink') }}</span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="redtheme">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.Red') }}</span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="bluetheme">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.Blue') }}</span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="yellowtheme">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.Yellow') }}</span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->

                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.System') }}</span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                data-kt-value="owntheme">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-night-day fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.own_style') }}</span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        {{-- <div class="menu-item px-3 my-0">
                            <a href="{{ route('customize') }}" class="menu-link px-3 py-2">
                                <span class="menu-icon" data-kt-element="icon">
                                    <i class="ki-duotone ki-screen fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="menu-title">{{ __('messages.Customize') }}</span>
                            </a>
                        </div> --}}
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                </div>
                <!--end::Theme mode-->
                <!--begin::Sidebar Toggler-->
                <!--begin::Activities-->
                <div class="d-flex align-items-center ms-3 ms-lg-4 border border-secondary rounded">
                    <!--begin::Logout Form-->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="btn btn-icon btn-active-color-danger btn-outline w-40px h-40px bg-body border border-body" onclick="document.getElementById('logout-form').submit();" data-bs-toggle="tooltip" data-bs-placement="top" title="Log out" data-bs-custom-class="custom-tooltip">
                        <i class="bi bi-power" style="font-size: 28px;"></i>
                    </div>
                    <!--end::Logout Form-->
                    
                </div>

                <!--end::Activities-->
                <!--end::Sidebar Toggler-->
            </div>
            <!--end::Topbar-->
        </div>
        <!--end::Container-->
    </div>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->

        <div class="container-fluid" id="kt_content_container">
            <!--begin::Row-->

            <div class="row g-2 g-lg-10">

                {{-- Start Checking If The User Is Owing --}}
                @if (Auth::check() && ucfirst(Auth::user()->email) === 'Owing@user.com')
                    <!--begin::Alert-->
                    <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-information fs-2hx text-light me-4 mb-5 mb-sm-0"><span
                                    class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h4 class="mb-2 light">This is an alert</h4>
                            <!--end::Title-->

                            <!--begin::Content-->
                            <span>The alert component can be used to highlight certain parts of your page for higher content
                                visibility.</span>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Close-->
                        <button type="button"
                                class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                data-bs-dismiss="alert">
                            <i class="ki-duotone ki-cross fs-1 text-light"><span class="path1"></span><span
                                        class="path2"></span></i>
                        </button>
                        <!--end::Close-->
                    </div>
                    <!--end::Alert-->
                    <!--begin::Alert-->
                    <div
                            class="alert alert-dismissible bg-light-danger d-flex flex-center flex-column py-10 px-10 px-lg-20 mb-10">
                        <!--begin::Close-->
                        <button type="button" class="position-absolute top-0 end-0 m-2 btn btn-icon btn-icon-danger"
                                data-bs-dismiss="alert">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                        class="path2"></span></i>
                        </button>
                        <!--end::Close-->

                        <!--begin::Icon-->
                        <i class="ki-duotone ki-information-5 fs-5tx text-danger mb-5"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span></i>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="text-center">
                            <!--begin::Title-->
                            <h1 class="fw-bold mb-5">This is a reminder.</h1>
                            <!--end::Title-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed border-danger opacity-25 mb-5"></div>
                            <!--end::Separator-->

                            <!--begin::Content-->
                            <div class="mb-9 text-dark">
                                Please settle your outstanding bill with <strong>GBA asap</strong>.<br/>
                                Please read our <a href="#" class="fw-bold me-1">Terms and Conditions</a> for more
                                info.
                            </div>
                            <!--end::Content-->

                            <!--begin::Buttons-->
                            <div class="d-flex flex-center flex-wrap">
                                <a href="#"
                                   class="btn btn-outline btn-outline-danger btn-active-danger m-2">Cancel</a>
                                <a href="#" class="btn btn-danger m-2">Ok, I got it</a>
                            </div>
                            <!--end::Buttons-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Alert-->
                @endif
                {{-- End Checking If The User Is Owing --}}

                @yield('row_content')
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
@endsection







@section('footer')

        <!--begin::Container-->
        <div class="footer container-fluid d-flex flex-column flex-md-row flex-stack bg-body mx-auto mt-auto shadow-lg" id="kt_footer">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <a href="/contact" class="text-dark text-hover-primary fw-semibold me-1 fs-4">GBA</a>
            </div>
            <!--end::Copyright-->

            <!--begin::Menu-->
            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                <a href="/contact" class="pt-2 text-dark text-hover-primary fw-semibold me-1 fs-4">Contacts</a>
            </ul>
            <!--end::Menu-->
        </div>
        <!--end::Container-->

<!--begin::Activities drawer-->
<div id="kt_activities" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="activities"
    data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'170px', 'lg': '700px'}" data-kt-drawer-direction="end"
    data-kt-drawer-toggle="#kt_activities_toggle" data-kt-drawer-close="#kt_activities_close">
    <div class="card shadow-none border-0 rounded-0">
        <!--begin::Header-->
        <div class="card-header" id="kt_activities_header">
            <h3 class="card-title fw-bold text-dark">Activity Logs</h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5"
                        id="kt_activities_close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body position-relative mt-4" id="kt_activities_body">
            <!--begin::Content-->
            <div id="kt_activities_scroll" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true"
                data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_activities_body"
                data-kt-scroll-dependencies="#kt_activities_header, #kt_activities_footer"
                data-kt-scroll-offset="5px">
                <!--begin::Timeline items-->
                <div class="timeline">
                    <!--begin::Timeline item-->
                    <div class="timeline-item">
                        <!--begin::Timeline line-->
                        <div class="timeline-line w-40px"></div>
                        <!--end::Timeline line-->
                        <!--begin::Timeline icon-->
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-dark">
                                <i class="ki-duotone ki-flag fs-2 text-gray-500">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <!--end::Timeline icon-->
                        <!--begin::Timeline content-->
                        <div class="timeline-content mb-10 mt-10">
                            <!--begin::Timeline heading-->
                            <div class="overflow-auto pe-3">
                                <!--begin::Title-->
                                <div class="fs-5 fw-semibold mb-2">You have a new message
                                    <button class="badge badge-sm bg-danger" style="cursor: pointer;">clear</button>
                                </div>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="d-flex align-items-center mt-1 fs-6">
                                    <!--begin::Info-->
                                    <div class="me-2 fs-7 text-gray-700">10 minutes ago</div>
                                    <!--end::Info-->
                                    <!--begin::User-->
                                    <span> by </span><a href="#" class="text-primary fw-bold me-1">Jane Doe</a>
                                    <!--end::User-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Timeline heading-->
                        </div>
                        <!--end::Timeline content-->
                    </div>
                    <!--end::Timeline item-->
                    <!--begin::Timeline item-->
                    <div class="timeline-item">
                        <!--begin::Timeline line-->
                        <div class="timeline-line w-40px"></div>
                        <!--end::Timeline line-->
                        <!--begin::Timeline icon-->
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-dark">
                                <i class="ki-duotone ki-sms fs-2 text-gray-500">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <!--end::Timeline icon-->
                        <!--begin::Timeline content-->
                        <div class="timeline-content mb-10 mt-n1">
                            <!--begin::Timeline heading-->
                            <div class="pe-3 mb-5">
                                <!--begin::Title-->
                                <div class="fs-5 fw-semibold mb-2">Memorial Service Planning
                                    <a href="#" class="text-primary fw-bold me-1">#12345</a> has been allocated to you
                                    for the Eternal Rest Funeral Services
                                </div>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="overflow-auto pb-5">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="me-2 fs-7">Assigned at 10:00 AM by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <a href="#" class="text-primary fw-bold me-1">John Doe</a>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Timeline heading-->
                        </div>
                        <!--end::Timeline content-->
                    </div>
                    <!--end::Timeline item-->
                    <!--begin::Timeline item-->
                    <div class="timeline-item">
                        <!--begin::Timeline line-->
                        <div class="timeline-line w-40px"></div>
                        <!--end::Timeline line-->
                        <!--begin::Timeline icon-->
                        <div class="timeline-icon symbol symbol-circle symbol-40px">
                            <div class="symbol-label bg-dark">
                                <i class="ki-duotone ki-sms fs-2 text-gray-500">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                        <!--end::Timeline icon-->
                        <!--begin::Timeline content-->
                        <div class="timeline-content mb-10 mt-n1">
                            <!--begin::Timeline heading-->
                            <div class="pe-3 mb-5">
                                <!--begin::Title-->
                                <div class="fs-5 fw-semibold mb-2">New User Registration
                                    <a href="#" class="text-primary fw-bold me-1">#67890</a> has been successfully completed.
                                </div>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="overflow-auto pb-5">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        <div class="me-2 fs-7">Completed at 2:30 PM by</div>
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <a href="#" class="text-primary fw-bold me-1">Alice Smith</a>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Timeline heading-->
                        </div>
                        <!--end::Timeline content-->
                    </div>
                    <!--end::Timeline item-->
                </div>
                <!--end::Timeline items-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Body-->

        <!--begin::Footer-->
        <div class="card-footer py-5 text-center" id="kt_activities_footer">
            <a href="#" class="btn btn-bg-body text-primary">End Of Activities.</a>
        </div>
        <!--end::Footer-->
    </div>
</div>
<!--end::Activities drawer-->


        <!-- Delete Confirmation Modal -->
{{-- <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST" action="">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div> --}}

@endsection

@section('drawer')
@endsection

@push('scripts')



<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var formAction = this.getAttribute('data-action');
                var form = document.getElementById('deleteForm');
                form.action = formAction;
                deleteModal.show();
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        
        document.querySelectorAll('.btn-delete-modal').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var formAction = this.getAttribute('data-action');
                var form = document.getElementById('deleteForm');
                form.action = formAction;
                deleteModal.show();
            });
        });

        document.querySelectorAll('.btn-delete-confirm').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var confirmAction = confirm('Are you sure you want to delete this item?');
                if (confirmAction) {
                    window.location.href = this.getAttribute('href');
                }
            });
        });
    });
</script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var button = document.getElementById('toggleDrawerButton');
            var isToggled = false;

            button.addEventListener('click', function() {
                if (!isToggled) {
                    // Move the button 250px to the right
                    button.style.left = '250px';
                } else {
                    // Move the button back to its initial position
                    button.style.left = '0';
                }

                // Toggle the state
                isToggled = !isToggled;
            });
        });
    </script>

    {{-- Start Aside Script For Button Toggle --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.getElementById('toggleDrawerButton');
            const aside = document.getElementById('kt_aside');
            const wrapper = document.getElementById('kt_wrapper');

            toggleButton.addEventListener('click', function () {
                // Toggle the 'drawer-on' class on the aside
                aside.classList.toggle('drawer-on');

                // Check if the aside now has the 'drawer-on' class
                const isDrawerOn = aside.classList.contains('drawer-on');

                // Adjust the padding-left of the wrapper based on the drawer state
                wrapper.style.paddingLeft = isDrawerOn ? '250px' : '0px';
            });
        });
    </script>
    {{-- Start Aside Script For Button Toggle --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleButtons = [document.getElementById('kt_aside_toggle'), document.getElementById('kt_aside_toggle_new')];
            const wrapper = document.getElementById('kt_wrapper');
            const body = document.body; // Assuming the drawer-on class will be toggled on the body.

            toggleButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // This example simply toggles a class on the body. Your actual implementation may differ.
                    body.classList.toggle('drawer-on');

                    const isDrawerOpen = body.classList.contains('drawer-on');

                    if (isDrawerOpen) {
                        // Drawer is now open, apply padding with transition.
                        wrapper.style.transition = 'padding-left 0.5s ease-in';
                        wrapper.style.paddingLeft = '250px'; // Adjust as needed based on your drawer width.
                    } else {
                        // Drawer is now closed, remove padding.
                        wrapper.style.paddingLeft = '0px';
                    }
                });
            });
        });

    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var button = document.getElementById('moveContentButton');
            var content = document.getElementById('kt_wrapper');
            var paddingApplied = false; // Tracks the state of padding


            button.addEventListener('click', function () {
                if (paddingApplied) {
                    content.style.paddingLeft = '0px'; // Move content back
                    document.getElementById('kt_aside_toggle').click();
                } else {
                    content.style.paddingLeft = '250px'; // Move content away
                    document.getElementById('kt_aside_toggle').click();
                }
                paddingApplied = !paddingApplied; // Toggle the state
            });
        });

    </script>

    {{-- <script>
        var hostUrl = "{{ asset('assets/') }}";
    </script> --}}

    {{-- Start Sweet Alert for all success messages redirect --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let successMessage = "{{ Session::get('success') }}";

            if (successMessage) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: successMessage,
                    showConfirmButton: false,
                    timer: 1800,
                })
            }
        });
    </script>
    {{-- End Sweet Alert for all success messages redirect --}}

    <!-- Core JS Files -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('js/core/bootstrap.min.js') }}"></script> --}}
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/plugins/choices.min.js') }}"></script>

    <script>
        $(function () {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function (start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });

        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[4]); // use data for the date column

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function () {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            // DataTables initialisation
            var table = $('#datatable-search').DataTable();

            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
            });
        });
    </script>

    <!--  Not sure   -->
    <script>
        $('input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], input[type=date], input[type=time], textarea')
            .each(function (element, i) {
                if ((element.value !== undefined && element.value.length > 0) || $(this).attr('placeholder') !==
                    undefined) {
                    $(this).siblings('div').addClass('is-invalid focused is-focused');
                } else {
                    $(this).siblings('label').removeClass('is-filled');
                }
            });
        //$('input[type=email]').val('test').siblings('label').addClass('is-filled');
    </script>


    <!-- Google maps auto-complete form -->
    {{-- <script>
        "use strict";
        Object.defineProperty(exports, "__esModule", {
            value: true
        });
        var autocomplete;
        var address1Field;
        var address2Field;
        var postalField;

        function initAutocomplete() {
            address1Field = document.getElementById("Line1");
            address2Field = document.getElementById("Line2");
            postalField = document.getElementById("PostalCode");
            // Create the autocomplete object, restricting the search predictions to
            // addresses in the US and Canada.
            autocomplete = new google.maps.places.Autocomplete(address1Field, {
                componentRestrictions: {
                    country: ["za"]
                },
                fields: ["address_components", "geometry", "name"],
                types: [],
            });
            address1Field.focus();
            // When the user selects an address from the drop-down, populate the
            // address fields in the form.
            autocomplete.addListener("place_changed", fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();
            var address1 = "";
            var postcode = "";

            // Assuming you have a field to store the place name
            var placeNameField = document.getElementById("PlaceName");
            if (placeNameField && place.name) {
                placeNameField.value = place.name; // Set the place name
            }

            // Get each component of the address from the place details
            for (const component of place.address_components) {
                const componentType = component.types[0]; // Fixed type error by assuming correct structure

                switch (componentType) {
                    case "street_number": {
                        address1 = `${component.long_name} ${address1}`;
                        break;
                    }
                    case "route": {
                        address1 += component.short_name;
                        break;
                    }
                    case "postal_code": {
                        postcode = component.long_name;
                        break;
                    }
                    case "postal_code_suffix": {
                        postcode += `-${component.long_name}`;
                        break;
                    }
                    case "locality": {
                        document.getElementById("City").value = component.long_name;
                        break;
                    }
                    case "sublocality_level_1": {
                        document.getElementById("TownSuburb").value = component.long_name;
                        break;
                    }
                    case "administrative_area_level_1": {
                        document.getElementById("Province").value = component.long_name;
                        break;
                    }
                    case "administrative_area_level_2": {
                        document.getElementById("Line2").value = component.long_name;
                        break;
                    }
                    case "country":
                        document.getElementById("Country").value = component.long_name.toUpperCase();
                        break;
                }
            }

            address1Field.value = address1;
            document.getElementById("PostalCode").value = postcode;

            // Focus on the second address line for additional details
            address2Field.focus();
        }


        window.initAutocomplete = initAutocomplete;
    </script> --}}



    {{-- //This is for the member form - original --}}
    {{-- <script>
        function getDOB(IDNumber) {
            var Year = IDNumber.substring(0, 2);
            var Month = IDNumber.substring(2, 4);
            var Day = IDNumber.substring(4, 6);
            

            var cutoff = (new Date()).getFullYear() - 2000;

            var Y = (Year > cutoff ? '19' : '20') + Year;

            document.getElementById("inputYear").value += Y;
            document.getElementById("inputMonth").value += Month;
            document.getElementById("inputDay").value += Day;
            
        }
    </script> --}}


    <script>
        function getDOB(IDNumber) {
            // Clear existing error messages
            $('#error span').remove();

            var error = $('#error');
            var correct = true;

            // Validate ID number length and numeric value
            if (IDNumber.length != 13 || isNaN(IDNumber)) {
                error.append('<p>SA ID number not valid</p>');
                correct = false;
            } else {
                var yearPrefix = (parseInt(IDNumber.substring(0, 2)) > new Date().getFullYear() % 100) ? '19' : '20';
                var birthYear = yearPrefix + IDNumber.substring(0, 2);
                var birthMonth = IDNumber.substring(2, 4);
                var birthDay = IDNumber.substring(4, 6);
                var tempDate = new Date(birthYear, birthMonth - 1, birthDay);
                var currentYear = new Date().getFullYear();
                var age = currentYear - birthYear;

                // Validate the extracted date
                if (tempDate.getFullYear() != birthYear || tempDate.getMonth() + 1 != birthMonth || tempDate.getDate() != birthDay) {
                    error.append('<p>SA ID number not valid</p>');
                    correct = false;
                }
            }

            if (correct) {
                error.hide();
                $('#IDNumber, #inputYearDiv, #inputMonthDiv, #inputDayDiv').addClass('is-valid').removeClass('is-invalid');
                $('#inputYear').val(birthYear);
                $('#inputMonth').val(birthMonth);
                $('#inputDay').val(birthDay);
                $('#age').val(age);

                // Call the function to select the membership based on age
                if (typeof selectMembershipBasedOnAge === 'function') {
                    selectMembershipBasedOnAge(age);
                }
            } else {
                // Clear the fields if the ID is invalid
                error.show();
                $('#IDNumber, #inputYearDiv, #inputMonthDiv, #inputDayDiv').addClass('is-invalid').removeClass('is-valid');
                $('#inputYear').val(''); // Clear the year input
                $('#inputMonth').val(''); // Clear the month input
                $('#inputDay').val(''); // Clear the day input
                $('#age').val(''); // Clear the age input
                $('#memtype').val('0').trigger('change'); // Clear the membership selection
            }

            return false;
        }

    </script>
    
    

    {{-- This is for the dependent form --}}
    <script>
        function getDOBDep(IDNumber) {
            // if no error found, hide the error message


            // first clear any left over error messages
            $('#error span').remove();



            document.getElementById("inputYearDep").value = "";  // Clear existing content
            document.getElementById("inputMonthDep").value = "";  // Clear existing content
            document.getElementById("inputDayDep").value = "";  // Clear existing content



            //This clears the red x mark
            document.getElementById("IDNumberDepDiv").classList.remove('is-invalid');
            document.getElementById("inputYearDepDiv").classList.remove('is-invalid');
            document.getElementById("inputMonthDepDiv").classList.remove('is-invalid');
            document.getElementById("inputDayDepDiv").classList.remove('is-invalid');

            //This clears the green checkmark
            document.getElementById("IDNumberDepDiv").classList.remove('is-valid');
            document.getElementById("inputYearDepDiv").classList.remove('is-valid');
            document.getElementById("inputMonthDepDiv").classList.remove('is-valid');
            document.getElementById("inputDayDepDiv").classList.remove('is-valid');


            // store the error div, to save typing
            var error = $('#error');

            // assume everything is correct and if it later turns out not to be, just set this to false
            var correct = true;

            // SA ID Number have to be 13 digits, so check the length
            if (IDNumber.length != 13 || !isNumber(IDNumber)) {
                error.append('<p>SA ID number not a valid number</p>');
                correct = false;
            }
            // get first 6 digits as a valid date
            var tempDate = new Date(IDNumber.substring(0, 2), IDNumber.substring(2, 4) - 1, IDNumber.substring(4, 6));

            var id_date = tempDate.getDate();
            var id_month = tempDate.getMonth();
            var id_year = tempDate.getFullYear();


            var Year = IDNumber.substring(0, 2);

            var cutoff = (new Date()).getFullYear() - 2000;

            var Y = (Year > cutoff ? '19' : '20') + Year;


            var fullDate = id_date + "-" + (id_month + 1) + "-" + id_year;

            if (!((tempDate.getYear() == IDNumber.substring(0, 2)) && (id_month == IDNumber.substring(2, 4) - 1) && (
                id_date == IDNumber.substring(4, 6)))) {
                error.append('<p>SA ID number does not appear to be authentic - date part not valid</p>');
                correct = false;
            }


            // if no error found, hide the error message
            if (correct) {
                error.css('display', 'none');


                //This adds the green checkmark
                document.getElementById("IDNumberDepDiv").classList.add('is-valid');
                document.getElementById("inputYearDepDiv").classList.add('is-valid');
                document.getElementById("inputMonthDepDiv").classList.add('is-valid');
                document.getElementById("inputDayDepDiv").classList.add('is-valid');

                // and put together a result message
                document.getElementById("inputYearDep").value += Y;
                document.getElementById("inputMonthDep").value += (id_month + 1);
                document.getElementById("inputDayDep").value += id_date;
            }
            // otherwise, show the error
            else {
                error.css('display', 'block');

                //This adds the green checkmark
                document.getElementById("IDNumberDepDiv").classList.add('is-invalid');
                document.getElementById("inputYearDepDiv").classList.add('is-invalid');
                document.getElementById("inputMonthDepDiv").classList.add('is-invalid');
                document.getElementById("inputDayDepDiv").classList.add('is-invalid');
            }

            return false;
        }

        function isNumber(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }
    </script>


    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    </script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('kt_aside_toggle');
            const asideElement = document.getElementById('kt_aside');

            toggleButton.addEventListener('click', function() {
                asideElement.classList.toggle('hidden');
            });
        });
    </script>


    {{-- Start Redirect Back Function --}}
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    {{-- End Redirect Back Function --}}

    <!--begin::Javascript-->

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <!-- ... Include all your other scripts here ... -->
    {{-- <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script> --}}
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <!-- ... Include all your other scripts here ... -->
    {{-- <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script> --}}
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.0.1/intro.min.js"></script>
    {{-- <script src="{{ asset('public/vendor/intro.js/intro.module.js') }}"></script> --}}
    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('assets/') }}";
        //introJs().start();
    </script>
        <!-- Include Intro.js JavaScript from CDN -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/intro.js/minified/intro.min.js"></script> --}}
    <script>
      function startTour() {
    //introJs().start();
      }
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.2.9') }}"></script>

    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->

    <script src="{{ asset('assets/js/custom/account/settings/deactivate-account.js') }}"></script>
    <script src="{{ asset('assets/js/custom/pages/user-profile/general.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>


<script>
$(document).ready(function() {
    // CSRF Token setup for jQuery AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Function to handle the deletion of notifications
    window.deleteNotification = function(notificationId, element) {
        $.ajax({
            url: '/notifications/' + notificationId,
            type: 'DELETE',
            success: function(response) {
                if (response.status === 'success') {
                    // Remove the notification element from the UI
                    $('#notification-' + notificationId).remove();
                    $(element).closest('.timeline-item').remove();

                    // Decrement the counter
                    let countElement = $('#unreadCount');
                    let currentCount = parseInt(countElement.text());
                    countElement.text(currentCount - 1);

                    let countElementLogs = $('#unreadCountLogs');
                    let currentCountLogs = parseInt(countElementLogs.text());
                    countElementLogs.text(currentCountLogs - 1);
                } else {
                    alert('Failed to delete notification');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting the notification', error);
            }
        });
    }
});
</script>

<script>
// JavaScript to add 'active' class based on current URL
//document.addEventListener("DOMContentLoaded", function() {
    //const links = document.querySelectorAll('.menu-link');
    //const currentLocation = window.location.href;

    //links.forEach(link => {
       // if (link.href === currentLocation) {
       //     link.classList.add('active');
       // }
    //})
//});

</script>

<script>
        $(document).ready(function() {
            $('.srchable').select2({
                width: '100%', // Ensures the width of the select matches container
                placeholder: 'Select Options', // Placeholder if needed
                allowClear: true // Allows clearing the selection
            });
        });
    </script>

    <!--end::Custom Javascript-->


 <script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#datetime-picker", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            altInput: true,
            altFormat: "F j, Y h:i K",
            time_24hr: false
        });
    });
</script>

<script>
        function changeTheme() {
            const theme = document.getElementById('themeSelect').value;
            document.getElementById('bootswatchCss').href = theme;
        }
    </script>

<script>
    $("#kt_datepicker_1").flatpickr();
    </script>

    <script>
    $("#kt_datepicker_3").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});
</script>

{{-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
  duration: 1200,
})
</script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#start_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                "locale": {
                    "firstDayOfWeek": 1 // start week on Monday
                }
            });

            flatpickr("#end_date", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                "locale": {
                    "firstDayOfWeek": 1 // start week on Monday
                }
            });

            flatpickr("#standard_endtime", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });

            flatpickr("#standard_starttime", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });

        });
    </script> --}}



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the current URL path
    var currentPath = window.location.pathname;

    // Get all menu links (both top-level and sub-menu)
    var menuLinks = document.querySelectorAll('.menu-link');

    // Loop through menu links
    menuLinks.forEach(function(link) {
        // Check if the href of the link matches the current path
        if (link.getAttribute('href') === currentPath) {
            // Add active class to the parent menu item
            var parentMenuItem = link.closest('.menu-item');
            parentMenuItem.classList.add('menu-item-active');

            // If the parent menu item has sub-menu items
            var subMenu = parentMenuItem.querySelector('.menu-sub');
            if (subMenu) {
                // Expand the sub-menu
                subMenu.style.display = 'block';
                // Add active class to the sub-menu item
                var subMenuItems = subMenu.querySelectorAll('.menu-link');
                subMenuItems.forEach(function(subLink) {
                    if (subLink.getAttribute('href') === currentPath) {
                        subLink.closest('.menu-item').classList.add('menu-item-active');
                    }
                });
            }
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var currentPath = window.location.pathname;
    
    // Function to open the menu and submenu items
    function openMenu(menuId, subMenuId) {
        var menu = document.getElementById(menuId);
        var subMenu = document.getElementById(subMenuId);
        if (menu && subMenu) {
            // Open the parent menu item
            menu.classList.add('menu-active');
            // Open the submenu item
            subMenu.style.display = 'block';
            subMenu.classList.add('menu-active');
        }
    }
    
    // Map current path to menu items
    if (currentPath.startsWith('/admin/user')) {
        openMenu('menu-admin-space', 'sub-menu-admin-space');
        document.getElementById('menu-users').classList.add('menu-active');
    } else if (currentPath.startsWith('/admin/role')) {
        openMenu('menu-admin-space', 'sub-menu-admin-space');
        document.getElementById('menu-roles').classList.add('menu-active');
    } else if (currentPath.startsWith('/admin/permission')) {
        openMenu('menu-admin-space', 'sub-menu-admin-space');
        document.getElementById('menu-permissions').classList.add('menu-active');
    } else if (currentPath.startsWith('/admin/employee') ||
               currentPath.startsWith('/admin/employeerole') ||
               currentPath.startsWith('/admin/jobdescriptions')) {
        openMenu('menu-admin-space', 'sub-menu-admin-space');
        openMenu('menu-employee-management', 'sub-menu-employee-management');
        
        if (currentPath.startsWith('/admin/employee')) {
            document.getElementById('menu-employees').classList.add('menu-active');
        } else if (currentPath.startsWith('/admin/employeerole')) {
            document.getElementById('menu-employeeroles').classList.add('menu-active');
        } else if (currentPath.startsWith('/admin/jobdescriptions')) {
            document.getElementById('menu-jobdescriptions').classList.add('menu-active');
        }
    }
});
</script>


@endpush
