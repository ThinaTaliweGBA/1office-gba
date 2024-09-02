
@extends('layouts.app2')

@push('styles')

    {{-- Start External Libraries and Stylesheets --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))
    </script>
    <link rel="stylesheet" type="text/css"
        href="https://cdn3.devexpress.com/jslib/23.2.3/css/dx.material.blue.light.css" />
    {{-- <link rel="stylesheet" type="text/css" href="styles.css" /> --}}
    {{-- <script src="index.js"></script> --}}

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.2.3/css/dx.light.css">
    {{-- <link rel="stylesheet" href="index.css"> --}}

    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/23.2.3/js/dx.all.js"></script>
    {{-- <script type="text/javascript" src="index.js"></script> --}}

    <style>
        #pivotgrid,
        #pivotgrid-chart {
            margin-top: 20px;
            padding: 20px 20px;
        }

        .currency {
            text-align: center;
        }

        .dx-pivotgrid-container{
            background-color: lightgray;
        }
    </style>

    <script>
        function initializeComponents(data) {
            const pivotGrid = $('#pivotgrid').dxPivotGrid({
                dataSource: {
                    fields: [{
                            caption: 'Name',
                            dataField: 'name',
                            area: 'row'
                        },
                        {
                            caption: 'Membership Code',
                            dataField: 'membership_code',
                            area: 'row'
                        }, {
                            caption: 'ID Number',
                            dataField: 'id_number',
                            area: 'row'
                        },
                        {
                            caption: 'Join Date',
                            dataField: 'join_date',
                            dataType: 'date',
                            area: 'column'
                        },
                        {
                            caption: 'End Date',
                            dataField: 'end_date',
                            dataType: 'date',
                            area: 'column'
                        },
                        {
                            caption: 'Gender',
                            dataField: 'gender_id',
                            area: 'row'
                        },
                        {
                            caption: 'Membership Fee',
                            dataField: 'membership_fee',
                            dataType: 'number',
                            summaryType: 'sum',
                            format: {
                                type: 'custom',
                                formatter: formatCurrency
                            },
                            area: 'data'
                        }
                    ],
                    store: data
                },
                allowSortingBySummary: true,
                allowFiltering: true,
                showBorders: true,
                fieldChooser: {
                    enabled: true,
                    height: 400
                },export: {enabled: true}  // Enable exporting
            }).dxPivotGrid('instance');

            const pivotGridChart = $('#pivotgrid-chart').dxChart({
                commonSeriesSettings: {
                    type: 'bar'
                },
                tooltip: {
                    enabled: true,
                    format: 'currency',
                    customizeTooltip(args) {
                        return {
                            html: `${args.seriesName} | ${args.valueText}`
                        };
                    }
                },
                size: {
                    height: 350
                },
                adaptiveLayout: {
                    width: 450
                },export: {enabled: true}  // Enable exporting
            }).dxChart('instance');

            pivotGrid.bindChart(pivotGridChart, {
                dataFieldsDisplayMode: 'splitPanes',
                alternateDataFields: false
            });
        }
    </script>
@endpush


