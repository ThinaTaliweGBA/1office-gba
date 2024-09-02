@extends('layouts.app2')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('row_content')
    <div class="card pb-4">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Create New Sales Transaction</span>
                {{-- <span class="text-muted mt-1 fw-semibold fs-7">See All Dependants.</span> --}}
            </h3>
            <a href="{{ url()->previous() }}" class="btn btn-light mb-3">
                <i class="fas fa-arrow-left"></i>Back
            </a>
        </div>
        <!--end::Header-->
        <!-- New Table for Commission Rates -->
        <div class="border border-solid pt-4 ps-8 mx-6">
        <form action="{{ route('sales.store') }}" method="post">
            @csrf
            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" id="product_name" required class="mb-4">
            <br>
            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" required class="mb-4 mx-8">
            <br>
            <label for="commission_rate_id">Commission Rate:</label>
            <select name="commission_rate_id" id="commission_rate_id" required class="mb-4">
                <option value="">Select Commission Rate</option>
                @foreach($rates as $rate)
                    <option value="{{ $rate->id }}">{{ $rate->rate }}%</option>
                @endforeach
            </select>
            <br>
            <!-- Fields for product_name, amount, commission_rate_id -->
            <button type="submit" class="btn bg-info">Add Transaction</button>
        </form>
    </div>
    </div>
@endsection
