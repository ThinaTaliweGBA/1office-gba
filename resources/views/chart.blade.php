@extends('layouts.app2')

@push('styles')
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
@endpush

@section('row_content')
    <!--begin::Row-->
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        <!--begin::Chart widget 22-->
        <div class="card h-xl-100">
            <!--begin::Header-->
            <div class="card-header position-relative py-0 border-bottom-2 mt-10" style="margin-left: auto; margin-right: auto; width: fit-content;">
                <!--begin::Subtitle-->
                <a><span class="nav-text fw-semibold fs-4 mb-3 fw-bold">Reports Data Overview</span></a>
                <!--end::Subtitle-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pb-3">
                <div>
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-wrap flex-md-nowrap">
                        <!--begin::Items-->
                        <div class="me-md-5 w-100">
                            <!--begin::Item-->
                            <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                <!--begin::Block-->
                                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-50px me-4">
                                        <span class="symbol-label">
                                            <i class="ki-duotone ki-timer fs-2qx text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Section-->
                                    <div class="me-2">
                                        <a href="/report"
                                            class="text-gray-800 text-hover-primary fs-6 fw-bold">Membership</a>
                                        <span class="text-gray-400 fw-bold d-block fs-7">Great, keep it up.</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Block-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <span class="text-dark fw-bolder fs-2x">73</span>
                                    <span class="fw-semibold fs-2 text-gray-600 mx-1 pt-1">/</span>
                                    <span class="text-gray-600 fw-semibold fs-2 me-3 pt-2">76</span>
                                    <span class="badge badge-lg badge-light-success align-self-center px-2">95%</span>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                <!--begin::Block-->
                                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-50px me-4">
                                        <span class="symbol-label">
                                            <i class="ki-duotone ki-element-11 fs-2qx text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Section-->
                                    <div class="me-2">
                                        <a href="/person" class="text-gray-800 text-hover-primary fs-6 fw-bold">Persons</a>
                                        <span class="text-gray-400 fw-bold d-block fs-7">Don’t forget to turn up</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Block-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <span class="text-dark fw-bolder fs-2x">207</span>
                                    <span class="fw-semibold fs-2 text-gray-600 mx-1 pt-1">/</span>
                                    <span class="text-gray-600 fw-semibold fs-2 me-3 pt-2">214</span>
                                    <span class="badge badge-lg badge-light-success align-self-center px-2">92%</span>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                <!--begin::Block-->
                                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-50px me-4">
                                        <span class="symbol-label">
                                            <i class="ki-duotone ki-abstract-24 fs-2qx text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Section-->
                                    <div class="me-2">
                                        <a href="reporting" class="text-gray-800 text-hover-primary fs-6 fw-bold">Real-Time
                                            Update</a>
                                        <span class="text-gray-400 fw-bold d-block fs-7">3 Available Visualizations</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Block-->
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <span class="text-dark fw-bolder fs-2x">27</span>
                                    <span class="fw-semibold fs-2 text-gray-600 mx-1 pt-1">/</span>
                                    <span class="text-gray-600 fw-semibold fs-2 me-3 pt-2">38</span>
                                    <span class="badge badge-lg badge-light-warning align-self-center px-2">80%</span>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Wrapper-->
                </div>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end::Chart widget 22-->
    </div>
    <!--end::Row-->
    {{-- begin::Card --}}
    <div class="card">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5" style=" text-align: center; ">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Graph Title</span>
                <span class="text-muted mt-1 fw-semibold fs-7"></span>
            </h3>
        </div>
        <!--end::Header-->
        <div class="px-4 pb-4 py-4">
            <!-- begin::Col-->
            <div class="col-12 col-xxl-12 col-md-12 mb-xxl-10">
                <!--begin::Mixed Widget 5-->
                <div class="card card-bordered">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                    <div class="card-body">
                        {{-- <canvas id="myChart2"></canvas> --}}
                    </div>
                </div>
                <!--end::Mixed Widget 5-->
                <form id="exportPdfForm" method="POST" action="{{ route('generate-pdf') }}">
                    @csrf
                    <input type="hidden" name="imgData" id="imgDataInput">
                    <x-button type="submit" id="exportPdfBtn" class="btn-danger hover-scale m-2" text="Export to PDF"></x-button>
                    <button type="submit" id="exportPdfBtn2" class="btn btn-danger hover-scale m-2">Export to
                        Excel</button>
                    <button type="submit" id="exportPdfBtn3" class="btn btn-danger hover-scale m-2">Export to
                        CSV</button>
                </form>
            </div>
            <!--end::Col-->
        </div>
    </div>
    {{-- end::Card --}}
    <!--begin::Row-->
    <div class="row g-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-4 mb-xl-3">
            <!--begin::Lists Widget 19-->
            <div class="card card-flush h-xl-100" id="myChart3">
                <!--begin::Heading-->
                <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px"
                    style="background-image:url('assets/media/svg/shapes/top-green.png" data-bs-theme="light">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column text-white pt-15">
                        <span class="fw-bold fs-2x mb-3">Stats Overview</span>
                        <div class="fs-4 text-white">
                            <span class="opacity-75">There are</span>
                            <span class="position-relative d-inline-block">
                                <a href="" class="link-white opacity-75-hover fw-bold d-block mb-1">4</a>
                                <!--begin::Separator-->
                                <span
                                    class="position-absolute opacity-50 bottom-0 start-0 border-2 border-body border-bottom w-100"></span>
                                <!--end::Separator-->
                            </span>
                            <span class="opacity-75"> major stats.</span>
                        </div>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar pt-5">
                        <!--begin::Menu-->
                        <button
                            class="btn btn-sm btn-icon btn-active-color-primary btn-color-white bg-white bg-opacity-25 bg-hover-opacity-100 bg-hover-white bg-active-opacity-25 w-20px h-20px"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                            data-kt-menu-overflow="true">
                            <i class="ki-duotone ki-dots-square fs-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </button>
                        <!--begin::Menu 2-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Filter Actions</div>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu separator-->
                            <div class="separator mb-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3">New Ticket</a>
                            </div>
                            <!--end::Menu item-->

                            <!--begin::Menu item-->
                            <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                data-kt-menu-placement="right-start">
                                <!--begin::Menu item-->
                                <a href="#" class="menu-link px-3">
                                    <span class="menu-title">New Group</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <!--end::Menu item-->
                                <!--begin::Menu sub-->
                                <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Admin Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Staff Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Member Group</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu sub-->
                            </div>
                            <!--end::Menu item-->

                            <!--begin::Menu separator-->
                            <div class="separator mt-3 opacity-75"></div>
                            <!--end::Menu separator-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <div class="menu-content px-3 py-3">
                                    <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                </div>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu 2-->
                        <!--end::Menu-->
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Heading-->
                <!--begin::Body-->
                <div class="card-body mt-n20">
                    <!--begin::Stats-->
                    <div class="mt-n20 position-relative">
                        <!--begin::Row-->
                        <div class="row g-3 g-lg-6">
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <i class="ki-duotone ki-flask fs-1 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">37</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">Total Rates</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <i class="ki-duotone ki-bank fs-1 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">6</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">All Members</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <i class="ki-duotone ki-award fs-1 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">4,7</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">Avgerage</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <i class="ki-duotone ki-timer fs-1 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">822</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">Modal Stat</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-30px me-5 mb-8">
                                        <span class="symbol-label">
                                            <i class="ki-duotone ki-timer fs-1 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">82</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-gray-500 fw-semibold fs-6">Modal Stat</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Lists Widget 19-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-8 mb-5 mb-xl-10">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <!--begin::Slider Widget 2-->
                    <div id="kt_sliders_widget_2_slider"
                        class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100"
                        data-bs-ride="carousel" data-bs-interval="5500">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h4 class="card-title d-flex align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Today’s Events</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-7">24 events on all activities</span>
                            </h4>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Carousel Indicators-->
                                <ol
                                    class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-success">
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="0"
                                        class="active ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="1" class="ms-1">
                                    </li>
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="2" class="ms-1">
                                    </li>
                                </ol>
                                <!--end::Carousel Indicators-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-6">
                            <!--begin::Carousel-->
                            <div class="carousel-inner">
                                <!--begin::Item-->
                                <div class="carousel-item active show">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center mb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-70px symbol-circle me-5">
                                            <span class="symbol-label bg-light-success">
                                                <i class="ki-duotone ki-abstract-24 fs-3x text-success">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="m-0">
                                            <!--begin::Subtitle-->
                                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                            <!--end::Subtitle-->
                                            <!--begin::Items-->
                                            <div class="d-flex d-grid gap-5">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>5 Topics</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>1 Speakers</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>60 Min</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>137 students</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Action-->
                                    <div class="m-0">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>
                                        <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="carousel-item">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center mb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-70px symbol-circle me-5">
                                            <span class="symbol-label bg-light-danger">
                                                <i class="ki-duotone ki-abstract-25 fs-3x text-danger">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="m-0">
                                            <!--begin::Subtitle-->
                                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                            <!--end::Subtitle-->
                                            <!--begin::Items-->
                                            <div class="d-flex d-grid gap-5">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>12 Topics</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>1 Speakers</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>50 Min</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>72 students</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Action-->
                                    <div class="m-0">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>
                                        <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="carousel-item">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center mb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-70px symbol-circle me-5">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-duotone ki-abstract-36 fs-3x text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="m-0">
                                            <!--begin::Subtitle-->
                                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                            <!--end::Subtitle-->
                                            <!--begin::Items-->
                                            <div class="d-flex d-grid gap-5">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>3 Topics</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>1 Speakers</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>50 Min</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>72 students</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Action-->
                                    <div class="m-0">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>
                                        <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Carousel-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Slider Widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <!--begin::Slider Widget 2-->
                    <div id="kt_sliders_widget_2_slider"
                        class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100"
                        data-bs-ride="carousel" data-bs-interval="5500">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h4 class="card-title d-flex align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Today’s Events</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-7">24 events on all activities</span>
                            </h4>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Carousel Indicators-->
                                <ol
                                    class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-success">
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="0"
                                        class="active ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="1" class="ms-1">
                                    </li>
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="2" class="ms-1">
                                    </li>
                                </ol>
                                <!--end::Carousel Indicators-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-6">
                            <!--begin::Carousel-->
                            <div class="carousel-inner">
                                <!--begin::Item-->
                                <div class="carousel-item active show">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center mb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-70px symbol-circle me-5">
                                            <span class="symbol-label bg-light-success">
                                                <i class="ki-duotone ki-abstract-24 fs-3x text-success">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="m-0">
                                            <!--begin::Subtitle-->
                                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                            <!--end::Subtitle-->
                                            <!--begin::Items-->
                                            <div class="d-flex d-grid gap-5">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>5 Topics</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>1 Speakers</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>60 Min</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>137 students</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Action-->
                                    <div class="m-0">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>
                                        <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="carousel-item">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center mb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-70px symbol-circle me-5">
                                            <span class="symbol-label bg-light-danger">
                                                <i class="ki-duotone ki-abstract-25 fs-3x text-danger">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="m-0">
                                            <!--begin::Subtitle-->
                                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                            <!--end::Subtitle-->
                                            <!--begin::Items-->
                                            <div class="d-flex d-grid gap-5">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>12 Topics</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>1 Speakers</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>50 Min</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>72 students</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Action-->
                                    <div class="m-0">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>
                                        <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="carousel-item">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center mb-9">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-70px symbol-circle me-5">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-duotone ki-abstract-36 fs-3x text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Info-->
                                        <div class="m-0">
                                            <!--begin::Subtitle-->
                                            <h4 class="fw-bold text-gray-800 mb-3">Ruby on Rails</h4>
                                            <!--end::Subtitle-->
                                            <!--begin::Items-->
                                            <div class="d-flex d-grid gap-5">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>3 Topics</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>1 Speakers</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-column flex-shrink-0">
                                                    <!--begin::Section-->
                                                    <span
                                                        class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>50 Min</span>
                                                    <!--end::Section-->
                                                    <!--begin::Section-->
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>72 students</span>
                                                    <!--end::Section-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Action-->
                                    <div class="m-0">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Details</a>
                                        <a href="#" class="btn btn-sm btn-success mb-2" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_create_campaign">Join Event</a>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Carousel-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Slider Widget 2-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            {{-- <div class="row g-5 g-xl-10">
                    <!--begin::Col-->
                    <div class="col-xl-12 mb-xl-10">
                        <!--begin::Slider Widget 1-->
                        <canvas id="myChart2"></canvas>
                        <!--end::Slider Widget 1-->
                    </div>
                    <!--end::Col-->
                </div> --}}
            <!--end::Row-->
            <div class="card">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Report: Membership Overview</span>
                    </h3>
                </div>
                <!--end::Header-->
                <div class="px-4 pb-4 py-4">
                    <!-- begin::Col-->
                    <div class="col-12 col-xxl-12 col-md-12 mb-xxl-10">
                        <!--begin::Mixed Widget 5-->
                        <div class="card card-bordered">
                            <div class="card-body">
                                <canvas id="myChart4"></canvas>
                            </div>
                        </div>
                        <!--end::Mixed Widget 5-->
                    </div>
                    <!--end::Col-->
                </div>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
