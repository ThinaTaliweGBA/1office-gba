@extends('layouts.app2')

@push('styles')
    <!-- DataTables CSS CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="panel">
            <div class="panel-heading border">
                <h2 class="bg-gba">Data tables</h2>
            </div>
            <div class="panel-body">
                <table class="table table-bordered bordered table-striped table-condensed bg-gba-light" id="example">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Address Type ID</th>
                            <th>Line 1</th>
                            <th>Suburb</th>
                            <th>City</th>
                            <th>ZIP</th>
                            <th>District</th>
                            <th>Province</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be added here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

    <script>
     var myJQuery = jQuery.noConflict(true);

         myJQuery(document).ready(function($) {
            // The URL from which to fetch the data

            // AJAX request to fetch the data
            $.ajax({
                url: '/logs',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Append data to table
                    $.each(data, function(index, item) {
                        var row = $('<tr>').append(
                            $('<td>').text(item.id),
                            $('<td>').text(item.adress_type_id),
                            $('<td>').text(item.line1),
                            $('<td>').text(item.suburb),
                            $('<td>').text(item.city),
                            $('<td>').text(item.ZIP),
                            $('<td>').text(item.district),
                            $('<td>').text(item.province)
                        );
                        $('#example tbody').append(row);
                    });

                    // Initialize DataTables after appending data
                    $('#example').DataTable();
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>
@endpush