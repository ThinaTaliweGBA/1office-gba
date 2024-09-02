@extends('layouts.master')
@section('title', 'GBA System')

 @push('styles')
{{--<script>
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

</script> --}}

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    {{-- <link href="{{ asset('css/dynamic_styles.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/intro.js/minified/introjs.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- Start Styling for the header breadcrum --}}
<style>
/* Target the page-title container */
.page-title {
    /* Other styles for .page-title can be placed here if needed */
}

/* Specific styling for breadcrumb links */
.page-title a {
    color: #007bbf; /* Default link color */
    text-decoration: none; /* Optional: removes underline from links */
    transition: color 0.3s; /* Smooth transition for color change */
}

/* Hover state for breadcrumb links */
.page-title a:hover {
    color: #aa56b3; /* Color when hovered */
    
}
</style>
{{-- End Styling for the header breadcrum --}}


    {{--START Siya: Google auto-complete always on top --}}
    <style>
        .pac-container {
            z-index: 10000 !important; /* Ensure this value is higher than the modal's z-index */
        }
    </style>
    {{--END Siya: Google auto-complete always on top --}}

            <!-- Google maps auto-complete form -->
            {{-- <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1KOXQsWQgBsFdgoKlPAa38CS0nTzAmM&libraries=places&callback=initAutocomplete">
            </script> --}}
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAF1KOXQsWQgBsFdgoKlPAa38CS0nTzAmM&libraries=places" async defer></script>
    
        {{--Start: Trying a modularized version of Google maps auto-complete --}}
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

@endpush

@section('themeMode')
    <x-theme.theme-mode/>
@endsection

@section('aside')

    {{-- Start SidePanel Toggle Button --}}
    {{-- <div id="toggleDrawerButton" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle me-n2"
        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
        data-kt-toggle-name="aside-minimize" style="padding: 10px; font-size: 24px; position: fixed; top: 50%; transform: translateY(-50%);">
        <i class="ki-outline ki-double-left fs-1 rotate-180" style="font-size: 24px;"></i>
    </div> --}}
    {{-- End SidePanel Toggle Button --}}
    <div id="toggleDrawerButton" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle me-n2"
    data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
    data-kt-toggle-name="aside-minimize" style="padding: 10px; font-size: 24px; position: fixed; top: 50%; left: 0; transform: translateY(-50%);">
    <i class="ki-outline ki-double-right fs-1 rotate-180" style="font-size: 34px;"></i>
    </div>


    <div id="kt_aside" class="aside pt-7 pb-4 pb-lg-7 pt-lg-17 hidden shadow" data-kt-drawer="true" data-kt-drawer-name="aside"
         data-kt-drawer-activate="{default: true, lg: true}" data-kt-drawer-overlay="true"
         data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
         data-kt-drawer-toggle="#kt_aside_toggle">
        <!--begin::Brand-->
        <div class="d-flex justify-content-center p-4 mb-10">
            <a href="{{ route('home') }}">
                {{-- <h1 class="text-center">{{ __('messages.GBASystem') }}</h1> --}}
                <a href="/">
                    <img alt="Logo" src="{{ asset('img/GBA-LOGO-white.png') }}" class="h-90px logo theme-light-show">
                    <img alt="Logo" src="{{ asset('img/GBA-LOGO-white.png') }}" class="h-90px logo theme-dark-show">
                </a>
            </a>
        </div>
        <!--end::Brand-->

        <!--begin::Aside user-->
        <div class="aside-user mb-5 mb-lg-10 p-6" id="kt_aside_user">
            <!--begin::User-->
        @auth
            <x-aside.profile name="{{ ucfirst(Auth::user()->name) }}"
                            profileLink="{{ route('admin.account.info') }}"
                            profileImg="{{ asset('assets/media/avatars/blank.png') }}"
                            description="{{ ucfirst(Auth::user()->email) }}"
                            class="additional-css-classes"/>
            <!--end::User-->
        @else
            <script>window.location.href = "{{ route('login') }}";</script>
        @endauth


            <!--end::User-->
        </div>
        <!--end::Aside user-->

        <!--begin::Aside menu-->
        <div class="aside-menu flex-column-fluid ps-3 ps-lg-5 pe-1 mb-9" id="kt_aside_menu">
            <!--begin::Aside Menu-->
            <div class="w-100 hover-scroll-y pe-2 me-2" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                 data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                 data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_user, #kt_aside_footer"
                 data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper" data-kt-scroll-offset="0">
                <!--begin::Menu-->
                <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold" id="#kt_aside_menu"
                     data-kt-menu="true">
                    <!--begin:Menu item-->
                    <x-aside.aside-menu menu-title="{{ __('messages.Memberships') }}"
                                        menu-icon="bi bi-person-rolodex"
                                        :menu-items="[
                            ['url' => '/add-member', 'title' => __('messages.New Membership')],
                            ['url' => '/memberships', 'title' => __('messages.All Memberships')],
                        ]"/>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <x-aside.aside-menu :menu-title="__('messages.Dependants')"
                                        :menu-icon="'bi bi-people-fill'"
                                        :menu-items="[['url' => '/dependants', 'title' => __('messages.AllDependants')]]"/>
                    <!--end:Menu item-->
                    @canany(['user edit', 'role edit', 'permission edit'])
                        <!--begin:Menu item-->
                        {{-- <x-aside.aside-menu :menu-title="__('Lede Reporting')" :menu-icon="'ki-duotone ki-chart-line-up'" :menu-items="[
                            ['url' => '/member/profile', 'title' => __('Profiles Report')],
                            ['url' => '/member/status', 'title' => __('Status Report')],
                            ['url' => '/member/demographic', 'title' => __('Demographics Report')],
                            ['url' => '/member/geographic', 'title' => __('Geographic Distribution Report')],
                            ['url' => '/member/financial', 'title' => __('Financial Reports')],
                            [
                                'url' => '/member/growth-retention',
                                'title' => __('Membership Growth and Retention Reports'),
                            ],
                            ['url' => '/member/insurance-claims', 'title' => __('Insurance and Claims Report')],
                            ['url' => '/member/communication', 'title' => __('Communication Preferences Report')],
                            ['url' => '/member/audit', 'title' => __('Audit and Data Integrity Reports')],
                            ['url' => '/member/lifecycle', 'title' => __('Membership Lifecycle Reports')],
                        ]" /> --}}
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        {{-- <x-aside.aside-menu :menu-title="__('messages.Admin Space')"
                                            :menu-icon="'bi bi-briefcase'" :menu-items="[
                            ['url' => '/admin/user', 'title' => __('messages.Users')],
                            ['url' => '/admin/role', 'title' => __('messages.Roles')],
                            ['url' => '/admin/permission', 'title' => __('messages.Permissions')],
                            ['url' => '/admin/employee', 'title' => __('Employee Management'), 'sub-items' => [
                                ['url' => '/admin/employee/add', 'title' => __('Add Employee')],
                                ['url' => '/admin/employee/view', 'title' => __('View Employees')]
                            ]],
                        ]"/> --}}
                        <!--end:Menu item-->


    <div data-kt-menu-trigger="click" class="menu-item menu-accordion hover"><!--begin:Menu link--><span
            class="menu-link"><span class="menu-icon"><i class="bi bi-briefcase fs-2"><span
                        class="path1"></span><span class="path2"></span></i></span><span
                class="menu-title">Admin Space</span><span
                class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion" kt-hidden-height="97" style=""><!--begin:Menu item-->
        <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                            href="/admin/user"><span class="menu-bullet"><span
                                    class="bullet bullet-dot"></span></span><span
                                class="menu-title">Users</span></a><!--end:Menu link--></div>
                                <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                            href="/admin/role"><span class="menu-bullet"><span
                                    class="bullet bullet-dot"></span></span><span
                                class="menu-title">Roles</span></a><!--end:Menu link--></div>
                                <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                            href="/admin/permission"><span class="menu-bullet"><span
                                    class="bullet bullet-dot"></span></span><span
                                class="menu-title">Permissions</span></a><!--end:Menu link--></div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion"><!--begin:Menu link--><span
                    class="menu-link"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span
                        class="menu-title">Employee Management</span><span
                        class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                <div class="menu-sub menu-sub-accordion menu-active-bg"><!--begin:Menu item-->
                <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                            href="/admin/employee"><span class="menu-bullet"><span
                                    class="bullet bullet-dot"></span></span><span
                                class="menu-title">Employees</span></a><!--end:Menu link--></div>
                    <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                            href="/admin/employeerole"><span class="menu-bullet"><span
                                    class="bullet bullet-dot"></span></span><span
                                class="menu-title"> Employee Roles</span></a><!--end:Menu link--></div>
                    <!--end:Menu item--><!--begin:Menu item-->
                    <div class="menu-item"><!--begin:Menu link--><a class="menu-link"
                            href="/admin/jobdescriptions"><span class="menu-bullet"><span
                                    class="bullet bullet-dot"></span></span><span
                                class="menu-title">Job Descriptions</span></a><!--end:Menu link--></div>
                    <!--end:Menu item--><!--end:Menu item-->
                </div><!--end:Menu sub-->
            </div><!--end:Menu item-->
        </div><!--end:Menu sub-->
    </div>






                        <!--begin:Menu item-->
                        {{-- <x-aside.aside-menu :menu-title="__('messages.sales_commission')" :menu-icon="'ki-duotone ki-tag'" :menu-items="[
                            ['url' => '/sales', 'title' => __('messages.sales')],
                            ['url' => '/commission/create', 'title' => __('messages.commissions')],
                        ]" /> --}}
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <x-aside.aside-menu :menu-title="__('messages.interfaces')"
                                            :menu-icon="'bi bi-gear-wide-connected'" :menu-items="[
                            ['url' => '/resolutionhub', 'title' => __('Resolution Hub')],
                            {{-- ['url' => '/fixer', 'title' => __('messages.sanitizer')], --}}
                            {{-- ['url' => '/mapper', 'title' => __('messages.mapping')], --}}
                            {{-- ['url' => '/class', 'title' => __('Classifications')], --}}
                            {{-- ['url' => '/logs', 'title' => __('messages.logs')], --}}
                            {{-- ['url' => '/logs', 'title' => __('Drag and Drop 1')],
                            ['url' => '/logs2', 'title' => __('Drag and Drop 2')], --}}
                        ]"/>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <x-aside.aside-menu menu-title="{{ __('Payments') }}" menu-icon="bi bi-wallet2"
                                            :menu-items="[
                            {{-- ['url' => '/add-member', 'title' => __('messages.New Membership')], --}}
                            ['url' => '/payments', 'title' => __('Make Payments')],
                {{--                            ['url' => '/cash', 'title' => __('Cash')],--}}
                {{--                            ['url' => '/dataVia', 'title' => __('Data Via')],--}}
                {{--                            ['url' => '/DebitOrder', 'title' => __('Debit Order')],--}}
                        ]"/>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <x-aside.aside-menu :menu-title="__('Funeral')" :menu-icon="'bi bi-device-ssd'"
                                            :menu-items="[
                            {{-- ['url' => '/chart', 'title' => __('messages.dashboard')], --}}
                            {{-- ['url' => '/report', 'title' => __('messages.membership')], --}}
                            {{-- ['url' => '/person', 'title' => __('messages.persons')], --}}
                            {{-- ['url' => '/reports', 'title' => __('All Reports')], --}}
                            ['url' => '/deaths', 'title' => __('Deaths')],
                            ['url' => '/funerals', 'title' => __('Funerals')],
                            {{-- ['url' => '/reporting', 'title' => __('messages.real_time_updates')], --}}
                        ]"/>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <x-aside.aside-menu :menu-title="__('messages.Reporting')"
                                            :menu-icon="'bi bi-clipboard-data'" :menu-items="[
                            {{-- ['url' => '/chart', 'title' => __('messages.dashboard')], --}}
                            {{-- ['url' => '/report', 'title' => __('messages.membership')], --}}
                            {{-- ['url' => '/person', 'title' => __('messages.persons')], --}}
                            {{-- ['url' => '/reports', 'title' => __('All Reports')], --}}
                            ['url' => '/report', 'title' => __('Memberships')],
                            ['url' => '/api/rowdetails', 'title' => __('Debit Orders')],
                            {{-- ['url' => '/pivotScroll', 'title' => __('Scroll')], --}}
                            {{-- ['url' => '/pivotTables', 'title' => __('Table')], --}}
                            {{-- ['url' => '/reporting', 'title' => __('messages.real_time_updates')], --}}
                        ]"/>
                        <!--end:Menu item-->
                    @endcanany
                    {{-- <div id="google_translate_element" class="text-center mt-4">Language:</div> --}}
                    <!--begin:Menu item-->
                    {{-- <x-aside.aside-menu :menu-title="__('messages.More')" :menu-icon="'ki-duotone ki-abstract-35 fs-2'" :menu-items="[ --}}
                    {{-- ['url' => '/testingview', 'title' => __('messages.Developments')], --}}
                    {{-- ['url' => '/whatsapp', 'title' => __('WhatsApp')], --}}
                    {{-- ['url' => '/contact', 'title' => __('messages.Find Us')], --}}
                    {{-- ['url' => '/settings', 'title' => __('messages.Customize')], --}}
                    {{-- ]" /> --}}
                    <!--end:Menu item-->































                </div>
                <!--end::Menu-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside menu-->

        <!--begin::Footer-->
        <div class="aside-footer flex-column-auto px-6 px-lg-9 pb-16" id="kt_aside_footer">
            <!--begin::User panel-->
            <div class="d-flex flex-stack ms-7">
                <!--begin::Link-->
                <x-aside.click-icon link="/logout" class="additional-classes" text="{{ __('messages.LogOut') }}"
                                    icon="ki-duotone ki-entrance-left"/>
                <!--end::Link-->
                <!--begin::User menu-->
                <x-aside.footer-menu :items="[
                    ['url' => '/admin/edit-account-info', 'title' => __('messages.profile')],
                    ['url' => '/', 'title' => __('messages.Dependants'), 'badge' => '3'],
                    ['url' => '/', 'title' => __('messages.Memberships')],
                    
                ]" classes="additional-classes"/>
                
                <!--end::User menu-->
            </div>
            <!--end::User panel-->
        </div>
        <!--end::Footer-->
    </div>
    {{-- <div id="google_translate_element"></div> --}}
@endsection

@section('header')
    <div id="kt_header" class="header border-gba-light mx-auto bg-gba-light my-4 p-0 shadow">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-center flex-wrap justify-content-between"
             id="kt_header_container">


            {{-- Start SidePanel Toggle Button --}}
            {{-- <div id="toggleDrawerButton" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle me-n2"
                 data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                 data-kt-toggle-name="aside-minimize" style="padding: 10px; font-size: 24px;">
                <i class="ki-outline ki-double-left fs-1 rotate-180" style="font-size: 24px;"></i></div> --}}
            {{-- Start SidePanel Toggle Button --}}


            <!--begin::Page title-->
            <x-header.page-title title="Current Dashboard" subtitle="current page" class="additional-classes"/>
            <!--end::Page title=-->

            <!--begin::Solid input group style-->
            <div class="input-group input-group-solid flex-nowrap mx-2" style="width: 170px;">
                <div class="overflow-hidden flex-grow-1">
                    <form action="{{ route('direction.switch') }}" method="POST" class="w-100">
                        @csrf
                        <select name="direction" class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select a direction" onchange="this.form.submit();">
                            <option value="ltr" {{ session('appdirection') == 'ltr' ? 'selected' : '' }}>LTR</option>
                            <option value="rtl" {{ session('appdirection') == 'rtl' ? 'selected' : '' }}>RTL</option>
                        </select>
                    </form>
                </div>
            </div>
            <!-- end::Solid input group style-->

            @canany(['user edit', 'role edit', 'permission edit'])
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
            @endcanany

            <!--begin::Solid input group style-->
            <div class="input-group input-group-solid mx-2" style="width: 190px; font-size: 0.8rem;">
                <div class="overflow-hidden flex-grow-1">
                    <form action="{{ route('language.switch') }}" method="POST" class="w-100">
                        @csrf
                        <select name="language" class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Select a Language" onchange="this.form.submit();"
                                style="background-color: #e2e2e2 !important;">
                            <option value="en" {{ session('applocale') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="af" {{ session('applocale') == 'af' ? 'selected' : '' }}>Afrikaans</option>
                        </select>
                    </form>
                </div>
            </div>
            <!--end::Solid input group style-->

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


                    <div class="btn btn-icon btn-active-color-primary btn-outline w-40px h-40px bg-light"
                        id="kt_activities_toggle">
                        <!-- Notification Icon -->
                        <i class="ki-duotone ki-notification-bing" style="font-size: 34px; color: #646c9a;">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
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
                    <a href="#" class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline w-40px h-40px bg-gba-light border border-dark"
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
                                <span class="menu-title">{{ __('messages.Light') }}</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3 my-0">
                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
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
                <div class="d-flex align-items-center ms-3 ms-lg-4">
    <!--begin::Logout Form-->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <button class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline w-40px h-40px bg-light  border border-dark" onclick="document.getElementById('logout-form').submit();">
        <i class="bi bi-power" style="font-size: 28px; color: red;"></i>
    </button>
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
        <div class="footer container-fluid d-flex flex-column flex-md-row flex-stack bg-gba mx-auto" id="kt_footer">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <a href="/home" target="_blank" class="text-black text-hover-primary fw-semibold me-1 fs-4"></a>
            </div>
            <!--end::Copyright-->

            <!--begin::Menu-->
            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                {{-- <li class="menu-item">
                    <a href="{{ route('user-settings') }}" target="_blank"
                       class="menu-link px-2">{{ __('messages.Contacts') }}</a>
                </li> --}}

                <a href="/contact" target="_blank" class="pt-2 text-black text-hover-primary fw-semibold me-1 fs-4">Contacts</a>
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
                    {{-- <h3 class="card-title fw-bold text-dark">Activity Logs : <span class="badge badge-danger fs-3"><span id="unreadCountLogs">{{ auth()->user()->unreadNotifications->count() }}</span> :  Unread Notifications.</span></h3> --}}
                    <h3 class="card-title fw-bold text-dark">Activity Logs : <span class="badge badge-danger fs-3"><span id="unreadCountLogs">{{ auth()->user()->unreadNotifications->count() }}</span> :  Unread Notifications.</span></h3>
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
                            <div class="timeline">
                                <div id="unreadNotificationsBadge" class="mb-3">
                                
                            </div>
                        
                        {{-- @dump(auth()->user()->unreadNotifications) --}}
                        @foreach(auth()->user()->notifications as $notification)
                            <!-- Notification Badge for Unread Notifications -->

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
                            <div class="timeline-content mb-10 mt-n2">
                                <!--begin::Timeline heading-->
                                <div class="overflow-auto pe-3">
                                    <!--begin::Title-->
                                    {{-- <div class="fs-5 fw-semibold mb-2">{{ $notification->data['message'] }} <button onclick="deleteNotification('{{ $notification->id }}', this)" class="badge badge-sm bg-danger" style="cursor: pointer;">clear</button></div> --}}
                                    <div class="fs-5 fw-semibold mb-2">{{ $notification->data['message'] }}<button onclick="deleteNotification('{{ $notification->id }}', this)" class="badge badge-sm bg-danger" style="cursor: pointer;">clear</button></div>
                                    {{-- <div class="fs-5 fw-semibold mb-2"></div> --}}
                                    <!--end::Title-->
                                    <!--begin::Description-->
                                    <div class="d-flex align-items-center mt-1 fs-6">
                                        <!--begin::Info-->
                                        {{-- <div class="me-2 fs-7 text-gray-700">{{ $notification->created_at }}</div> --}}
                                        <!--end::Info-->
                                        <!--begin::User-->
                                        <div class="symbol symbol-circle symbol-25px" data-bs-toggle="tooltip"
                                            data-bs-boundary="window" data-bs-placement="top" title="{{Auth::user()->email}} ">
                                            <!--begin::User-->
                                            <span>{{ $notification->data['action'] }}  <span class="me-2 fs-7 text-gray-700">{{ $notification->created_at->diffForHumans() }} </span> by </span><a href="#" class="text-primary fw-bold me-1">{{Auth::user()->name}}</a>
                                            {{-- <span> by </span><a href="#" class="text-primary fw-bold me-1"></a> --}}
                                            {{-- <!--end::User--> --}}                                          
                                        </div>
                                        <!--end::User-->
                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Timeline heading-->
                            </div>
                            <!--end::Timeline content-->
                        </div>
                        @endforeach
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
                                            <a href="#" class="text-primary fw-bold me-1">#12345</a>has been allocated to you
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
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline items-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="card-footer py-5 text-center" id="kt_activities_footer">
                    <a href="#" class="btn btn-bg-body text-primary">End Of Activities.
                    </a>
                </div>
                <!--end::Footer-->
            </div>
        </div>
        <!--end::Activities drawer-->
@endsection

@section('drawer')
@endsection

@push('scripts')
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

    <script>
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

    </script>

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
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
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
    <script>
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
    </script>

    {{-- This is for the member form - Test --}}
    <script>
        function getDOB(IDNumber) {

            // first clear any left over error messages
            $('#error span').remove();

            //This clears the red x mark
            document.getElementById("IDNumber").classList.remove('is-invalid');
            document.getElementById("inputYearDiv").classList.remove('is-invalid');
            document.getElementById("inputMonthDiv").classList.remove('is-invalid');
            document.getElementById("inputDayDiv").classList.remove('is-invalid');

            //This clears the green checkmark
            document.getElementById("IDNumber").classList.remove('is-valid');
            document.getElementById("inputYearDiv").classList.remove('is-valid');
            document.getElementById("inputMonthDiv").classList.remove('is-valid');
            document.getElementById("inputDayDiv").classList.remove('is-valid');


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
                error.append('<p>SA ID number not valid</p>');
                correct = false;
            }


            // if no error found, hide the error message
            if (correct) {
                error.css('display', 'none');


                //This adds the green checkmark
                document.getElementById("IDNumber").classList.add('is-valid');
                document.getElementById("inputYearDiv").classList.add('is-valid');
                document.getElementById("inputMonthDiv").classList.add('is-valid');
                document.getElementById("inputDayDiv").classList.add('is-valid');

                // and put together a result message
                document.getElementById("inputYear").value += Y;
                document.getElementById("inputMonth").value += (id_month + 1);
                document.getElementById("inputDay").value += id_date;
            }
            // otherwise, show the error
            else {
                error.css('display', 'block');

                //This adds the green checkmark
                document.getElementById("IDNumber").classList.add('is-invalid');
                document.getElementById("inputYearDiv").classList.add('is-invalid');
                document.getElementById("inputMonthDiv").classList.add('is-invalid');
                document.getElementById("inputDayDiv").classList.add('is-invalid');
            }

            return false;


        }

        function isNumber(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
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
                placeholder: 'Select Membership Type', // Placeholder if needed
                allowClear: true // Allows clearing the selection
            });
        });
    </script>

    <!--end::Custom Javascript-->
@endpush
