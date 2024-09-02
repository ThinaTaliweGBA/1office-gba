
 {{-- Slightly good data table --}}
 {{-- <!DOCTYPE html>
<html>
<head>
    <title>Dynamic DataTable with jQuery</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <style>
        table tr th {
            background: forestgreen;
            color: white;
            text-align: left;
            vertical-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="panel">
            <div class="panel-heading border">
                <h2>Data tables</h2>
            </div>
            <div class="panel-body">
                <table class="table table-bordered bordered table-striped table-condensed" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows will be added here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script>
        var data = [
            { id: 1, name: 'Tiger Nixon', position: 'System Architect', office: 'Edinburgh', age: 61, startDate: '2011/04/25' },
            { id: 2, name: 'Garrett Winters', position: 'Accountant', office: 'Tokyo', age: 63, startDate: '2011/07/25' },
            // More data here
        ];
        
        $(document).ready(function() {
            // Append data to table
            $.each(data, function(index, item) {
                var row = $('<tr>').append(
                    $('<td>').text(index + 1),
                    $('<td>').text(item.name),
                    $('<td>').text(item.position),
                    $('<td>').text(item.office),
                    $('<td>').text(item.age),
                    $('<td>').text(item.startDate)
                );
                $('#example tbody').append(row);
            });

            // Initialize DataTables after appending data
            $('#example').DataTable();
        });
    </script>
</body>
</html>

 --}}




 {{-- @extends('layouts.app1')

@push('styles')
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    @endpush

@section('content')

   <div class="container">
        <div class="panel">
            <div class="panel-heading border">
                <h2>Data tables</h2>
            </div>
            <div class="panel-body">
                <table class="table table-bordered bordered table-striped table-condensed" id="example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start Date</th>
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
        var data = [
            { id: 1, name: 'Tiger Nixon', position: 'System Architect', office: 'Edinburgh', age: 61, startDate: '2011/04/25' },
            { id: 2, name: 'Garrett Winters', position: 'Accountant', office: 'Tokyo', age: 63, startDate: '2011/07/25' },
            // More data here
        ];
        
        $(document).ready(function() {
            // Append data to table
            $.each(data, function(index, item) {
                var row = $('<tr>').append(
                    $('<td>').text(index + 1),
                    $('<td>').text(item.name),
                    $('<td>').text(item.position),
                    $('<td>').text(item.office),
                    $('<td>').text(item.age),
                    $('<td>').text(item.startDate)
                );
                $('#example tbody').append(row);
            });

            // Initialize DataTables after appending data
            $('#example').DataTable();
        });
    </script>

@endpush  --}}


 @extends('layouts.app1')

 @push('styles')
     {{-- CDN links for DataTables CSS could be added here if needed --}}
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
                             <th>#</th>
                             <th>Name</th>
                             <th>Position</th>
                             <th>Office</th>
                             <th>Age</th>
                             <th>Start Date</th>
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
     {{-- Adjustments to include DataTables script if not part of the global setup --}}

     <script>
         var myJQuery = jQuery.noConflict(true);

         myJQuery(document).ready(function($) {
             // Data array
var data = [
    { id: 1, name: 'Tiger Nixon', position: 'System Architect', office: 'Edinburgh', age: 61, startDate: '2011/04/25' },
    { id: 2, name: 'Garrett Winters', position: 'Accountant', office: 'Tokyo', age: 63, startDate: '2011/07/25' },
    { id: 32, name: 'Suki Burks', position: 'Developer', office: 'London', age: 53, startDate: '2009/10/22' }
];



             // Append data to table
             $.each(data, function(index, item) {
                 var row = $('<tr>').append(
                     $('<td>').text(index + 1),
                     $('<td>').text(item.name),
                     $('<td>').text(item.position),
                     $('<td>').text(item.office),
                     $('<td>').text(item.age),
                     $('<td>').text(item.startDate)
                 );
                 $('#example tbody').append(row);
             });

             // Check if DataTable initializes
             console.log("Initializing DataTable");

             // Initialize DataTables after appending data
             $('#example').DataTable();
         });
     </script>
 @endpush





{{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


@extends('layouts.app2')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.dataTables.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid green;
            background-color: #f5f5f5;
            /* Updated background color for better readability */
            max-width: 90%;
            border-radius: 5px;
        }

        #membershipsTable {
            width: 100%;
        }

        #membershipsTable thead {
            background-color: forestgreen;
            color: white;
        }

        #membershipsTable tbody tr {
            background-color: lightgreen;
        }
    </style>
@endpush

@section('content')
    <h1 style="text-align: center; padding: 2px; margin: 2px;">Deaths</h1>

    <div class="container bg-gba-light">
        <table id="membershipsTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Membership ID</th>
                    <th>Main Member</th>
                    <th>Dependant</th>
                    <th>Relationship</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($membershipsDependant as $membership)
                    <!-- Main Member Row -->
                    {{-- <tr>
                        <td>{{ $membership->membership_code }}</td>
                        <td>{{ $membership->person->first_name }}</td>
                        <td></td>
                        <td></td>
                    </tr> --}}
                    @if ($membership->person->dependant->isEmpty())
                        <!-- Row indicating no dependants -->
                        <tr>
                            <td>{{ $membership->membership_code }}</td>
                            <td>{{ $membership->person->first_name }}</td>
                            <td colspan="2" style="color: red;">No dependants</td>
                            <td></td>
                        </tr>
                    @else
                        <!-- Rows for each dependant -->
                        @foreach ($membership->person->dependant as $dependant)
                            <tr>
                                <td>{{ $membership->membership_code }}</td>
                                <td>{{ $membership->person->first_name }}</td>
                                <td>{{ $dependant->personDep->first_name }}</td>
                                <td>{{ $dependant->relationshipType->name }}</td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>

        </table>
    </div>


@endsection

@push('scripts')

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>

    <script>
        var myJQuery = jQuery.noConflict(true);
        myJQuery(document).ready(function($) {
            var table = $('#membershipsTable').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 0
                }],
                "order": [
                    [0, 'asc']
                ],
                "rowGroup": {
                    "dataSrc": 0,
                    "startRender": function(rows, group) {
                        return $('<tr/>')
                            .append('<td colspan="4">Membership ID: ' + group + '</td>')
                            .attr('data-group', group)
                            .toggleClass('collapsed', false);
                    }
                }
            });

            $('#membershipsTable tbody').on('click', 'tr.dtrg-start', function() {
                var group = $(this).data('group');
                var collapsedRows = table.rows('[data-group="' + group + '"]').nodes();
                $(collapsedRows).toggle();
            });
        });
    </script>
@endpush
