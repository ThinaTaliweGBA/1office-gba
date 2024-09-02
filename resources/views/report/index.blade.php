@extends('layouts.app2')

@push('styles')
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--begin::Vendor Stylesheets(used for this page only)-->

    <script src="assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!--end::Vendor Stylesheets-->

    {{-- Start Racing Graphs d3.js Libraries --}}
    <script src="https://d3js.org/d3.v5.min.js"></script>
    {{-- End Racing Graphs d3.js Libraries --}}

    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* This creates a 3-column grid */
            gap: 15px;
            /* Spacing between grid items */
            padding-bottom: 15px;
        }

        .grid-item {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
    </style>

    {{-- Start Styling Owing Members --}}
    <style>
        .card {
            border-radius: 15px;
        }

        .card-title {
            font-size: 1.5em;
            color: #333;
        }

        .card-text {
            font-size: 1.2em;
            color: #666;
        }
    </style>
    {{-- End Styling Owing Members --}}
@endpush

@section('content')

    {{-- Start Filtering Form Submit --}}
    <div id="feature_one" class="card mt-8 mb-4 rounded-2 shadow mx-auto p-4">
        <div style="margin-left: auto; margin-right: auto; width: fit-content;">
            <h2 class="m-5">Data Filtering</h2>
        </div>

        <form action="{{ route('report.index') }}" method="GET"
            style="margin-left: auto; margin-right: auto; width: fit-content; border: 2px gray dotted"
            class="bg-gba-light p-2 mx-auto">
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

            <button type="submit" class="btn btn-sm btn-success ms-4 pulse"><span class="pulse-ring"></span>Filter</button>
        </form>
        <br>

        {{-- Start Cards Display --}}
        {{-- Start Cards Display --}}
        @if(isset($filters['date_from']) || isset($filters['date_to']) || isset($filters['gender_id']) || isset($filters['language_id']))
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
        @endif
        {{-- End Cards Display --}}

        {{-- End Cards Display --}}

        {{-- {{ $data }} --}}
        <div class="table-responsive" style="margin-left: auto; margin-right: auto; width: fit-content;" hidden>
            <table class="table table-rounded border gy-7 gs-7">
                <thead>
                    <tr class="fw-semibold fs-6 text-dark border-bottom-2 bg-info-subtle">
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
                        <tr class="bg-light">
                            <td>{{ $record->membership_code }}</td>
                            <td>{{ $record->initials }}</td>
                            <td>{{ $record->surname }}</td>
                            <td>
                                @if ($record->gender_id == 'M')
                                    Male
                                @elseif ($record->gender_id == 'F')
                                    Female
                                @else
                                    Other
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($record->join_date)->format('Y-m-d') }}</td>
                            <td>
                                @if ($record->language_id == '1')
                                    English
                                @elseif ($record->language_id == '2')
                                    Afrikaans
                                @else
                                    Other
                                @endif
                            </td>

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


    <div class="m-7 p-2 bg-transparent">

        {{-- Start Data Statistics Overview --}}
        <div id="feature_two" class="card rounded-2 mb-2 shadow">
            <div>
                <h2 class="text-center m-5">Data Statistics Overview</h2>
            </div>

            <!--begin::Row-->
            <div class="row g-3 p-2">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::List widget 25-->
                    <div class="card bg-gradient px-5 pt-5 mt-5 mb-5 rounded-2 bg-light shadow-lg">
                        <div class="h-lg-50">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title text-gray-800 fs-1"
                                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                                    Total Memberships</h3>
                                <!--end::Title-->

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="text-gray-700 fw-semibold fs-5 me-2">All Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-senter">
                                        <!--begin::Number-->
                                        <span class="text-gray-900 fw-bolder fs-3">{{ $totalMemberships }}</span>
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
                                    <div class="text-gray-700 fw-semibold fs-5 me-2">Active Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-center">
                                        @if ($totalMembershipsActive < $totalMembershipsDeleted)
                                            <i class="ki-duotone ki-arrow-down-right fs-1 text-danger me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        @else
                                            <i class="ki-duotone ki-arrow-up-right fs-1 text-success me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        @endif
                                        <!--begin::Number-->
                                        <span class="text-gray-900 fw-bolder fs-3">{{ $totalMembershipsActive }}</span>
                                        <!--end::Number-->
                                        {{-- <span class="text-gray-400 fw-bold fs-6">/{{ $totalMemberships }}</span> --}}
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
                                    <div class="text-gray-700 fw-semibold fs-5 me-2">Deleted Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-senter">
                                        @if ($totalMembershipsActive > $totalMembershipsDeleted)
                                            <i class="ki-duotone ki-arrow-down-right fs-1 text-danger me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        @else
                                            <i class="ki-duotone ki-arrow-up-right fs-1 text-success me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        @endif
                                        <!--begin::Number-->
                                        <span class="text-gray-900 fw-bolder fs-3">{{ $totalMembershipsDeleted }}</span>
                                        <!--end::Number-->
                                        {{-- <span class="text-gray-400 fw-bold fs-6">/{{ $totalMemberships }}</span> --}}
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
                <div class="col-xl-8">
                    <!--begin::List widget 25-->
                    <div class="card bg-gradient px-5 pt-5 mt-5 mb-5 rounded-2 bg-light shadow-lg">
                        <div class="h-lg-50">
                            <!--begin::Header-->
                            <div class="card-header pt-5">
                                <!--begin::Title-->
                                <h3 class="card-title text-gray-800 fs-1"
                                    style="margin-left: auto; margin-right: auto; width: fit-content;">
                                    Memberships by Gender</h3>
                                <!--end::Title-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body pt-5">
                                <!--begin::Item-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Section-->
                                    <div class="text-gray-700 fw-semibold fs-5 me-2">All Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-senter">
                                        {{-- <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i> --}}
                                        <!--begin::Number-->
                                        <div class="text-gray-900 fw-bolder fs-3">
                                            @foreach ($membershipsByGender as $membership)
                                                <span>[
                                                    {{ $membership->count }}
                                                    @if (array_key_exists($membership->gender_id, $genders))
                                                        <!-- If the gender_id is in the genders array, dump the gender_id and show the badge with the gender name -->
                                                        {{-- @dump($membership->gender_id) <!-- This will show the gender_id being processed --> --}}
                                                        <span class="badge"
                                                            style="background-color: #ff7db0;">{{ $genders[$membership->gender_id] }}</span>
                                                    @else
                                                        <!-- If no match found in the genders array, show a default badge -->
                                                        <span class="badge bg-info-subtle text-dark">Others</span>
                                                    @endif
                                                    ]
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
                                    <div class="text-gray-700 fw-semibold fs-5 me-2">Active Memberships</div>
                                    <!--end::Section-->
                                    <!--begin::Statistics-->
                                    <div class="d-flex align-items-senter">
                                        {{-- <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i> --}}
                                        <!--begin::Number-->
                                        <div class="text-gray-900 fw-bolder fs-3">
                                            @foreach ($membershipsByGenderActive as $membership)
                                               <span>[
                                                    {{ $membership->count }}
                                                    @if (array_key_exists($membership->gender_id, $genders))
                                                        <!-- If the gender_id is in the genders array, dump the gender_id and show the badge with the gender name -->
                                                        {{-- @dump($membership->gender_id) <!-- This will show the gender_id being processed --> --}}
                                                        <span class="badge"
                                                            style="background-color: #ff7db0;">{{ $genders[$membership->gender_id] }}</span>
                                                    @else
                                                        <!-- If no match found in the genders array, show a default badge -->
                                                        <span class="badge bg-info-subtle text-dark">Others</span>
                                                    @endif
                                                    ]
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                </div>
                                <!--begin::Separator-->
                            <div class="separator separator-dashed my-3 bg-dark"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="text-gray-700 fw-semibold fs-5 me-2">Deleted Memberships</div>
                                <!--end::Section-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-senter">
                                    {{-- <i class="ki-duotone ki-arrow-up-right fs-2 text-success me-2">
                                                                            <span class="path1"></span>
                                                                            <span class="path2"></span>
                                                                        </i> --}}
                                    <!--begin::Number-->
                                    <div class="text-gray-900 fw-bolder fs-3">
                                        @foreach ($membershipsByGenderDeleted as $membership)
                                            <span>[
                                                    {{ $membership->count }}
                                                    @if (array_key_exists($membership->gender_id, $genders))
                                                        <!-- If the gender_id is in the genders array, dump the gender_id and show the badge with the gender name -->
                                                        {{-- @dump($membership->gender_id) <!-- This will show the gender_id being processed --> --}}
                                                        <span class="badge"
                                                            style="background-color: #ff7db0;">{{ $genders[$membership->gender_id] }}</span>
                                                    @else
                                                        <!-- If no match found in the genders array, show a default badge -->
                                                        <span class="badge bg-info-subtle text-dark">Others</span>
                                                    @endif
                                                    ]
                                                </span>
                                        @endforeach
                                    </div>

                                    <!--end::Number-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
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
    {{-- <div id="feature_two" class="border border-solid bg-secondary rounded-2 my-5">
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
        </div> --}}
    {{-- End Membership by Age --}}

    {{-- Start Membership Trends Graph --}}
    <div id="feature_two" class="border border-solid bg-secondary rounded-2 my-5 shadow-lg hidden">
        <div style="margin-left: auto; margin-right: auto; width: fit-content;">
            <h2 class="m-5">Membership Trends Overview</h2>
        </div>

        <!--begin::Row-->
        <!-- For All Memberships -->
        <div class="card m-4 bg-light">
            <div class="card-header mx-auto">
                <h4 class="card-title text-center">All Yearly Membership Trends</h4>
            </div>
            <div class="card-body rounded">
                <canvas id="allMembershipsChart"></canvas>
            </div>
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-3 g-xl-6 mb-xl-5 p-3">
            <!--begin::Col-->
            <div class="col-xl-6">
                <!-- For Active Memberships -->
                <div class="card bg-light">
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
                <div class="card bg-light">
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
    <div id="feature_one" class="border border-solid bg-secondary rounded-2 p-4 hidden">
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
    <div id="feature_two" class="border border-solid bg-secondary rounded-2 my-5 hidden">
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
    {{-- <div id="feature_one" class="border border-solid bg-secondary rounded-2">
            <div style="margin-left: auto; margin-right: auto; width: fit-content;">
                <h2 class="m-5">Members Owing Insight(Monthly based)</h2>
            </div>
            <canvas id="myPolarAreaChart" width="50" height="50"></canvas>
        </div> --}}
    {{-- End Display Gender-Wise Owe Count --}}

    {{-- Start Gender-Wise Count --}}
    <div id="feature_one" class="border border-solid bg-secondary rounded-2 mt-4 hidden">
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
                                @if ($genderCount->gender_id === '1')
                                    Male(s)
                                @elseif ($genderCount->gender_id === '2')
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


    {{-- <div id="drag-container" class="border border-solid">
            @foreach ($items as $item)
                <div draggable="true" id="item-{{ $item->id }}" class="draggable-item">
                    {{ $item->name }}
                </div>
            @endforeach
        </div> --}}
