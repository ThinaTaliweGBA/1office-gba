@extends('layouts.app2')

@push('styles')
<link rel="stylesheet" href="public/css/jkanban.min.css">
@endpush

@section('row_content')
    <x-button type="button" id="kt_docs_sweetalert_basic" class="btn-primary" text="Toggle SweetAlert"></x-button>
    
    <div id="kt_docs_jkanban_basic"></div>

    <!--begin::Col-->
    <div class="col-xxl-4 col-md-4 mb-xxl-10">

        <!--begin::List Widget 4-->

        <div class="input-group mb-5">
            <div class="autocomplete" style="width:300px;">
                <input id="myInput" type="text" name="myCurrency" placeholder="Enter Currency" class="form-control"
                    aria-label="Enter Country" aria-describedby="basic-addon2">
            </div>
        </div>

        <!--end::List Widget 4-->
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-xxl-8 col-md-8 mb-xxl-10">
        <!--begin::Tables Widget 9-->

        <!--begin::Input group-->
        <div class="input-group mb-5">
            <div class="autocomplete" style="width:300px;">
                <input id="myInput2" type="text" name="myCountry" placeholder="Enter Country" class="form-control"
                    aria-label="Enter Country" aria-describedby="basic-addon2">
            </div>
        </div>
        <!--end::Input group-->
        <!--Make sure the form has the autocomplete function switched off:-->


        <!--end::Tables Widget 9-->
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-xxl-8 col-md-8 mb-xxl-10">
        <!--begin::App settings toggle-->
        <x-button type="button" text="Customize" id="kt_app_layout_builder_toggle" class="btn btn-info app-layout-builder-toggle lh-1 py-4"
            data-bs-custom-class="tooltip-inverse" data-bs-placement="left" data-bs-dismiss="click" data-bs-trigger="hover"
            data-bs-original-title="Metronic Builder" data-kt-initialized="1">
            <i class="ki-outline ki-setting-4 fs-4 me-1"></i> Customize
        </x-button>
        <!--end::App settings toggle-->


        <!--begin::App settings Side Menue-->
        <div id="kt_app_layout_builder" class="bg-body drawer drawer-end" data-kt-drawer="true"
            data-kt-drawer-name="app-settings" data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
            data-kt-drawer-width="{default:'300px', 'lg': '380px'}" data-kt-drawer-direction="end"
            data-kt-drawer-toggle="#kt_app_layout_builder_toggle" data-kt-drawer-close="#kt_app_layout_builder_close"
            style="width: 300px !important;">

            <!--begin::Card-->
            <div class="card border-0 shadow-none rounded-0 w-100">
                <!--begin::Card header-->
                <div class="card-header bgi-position-y-bottom bgi-position-x-end bgi-size-cover bgi-no-repeat rounded-0 border-0 py-4"
                    id="kt_app_layout_builder_header"
                    style="background-image:url('/public/img/cust/customizer-header-bg.jpg')">

                    <!--begin::Card title-->
                    <h3 class="card-title fs-3 fw-bold text-white flex-column m-0">
                        Metronic Builder

                        <small class="text-white opacity-50 fs-7 fw-semibold pt-1">
                            Get your product deeply customized
                        </small>
                    </h3>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-sm btn-icon btn-color-white p-0 w-20px h-20px rounded-1"
                            id="kt_app_layout_builder_close">
                            <i class="ki-outline ki-cross-square fs-2"></i> </button>
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body position-relative" id="kt_app_layout_builder_body">
                    <!--begin::Content-->
                    <div id="kt_app_settings_content" class="position-relative scroll-y me-n5 pe-5" data-kt-scroll="true"
                        data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_app_layout_builder_body"
                        data-kt-scroll-dependencies="#kt_app_layout_builder_header, #kt_app_layout_builder_footer"
                        data-kt-scroll-offset="5px" style="height: 778px;">

                        <!--begin::Form-->
                        <form class="form" method="POST" id="kt_app_layout_builder_form"
                            action="/metronic8/demo25/index.php">
                            <input type="hidden" id="kt_app_layout_builder_action" name="layout-builder[action]">

                            <!--begin::Card body-->
                            <div class="card-body p-0">

                                <!--begin::Form group-->
                                <div class="form-group">
                                    <!--begin::Heading-->
                                    <div class="mb-6">
                                        <h4 class="fw-bold text-dark">Theme Mode</h4>
                                        <div class="fw-semibold text-muted fs-7 d-block lh-1">
                                            Enjoy Dark &amp; Light modes.

                                            <a class="fw-semibold" href="#" target="_blank">See docs</a>
                                        </div>
                                    </div>
                                    <!--end::Heading-->

                                    <!--begin::Options-->
                                    <div class="row " data-kt-buttons="true"
                                        data-kt-buttons-target=".form-check-image,.form-check-input"
                                        data-kt-initialized="1">
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <!--begin::Option-->
                                            <label class="form-check-image form-check-success">
                                                <!--begin::Image-->
                                                <div class="form-check-wrapper border-gray-200 border-2">
                                                    <img src="{{ asset('img/cust/light-ltr.png') }}"
                                                        class="form-check-rounded mw-100" alt="">
                                                </div>
                                                <!--end::Image-->

                                                <!--begin::Check-->
                                                <div
                                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-success">
                                                    <input class="form-check-input" type="radio" value="light"
                                                        name="theme_mode" id="kt_layout_builder_theme_mode_light">

                                                    <!--begin::Label-->
                                                    <div class="form-check-label text-gray-700">
                                                        Light </div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Check-->
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-6">
                                            <!--begin::Option-->
                                            <label class="form-check-image form-check-success active">
                                                <!--begin::Image-->
                                                <div class="form-check-wrapper border-gray-200 border-2">
                                                    <img src="{{ asset('img/cust/dark-ltr.png') }}"
                                                        class="form-check-rounded mw-100" alt="">
                                                </div>
                                                <!--end::Image-->

                                                <!--begin::Check-->
                                                <div
                                                    class="form-check form-check-custom form-check-solid form-check-sm form-check-success">
                                                    <input class="form-check-input" type="radio" value="dark"
                                                        name="theme_mode" id="kt_layout_builder_theme_mode_dark">

                                                    <!--begin::Label-->
                                                    <div class="form-check-label text-gray-700">
                                                        Dark </div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Check-->
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Col-->

                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Form group-->
                                <div class="separator separator-dashed my-5"></div>

                                <!--begin::Form group-->
                                <div class="form-group d-flex flex-stack">
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-column">
                                        <h4 class="fw-bold text-dark">RTL Mode</h4>
                                        <div class="fs-7 fw-semibold text-muted">
                                            Change Language Direction.

                                            <a class="fw-semibold"
                                                href="https://preview.keenthemes.com/html/metronic/docs/getting-started/rtl"
                                                target="_blank">See docs</a>
                                        </div>
                                    </div>
                                    <!--end::Heading-->

                                    <!--begin::Option-->
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Check-->
                                        <div
                                            class="form-check form-check-custom form-check-solid form-check-success form-switch">
                                            <input type="hidden" value="false"
                                                name="layout-builder[layout][app][general][rtl]">

                                            <input class="form-check-input w-45px h-30px" type="checkbox" value="true"
                                                name="layout-builder[layout][app][general][rtl]">
                                        </div>
                                        <!--end::Check-->
                                    </div>
                                    <!--end::Option-->
                                </div>
                                <!--end::Form group-->
                                <div class="separator separator-dashed my-5"></div>


                                <!--begin::Form group-->
                                <div class="form-group ">
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-column mb-4">
                                        <h4 class="fw-bold text-dark">Width Mode</h4>
                                        <div class="fs-7 fw-semibold text-muted">Page width options</div>
                                    </div>
                                    <!--end::Heading-->

                                    <!--begin::Options-->
                                    <div class="d-flex gap-7">
                                        <!--begin::Check-->
                                        <div
                                            class="form-check form-check-custom form-check-success form-check-solid form-check-sm">
                                            <input class="form-check-input" type="radio" checked=""
                                                value="default" id="kt_layout_builder_page_width_default"
                                                name="layout-builder[layout][app][general][page-width]">

                                            <!--begin::Label-->
                                            <label class="form-check-label text-gray-700 fw-bold text-nowrap"
                                                for="kt_layout_builder_page_width_default">
                                                Default </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Check-->
                                        <!--begin::Check-->
                                        <div
                                            class="form-check form-check-custom form-check-success form-check-solid form-check-sm">
                                            <input class="form-check-input" type="radio" value="fluid"
                                                id="kt_layout_builder_page_width_fluid"
                                                name="layout-builder[layout][app][general][page-width]">

                                            <!--begin::Label-->
                                            <label class="form-check-label text-gray-700 fw-bold text-nowrap"
                                                for="kt_layout_builder_page_width_fluid">
                                                Fluid </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Check-->
                                        <!--begin::Check-->
                                        <div
                                            class="form-check form-check-custom form-check-success form-check-solid form-check-sm">
                                            <input class="form-check-input" type="radio" value="fixed"
                                                id="kt_layout_builder_page_width_fixed"
                                                name="layout-builder[layout][app][general][page-width]">

                                            <!--begin::Label-->
                                            <label class="form-check-label text-gray-700 fw-bold text-nowrap"
                                                for="kt_layout_builder_page_width_fixed">
                                                Fixed </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Check-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Form group-->
                                <div class="separator separator-dashed my-5"></div>


                                <!--begin::Form group-->
                                <div class="form-group ">
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-column mb-4">
                                        <h4 class="fw-bold text-dark">KeenIcons Style</h4>

                                        <div>
                                            <span class="fs-7 fw-semibold text-muted">Select global UI icons style.</span>
                                            <a class="fw-semibold"
                                                href="https://preview.keenthemes.com/html/metronic/docs/icons/keenicons"
                                                target="_blank">Learn more</a>
                                        </div>
                                    </div>
                                    <!--end::Heading-->

                                    <!--begin::Options-->
                                    <div class="d-flex flex-stack gap-3 " data-kt-buttons="true"
                                        data-kt-buttons-target=".form-check-image,.form-check-input"
                                        data-kt-initialized="1">

                                        <!--begin::Option-->
                                        <label
                                            class="form-check-image form-check-success w-100 parent-active parent-hover ">
                                            <!--begin::Image-->
                                            <div
                                                class="form-check-wrapper d-flex flex-center border-gray-200 border-2 mb-0 py-3 px-4">
                                                <i
                                                    class="ki-duotone ki-picture fs-1 text-gray-500 parent-active-gray-700 parent-hover-gray-700"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                                <span
                                                    class="fs-7 fw-semibold ms-2 text-gray-500 parent-active-gray-700 parent-hover-gray-700">Duotone</span>
                                            </div>
                                            <!--end::Image-->

                                            <!--begin::Check-->
                                            <div
                                                style="visibility: hidden; height: 0 !important; width: 0 !important; overflow:hidden">
                                                <input class="form-check-input" type="radio" value="duotone"
                                                    name="layout-builder[layout][app][general][icons]">
                                            </div>
                                            <!--end::Check-->
                                        </label>
                                        <!--end::Option-->

                                        <!--begin::Option-->
                                        <label
                                            class="form-check-image form-check-success w-100 parent-active parent-hover active">
                                            <!--begin::Image-->
                                            <div
                                                class="form-check-wrapper d-flex flex-center border-gray-200 border-2 mb-0 py-3 px-4">
                                                <i
                                                    class="ki-outline ki-picture fs-1 text-gray-500 parent-active-gray-700 parent-hover-gray-700"></i>
                                                <span
                                                    class="fs-7 fw-semibold ms-2 text-gray-500 parent-active-gray-700 parent-hover-gray-700">Outline</span>
                                            </div>
                                            <!--end::Image-->

                                            <!--begin::Check-->
                                            <div
                                                style="visibility: hidden; height: 0 !important; width: 0 !important; overflow:hidden">
                                                <input class="form-check-input" type="radio" value="outline"
                                                    checked="" name="layout-builder[layout][app][general][icons]">
                                            </div>
                                            <!--end::Check-->
                                        </label>
                                        <!--end::Option-->

                                        <!--begin::Option-->
                                        <label
                                            class="form-check-image form-check-success w-100 parent-active parent-hover ">
                                            <!--begin::Image-->
                                            <div
                                                class="form-check-wrapper d-flex flex-center border-gray-200 border-2 mb-0 py-3 px-4">
                                                <i
                                                    class="ki-solid ki-picture fs-1 text-gray-500 parent-active-gray-700 parent-hover-gray-700"></i>
                                                <span
                                                    class="fs-7 fw-semibold ms-2 text-gray-500 parent-active-gray-700 parent-hover-gray-700">Solid</span>
                                            </div>
                                            <!--end::Image-->

                                            <!--begin::Check-->
                                            <div
                                                style="visibility: hidden; height: 0 !important; width: 0 !important; overflow:hidden">
                                                <input class="form-check-input" type="radio" value="solid"
                                                    name="layout-builder[layout][app][general][icons]">
                                            </div>
                                            <!--end::Check-->
                                        </label>
                                        <!--end::Option-->

                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Form group-->
                                <div class="separator separator-dashed my-5"></div>


                                <!--begin::Form group-->
                                <div class="form-group d-flex flex-stack">
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-column">
                                        <h4 class="fw-bold text-dark">Aside</h4>
                                        <div class="fs-7 fw-semibold text-muted">
                                            Display aside penel.

                                            <a href="/metronic8/demo25/../demo25/layout-builder.html"
                                                class="fw-semibold text-primary">
                                                More layout options
                                            </a>
                                        </div>
                                    </div>
                                    <!--end::Heading-->

                                    <!--begin::Option-->
                                    <div class="d-flex justify-content-end">
                                        <!--begin::Check-->
                                        <div
                                            class="form-check form-check-solid form-check-custom form-check-success form-switch">
                                            <input type="hidden" value="false"
                                                name="layout-builder[layout][app][aside][display]">
                                            <input class="form-check-input w-45px h-30px" type="checkbox" checked=""
                                                value="true" name="layout-builder[layout][app][aside][display]"
                                                id="kt_builder_aside">

                                            <!--begin::Label-->
                                            <label class="form-check-label" for="kt_builder_aside"></label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Check-->
                                    </div>
                                    <!--end::Option-->
                                </div>
                                <!--end::Form group-->

                            </div>
                            <!--end::Card body-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Card body-->

                <!--begin::Card footer-->
                <div class="card-footer border-0 d-flex gap-3 pb-9 pt-0" id="kt_app_layout_builder_footer">
                    <button type="button" id="kt_app_layout_builder_preview"
                        class="btn btn-primary flex-grow-1 fw-semibold">

                        <!--begin::Indicator label-->
                        <span class="indicator-label">
                            Preview</span>
                        <!--end::Indicator label-->

                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!--end::Indicator progress--> </button>

                    <button type="button" id="kt_app_layout_builder_reset"
                        class="btn btn-light flex-grow-1 fw-semibold">

                        <!--begin::Indicator label-->
                        <span class="indicator-label">
                            Reset</span>
                        <!--end::Indicator label-->

                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        <!--end::Indicator progress--> </button>
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--begin::App settings Side Menue-->
    </div>
    <!--end::Col-->

    <div id="kt_content_container">
        <!--begin::Layout Builder Notice-->
        <div class="card mb-10">
            <div class="card-body d-flex align-items-center p-5 p-lg-8">
                <!--begin::Icon-->
                <div
                    class="d-flex h-50px w-50px h-lg-80px w-lg-80px flex-shrink-0 flex-center position-relative align-self-start align-self-lg-center mt-3 mt-lg-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="text-primary h-75px w-75px h-lg-100px w-lg-100px position-absolute opacity-5">
                        <path fill="currentColor"
                            d="M10.2,21.23,4.91,18.17a3.58,3.58,0,0,1-1.8-3.11V8.94a3.58,3.58,0,0,1,1.8-3.11L10.2,2.77a3.62,3.62,0,0,1,3.6,0l5.29,3.06a3.58,3.58,0,0,1,1.8,3.11v6.12a3.58,3.58,0,0,1-1.8,3.11L13.8,21.23A3.62,3.62,0,0,1,10.2,21.23Z">
                        </path>
                    </svg>

                    <i class="ki-duotone ki-wrench fs-2x fs-lg-3x text-primary position-absolute"><span
                            class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Icon-->

                <!--begin::Description-->
                <div class="ms-6">
                    <p class="list-unstyled text-gray-600 fw-semibold fs-6 p-0 m-0">
                        The layout builder is to assist your set and configure your preferred project layout specifications
                        and
                        preview it in real time and export the HTML template with its includable partials of this demo.
                    </p>
                </div>
                <!--end::Description-->
            </div>
        </div>
        <!--end::Layout Builder Notice-->

        <!--begin::Layout Builder Modal-->
        <div class="modal fade" id="kt_layout_builder_recaptcha_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">reCaptcha Verification</h3>
                        <button class="btn btn-sm btn-icon btn-light btn-hover-primary" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki ki-close fs-4 text-muted"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form">
                            <div class="form-group">
                                <script src="https://www.google.com/recaptcha/api.js"></script>
                                <div class="g-recaptcha" data-sitekey="6Lf92jMUAAAAANk8wz68r73rA2uPGr4_e0gn96BL">
                                    <div style="width: 304px; height: 78px;">
                                        <div><iframe title="reCAPTCHA"
                                                src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6Lf92jMUAAAAANk8wz68r73rA2uPGr4_e0gn96BL&amp;co=aHR0cHM6Ly9wcmV2aWV3LmtlZW50aGVtZXMuY29tOjQ0Mw..&amp;hl=en&amp;v=SglpK98hSCn2CroR0bKRSJl5&amp;size=normal&amp;cb=r7yzbn1t4w12"
                                                width="304" height="78" role="presentation" name="a-97r1u0q9w2zk"
                                                frameborder="0" scrolling="no"
                                                sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe>
                                        </div>
                                        <textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response"
                                            style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                    </div><iframe style="display: none;"></iframe>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary  me-2"
                            id="kt_layout_builder_verify">Submit</button>
                        <button type="button" class="btn btn-hover-light btn-text-muted fw-semibold"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Layout Builder Modal-->

        <!--begin::Card-->
        <div class="card">
            <!--begin::Header-->
            <div class="card-header card-header-stretch overflow-auto">
                <!--begin::Tabs-->
                <ul class="nav nav-stretch nav-line-tabs fw-semibold fs-6 border-transparent flex-nowrap" role="tablist"
                    id="kt_layout_builder_tabs">

                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#kt_layout_builder_main" role="tab"
                            aria-selected="true">
                            Main </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#kt_layout_builder_header" role="tab"
                            aria-selected="false" tabindex="-1">
                            Header </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#kt_layout_builder_content" role="tab"
                            aria-selected="false" tabindex="-1">
                            Content </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#kt_layout_builder_footer" role="tab"
                            aria-selected="false" tabindex="-1">
                            Footer </a>
                    </li>
                </ul>
                <!--end::Tabs-->
            </div>
            <!--end::Header-->

            <!--begin::Form-->
            <form class="form" method="POST" id="kt_layout_builder_form" action="/metronic8/demo15/index.php">
                <!--begin::Body-->
                <div class="card-body">
                    <div class="tab-content pt-3">

                        <!--begin::Tab pane-->
                        <div class="tab-pane active show" id="kt_layout_builder_main" role="tabpanel">

                            <!--begin::Form group-->
                            <div class="form-group">
                                <!--begin::Heading-->
                                <div class="mb-6">
                                    <h4 class="fw-bold text-dark">Theme Mode</h4>
                                    <div class="fw-semibold text-muted fs-7 d-block lh-1">
                                        Enjoy Dark &amp; Light modes.

                                        <a class="fw-semibold"
                                            href="https://preview.keenthemes.com/html/metronic/docs/getting-started/dark-mode"
                                            target="_blank">See docs</a>
                                    </div>
                                </div>
                                <!--end::Heading-->

                                <!--begin::Options-->
                                <div class="row mw-lg-600px" data-kt-buttons="true"
                                    data-kt-buttons-target=".form-check-image,.form-check-input" data-kt-initialized="1">
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Option-->
                                        <label class="form-check-image form-check-success">
                                            <!--begin::Image-->
                                            <div class="form-check-wrapper border-gray-200 border-2">
                                                <img src="{{ asset('img/cust/light-ltr.png') }}"
                                                    class="form-check-rounded mw-100" alt="">
                                            </div>
                                            <!--end::Image-->

                                            <!--begin::Check-->
                                            <div
                                                class="form-check form-check-custom form-check-solid form-check-sm form-check-success">
                                                <input class="form-check-input" type="radio" value="light"
                                                    name="theme_mode" id="kt_layout_builder_theme_mode_light">

                                                <!--begin::Label-->
                                                <div class="form-check-label text-gray-700">
                                                    Light </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Check-->
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-6">
                                        <!--begin::Option-->
                                        <label class="form-check-image form-check-success active">
                                            <!--begin::Image-->
                                            <div class="form-check-wrapper border-gray-200 border-2">
                                                <img src="{{ asset('img/cust/dark-ltr.png') }}"
                                                    class="form-check-rounded mw-100" alt="">
                                            </div>
                                            <!--end::Image-->

                                            <!--begin::Check-->
                                            <div class="form-check form-check-custom form-check-solid form-check-sm form-check-success">
                                                <input class="form-check-input" type="radio" value="dark"
                                                    name="theme_mode" id="kt_layout_builder_theme_mode_dark">

                                                <!--begin::Label-->
                                                <div class="form-check-label text-gray-700">
                                                    Dark </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Check-->
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <!--end::Options-->
                            </div>
                            <!--end::Form group-->
                            <div class="separator separator-dashed my-6"></div>

                            <!--begin::Form group-->
                            <div class="form-group d-flex flex-stack">
                                <!--begin::Heading-->
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold text-dark">RTL Mode</h4>
                                    <div class="fs-7 fw-semibold text-muted">
                                        Change Language Direction.

                                        <a class="fw-semibold"
                                            href="https://preview.keenthemes.com/html/metronic/docs/getting-started/rtl"
                                            target="_blank">See docs</a>
                                    </div>
                                </div>
                                <!--end::Heading-->

                                <!--begin::Option-->
                                <div class="d-flex justify-content-end">
                                    <!--begin::Check-->
                                    <div
                                        class="form-check form-check-custom form-check-solid form-check-success form-switch">
                                        <input type="hidden" value="false"
                                            name="layout-builder[layout][app][general][rtl]">

                                        <input class="form-check-input w-45px h-30px" type="checkbox" value="true"
                                            name="layout-builder[layout][app][general][rtl]">
                                    </div>
                                    <!--end::Check-->
                                </div>
                                <!--end::Option-->
                            </div>
                            <!--end::Form group-->

                            <div class="separator separator-dashed my-6"></div>


                            <!--begin::Form group-->
                            <div class="form-group d-flex flex-stack">
                                <!--begin::Heading-->
                                <div class="d-flex flex-column ">
                                    <h4 class="fw-bold text-dark">KeenIcons Style</h4>

                                    <div>
                                        <span class="fs-7 fw-semibold text-muted">Select global UI icons style.</span>
                                        <a class="fw-semibold"
                                            href="https://preview.keenthemes.com/html/metronic/docs/icons/keenicons"
                                            target="_blank">Learn more</a>
                                    </div>
                                </div>
                                <!--end::Heading-->

                                <!--begin::Options-->
                                <div class="d-flex flex-stack gap-3 mw-lg-600px" data-kt-buttons="true"
                                    data-kt-buttons-target=".form-check-image,.form-check-input" data-kt-initialized="1">

                                    <!--begin::Option-->
                                    <label
                                        class="form-check-image form-check-success w-100 parent-active parent-hover active">
                                        <!--begin::Image-->
                                        <div
                                            class="form-check-wrapper d-flex flex-center border-gray-200 border-2 mb-0 py-3 px-4">
                                            <i
                                                class="ki-duotone ki-picture fs-1 text-gray-500 parent-active-gray-700 parent-hover-gray-700"><span
                                                    class="path1"></span><span class="path2"></span></i>
                                            <span
                                                class="fs-7 fw-semibold ms-2 text-gray-500 parent-active-gray-700 parent-hover-gray-700">Duotone</span>
                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Check-->
                                        <div
                                            style="visibility: hidden; height: 0 !important; width: 0 !important; overflow:hidden">
                                            <input class="form-check-input" type="radio" value="duotone"
                                                checked="" name="layout-builder[layout][app][general][icons]">
                                        </div>
                                        <!--end::Check-->
                                    </label>
                                    <!--end::Option-->

                                    <!--begin::Option-->
                                    <label class="form-check-image form-check-success w-100 parent-active parent-hover ">
                                        <!--begin::Image-->
                                        <div
                                            class="form-check-wrapper d-flex flex-center border-gray-200 border-2 mb-0 py-3 px-4">
                                            <i
                                                class="ki-outline ki-picture fs-1 text-gray-500 parent-active-gray-700 parent-hover-gray-700"></i>
                                            <span
                                                class="fs-7 fw-semibold ms-2 text-gray-500 parent-active-gray-700 parent-hover-gray-700">Outline</span>
                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Check-->
                                        <div
                                            style="visibility: hidden; height: 0 !important; width: 0 !important; overflow:hidden">
                                            <input class="form-check-input" type="radio" value="outline"
                                                name="layout-builder[layout][app][general][icons]">
                                        </div>
                                        <!--end::Check-->
                                    </label>
                                    <!--end::Option-->

                                    <!--begin::Option-->
                                    <label class="form-check-image form-check-success w-100 parent-active parent-hover ">
                                        <!--begin::Image-->
                                        <div
                                            class="form-check-wrapper d-flex flex-center border-gray-200 border-2 mb-0 py-3 px-4">
                                            <i
                                                class="ki-solid ki-picture fs-1 text-gray-500 parent-active-gray-700 parent-hover-gray-700"></i>
                                            <span
                                                class="fs-7 fw-semibold ms-2 text-gray-500 parent-active-gray-700 parent-hover-gray-700">Solid</span>
                                        </div>
                                        <!--end::Image-->

                                        <!--begin::Check-->
                                        <div
                                            style="visibility: hidden; height: 0 !important; width: 0 !important; overflow:hidden">
                                            <input class="form-check-input" type="radio" value="solid"
                                                name="layout-builder[layout][app][general][icons]">
                                        </div>
                                        <!--end::Check-->
                                    </label>
                                    <!--end::Option-->

                                </div>
                                <!--end::Options-->
                            </div>
                            <!--end::Form group-->
                            <div class="separator separator-dashed my-6"></div>

                            <!--begin::Form group-->
                            <div class="form-group d-flex flex-stack">
                                <!--begin::Heading-->
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold text-dark">Page Loader</h4>
                                    <div class="fs-7 fw-semibold text-muted">Display page loading indicator</div>
                                </div>
                                <!--end::Heading-->

                                <!--begin::Option-->
                                <div class="d-flex justify-content-end gap-7">
                                    <!--begin::Check-->
                                    <div
                                        class="form-check form-check-custom form-check-success form-check-solid form-check-sm">
                                        <input class="form-check-input" type="radio" checked="" value="none"
                                            id="kt_builder_page_loader_type_none"
                                            name="layout-builder[layout][app][page-loader][type]">

                                        <!--begin::Label-->
                                        <label class="form-check-label text-gray-700 fw-bold text-nowrap"
                                            for="kt_builder_page_loader_type_none">
                                            None </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Check-->
                                    <!--begin::Check-->
                                    <div
                                        class="form-check form-check-custom form-check-success form-check-solid form-check-sm">
                                        <input class="form-check-input" type="radio" value="default"
                                            id="kt_builder_page_loader_type_default"
                                            name="layout-builder[layout][app][page-loader][type]">

                                        <!--begin::Label-->
                                        <label class="form-check-label text-gray-700 fw-bold text-nowrap"
                                            for="kt_builder_page_loader_type_default">
                                            Default </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Check-->
                                    <!--begin::Check-->
                                    <div
                                        class="form-check form-check-custom form-check-success form-check-solid form-check-sm">
                                        <input class="form-check-input" type="radio" value="spinner-message"
                                            id="kt_builder_page_loader_type_spinner-message"
                                            name="layout-builder[layout][app][page-loader][type]">

                                        <!--begin::Label-->
                                        <label class="form-check-label text-gray-700 fw-bold text-nowrap"
                                            for="kt_builder_page_loader_type_spinner-message">
                                            Message </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Check-->
                                    <!--begin::Check-->
                                    <div
                                        class="form-check form-check-custom form-check-success form-check-solid form-check-sm">
                                        <input class="form-check-input" type="radio" value="spinner-logo"
                                            id="kt_builder_page_loader_type_spinner-logo"
                                            name="layout-builder[layout][app][page-loader][type]">

                                        <!--begin::Label-->
                                        <label class="form-check-label text-gray-700 fw-bold text-nowrap"
                                            for="kt_builder_page_loader_type_spinner-logo">
                                            Logo </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Check-->
                                </div>
                                <!--end::Option-->
                            </div>
                            <!--end::Form group-->
                        </div>
                        <!--end::Tab pane-->

                        <!--begin::Tab pane-->
                        <div class="tab-pane" id="kt_layout_builder_header" role="tabpanel">
                            <div class="row mb-10">
                                <label class="col-lg-3 col-form-label text-lg-end">Fixed Header:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <input type="hidden" name="layout-builder[layout][header][fixed][desktop]"
                                        value="false">
                                    <input type="hidden" name="layout-builder[layout][header][fixed][tablet-and-mobile]"
                                        value="false">

                                    <label class="form-check form-check-custom form-check-solid form-switch mb-5">
                                        <input class="form-check-input" type="checkbox"
                                            name="layout-builder[layout][header][fixed][desktop]" value="true">
                                        <span class="form-check-label text-muted">Desktop</span>
                                    </label>

                                    <label class="form-check form-check-custom form-check-solid form-switch mb-3">
                                        <input class="form-check-input" type="checkbox"
                                            name="layout-builder[layout][header][fixed][tablet-and-mobile]"
                                            value="true">
                                        <span class="form-check-label text-muted">Tablet &amp; Mobile</span>
                                    </label>

                                    <div class="form-text text-muted">Enable fixed header</div>
                                </div>
                            </div>

                            <div class="row mb-10">
                                <label class="col-lg-3 col-form-label text-lg-end">Width:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-select form-select-solid select2-hidden-accessible"
                                        name="layout-builder[layout][header][width]" data-control="select2"
                                        data-hide-search="true" data-select2-id="select2-data-7-k61v" tabindex="-1"
                                        aria-hidden="true" data-kt-initialized="1">
                                        <option value="fluid" selected="" data-select2-id="select2-data-9-kws5">Fluid
                                        </option>
                                        <option value="fixed">Fixed</option>
                                    </select><span class="select2 select2-container select2-container--bootstrap5"
                                        dir="ltr" data-select2-id="select2-data-8-mq32" style="width: 100%;"><span
                                            class="selection"><span
                                                class="select2-selection select2-selection--single form-select form-select-solid"
                                                role="combobox" aria-haspopup="true" aria-expanded="false"
                                                tabindex="0" aria-disabled="false"
                                                aria-labelledby="select2-layout-builderlayoutheaderwidth-ez-container"
                                                aria-controls="select2-layout-builderlayoutheaderwidth-ez-container"><span
                                                    class="select2-selection__rendered"
                                                    id="select2-layout-builderlayoutheaderwidth-ez-container"
                                                    role="textbox" aria-readonly="true" title="Fluid">Fluid</span><span
                                                    class="select2-selection__arrow" role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    <div class="form-text text-muted">Select header width type.</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Tab pane-->

                        <!--begin::Tab pane-->
                        <div class="tab-pane" id="kt_layout_builder_content" role="tabpanel">
                            <div class="row mb-10">
                                <label class="col-lg-3 col-form-label text-lg-end">Width:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-select form-select-solid select2-hidden-accessible"
                                        name="layout-builder[layout][content][width]" data-control="select2"
                                        data-hide-search="true" data-select2-id="select2-data-10-kqxl" tabindex="-1"
                                        aria-hidden="true" data-kt-initialized="1">
                                        <option value="fluid" selected="" data-select2-id="select2-data-12-149g">
                                            Fluid</option>
                                        <option value="fixed">Fixed</option>
                                    </select><span class="select2 select2-container select2-container--bootstrap5"
                                        dir="ltr" data-select2-id="select2-data-11-pdgl" style="width: 100%;"><span
                                            class="selection"><span
                                                class="select2-selection select2-selection--single form-select form-select-solid"
                                                role="combobox" aria-haspopup="true" aria-expanded="false"
                                                tabindex="0" aria-disabled="false"
                                                aria-labelledby="select2-layout-builderlayoutcontentwidth-zz-container"
                                                aria-controls="select2-layout-builderlayoutcontentwidth-zz-container"><span
                                                    class="select2-selection__rendered"
                                                    id="select2-layout-builderlayoutcontentwidth-zz-container"
                                                    role="textbox" aria-readonly="true" title="Fluid">Fluid</span><span
                                                    class="select2-selection__arrow" role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    <div class="form-text text-muted">Select content layout width type.</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Tab pane-->

                        <!--begin::Tab pane-->
                        <div class="tab-pane" id="kt_layout_builder_footer" role="tabpanel">
                            <div class="row mb-10">
                                <label class="col-lg-3 col-form-label text-lg-end">Width:</label>
                                <div class="col-lg-9 col-xl-4">
                                    <select class="form-select form-select-solid select2-hidden-accessible"
                                        name="layout-builder[layout][footer][width]" data-control="select2"
                                        data-hide-search="true" data-select2-id="select2-data-13-3mvm" tabindex="-1"
                                        aria-hidden="true" data-kt-initialized="1">
                                        <option value="fluid" selected="" data-select2-id="select2-data-15-5sio">
                                            Fluid</option>
                                        <option value="fixed">Fixed</option>
                                    </select><span class="select2 select2-container select2-container--bootstrap5"
                                        dir="ltr" data-select2-id="select2-data-14-f2o7" style="width: 100%;"><span
                                            class="selection"><span
                                                class="select2-selection select2-selection--single form-select form-select-solid"
                                                role="combobox" aria-haspopup="true" aria-expanded="false"
                                                tabindex="0" aria-disabled="false"
                                                aria-labelledby="select2-layout-builderlayoutfooterwidth-ws-container"
                                                aria-controls="select2-layout-builderlayoutfooterwidth-ws-container"><span
                                                    class="select2-selection__rendered"
                                                    id="select2-layout-builderlayoutfooterwidth-ws-container"
                                                    role="textbox" aria-readonly="true" title="Fluid">Fluid</span><span
                                                    class="select2-selection__arrow" role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    <div class="form-text text-muted">Select footer layout width type.</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Tab pane-->
                    </div>
                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="card-footer d-flex py-8">
                    <input type="hidden" id="kt_layout_builder_tab" name="layout-builder[tab]"
                        value="kt_layout_builder_main">
                    <input type="hidden" id="kt_layout_builder_action" name="layout-builder[action]">

                    <button type="button" id="kt_layout_builder_preview" class="btn btn-primary me-2">
                        <span class="indicator-label">
                            Preview
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>


                    <button type="button" id="kt_layout_builder_export" class="btn btn-light me-2">
                        <span class="indicator-label">
                            Export
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>

                    <button type="button" id="kt_layout_builder_reset" class="btn btn-active-light btn-color-muted">
                        <span class="indicator-label">
                            Reset
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>

