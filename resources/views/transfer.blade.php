<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Transfer</title>

    <style>
        .script-output-container {
            position: relative; /* Needed to contain the absolute positioned pre tag */
            padding: 0;
            border: 1px solid #dee2e6; /* Match Bootstrap's card body border */
            height: 300px; /* Fixed height for the output area */
            overflow-y: auto; /* Enable vertical scrolling */
            background-color: #f8f9fa; /* Match Bootstrap's card body background */
        }
    
        #script-output {
            position: absolute; /* Absolute position within the container */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: 0; /* Remove default margin */
            padding: 0.75rem; /* Add some padding */
            border: none; /* Remove default border */
            white-space: pre-wrap; /* Ensures the text wraps */
            overflow-wrap: break-word; /* Breaks the words to prevent horizontal scrolling */
        }
    </style>
    
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
                        <form method="POST" action="/transfer">
                            @csrf
                            <div class="form-group">
                                <label for="database">Select database:</label>
                                <select class="form-control" id="database" name="database">
                                    <!-- Databases will be populated here using AJAX -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="table">Select table:</label>
                                <select class="form-control" id="table" name="table">
                                    <!-- Tables will be populated here using AJAX -->
                                </select>
                            </div>
                            <!-- Add other inputs as needed -->
                            <button type="submit" class="btn btn-primary">Run Script</button>
                        </form>


                        <div id="script-status" class="alert alert-success" style="{{ empty($success) ? 'display: none;' : '' }}">
                            {{ $success ?? 'Waiting for script to run...' }}
                        </div>
                        


                        <div class="row justify-content-center mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">Script Output</div>
                                    <!-- Add a custom class to the script output container for styling -->
                                    <div class="card-body script-output-container">
                                        <pre id="script-output">Output will appear here...</pre>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- @if (!empty($output))
                            <h3>Script Output</h3>
                            <pre>{{ $output }}</pre>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>


    {{-- @if(!empty($error))
    <div class="alert alert-danger">
        <ul>
            @foreach ($error as $line)
                <li>{{ $line }}</li>
            @endforeach
        </ul>
    </div>
    @endif --}}


        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">Mappings For Selected (Source_table and Target_table)</div>

                    <div class="card-body col-md-12">
                        <!-- Mappings will be displayed here -->
                        <div id="mappings" style="max-width: 100%; overflow-x: auto;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    




    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            function loadMappings() {
                var selectedMapping = $('#table').val();
                $.get('/get-mappings/' + encodeURIComponent(selectedMapping), function(data) {
                    var mappings = data;
                    var mappingsDiv = $('#mappings');
                    mappingsDiv.empty();
                    var table = $('<table></table>').addClass('table table-striped');
                    var thead = $('<thead></thead>');
                    thead.append('<tr><th>Source DB</th><th>Source Table</th><th>Source Column</th><th>Target DB</th><th>Target Table</th><th>Target Column</th></tr>');
                    table.append(thead);
                    var tbody = $('<tbody></tbody>');
                    $.each(mappings, function(key, value) {
                        tbody.append('<tr><td>' + value.source_db + '</td><td>' + value.source_table + '</td><td>' + value.source_column + '</td><td>' + value.target_db + '</td><td>' + value.target_table + '</td><td>' + value.target_column + '</td></tr>');
                    });
                    table.append(tbody);
                    mappingsDiv.append(table);
                });
            }
        
            $('#table').change(loadMappings);
        
            $.get('/get-databases', function(data) {
                var databases = data;
                var databaseSelect = $('#database');
                databaseSelect.empty();
                $.each(databases, function(key, value) {
                    databaseSelect.append($('<option></option>').val(value.source_db).text(value.source_db));
                });
                // Trigger a change event to load the tables for the selected database
                databaseSelect.change();
            });
        
            $('#database').change(function() {
                var selectedDatabase = $(this).val();
                $.get('/get-tables/' + selectedDatabase, function(data) {
                    var tableSelect = $('#table');
                    tableSelect.empty();
                    $.each(data, function(index, sourceTargetPair) {
                        tableSelect.append($('<option></option>').val(sourceTargetPair).text(sourceTargetPair));
                    });
                    // Call loadMappings after populating the table select
                    loadMappings();
                });
            });
        });
        </script>









<script>
    let scriptStarted = false; // Flag to track if the script has started
    let fetchingOutput = false; // Flag to track if the output is being fetched

    function updateOutput() {
        if (fetchingOutput) return; // Skip if already fetching output
        fetchingOutput = true;
        console.log("Fetching script output...");
        fetch('/get-script-output')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok for get-script-output');
                }
                return response.json();
            })
            .then(data => {
                console.log("Output received:", data);
                if (data.output) {
                    let outputElement = document.getElementById('script-output');
                    outputElement.textContent += data.output;
                    outputElement.scrollTop = outputElement.scrollHeight;
                }
                fetchingOutput = false; // Reset flag after fetching
            })
            .catch(error => {
                console.error('Error fetching script output:', error);
                fetchingOutput = false; // Reset flag on error
            });
    }

    function checkScriptStatus() {
        console.log("Checking script status...");
        fetch('/check-script-status')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok for check-script-status');
                }
                return response.json();
            })
            .then(data => {
                console.log("Script status:", data.status);
                if (data.status === 'completed') {
                    document.getElementById('script-status').textContent = 'Script has completed.';
                    clearInterval(intervalId);
                    clearInterval(errorIntervalId);
                }
            })
            .catch(error => console.error('Error checking script status:', error));
    }

    function checkForScriptError() {
        if (!scriptStarted || fetchingOutput) return; // Skip if script hasn't started or output is being fetched
        fetch('/get-latest-script-error')
            .then(response => response.json())
            .then(data => {
                if (data.error && data.error !== 'No error found.') {
                    let statusElement = document.getElementById('script-status');
                    statusElement.textContent = 'Error: ' + data.error;
                    statusElement.classList.remove('alert-success');
                    statusElement.classList.add('alert-danger');
                    statusElement.style.display = 'block';
                    clearInterval(intervalId);
                    clearInterval(errorIntervalId);
                }
            })
            .catch(error => console.error('Error fetching script error:', error));
    }

    function updateUI() {
        updateOutput();
        checkScriptStatus();
    }

    let intervalId = setInterval(updateUI, 3000); 
    let errorIntervalId = setInterval(checkForScriptError, 5000); 

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize script-status element
        const scriptStatusElement = document.getElementById('script-status');
        scriptStatusElement.style.display = 'none';
        scriptStatusElement.textContent = '';

        const form = document.querySelector('form');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            fetch('/transfer', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok for /transfer');
                }
                return response.json();
            })
            .then(data => {
                scriptStatusElement.style.display = 'block';
                scriptStatusElement.textContent = data.success || 'Script is running...';
                scriptStarted = true;
                updateUI();
            })
            .catch(error => {
                console.error('Error during form submission:', error);
            });
        });
    });
</script>


        
    
</body>
</html>