@endsection

@push('scripts')
    {{-- Start Preparing The Gender-Wise Data --}}
    @php
        $labels = [];
        $data = [];
        $colors = [
            'rgb(42, 82, 190)',
            'rgb(255, 97, 56)',
            'rgb(173, 255, 195)',
            'rgb(255, 105, 180)',
            'rgb(255, 223, 0)',
            'rgb(198, 21, 21)',
            'rgb(64, 224, 208)',
            'rgb(250, 128, 114)',
        ]; // Add more colors if needed
        $index = 0;
        foreach ($unpaidMembersGrouped as $group) {
            if ($group->months_owed_group <= 6) {
                $labels[] = $group->months_owed_group . ' months';
                $data[] = $group->member_count;
            } else {
                $labels[] = '7 months+';
                // $data[] = $group->member_count;
            }
            $index++;
        }
    @endphp
    {{-- End Preparing The Gender-Wise Data --}}

    {{-- Start Gender-Wise Data Displaying --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const data = {
                labels: @json($labels),
                datasets: [{
                    label: 'Months Owed by Members',
                    data: @json($data),
                    backgroundColor: @json($colors)
                }]
            };

            const config = {
                type: 'polarArea',
                data: data,
                options: {}
            };

            var ctx = document.getElementById('myPolarAreaChart').getContext('2d');
            new Chart(ctx, config);
        });
    </script>
    {{-- End Gender-Wise Data Display --}}


    {{-- Start Membership Trends Graph --}}
    <script>
        // Data for All Memberships
        var allMembershipsData = {
            labels: [
                @foreach ($yearlyMembershipTrends as $trend)
                    "{{ $trend->year }}",
                @endforeach
            ],
            datasets: [{
                label: 'All Memberships',
                data: [
                    @foreach ($yearlyMembershipTrends as $trend)
                        "{{ $trend->count }}",
                    @endforeach
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };

        // Data for Active Memberships
        var activeMembershipsData = {
            labels: [
                @foreach ($yearlyMembershipTrendsActive as $trend)
                    "{{ $trend->year }}",
                @endforeach
            ],
            datasets: [{
                label: 'Active Memberships',
                data: [
                    @foreach ($yearlyMembershipTrendsActive as $trend)
                        "{{ $trend->count }}",
                    @endforeach
                ],
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        };

        // Data for Deleted Memberships
        var deletedMembershipsData = {
            labels: [
                @foreach ($yearlyMembershipTrendsDeleted as $trend)
                    "{{ $trend->year }}",
                @endforeach
            ],
            datasets: [{
                label: 'Deleted Memberships',
                data: [
                    @foreach ($yearlyMembershipTrendsDeleted as $trend)
                        "{{ $trend->count }}",
                    @endforeach
                ],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        };

        // Create the charts
        new Chart(document.getElementById('allMembershipsChart'), {
            type: 'line',
            data: allMembershipsData
        });

        new Chart(document.getElementById('activeMembershipsChart'), {
            type: 'line',
            data: activeMembershipsData
        });

        new Chart(document.getElementById('deletedMembershipsChart'), {
            type: 'line',
            data: deletedMembershipsData
        });
    </script>
    {{-- End Membership Trends Graph --}}

    {{-- Start Filter Date Pickers --}}
    <script>
        $("#kt_datepicker_1").flatpickr();
        $("#kt_datepicker_2").flatpickr();
    </script>
    {{-- End Filter Date Pickers --}}

    {{-- Start Gender-Wise Owing Chart --}}

    {{-- End Gender-Wise Owing Chart --}}

    {{-- Start Gender-Wise Graph --}}

    {{-- End Gender-Wise Graph --}}

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    <!--end::Custom Javascript-->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let draggables = document.querySelectorAll('.draggable-item');

            draggables.forEach(draggable => {
                draggable.addEventListener('dragstart', function(event) {
                    event.dataTransfer.setData("text/plain", event.target.id);
                });
            });

            let container = document.getElementById('drag-container');
            container.addEventListener('dragover', function(event) {
                event.preventDefault();
            });

            container.addEventListener('drop', function(event) {
                event.preventDefault();
                let data = event.dataTransfer.getData("text");
                let droppedElement = document.getElementById(data);
                container.appendChild(droppedElement);
                // Call function to update order in backend
                updateOrderOnBackend(droppedElement.id);
            });
        });

        function updateOrderOnBackend(itemId) {
            // AJAX request to Laravel backend
            // Example: axios.post('/update-order', { itemId: itemId })
        }
    </script>
@endpush
