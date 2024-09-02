@extends('layouts.app2')

@section('row_content')
    <div class="card">
        <div class="card-header border-0 pt-6">
            <h2 style="margin-left: auto; margin-right: auto; width: fit-content;">Data</h2>
        </div>

        <div class="card-body py-4">
            <div class="table-responsive">
                <table id="kt_datatable_horizontal_scroll" class="table table-striped table-row-bordered gy-5 gs-7"
                    style="border: 3px solid rgb(21,23,23);">
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th class="min-w-150px">ID</th>
                            <th class="min-w-200px">Duplicate Identifiers</th>
                            <th class="min-w-200px">Identifiers Hash</th>
                            <th class="min-w-200px">Target Identifiers</th>
                            <th class="min-w-150px">Target Duplicate ID</th>
                            <th class="min-w-150px">Source DB</th>
                            <th class="min-w-200px">Source Table</th>
                            <th class="min-w-200px">Target Table</th>
                            <th class="min-w-300px">Details</th>
                            <th class="min-w-100px">Fixed</th>
                            <th class="min-w-150px">Created At</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($duplicates as $duplicate)
                            <tr>
                                <td>{{ $duplicate->id }}</td>
                                <td>{{ $duplicate->duplicate_record_identifiers }}</td>
                                <td>{{ $duplicate->duplicate_record_identifiers_hash }}</td>
                                <td>{{ $duplicate->target_duplicate_identifiers }}</td>
                                <td>{{ $duplicate->target_duplicate_id }}</td>
                                <td>{{ $duplicate->source_db_name }}</td>
                                <td>{{ $duplicate->source_table_name }}</td>
                                <td>{{ $duplicate->target_table_name }}</td>
                                <td>{{ $duplicate->duplicate_details }}</td>
                                <td>{{ $duplicate->fixed }}</td>
                                <td>{{ $duplicate->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <script>
                $("#kt_datatable_horizontal_scroll").DataTable({
                    "scrollX": true
                });
            </script>
        </div>
    </div>

@endsection