@section('row_content')
    <div class="dx-viewport p-16">
        <div class="demo-container">
            <h1 class='text-center'>Memberships</h1>
            <div id="pivotgrid-demo">
                <div id="pivotgrid-chart"></div>
                <div id="pivotgrid"></div>
            </div>
        </div>
    </div>

    <script>
        function formatCurrency(value) {
            return new Intl.NumberFormat('en-ZA', {
                style: 'currency',
                currency: 'ZAR'
            }).format(value);
        }
        var membershipsDataUrl = "<?php echo env('MEMBERSHIPS_DATA_URL'); ?>";

        $.ajax({
            url: membershipsDataUrl,
            method: 'GET',
            success: function(data) {
                initializeComponents(data);
            }
        });
    </script>

        <div class="card p-8 m-16">

        {{-- Start Filtering Form Submit --}}
        <div id="feature_one" class="border border-solid bg-secondary rounded-2">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Data Filtering</h2>
            </div>

            {{-- Start Cards Display --}}
            <div class="row g-5 g-xl-10 mb-20 mb-xl-10" style="margin-left: auto; margin-right: auto; width: fit-content;">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-30"
                        style="background-color: #F1416C;background-image:url('assets/media/svg/shapes/wave-bg-red.svg')">
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ $afMembers }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Afrikaans Speaking</span>
                                    <span class="">Members</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-30"
                        style="background-color: #7239EA;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ $enMembers }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">English Speaking</span>
                                    <span class="">Members</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-30"
                        style="background-color: #a419a0;background-image:url('assets/media/svg/shapes/wave-bg-red.svg')">
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ $maleMembers }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Total Male</span>
                                    <span class="">Members</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-30"
                        style="background-color: #5df2ff;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ $femaleMembers }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Total Female</span>
                                    <span class="">Members</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
            </div>
            {{-- End Cards Display --}}


            <form action="{{ route('report.index') }}" method="GET"
                style="margin-left: auto; margin-right: auto; width: fit-content; border: 2px gray dotted"
                class="bg-primary">
                <!-- Date Range filters -->

                <label for="">From: </label>
                <input type="date" name="date_from" value="{{ $filters['date_from'] }}">
                <label for="">To: </label>
                <input type="date" name="date_to" value="{{ $filters['date_to'] }}">

                <!-- Gender filter -->
                <label for="gender_id">Gender: </label>
                <select name="gender_id" id="gender_id">
                    <option value="" {{ empty($filters['gender_id']) ? 'selected' : '' }}>All</option>
                    <option value="M"
                        {{ isset($filters['gender_id']) && $filters['gender_id'] === 'M' ? 'selected' : '' }}>Male</option>
                    <option value="F"
                        {{ isset($filters['gender_id']) && $filters['gender_id'] === 'F' ? 'selected' : '' }}>Female
                    </option>
                </select>

                <!-- Language filter -->
                <label for="language_id">Language: </label>
                <select name="language_id" id="language_id">
                    <option value="" {{ empty($filters['language_id']) ? 'selected' : '' }}>All</option>
                    <option value="1"
                        {{ isset($filters['language_id']) && $filters['language_id'] === '1' ? 'selected' : '' }}>English
                    </option>
                    <option value="2"
                        {{ isset($filters['language_id']) && $filters['language_id'] === '2' ? 'selected' : '' }}>Afrikaans
                    </option>
                </select>

                {{-- <!-- Language filter -->
            <label for="language_id">Language: </label>
            <select name="language_id" id="language_id" class="form-select form-select-solid" data-control="select2" data-close-on-select="false" data-placeholder="Select an option" data-allow-clear="true">
                <option value="" {{ empty($filters['language_id']) ? 'selected' : '' }}>All</option>
                <option value="1" {{ isset($filters['language_id']) && $filters['language_id'] === '1' ? 'selected' : '' }}>English</option>
                <option value="2" {{ isset($filters['language_id']) && $filters['language_id'] === '2' ? 'selected' : '' }}>Afrikaans</option>
            </select> --}}



                <button type="submit" class="btn btn-sm btn-info">Filter</button>
            </form>
            <br>
            {{-- {{ $data }} --}}
            <div class="table-responsive" style="margin-left: auto; margin-right: auto; width: fit-content;">
                <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200 bg-light">
                            <th>Code</th>
                            <th>Initails</th>
                            <th>Surname</th>
                            <th>Gender</th>
                            <th>Join Data</th>
                            <th>Language</th>
                            <th>Member Fee</th>
                            <th>Last Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $record)
                            <tr>
                                <td>{{ $record->membership_code }}</td>
                                <td>{{ $record->initials }}</td>
                                <td>{{ $record->surname }}</td>
                                <td>{{ $record->gender_id }}</td>
                                <td>{{ \Carbon\Carbon::parse($record->join_date)->format('Y-m-d') }}</td>
                                <td>{{ $record->language_id }}</td>
                                <td>R{{ number_format($record->membership_fee, 2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($record->last_payment_date)->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- {{ $data }} --}}

        </div>
        {{-- End Filtering Form Submit --}}

        {{-- Start Data Statistics Overview --}}
        <div id="feature_two" class="border border-solid bg-secondary rounded-2 my-5">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Data Statistics Overview</h2>
            </div>

            <!--begin::Row-->
            <div class="row g-3 g-xl-6 mb-xl-5 p-3">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::List widget 25-->
                    <div class="card bg-gradient px-5 pt-5 mt-5 mb-5 rounded-2 bg-secondary">
                        <div class="h-lg-50">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title text-gray-800"
                                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                                    Total Memberships</h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar d-none">
                                    <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                    <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                        class="btn btn-sm btn-light d-flex align-items-center px-4">
                                        <!--begin::Display range-->
                                        <div class="text-gray-600 fw-bold">Loading date range...</div>
                                        <!--end::Display range-->
                                        <i class="ki-duotone ki-calendar-8 fs-1 ms-2 me-0">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </div>
                                    <!--end::Daterangepicker-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="text-gray-700 fw-semibold fs-6 me-2">All Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-senter">
                                        {{-- <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i> --}}
                                        <!--begin::Number-->
                                        <span class="text-gray-900 fw-bolder fs-6">{{ $totalMemberships }}</span>
                                        <!--end::Number-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3 bg-dark"></div>
                                <!--end::Separator-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="text-gray-700 fw-semibold fs-6 me-2">Active Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center">
                                        @if ($totalMembershipsActive < $totalMembershipsDeleted)
                                            <i class="ki-duotone ki-arrow-down-right fs-2 text-danger me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        @else
                                            <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        @endif
                                        <!--begin::Number-->
                                        <span class="text-gray-900 fw-bolder fs-6">{{ $totalMembershipsActive }}</span>
                                        <!--end::Number-->
                                        <span class="text-gray-400 fw-bold fs-6">/{{ $totalMemberships }}</span>
                                    </div>
                                    <!--end::Statistics-->

                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3 bg-dark"></div>
                                <!--end::Separator-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="text-gray-700 fw-semibold fs-6 me-2">Deleted Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-senter">
                                        @if ($totalMembershipsActive > $totalMembershipsDeleted)
                                            <i class="ki-duotone ki-arrow-down-right fs-2 text-danger me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        @else
                                            <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        @endif
                                        <!--begin::Number-->
                                        <span class="text-gray-900 fw-bolder fs-6">{{ $totalMembershipsDeleted }}</span>
                                        <!--end::Number-->
                                        <span class="text-gray-400 fw-bold fs-6">/{{ $totalMemberships }}</span>
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <!--end::LIst widget 25-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::List widget 25-->
                    <div class="card bg-gradient px-5 pt-5 mt-5 mb-5 rounded-2 bg-secondary">
                        <div class="h-lg-50">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title text-gray-800"
                                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                                    Memberships by Gender</h3>
                                <!--end::Title-->
                                <!--begin::Toolbar-->
                                <div class="card-toolbar d-none">
                                    <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                    <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                        class="btn btn-sm btn-light d-flex align-items-center px-4">
                                        <!--begin::Display range-->
                                        <div class="text-gray-600 fw-bold">Loading date range...</div>
                                        <!--end::Display range-->
                                        <i class="ki-duotone ki-calendar-8 fs-1 ms-2 me-0">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </div>
                                    <!--end::Daterangepicker-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="text-gray-700 fw-semibold fs-6 me-2">All Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-senter">
                                        {{-- <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i> --}}
                                        <!--begin::Number-->
                                        <div class="text-gray-900 fw-bolder fs-6">
                                            @foreach ($membershipsByGender as $membership)
                                                <span>
                                                    {{ $membership->count }}
                                                    @if ($membership->gender_id == 'M')
                                                        <span class="badge bg-primary">{{ $membership->gender_id }}</span>
                                                    @elseif ($membership->gender_id == 'F')
                                                        <span class="badge bg-danger">{{ $membership->gender_id }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-info text-dark">{{ $membership->gender_id }}</span>
                                                    @endif
                                                </span>
                                            @endforeach
                                        </div>
                                        <!--end::Number-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3 bg-dark"></div>
                                <!--end::Separator-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="text-gray-700 fw-semibold fs-6 me-2">Active Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-senter">
                                        {{-- <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                        </i> --}}
                                        <!--begin::Number-->
                                        <div class="text-gray-900 fw-bolder fs-6">
                                            @foreach ($membershipsByGenderActive as $membership)
                                                <span>
                                                    {{ $membership->count }}
                                                    @if ($membership->gender_id == 'M')
                                                        <span class="badge bg-primary">{{ $membership->gender_id }}</span>
                                                    @elseif ($membership->gender_id == 'F')
                                                        <span class="badge bg-danger">{{ $membership->gender_id }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-info text-dark">{{ $membership->gender_id }}</span>
                                                    @endif
                                                </span>
                                            @endforeach
                                        </div>
                                        <!--end::Number-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-3 bg-dark"></div>
                                <!--end::Separator-->
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="text-gray-700 fw-semibold fs-6 me-2">Deleted Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-senter">
                                        {{-- <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                        </i> --}}
                                        <!--begin::Number-->
                                        <div class="text-gray-900 fw-bolder fs-6">
                                            @foreach ($membershipsByGenderDeleted as $membership)
                                                <span>
                                                    {{ $membership->count }}
                                                    @if ($membership->gender_id == 'M')
                                                        <span class="badge bg-primary">{{ $membership->gender_id }}</span>
                                                    @elseif ($membership->gender_id == 'F')
                                                        <span class="badge bg-danger">{{ $membership->gender_id }}</span>
                                                    @else
                                                        <span
                                                            class="badge bg-info text-dark">{{ $membership->gender_id }}</span>
                                                    @endif
                                                </span>
                                            @endforeach
                                        </div>
                                        <!--end::Number-->
                                    </div>
                                    <!--end::Statistics-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <!--end::LIst widget 25-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

        </div>
        {{-- End Data Statistics Overview --}}

        {{-- Start Membership by Age --}}
        <div id="feature_two" class="border border-solid bg-secondary rounded-2 my-5">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Memberships by Type (Age Group)</h2>
            </div>

            <!--begin::Row-->
            <div class="row g-3 g-xl-6 mb-xl-5 p-3">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::List widget 25-->
                    <div class="card bg-gradient px-5 pt-5 mt-5 mb-5 rounded-2 bg-secondary">
                        <div class="h-lg-50">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title text-gray-800"
                                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                                    All Memberships</h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                @foreach ($membershipsByType as $membership)
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">
                                            @if ($membership->bu_membership_type_id == '1')
                                                <span class="badge bg-success">A1 </span>
                                            @elseif ($membership->bu_membership_type_id == '2')
                                                <span class="badge bg-warning">A2 </span>
                                            @else
                                                <span class="badge bg-danger">A3 </span>
                                            @endif
                                            {{ $membershipTypeMapping[$membership->bu_membership_type_id] }}
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Statistics-->
                                        <div class="d-flex align-items-senter">
                                            <!--begin::Number-->
                                            <span class="text-gray-900 fw-bolder fs-6">{{ $membership->count }}</span>
                                            <!-- Check for highest value and display an indicator -->
                                            @if ($membership->count == $highestValue)
                                                <span class="badge bg-primary ms-2">Highest</span>
                                            @endif
                                            <!-- Check for lowest value and display an indicator -->
                                            @if ($membership->count == $lowestValue)
                                                <span class="badge bg-info ms-2">Lowest</span>
                                            @endif
                                            <!--end::Number-->
                                        </div>
                                        <!--end::Statistics-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-3 bg-dark"></div>
                                    <!--end::Separator-->
                                @endforeach
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <!--end::List widget 25-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::List widget 25-->
                    <div class="card bg-gradient px-5 pt-5 mt-5 mb-5 rounded-2 bg-secondary">
                        <div class="h-lg-50">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title text-gray-800"
                                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                                    Active Memberships</h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                @foreach ($membershipsByTypeActive as $membership)
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">
                                            @if ($membership->bu_membership_type_id == '1')
                                                <span class="badge bg-success">A1 </span>
                                            @elseif ($membership->bu_membership_type_id == '2')
                                                <span class="badge bg-warning">A2 </span>
                                            @else
                                                <span class="badge bg-danger">A3 </span>
                                            @endif
                                            {{ $membershipTypeMapping[$membership->bu_membership_type_id] }}
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Statistics-->
                                        <div class="d-flex align-items-senter">
                                            <!--begin::Number-->
                                            <span class="text-gray-900 fw-bolder fs-6">{{ $membership->count }}</span>
                                            <!-- Check for highest value and display an indicator -->
                                            @if ($membership->count == $highestValueActive)
                                                <span class="badge bg-primary ms-2">Highest</span>
                                            @endif
                                            <!-- Check for lowest value and display an indicator -->
                                            @if ($membership->count == $lowestValueActive)
                                                <span class="badge bg-info ms-2">Lowest</span>
                                            @endif
                                            <!--end::Number-->
                                        </div>
                                        <!--end::Statistics-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-3 bg-dark"></div>
                                    <!--end::Separator-->
                                @endforeach
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <!--end::List widget 25-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::List widget 25-->
                    <div class="card bg-gradient px-5 pt-5 mt-5 mb-5 rounded-2 bg-secondary">
                        <div class="h-lg-50">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title text-gray-800"
                                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                                    Deleted Memberships</h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                @foreach ($membershipsByTypeDeleted as $membership)
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">
                                            @if ($membership->bu_membership_type_id == '1')
                                                <span class="badge bg-success">A1 </span>
                                            @elseif ($membership->bu_membership_type_id == '2')
                                                <span class="badge bg-warning">A2 </span>
                                            @else
                                                <span class="badge bg-danger">A3 </span>
                                            @endif
                                            {{ $membershipTypeMapping[$membership->bu_membership_type_id] }}
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Statistics-->
                                        <div class="d-flex align-items-senter">
                                            <!--begin::Number-->
                                            <span class="text-gray-900 fw-bolder fs-6">{{ $membership->count }}</span>
                                            <!-- Check for highest value and display an indicator -->
                                            @if ($membership->count == $highestValueDeleted)
                                                <span class="badge bg-primary ms-2">Highest</span>
                                            @endif
                                            <!-- Check for lowest value and display an indicator -->
                                            @if ($membership->count == $lowestValueDeleted)
                                                <span class="badge bg-info ms-2">Lowest</span>
                                            @endif
                                            <!--end::Number-->
                                        </div>
                                        <!--end::Statistics-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-3 bg-dark"></div>
                                    <!--end::Separator-->
                                @endforeach
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <!--end::List widget 25-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        {{-- End Membership by Age --}}

        {{-- Start Membership Trends Graph --}}
        <div id="feature_two" class="border border-solid bg-secondary rounded-2 my-5">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Membership Trends Overview</h2>
            </div>

            <!--begin::Row-->
            <!-- For All Memberships -->
            <div class="card m-4">
                <div class="card-header">
                    <h4 class="card-title">All Yearly Membership Trends</h4>
                </div>
                <div class="card-body">
                    <canvas id="allMembershipsChart"></canvas>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row g-3 g-xl-6 mb-xl-5 p-3">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!-- For Active Memberships -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Active Yearly Membership Trends</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="activeMembershipsChart"></canvas>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!-- For Deleted Memberships -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Deleted Yearly Membership Trends</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="deletedMembershipsChart"></canvas>
                        </div>
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        {{-- End Membership Trends Graph --}}

        {{-- Start Membership Trends Data View --}}
        <div id="feature_one" class="border border-solid bg-secondary rounded-2 p-4">
            <h2 style="margin-left: auto; margin-right: auto; width: fit-content;">Membership Trends(Yearly based)</h2>
            <div class="grid-container">

                <!-- For All Memberships -->
                <div class="grid-item bg-gradient">
                    <h3 style="margin-left: auto; margin-right: auto; width: fit-content;">All Membership Trends
                    </h3><br>
                    @foreach ($yearlyMembershipTrends as $trend)
                        <p style="margin-left: auto; margin-right: auto; width: fit-content;">{{ $trend->year }} :
                            {{ $trend->count }} joined.</p>
                    @endforeach
                </div>

                <!-- For Active Memberships -->
                <div class="grid-item bg-gradient">
                    <h3 style="margin-left: auto; margin-right: auto; width: fit-content;">Active Membership Trends</h3>
                    <br>
                    @foreach ($yearlyMembershipTrendsActive as $trend)
                        <p style="margin-left: auto; margin-right: auto; width: fit-content;">{{ $trend->year }} :
                            {{ $trend->count }} joined.</p>
                    @endforeach
                </div>

                <!-- For Deleted Memberships -->
                <div class="grid-item bg-gradient">
                    <h3 style="margin-left: auto; margin-right: auto; width: fit-content;">Deleted Membership Trends</h3>
                    <br>
                    @foreach ($yearlyMembershipTrendsDeleted as $trend)
                        <p style="margin-left: auto; margin-right: auto; width: fit-content;">{{ $trend->year }} :
                            {{ $trend->count }} joined</p>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- End Membership Trends Graph --}}

        {{-- Start Membership Insight Details --}}
        <div id="feature_two" class="border border-solid bg-secondary rounded-2 my-5">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Membership Insights</h2>
            </div>

            <!--begin::Row-->
            <div class="row g-3 g-xl-6 mb-xl-5 p-3">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::List widget 25-->
                    <div class="card bg-gradient px-5 pt-5 mt-5 mb-5 rounded-2 bg-secondary">
                        <div class="h-lg-50">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <h3 class="card-title text-gray-800"
                                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                                    Reasons for ending membership
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                @foreach ($membershipsEndedByReason as $reason)
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">{{ $reason->end_reason }}</div>
                                        <div class="text-gray-900 fw-bolder fs-6">{{ $reason->count }}</div>
                                    </div>
                                    <div class="separator separator-dashed my-3 bg-dark"></div>
                                @endforeach
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <!--end::List widget 25-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::List widget 25-->
                    <div class="card bg-gradient px-5 pt-5 mt-5 mb-5 rounded-2 bg-secondary">
                        <div class="h-lg-50">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <h3 class="card-title text-gray-800"
                                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                                    Average Membership Fee by Region 1 (South Africa)
                                </h3>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                @foreach ($averageFeeByRegion as $region)
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">Overall Average Fee</div>
                                        <div class="text-gray-900 fw-bolder fs-6">
                                            R{{ number_format($region->average_fee, 2) }}</div>
                                    </div>
                                    <div class="separator separator-dashed my-3 bg-dark"></div>
                                @endforeach
                                @foreach ($averageFeeByRegionActive as $region)
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">(Active) Average Fee</div>
                                        <div class="text-gray-900 fw-bolder fs-6">
                                            R{{ number_format($region->average_fee, 2) }}</div>
                                    </div>
                                    <div class="separator separator-dashed my-3 bg-dark"></div>
                                @endforeach
                                @foreach ($averageFeeByRegionDeleted as $region)
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">(Deleted) Average Fee</div>
                                        <div class="text-gray-900 fw-bolder fs-6">
                                            R{{ number_format($region->average_fee, 2) }}</div>
                                    </div>
                                    <div class="separator separator-dashed my-3 bg-dark"></div>
                                @endforeach
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <!--end::List widget 25-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        {{-- End Membership Insight Details --}}

        {{-- Start Display Gender-Wise Owe Count --}}
        <div id="feature_one" class="border border-solid bg-secondary rounded-2">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Members Owing Insight(Monthly based)</h2>
            </div>
            {{-- <br> --}}
            <canvas id="myPolarAreaChart" width="50" height="50"></canvas>
        </div>
        {{-- End Display Gender-Wise Owe Count --}}

        {{-- Start Gender-Wise Count --}}
        <div id="feature_one" class="border border-solid bg-secondary rounded-2 mt-4">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Owing Members (Gender Based)</h2>
            </div>
            {{-- <br> --}}
            <div class="row m-4">
                @foreach ($genderOwingCounts as $genderCount)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg"> <!-- Added shadow for advanced look -->
                            <div class="card-body">
                                <h5 class="card-title">
                                    @if ($genderCount->gender_id === 'M')
                                        Male(s)
                                    @elseif ($genderCount->gender_id === 'F')
                                        Female(s)
                                    @else
                                        Unknown
                                    @endif
                                </h5>
                                <p class="card-text">Total: {{ $genderCount->member_count }} owing members
                                    <!-- Display badges -->
                                    @if ($genderCount->member_count == $maxCount)
                                        <span class="badge bg-success">Many</span>
                                    @elseif ($genderCount->member_count == $minCount)
                                        <span class="badge bg-danger">Fewer</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- New card for displaying average -->
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title">Total Owing Average</h5>
                            <p class="card-text">{{ $averageCount }} members.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Gender-Wise Count --}}

    </div>
@endsection

@push('scripts')
@endpush