@extends('layouts.app2')

@section('row_content')
    <div class="card">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Commissions</span>
                {{-- <span class="text-muted mt-1 fw-semibold fs-7">See All Dependants.</span> --}}
            </h3>
        </div>
        <!--end::Header-->
        <!-- New Table for Commission Rates -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Commission Rate</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($commissionRates as $rate)
                    <tr>
                        <td>{{ $rate->id }}</td>
                        <td>{{ $rate->rate }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    </div>
@endsection
