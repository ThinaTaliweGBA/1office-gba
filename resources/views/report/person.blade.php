@php
    use Carbon\Carbon;
@endphp
@extends('layouts.app2')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css"> --}}

    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/plugins/exporting.js"></script>

    {{-- Start Sheperd Stylng --}}
    <!-- Shepherd CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/css/shepherd.css" />
    <!-- Custom CSS for Shepherd Steps -->
    <style>
        .shepherd-button {
            background-color: #007bff;
            color: white;
        }

        .shepherd-button-secondary {
            background-color: #ccc;
            color: black;
        }

        .shepherd-progress-bar {
            height: 5px;
            background: #007bff;
        }
    </style>
    {{-- End Sheperd Stylng --}}


    {{-- Begin Broken Slice Pie --}}
    <!-- Styles -->
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>
    {{-- End Broken Slice Pie --}}

    {{-- Start Test Style --}}
    <style>
        .dropdown {
          position: relative;
          display: inline-block;
        }
        
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }
        
        .dropdown:hover .dropdown-content {
          display: block;
        }
        
        .desc {
          padding: 15px;
          text-align: center;
        }
        </style>
    {{-- End Test Style --}}
@endpush

@section('content')
    <div class="card p-8 m-16">

        {{-- Start Sheperd Intro Guide --}}
        <button id="start-tour" class="btn btn-info btn-sm mb-4">Click Me!</button>
        {{-- End Sheperd Intro Guide --}}
        <br>
        
        {{-- Start Data Filtering --}}
        <div id="feature_one" class="border border-solid bg-secondary rounded-2">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Data Filtering</h2>
            </div>


            <form action="{{ route('report.person') }}" method="GET"
                style="margin-left: auto; margin-right: auto; width: fit-content; border: 2px grey dotted; color: #000;" class="bg-primary">
                <!-- Existing filters -->
                <label for="">From: </label>
                <input type="date" name="date_from" value="{{ $filters['date_from'] }}">
                <label for="">To: </label>
                <input type="date" name="date_to" value="{{ $filters['date_to'] }}">

                <!-- Time interval dropdown -->
                {{-- <label for="interval">Time Interval: </label>
                <select name="interval" id="interval">
                    <option value="yearly"
                        {{ isset($filters['interval']) && $filters['interval'] == 'yearly' ? 'selected' : '' }}>Yearly
                    </option>
                    <option value="monthly"
                        {{ isset($filters['interval']) && $filters['interval'] == 'monthly' ? 'selected' : '' }}>Monthly
                    </option>
                    <option value="weekly"
                        {{ isset($filters['interval']) && $filters['interval'] == 'weekly' ? 'selected' : '' }}>Weekly
                    </option>
                    <option value="hourly"
                        {{ isset($filters['interval']) && $filters['interval'] == 'hourly' ? 'selected' : '' }}>Hourly
                    </option>
                </select> --}}

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



                {{-- <!-- Birth Date filter -->
                <label for="birth_date">Birth Date: </label>
                <input type="date" name="birth_date" value="{{ $filters['birth_date'] ?? '' }}"> --}}

                <!-- Married Status filter -->
                <label for="married_status">Married Status: </label>
                <select name="married_status" id="married_status">
                    <option value="" {{ empty($filters['married_status']) ? 'selected' : '' }}>All</option>
                    <option value="1"
                        {{ isset($filters['married_status']) && $filters['married_status'] === '1' ? 'selected' : '' }}>
                        Single</option>
                    <option value="2"
                        {{ isset($filters['married_status']) && $filters['married_status'] === '2' ? 'selected' : '' }}>
                        Married</option>
                    <option value="3"
                        {{ isset($filters['married_status']) && $filters['married_status'] === '3' ? 'selected' : '' }}>
                        Divorced</option>
                    <option value="4"
                        {{ isset($filters['married_status']) && $filters['married_status'] === '4' ? 'selected' : '' }}>
                        Widowed</option>
                </select>




                    {{-- <!-- Language filter -->
                    <label for="language_id">Language: </label>
                    <select name="language_id" id="language_id">
                        <option value="" {{ empty($filters['language_id']) ? 'selected' : '' }}>All</option>
                        <option value="1"
                            {{ isset($filters['language_id']) && $filters['language_id'] === '1' ? 'selected' : '' }}>Language 1
                        </option>
                        <option value="2"
                            {{ isset($filters['language_id']) && $filters['language_id'] === '2' ? 'selected' : '' }}>Language 2
                        </option>Demographic
                    </select> --}}

                <button type="submit" class="btn btn-sm btn-success">Filter</button>

            </form>
            <!-- Your graph or table here -->

            <div class="table-responsive" style="margin-left: auto; margin-right: auto; width: fit-content;">
                <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200 bg-light">
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Initials</th>
                            <th>Last Name</th>
                            <th>ID Number</th>
                            <th>Age</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $record)
                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->first_name }}</td>
                                <td>{{ $record->initials }}</td>
                                <td>{{ $record->last_name }}</td>
                                <td>{{ $record->id_number }}</td>
                                <td>{{ Carbon::parse($record->birth_date)->age }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- {{ $data }} --}}

        </div>
        {{-- End Data Filtering --}}

        <br>

        {{-- Start Recently Added Table --}}
        <div class="card mt-5 mb-xl-10 border border border-solid bg-secondary" id="feature_three">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5" style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Recently Added Persons</span>
                    <span class="text-muted mt-1 fw-semibold fs-7"
                        style="margin-left: auto; margin-right: auto; width: fit-content;">Added within the last
                        {{ $weeks }}
                        {{ Str::plural('week', $weeks) }}</span>
                </h3>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body py-3" style="margin-left: auto; margin-right: auto; width: fit-content;">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <!-- Add this above your table in the Blade view -->
                    <form method="GET" action="{{ url('person') }}">
                        <label for="weeks">Select Weeks:</label>
                        <select name="weeks" id="weeks" onchange="this.form.submit()">
                            <option value="1" {{ $weeks == 1 ? 'selected' : '' }}>1 Week</option>
                            <option value="4" {{ $weeks == 4 ? 'selected' : '' }}>4 Weeks</option>
                            <option value="8" {{ $weeks == 8 ? 'selected' : '' }}>8 Weeks</option>
                            <!-- Add as many options as you like -->
                        </select>
                    </form>

                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-primary">
                                <th class="ps-4 min-w-30px rounded-start">ID</th>
                                <th class="min-w-125px">Name(s)</th>
                                <th class="min-w-125px">Surname</th>
                                <th class="min-w-150px rounded-end">Created At</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            @foreach ($recentPersons as $person)
                                <tr>
                                    <td class="p-3">{{ $person->id }}</td>
                                    <td>{{ $person->first_name }}</td>
                                    <td>{{ $person->last_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($person->created_at)->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Body-->
        </div>
        {{-- End Recently Added Table --}}

        {{-- Start Data Statistics Overview --}}
        <div id="feature_two" class="border border-solid bg-secondary rounded-2">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Data Statistics Overview</h2>
            </div>

            <!--begin::Row-->
            <div class="row g-2 g-xl-6 mb-5 mb-xl-5 p-3">
                <!--begin::Col-->
                <div class="col-xl-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #ff0040;background-image:url('assets/media/svg/shapes/wave-bg-red.svg')">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #ff0040">
                                <i class="ki-duotone ki-call text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                @if ($oldestMember)
                                    <span class="fs-1hx text-white me-6">Oldest Member </span>
                                    <span
                                        class="fs-4hx text-white fw-bold me-6">{{ Carbon::parse($oldestMember->birth_date)->age }}</span>
                                    <div class="fw-bold fs-6 text-white">
                                        <span class="d-block">years</span>
                                        {{-- <h4>
                                                <span class="">years</span>
                                            </h4> --}}
                                    </div>
                                @endif

                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">
                                    {{ $oldestMember->first_name . ' ' . $oldestMember->last_name }}</span>
                                <span class="opacity-50">Member Details</span>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #5100ff;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #5100ff">
                                <i class="ki-duotone ki-call text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                @if ($youngestMember)
                                    <span class="fs-hx text-white me-6">Youngest Member </span>
                                    <span
                                        class="fs-4hx text-white fw-bold me-6">{{ Carbon::parse($youngestMember->birth_date)->age == 0 ? '<1' : Carbon::parse($youngestMember->birth_date)->age }}
                                    </span>
                                    <div class="fw-bold fs-6 text-white">
                                        <span class="d-block">years</span>
                                        {{-- <h4>
                                                <span class="">years</span>
                                            </h4> --}}
                                    </div>
                                @endif
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">
                                    {{ $youngestMember->first_name . ' ' . $youngestMember->last_name }}</span>
                                <span class="opacity-50">Member Details</span>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #007934d6;background-image:url('assets/media/svg/shapes/wave-bg-red.svg')">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #00762795">
                                <i class="ki-duotone ki-call text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ $countMaleMembers }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Total Male</span>
                                    <span class="">Members</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">Male</span>
                                <span class="opacity-50">Members</span>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-3">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #0095a2;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #008692">
                                <i class="ki-duotone ki-call text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ $countFemaleMembers }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Total Female</span>
                                    <span class="">Members</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">Female</span>
                                <span class="opacity-50">Members</span>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->


            <!--begin::Row-->
            <div class="row g-3 g-xl-6 mb-xl-5 p-3">
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #F1416C;background-image:url('assets/media/svg/shapes/wave-bg-red.svg')">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #F1416C">
                                <i class="ki-duotone ki-call text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ number_format($averageAge, 0) }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Approximate</span>
                                    <span class="">Average Age</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span class="fs-1 d-block">{{ number_format($averageAge, 2) . ' years.' }}</span>
                                <span class="opacity-50">Average Age Of All Members.</span>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-6">
                    <!--begin::Card widget 3-->
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #7239EA;background-image:url('assets/media/svg/shapes/wave-bg-purple.svg')">
                        <!--begin::Header-->
                        <div class="card-header pt-5 mb-3">
                            <!--begin::Icon-->
                            <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                                <i class="ki-duotone ki-call text-white fs-2qx lh-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </div>
                            <!--end::Icon-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end mb-3">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center">
                                <span
                                    class="fs-4hx text-white fw-bold me-6">{{ $firstPerson->first_name . ' ' . $firstPerson->last_name }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    {{-- <span class="d-block">English Speaking</span> --}}
                                    <span class="">First Member</span>
                                </div>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <!--begin::Progress-->
                            <div class="fw-bold text-white py-2">
                                <span
                                    class="fs-1 d-block">{{ Carbon::parse($firstPerson->birth_date)->age . ' years.' }}</span>
                                <span class="opacity-50">First Registered Member</span>
                            </div>
                            <!--end::Progress-->
                        </div>
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card widget 3-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        {{-- End Data Statistics Overview --}}


        {{-- Start Demographic Pie Distributions --}}
        <div class="card mt-10 border border-solid bg-secondary p-4">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5 underlined">Demographic Reports</h2>
            </div>
            <div class="row">
                <!-- Gender Pie Chart -->
                <div class="col-lg-6 col-md-12">
                    <div class="card" style="border: gray solid 1px;">
                        <div class="card-header">
                            <h4 class="card-title">Gender Distribution</h4>
                            {{-- <small class="text-muted">Pie chart representing gender distribution.</small> --}}
                        </div>
                        <div class="card-body">
                            <canvas id="genderPieChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Marital Status Pie Chart -->
                <div class="col-lg-6 col-md-12">
                    <div class="card" style="border: gray solid 1px;">
                        <div class="card-header">
                            <h4 class="card-title">Marital Status Distribution</h4>
                            {{-- <small class="text-muted">Pie chart representing marital status distribution.</small> --}}
                        </div>
                        <div class="card-body">
                            <canvas id="maritalPieChart" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Demographic Pie Distributions --}}

        {{-- Start Gender Distribution --}}
        <div class="card mt-5 mb-5 mb-xl-8 border border border-solid bg-secondary mt-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Gender Distribution</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Total counts by gender</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table id="gender-distribution-table" class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">Gender</th>
                                <th class="min-w-150px rounded-end">Total Count</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach ($genderData as $data)
                                <tr>
                                    <td class="ps-4">
                                        @if ($data->gender_id == 'F')
                                            Male
                                        @elseif ($data->gender_id == 'M')
                                            Female
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    <td>{{ $data->count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Body-->
        </div>
        {{-- End Gender Distribution --}}

        <br>

        {{-- Start Complex Data Statistics --}}
        <div class="card border border-solid rounded-2 bg-secondary mb-3">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="mt-4 text-decoration-dotted">Complex Data Statistics</h2>
            </div>
            <canvas id="genderAgeChart" width="400" height="200" class="my-5 p-5"></canvas>
        </div>
        {{-- End Complex Data Statistics --}}


        {{-- Start Search Table --}}
        <div class="card mt-6 mb-xl-8 border border border-solid bg-secondary">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column"
                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                    <span class="card-label fw-bold fs-3 mb-1">Search Person Here, Then Export Results.</span>
                    {{-- <span class="text-muted mt-1 fw-semibold fs-7">Complete List of Persons</span> --}}
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table id="datatable-search" class="table align-middle gs-0 gy-4"
                        style="margin-left: auto; margin-right: auto; width: fit-content;">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-30px rounded-start">ID</th>
                                <th class="min-w-100px">Name</th>
                                <th class="min-w-125px">Surname</th>
                                <th class="min-w-60px">Initials</th>
                                <th class="min-w-150px">Screen Name</th>
                                <th class="min-w-50px">ID Number</th>
                                <th class="min-w-150px">Birth Date</th>
                                <th class="min-w-100px">Maritial Status</th>
                                <th class="min-w-100px">Gender</th>
                                <th class="min-w-50px">Country</th>
                                {{-- <th class="min-w-150px">Source Column</th> --}}
                                <th class="min-w-10px">Deleted</th>
                                <th class="min-w-150px">Created</th>
                                <th class="min-w-150px rounded-end">Updated</th>
                            </tr>
                            <!-- Define your columns here -->

                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach ($persons as $person)
                                <tr>
                                    <td class="ps-4">{{ $person->id }}</td>
                                    <td>{{ $person->first_name }}</td>
                                    <td>{{ $person->last_name }}</td>
                                    <td>{{ $person->initials }}</td>
                                    <td>{{ $person->screen_name }}</td>
                                    <td>{{ $person->id_number }}</td>
                                    <td>{{ $person->birth_date }}</td>
                                    <td>
                                        @if ($person->married_status == 1)
                                            Married
                                        @elseif ($person->married_status == 2)
                                            Single
                                        @elseif ($person->married_status == 3)
                                            Divorced
                                        @elseif ($person->married_status == 4)
                                            Widowed
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    <td>
                                        @if ($person->gender_id == 'M')
                                            Male
                                        @elseif ($person->gender_id == 'F')
                                            Female
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    <td>
                                        @if ($person->residence_country_id == 197)
                                            South Africa
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    {{-- <td>{{ $person->deleted }}</td> --}}
                                    <td>
                                        @if ($person->deleted_at == 0)
                                            NA
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    <td>{{ $person->created_at }}</td>
                                    <td>{{ $person->updated_at }}</td>
                                    <!-- add more fields -->
                                </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
        {{-- End Search Table --}}

    </div>


    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/plugins/exporting.js"></script>
@endsection

@push('scripts')
    {{-- Script for the gender distribution pie chart --}}
    <script>
        const genderData = @json($genderData);

        const labels = genderData.map(data => data.gender_id === 'M' ? 'Male' : (data.gender_id === 'F' ? 'Female' :
            'Unknown'));
        const data = genderData.map(data => data.count);

        const ctx = document.getElementById('genderPieChart').getContext('2d');
        const myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#007bff', '#dc3545',
                        '#6c757d'
                    ], // Add more colors if there are more categories
                }]
            }
        });
    </script>

    {{-- Script for the maritial pie chart --}}
    <script>
        // Replace this line with data from your Laravel controller
        const maritalData = @json($maritalData);

        const maritalLabels = maritalData.map(data => {
            switch (data.married_status) {
                case '1':
                    return 'Married';
                case '2':
                    return 'Single';
                case '3':
                    return 'Divorced';
                case '4':
                    return 'Widowed';
                default:
                    return 'Unknown';
            }
        });
        const maritalDataCounts = maritalData.map(data => data.count);

        const maritalCtx = document.getElementById('maritalPieChart').getContext('2d');
        const myMaritalPieChart = new Chart(maritalCtx, {
            type: 'pie',
            data: {
                labels: maritalLabels,
                datasets: [{
                    data: maritalDataCounts,
                    backgroundColor: ['#ffc1a7', '#28a745', '#00bfff',
                        '#ff00bf', '#aabd49', '##ffc107'
                    ], // Add more colors if there are more categories
                }]
            }
        });
    </script>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('genderAgeChart').getContext('2d');

            // Assuming 'data' is passed from Laravel as a JSON-encoded variable
            var rawData = {!! $chartData !!};

            var labels = [];
            var maleData = [];
            var femaleData = [];

            rawData.forEach(function(item) {
                labels.push(item.age);
                if (item.gender_id === 'M') {
                    maleData.push(item.count);
                } else if (item.gender_id === 'F') {
                    femaleData.push(item.count);
                }
            });

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Male',
                        data: maleData,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 9
                    }, {
                        label: 'Female',
                        data: femaleData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 9
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('genderAgeChart').getContext('2d');

            var rawData = {!! $chartData !!};

            var genderLabels = [];
            var ageData = [];
            var countData = [];

            rawData.forEach(function(item) {
                genderLabels.push(item.gender_id);
                ageData.push(item.age);
                countData.push(item.count);
            });

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: genderLabels,
                    datasets: [{
                            label: 'Age',
                            data: ageData,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            fill: true
                        },
                        {
                            label: 'Count',
                            data: countData,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            fill: true
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 58,
                            min: 0,
                            stepSize: 2
                        }
                    },
                    legend: {
                        display: true
                    }
                }
            });
        });
    </script>

    {{-- Start Sheperd Guided Tour --}}
    <script src="https://cdn.jsdelivr.net/npm/shepherd.js@10.0.1/dist/js/shepherd.min.js"></script>
    <!-- Shepherd JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/shepherd.js/8.3.2/js/shepherd.min.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function createProgressBar(step, totalSteps) {
                const percentage = (step / totalSteps) * 100;
                return `<div class="shepherd-progress">
                            <div class="shepherd-progress-bar" style="width: ${percentage}%"></div>
                        </div>`;
            }

            var tour = new Shepherd.Tour({
                defaultStepOptions: {
                    cancelIcon: {
                        enabled: true
                    }
                },
                useModalOverlay: true
            });

            const totalSteps = 4;
            let currentStep = 0;

            tour.addStep({
                id: 'intro',
                text: `Welcome to the guided tour!, Press next to continue... ${createProgressBar(currentStep, totalSteps)}`,
                buttons: [{
                    classes: 'shepherd-button',
                    text: 'Next',
                    action: function() {
                        currentStep++;
                        return this.next();
                    }
                }]
            });

            tour.addStep({
                id: 'feature_one',
                text: `This is where you can filter your data, ${createProgressBar(currentStep, totalSteps)}`,
                attachTo: {
                    element: '#feature_one',
                    on: 'right'
                },
                buttons: [{
                        classes: 'shepherd-button-secondary',
                        text: 'Back',
                        action: function() {
                            currentStep--;
                            return this.back();
                        }
                    },
                    {
                        classes: 'shepherd-button',
                        text: 'Next',
                        action: function() {
                            currentStep++;
                            return this.next();
                        }
                    }
                ]
            });

            tour.addStep({
                id: 'feature_three',
                text: `View the latest data, ${createProgressBar(currentStep, totalSteps)}`,
                attachTo: {
                    element: '#feature_three',
                    on: 'left'
                },
                buttons: [{
                        classes: 'shepherd-button-secondary',
                        text: 'Back',
                        action: function() {
                            currentStep--;
                            return this.back();
                        }
                    },
                    {
                        classes: 'shepherd-button',
                        text: 'Next',
                        action: function() {
                            currentStep++;
                            return this.next();
                        }
                    }
                ]
            });

            tour.addStep({
                id: 'feature_two',
                text: `Here is the data statistics overall view, all the way down. Enjoy!! ${createProgressBar(currentStep, totalSteps)}`,
                attachTo: {
                    element: '#feature_two',
                    on: 'top'
                },
                buttons: [{
                        classes: 'shepherd-button-secondary',
                        text: 'Back',
                        action: function() {
                            currentStep--;
                            return this.back();
                        }
                    },
                    {
                        classes: 'shepherd-button',
                        text: 'Done',
                        action: function() {
                            currentStep++;
                            return this.next();
                        },
                        buttons: [{
                                classes: 'shepherd-button-secondary',
                                text: 'Back',
                                action: function() {
                                    currentStep--;
                                    return this.back();
                                }
                            },
                            {
                                classes: 'shepherd-button',
                                text: 'Done',
                                action: tour.complete
                            }
                        ]
                    }
                ]
            });

            // tour.start();
            // Start the tour when the button is clicked
            document.getElementById('start-tour').addEventListener('click', function() {
                tour.start();
            });
        });
    </script>
    {{-- End Sheperd Guided Tour --}}
@endpush