@endsection

@push('scripts')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                datasets: [{
                        label: 'Dataset 1',
                        data: [10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65], // Sample data for Dataset 1
                        backgroundColor: 'rgba(255, 99, 132, 0.9)'
                    },
                    {
                        label: 'Dataset 2',
                        data: [20, 25, 15, 30, 20, 40, 30, 40, 30, 35, 25, 30], // Sample data for Dataset 2
                        backgroundColor: 'rgba(54, 162, 235, 0.9)'
                    },
                    {
                        label: 'Dataset 3',
                        data: [15, 20, 25, 20, 25, 30, 35, 30, 35, 40, 45, 50], // Sample data for Dataset 3
                        backgroundColor: 'rgba(255, 206, 86, 0.9)'
                    }
                ]
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> <!-- Include Axios for making HTTP requests -->

    <script>
        axios.get('/get-chart-data')
            .then(response => {
                const data = response.data;

                var ctx = document.getElementById('myChart2').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                            'September', 'October', 'November', 'December'
                        ],
                        datasets: [{
                                label: 'Dataset 1',
                                data: data.dataset1,
                                backgroundColor: 'rgb(0, 255, 0)'
                            },
                            {
                                label: 'Dataset 2',
                                data: data.dataset2,
                                backgroundColor: 'rgb(255, 0, 0)'
                            },
                            {
                                label: 'Dataset 3',
                                data: data.dataset3,
                                backgroundColor: 'rgb(0, 128, 255)'
                            }
                        ]
                    }
                });
            })
            .catch(error => {
                console.error("There was an error retrieving the data", error);
            });
    </script>

    <script>
        document.getElementById("exportPdfBtn").addEventListener("click", function(event) {
            event.preventDefault(); // prevent the form from submitting immediately

            html2canvas(document.querySelector("#myChart"), {
                scale: window.devicePixelRatio // Use the device's pixel ratio to get a clearer image
            }).then(canvas => {
                let img = canvas.toDataURL("image/png");
                document.getElementById("imgDataInput").value = img; // set the data URL to the hidden input
                document.getElementById("exportPdfForm").submit(); // manually submit the form
            });
        });
    </script>

    <script>
        document.getElementById("exportPdfBtn2").addEventListener("click", function(event) {
            event.preventDefault(); // prevent the form from submitting immediately

            html2canvas(document.querySelector("#myChart2"), {
                scale: window.devicePixelRatio // Use the device's pixel ratio to get a clearer image
            }).then(canvas => {
                let img = canvas.toDataURL("image/png");
                document.getElementById("imgDataInput").value = img; // set the data URL to the hidden input
                document.getElementById("exportPdfForm").submit(); // manually submit the form
            });
        });
    </script>

    <script>
        document.getElementById("exportPdfBtn3").addEventListener("click", function(event) {
            event.preventDefault(); // prevent the form from submitting immediately

            html2canvas(document.querySelector("#myChart3"), {
                scale: window.devicePixelRatio // Use the device's pixel ratio to get a clearer image
            }).then(canvas => {
                let img = canvas.toDataURL("image/png");
                document.getElementById("imgDataInput").value = img; // set the data URL to the hidden input
                document.getElementById("exportPdfForm2").submit(); // manually submit the form
            });
        });
    </script>

    <script>
        var ctx = document.getElementById('myChart4').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'pie', // or line, pie, etc.
            data: {
                labels: ['Age < 15', 'Age > 15 & Age < 20', 'Age > 20'], // This would be dynamic based on your data
                datasets: [{
                    label: 'Memberships',
                    data: [12, 19, 3], // This would be dynamic based on your data
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(255, 99, 132, 0.5)'
                    ]
                }],
            }
        });
    </script>
@endpush
