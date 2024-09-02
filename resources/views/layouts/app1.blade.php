@extends('layouts.master1')

@section('title', 'GBA System')

@push('styles')

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Stylesheets Bundle-->
    <link href="{{ asset("assets/plugins/custom/datatables/datatables.bundle.css") }}" rel="stylesheet" type="text/css"/>
    {{-- Start Testing Border --}}
    <style>
        .border-gba{
            border: 1px solid forestgreen;
            border-radius: 10px;
        }
        .border-gba-light{
            border: 1px solid rgba(0, 146, 63, 0.21);
            border-radius: 10px;
        }
        .bg-gba{
            background-color: #00923f;
        }
        .bg-gba:hover {
            background-color: #00732d; /* Darker shade for hover effect */
        }
        .bg-gba-light{
            background-color: rgba(0, 146, 63, 0.21);
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
    </style>
    {{-- End Toggle Button Transition --}}
    
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
    <i class="ki-outline ki-double-right fs-1 rotate-180" style="font-size: 24px;"></i>
    </div>


    <div id="kt_aside" class="aside pt-7 pb-4 pb-lg-7 pt-lg-17 hidden" data-kt-drawer="true" data-kt-drawer-name="aside"
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
            <x-aside.profile name="{{ ucfirst(Auth::user()->name) }}" profileLink="{{ route('admin.account.info') }}"
                             profileImg="{{ asset('assets/media/avatars/blank.png') }}"
                             description="{{ ucfirst(Auth::user()->email) }}"
                             class="additional-css-classes"/>

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
                                        menu-icon="ki-duotone ki-home-2 fs-2"
                                        :menu-items="[
                            ['url' => '/add-member', 'title' => __('messages.New Membership')],
                            ['url' => '/memberships', 'title' => __('messages.All Memberships')],
                        ]"/>
                    <!--end:Menu item-->

                    <!--begin:Menu item-->
                    <x-aside.aside-menu :menu-title="__('messages.Dependants')"
                                        :menu-icon="'ki-duotone ki-abstract-26 fs-2'"
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
                        <x-aside.aside-menu :menu-title="__('messages.Admin Space')"
                                            :menu-icon="'ki-duotone ki-briefcase fs-2'" :menu-items="[
                            ['url' => '/admin/user', 'title' => __('messages.Users')],
                            ['url' => '/admin/role', 'title' => __('messages.Roles')],
                            ['url' => '/admin/permission', 'title' => __('messages.Permissions')],
                        ]"/>
                        <!--end:Menu item-->

                        <!--begin:Menu item-->
                        {{-- <x-aside.aside-menu :menu-title="__('messages.sales_commission')" :menu-icon="'ki-duotone ki-tag'" :menu-items="[
                            ['url' => '/sales', 'title' => __('messages.sales')],
                            ['url' => '/commission/create', 'title' => __('messages.commissions')],
                        ]" /> --}}
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <x-aside.aside-menu :menu-title="__('messages.interfaces')"
                                            :menu-icon="'ki-duotone ki-technology-4'" :menu-items="[
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
                        <x-aside.aside-menu menu-title="{{ __('Payments') }}" menu-icon="ki-duotone ki-home-2 fs-2"
                                            :menu-items="[
                            {{-- ['url' => '/add-member', 'title' => __('messages.New Membership')], --}}
                            ['url' => '/payments', 'title' => __('Make Payments')],
                {{--                            ['url' => '/cash', 'title' => __('Cash')],--}}
                {{--                            ['url' => '/dataVia', 'title' => __('Data Via')],--}}
                {{--                            ['url' => '/DebitOrder', 'title' => __('Debit Order')],--}}
                        ]"/>
                        <!--end:Menu item-->
                        <!--begin:Menu item-->
                        <x-aside.aside-menu :menu-title="__('Funeral')" :menu-icon="'ki-duotone ki-chart-line-up'"
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
                                            :menu-icon="'ki-duotone ki-chart-line-up'" :menu-items="[
                            {{-- ['url' => '/chart', 'title' => __('messages.dashboard')], --}}
                            {{-- ['url' => '/report', 'title' => __('messages.membership')], --}}
                            {{-- ['url' => '/person', 'title' => __('messages.persons')], --}}
                            {{-- ['url' => '/reports', 'title' => __('All Reports')], --}}
                            ['url' => '/pivotGrid', 'title' => __('Grid')],
                            {{-- ['url' => '/pivotScroll', 'title' => __('Scroll')], --}}
                            {{-- ['url' => '/pivotTables', 'title' => __('Table')], --}}
                            {{-- ['url' => '/reporting', 'title' => __('messages.real_time_updates')], --}}
                        ]"/>
                        <!--end:Menu item-->
                    @endcanany
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
@endsection

@section('header')
    <div id="kt_header" class="header border-gba-light mx-auto bg-gba-light my-4 p-0">
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
                    <div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline w-40px h-40px bg-gba-light"
                         id="kt_activities_toggle">
                        <i class="ki-duotone ki-notification-bing fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>
                    </div>
                    <!--end::Drawer toggle-->
                </div>
                <!--end::Activities-->
                <!--begin::Theme mode-->
                <div class="d-flex align-items-center ms-3 ms-lg-">
                    <!--begin::Menu toggle-->
                    <a href="#"
                       class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline w-40px h-40px bg-gba-light"
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
                    <!--begin::Drawer toggle-->
                    <div class="btn btn-icon btn-color-gray-700 btn-active-color-primary btn-outline w-40px h-40px bg-gba-light"><a
                                href="/logout"><i class="ki-duotone ki-exit-left fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i></a>
                    </div>
                    <!--end::Drawer toggle-->
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

                @yield('row_content')

            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
@endsection


@push('scripts')
<script src="{{ asset("assets/plugins/custom/datatables/datatables.bundle.js") }}" type="text/javascript"></script>
@endpush
