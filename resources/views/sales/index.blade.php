@extends('layouts.app2')

@section('row_content')
    <div class="card pb-4">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">All Sales</span>
                {{-- <span class="text-muted mt-1 fw-semibold fs-7">See All Dependants.</span> --}}
            </h3>
        </div>
        <!--end::Header-->
        <!-- New Table for Commission Rates -->
        <table>
            <thead class="bg-primary">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Commission Rate</th>
                </tr>
            </thead>
            <tbody class="bg-gradient">
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->product_name }}</td>
                        <td>{{ $transaction->amount }}</td>
                        <td>{{ $transaction->commissionRate->rate }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="row">
            <div class="col-4">
                <button class="btn btn-info"><a href="{{ route('sales.report') }}" target="_blank">Export to PDF</a></button>
                <button class="btn btn-success"><a href="{{ route('sales.create') }}" target="_blank">Add New</a></button>
            </div>
        </div>
    </div>
@endsection
