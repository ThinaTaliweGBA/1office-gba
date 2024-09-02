<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Transfer</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Data Transfer</div>

                    <div class="card-body">
                        <form id="transferForm" method="POST" action="/transfer">
                            @csrf

                            <div class="mb-3">
                                <label for="table" class="form-label">Select Table:</label>
                                <select class="form-select" name="table" id="table" required>
                                    @foreach ($mappings->unique('source_table') as $mapping)
                                        <option value="{{ $mapping->source_table }}">{{ $mapping->source_table }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="mappingTableContainer"></div>

                            <button type="submit" class="btn btn-primary">Start Transfer</button>
                        </form>
                    </div>
                         @if (!empty($output))
                    <h3>Script Output</h3>
                    <pre>{{ $output }}</pre>
                @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        // Fetch and display mappings when the selected table changes
        $('#table').change(function() {
            var selectedTable = $(this).val();
            $.get('/mappings/' + selectedTable, function(data) {
                var tableHtml = '<h5 class="mb-3">' + selectedTable + '</h5>' +
                                '<table class="table table-striped mb-4">' +
                                    '<thead><tr><th scope="col">Source</th><th scope="col">Target</th></tr></thead>' +
                                    '<tbody>';
                $.each(data, function(i, mapping) {
                    tableHtml += '<tr><td>' + mapping.source_db + '.' + mapping.source_table + '.' + mapping.source_column + '</td>' +
                                 '<td>' + mapping.target_db + '.' + mapping.target_table + '.' + mapping.target_column + '</td></tr>';
                });
                tableHtml += '</tbody></table>';
                $('#mappingTableContainer').html(tableHtml);
            });
        });

        // Trigger change event to load mappings for the initially selected table
        $('#table').trigger('change');
    });
    </script>
</body>
</html>
