@extends('layouts.app2')

@section('row_content')
    <div class="card" style="border: 2px gray dotted" class="bg-gradient">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Commissions</span>
                {{-- <span class="text-muted mt-1 fw-semibold fs-7">See All Dependants.</span> --}}
            </h3>
        </div>
        <!--end::Header-->
        <!-- Start Table for Commission Rates -->
        <table class="table table-bordered">
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
        <!-- End Table for Commission Rates -->
        <br>
        <form action="{{ route('commission.store') }}" method="post" style="margin-left: auto; margin-right: auto; width: fit-content; border: 2px gray dotted" class="bg-primary my-2">
            @csrf
            <label for="rate">Commission Rate (%):</label>
            <input type="number" name="rate" id="rate" required>
            <!-- Fields for rate -->
            <button type="submit" style="btn btn-success">Add Rate</button>
        </form>
    </div>
@endsection
