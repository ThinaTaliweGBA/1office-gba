@extends('layouts.app2')

@section('row_content')
    <div class="card">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Reports</span>
                <span class="text-muted mt-1 fw-semibold fs-7">See All Reports.</span>
            </h3>
        </div>
        <!--end::Header-->
        <div class="px-4 pb-4">
            <ul>
                @foreach ($reports as $report)
                    <li>
                        <a href="{{ route('reports.show', ['report' => $report->id]) }}">
                            {{ $report->report_type }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