@endsection

@push('scripts')
<script src="public/js/jkanban.min.js"></script>

    <script>
        function autocomplete(inp, arr, defaults) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
                // Append default values at the end
                for (i = 0; i < defaults.length; i++) {
                    b = document.createElement("DIV");
                    b.innerHTML = "<strong>" + defaults[i] + "</strong>";
                    b.innerHTML += "<input type='hidden' value='" + defaults[i] + "'>";
                    b.addEventListener("click", function(e) {
                        inp.value = this.getElementsByTagName("input")[0].value;
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }

        /*An array containing all the country names in the world:*/
        var countries = ["Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Anguilla", "Antigua & Barbuda",
            "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh",
            "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia & Herzegovina",
            "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia",
            "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central Arfrican Republic", "Chad", "Chile", "China",
            "Colombia", "Congo", "Cook Islands", "Costa Rica", "Cote D Ivoire", "Croatia", "Cuba", "Curacao", "Cyprus",
            "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt",
            "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands",
            "Fiji", "Finland", "France", "French Polynesia", "French West Indies", "Gabon", "Gambia", "Georgia",
            "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guam", "Guatemala", "Guernsey",
            "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India",
            "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey",
            "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon",
            "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia",
            "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania",
            "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco",
            "Mozambique", "Myanmar", "Namibia", "Nauro", "Nepal", "Netherlands", "Netherlands Antilles",
            "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "North Korea", "Norway", "Oman",
            "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland",
            "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russia", "Rwanda", "Saint Pierre & Miquelon",
            "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles",
            "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",
            "South Korea", "South Sudan", "Spain", "Sri Lanka", "St Kitts & Nevis", "St Lucia", "St Vincent", "Sudan",
            "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand",
            "Timor L'Este", "Togo", "Tonga", "Trinidad & Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks & Caicos",
            "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States of America",
            "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Virgin Islands (US)", "Yemen",
            "Zambia", "Zimbabwe"
        ];
        var defaultCountries = ["Unknown", "Undefined"];

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("myInput2"), countries, defaultCountries);

        /*An array containing all the currency names in the world:*/
        var currencies = ["United States dollar", "Euro", "Japanese yen", "Pound sterling", "Australian dollar",
            "Canadian dollar", "Swiss franc", "Renminbi", "Swedish krona", "New Zealand dollar", "Mexican peso",
            "Singapore dollar", "Hong Kong dollar", "Norwegian krone", "South Korean won", "Turkish lira",
            "Russian ruble", "Indian rupee", "Brazilian real", "South African rand", "Danish krone", "Polish złoty",
            "New Taiwan dollar", "Thai baht", "Indonesian rupiah", "Hungarian forint", "Czech koruna",
            "Israeli new shekel", "Chilean peso", "Philippine peso", "UAE dirham", "Colombian peso", "Saudi riyal",
            "Malaysian ringgit", "Romanian leu", "Icelandic króna", "Bulgarian lev", "Croatian kuna", "Jordanian dinar",
            "Peruvian sol", "Serbian dinar", "Kuwaiti dinar", "Uruguayan peso"
        ];
        var defaultCurrencies = ["Unknown", "Undefined"];

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("myInput"), currencies, defaultCurrencies);
    </script>

    <script>
        const button = document.getElementById('kt_docs_sweetalert_basic');

        button.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Here's a basic example of SweetAlert!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        });
    </script>

    <script>
        // Class definition
        var KTJKanbanDemoBasic = function() {
            // Private functions
            var exampleBasic = function() {
                var kanban = new jKanban({
                    element: '#kt_docs_jkanban_basic',
                    gutter: '0',
                    widthBoard: '250px',
                    boards: [{
                        'id': '_inprocess',
                        'title': 'In Process',
                        'item': [{
                                'title': '<span class="fw-bold">You can drag me too</span>'
                            },
                            {
                                'title': '<span class="fw-bold">Buy Milk</span>'
                            }
                        ]
                    }, {
                        'id': '_working',
                        'title': 'Working',
                        'item': [{
                                'title': '<span class="fw-bold">Do Something!</span>'
                            },
                            {
                                'title': '<span class="fw-bold">Run?</span>'
                            }
                        ]
                    }, {
                        'id': '_done',
                        'title': 'Done',
                        'item': [{
                                'title': '<span class="fw-bold">All right</span>'
                            },
                            {
                                'title': '<span class="fw-bold">Ok!</span>'
                            }
                        ]
                    }]
                });
            }

            return {
                // Public Functions
                init: function() {
                    exampleBasic();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTJKanbanDemoBasic.init();
        });
    </script>
@endpush
