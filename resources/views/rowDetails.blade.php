@extends('layouts.app2')

@push('styles')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .collapsible {
            cursor: pointer;
            background-color: #e0e0e0;
        }

        .collapsible:hover {
            background-color: #cccccc;
        }

        .hidden {
            display: none;
        }

        #chart-container {
            width: 80%;
            margin: 20px auto;
        }
    </style>
    <!-- Add these lines in the <head> section of your HTML -->
    <!-- Link to Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Link to Select2 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>
@endpush

@section('content')

    <div class="m-8">
        <div class="card shadow">
        <div class="card-header ">
                <h2 class="card-title mx-auto mb-4">Payments Report</h2>
                </div>
            <div class="card-body">
            
                <div class="row">
                    <div class="col-md-4 col-4">
                        <div class="card shadow">
                        <div class="card-header bg-gray">
                <h2 class="card-title mx-auto">Payment Search</h2>
                </div>
                            <div class="card-body">
                                <form method="GET" action="{{ route('api.rowdetails') }}">
                                    <div class="mb-3">
                                        <label for="membership_id" class="form-label">Membership ID</label>
                                        
                                        <select class="form-select select2 border border-dark" id="membership_id" name="membership_id">
                                            <option value="">Select Membership ID</option>
                                            @foreach ($memberships as $membership)
                                                <option value="{{ $membership->id }}"
                                                    {{ request('membership_id') == $membership->id ? 'selected' : '' }}>
                                                    {{ $membership->id }} - {{ $membership->name }}
                                                    {{ $membership->surname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date"
                                                value="{{ request('start_date') }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date"
                                                value="{{ request('end_date') }}">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-filter btn-success btn-sm text-center card-center w-50">Filter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-8">
                        <div class="card shadow">
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="kt_payment_table">
                                    <thead class="bg-secondary p-4">
                                        <tr>
                                            <th>ID</th>
                                            <th>Membership ID</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction Description</th>
                                            <th>Receipt Number</th>
                                            <th>Amount Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->membership_id }}</td>
                                                <td>{{ $payment->transaction_date }}</td>
                                                <td>{{ $payment->transaction_description }}</td>
                                                <td>{{ $payment->receipt_number }}</td>
                                                <td>{{ $payment->receipt_value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>

                                <!-- Pagination links -->
                                <div class="m-2 p-2 text-center bg-secondary pt-2" style="border: 2px solid black;">
                                    {{-- Pagination links --}}
                                    {{ $payments->appends(Request::except('page'))->links() }}
                                    {{-- Display current page and total records --}}
                                    <div class="m-2">
                                        <span class="m-4">Page {{ $payments->currentPage() }} of
                                            {{ $payments->lastPage() }} in {{ $payments->total() }} Total Record(s)</span>
                                    </div>
                                </div>

                                <p class="m-4">
                                    @if (!empty(request('membership_id')))
                                        @php
                                            $totalPayments = $payments->sum('receipt_value');
                                        @endphp
                                        <div class="card mt-4">
                                            <div class="card-body">
                                                <h5 class="card-title">Summary of Payments</h5>
                                                <p>Total payments made by Membership {{ request('membership_id') }} :
                                                    R{{ number_format($totalPayments, 2) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const collapsibles = document.querySelectorAll('.collapsible');
            collapsibles.forEach(collapsible => {
                collapsible.addEventListener('click', function() {
                    const groupIndex = this.getAttribute('data-index');
                    const groupRows = document.querySelectorAll(`.group-${groupIndex}`);
                    groupRows.forEach(row => row.classList.toggle('hidden'));
                });
            });

            // Prepare the data for Chart.js
            var paymentDates = {!! json_encode($payments->pluck('transaction_date')->toArray()) !!};
            var receiptValues = {!! json_encode($payments->pluck('receipt_value')->toArray()) !!};

            // Create the chart
            var ctx = document.getElementById('paymentsChart').getContext('2d');
            var paymentsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: paymentDates,
                    datasets: [{
                        label: 'Receipt Value',
                        data: receiptValues,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day'
                            },
                            title: {
                                display: true,
                                text: 'Transaction Date'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Receipt Value'
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.membership_id').select2();
            var selectedMembershipId = $(this).val();
            var selectedMembership = $(this).find('option:selected').text();
            console.log('Selected Membership ID: ' + selectedMembershipId + ', Details: ' + selectedMembership);
        });
    </script>

    <script>
        $("#kt_payment_table").DataTable();
    </script>
@endpush