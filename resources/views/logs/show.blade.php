@extends('layouts.app2')

@push('styles')
@endpush

@section('content')
<h1>Hello</h1>

@foreach ($addresses as $address)
    <p>{{ $address->address_line }}</p> {{-- Adjust based on your actual column name --}}
@endforeach
<div id="table-container"></div>
    <!-- Address data will be loaded here dynamically -->
    <!-- resources/views/addresses/list.blade.php -->
</div>
<h1>Hello boo</h1>

@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    // The URL from which to fetch the data
    var url = "<?php echo env('LOGS_URL'); ?>";
    
    // AJAX request to fetch the data
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Call the function to build the table
            var table = buildTable(data);
            // Insert the table into the div with id="table-container"
            $('#table-container').html(table);
        },
        error: function(error) {
            console.error('Error fetching data:', error);
            $('#table-container').html('<p>Error loading data</p>');
        }
    });

    // Function to dynamically build the table based on the data
    function buildTable(data) {
        var table = '<table border="1"><tr><th>ID</th><th>Address Type ID</th><th>Line 1</th><th>Suburb</th><th>City</th><th>ZIP</th><th>District</th><th>Province</th></tr>';
        $.each(data, function(index, item) {
            table += '<tr>' +
                        '<td>' + item.id + '</td>' +
                        '<td>' + item.adress_type_id + '</td>' +
                        '<td>' + item.line1 + '</td>' +
                        '<td>' + item.suburb + '</td>' +
                        '<td>' + item.city + '</td>' +
                        '<td>' + item.ZIP + '</td>' +
                        '<td>' + item.district + '</td>' +
                        '<td>' + item.province + '</td>' +
                     '</tr>';
        });
        table += '</table>';
        return table;
    }
});
</script>

@endpush
