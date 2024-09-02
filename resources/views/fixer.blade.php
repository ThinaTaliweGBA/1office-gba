@extends('layouts.app2')

@push('styles')
    <title>Transfer Logs</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        .container {
            max-width: 960px;
            margin: 0 auto;
        }

        .left {
            float: left;
            position: relative;
            width: 50%;
            height: 100%;
        }

        .right {
            float: left;
            position: relative;
            width: 40%;
            margin-left: 5%;
            height: 100%;
        }

        #display {
            background: #2d2d2d;
            border: 10px solid #000000;
            border-radius: 5px;
            font-size: 2em;
            color: white;
            height: 100px;
            min-width: 200px;
            text-align: center;
            padding: 1em;
            display: table-cell;
            vertical-align: middle;
        }

        #drag-elements {
            display: block;
            background-color: #dfdfdf;
            border-radius: 5px;
            min-height: 50px;
            margin: 0 auto;
            padding: 2em;
        }

        #drag-elements>div {
            text-align: center;
            float: left;
            padding: 1em;
            margin: 0 1em 1em 0;
            box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            border-radius: 100px;
            border: 2px solid #ececec;
            background: #F7F7F7;
            transition: all .5s ease;
        }

        #drag-elements>div:active {
            -webkit-animation: wiggle 0.3s 0s infinite ease-in;
            animation: wiggle 0.3s 0s infinite ease-in;
            opacity: .6;
            border: 2px solid #000;
        }

        #drag-elements>div:hover {
            border: 2px solid gray;
            background-color: #e5e5e5;
        }

        #drop-target {
            border: 2px dashed #D9D9D9;
            border-radius: 5px;
            min-height: 50px;
            margin: 0 auto;
            margin-top: 10px;
            padding: 2em;
            display: block;
            text-align: center;
        }

        #drop-target>div {
            transition: all .5s;
            text-align: center;
            float: left;
            padding: 1em;
            margin: 0 1em 1em 0;
            box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            border: 2px solid skyblue;
            background: #F7F7F7;
            transition: all .5s ease;
        }

        #drop-target>div:active {
            -webkit-animation: wiggle 0.3s 0s infinite ease-in;
            animation: wiggle 0.3s 0s infinite ease-in;
            opacity: .6;
            border: 2px solid #000;
        }

        @-webkit-keyframes wiggle {
            0% {
                -webkit-transform: rotate(0deg);
            }

            25% {
                -webkit-transform: rotate(2deg);
            }

            75% {
                -webkit-transform: rotate(-2deg);
            }

            100% {
                -webkit-transform: rotate(0deg);
            }
        }

        @keyframes wiggle {
            0% {
                transform: rotate(-2deg);
            }

            25% {
                transform: rotate(2deg);
            }

            75% {
                transform: rotate(-2deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        .gu-mirror {
            position: fixed !important;
            margin: 0 !important;
            z-index: 9999 !important;
            padding: 1em;
        }

        .gu-hide {
            display: none !important;
        }

        .gu-unselectable {
            -webkit-user-select: none !important;
            -moz-user-select: none !important;
            -ms-user-select: none !important;
            user-select: none !important;
        }

        .gu-transit {
            opacity: 0.5;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
            filter: alpha(opacity=50);
        }

        .gu-mirror {
            opacity: 0.5;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
            filter: alpha(opacity=50);
        }
    </style>

    <!-- Dragula CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css" />
    <!-- Dragula JS -->
    <script src="https://rawgit.com/bevacqua/dragula/master/dist/dragula.js"></script>
@endpush

@section('content')
    {{-- Dropdown Menu --}}

    <div class="rounded bg-secondary mx-8">
        <div class="row mt-5 mx-8">
            <div class="col-md-6 offset-md-3">
                <h2 class="mt-9" style="margin-left: auto; margin-right: auto; width: fit-content;">Data Sanitizer</h2>
                <h4 class="mt-4" style="margin-left: auto; margin-right: auto; width: fit-content;">Select Module and
                    Component</h4>
                <select id="module-select" class="form-control my-3">
                    <option disabled selected>Select a module</option>
                    <!-- Modules will be populated here -->
                </select>

                <select id="component-select" class="form-control my-3">
                    <option disabled selected>Select a component</option>
                    <!-- Components will be populated here -->
                </select>
            </div>
        </div>


        <!-- Unmatched Values Card -->
        <div class="row justify-content-center mt-5 mx-8">
            <div class="col-md-12">
                {{-- <div class="card">
                    <div class="card-header">Unmatched Values</div>
                    <div class="card-body">
                        <table id="unmatched-logs-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Source Table</th>
                                    <th>Target Table</th>
                                    <th>Missing Field</th>
                                    <th>Source Column</th>
                                    <th>Source Value</th>
                                    <th>Related Record</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Unmatched logs will be populated here -->
                            </tbody>
                        </table>
                    </div>
                </div> --}}
                <!-- Combined Card -->
                <div class="card mt-5 mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Unmatched Values</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Total unmatched records</span>
                        </h3><span>
                            <button id="countButton" type="button" class="btn btn-primary hover-scale"
                                data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                                Edit Checked Records
                            </button></span>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table id="unmatched-logs-table" class="table align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="rounded-start w-25px">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input ml-3 bg-primary hover-scale" type="checkbox"
                                                    value="1" data-kt-check="true"
                                                    data-kt-check-target=".widget-9-check" />
                                            </div>
                                        </th>
                                        <th class="ps-4 min-w-30px">ID</th>
                                        <th class="min-w-125px">Source Table</th>
                                        <th class="min-w-125px">Target Table</th>
                                        <th class="min-w-150px">Missing Field</th>
                                        <th class="min-w-150px">Source Column</th>
                                        <th class="min-w-150px">Source Value</th>
                                        <th class="min-w-150px">Related Record</th>
                                        <th class="pr-4 min-w-200px text-end rounded-end">Actions</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->

                                <tbody>
                                    <!-- Unmatched logs will be populated here -->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>




                {{--  HTML Button to Trigger the Alert --}}
                {{-- <button id="countButton" type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#kt_modal_1">
                    Edit Checked Records
                </button> --}}
                <!-- Button to trigger the modal -->
                <button id="countButton" class="btn btn-primary" style="display: none;">Edit Checked Records</button>




                <!-- Missing Values Card -->
                <div class="card mb-5 mb-xl-8 mt-5">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Missing Values</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Details of missing values</span>
                        </h3>
                        <!-- Uncomment this if you need a toolbar
                                                                                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Tooltip info">
                                                                                    <a href="#" class="btn btn-sm btn-light btn-active-primary">
                                                                                    <i class="ki-duotone ki-plus fs-2"></i>Action</a>
                                                                                </div>
                                                                                -->
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table id="missing-logs-table"
                                class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-30px rounded-start">ID</th>
                                        <th class="min-w-125px">Source Table</th>
                                        <th class="min-w-125px">Target Table</th>
                                        <th class="min-w-150px">Missing Field</th>
                                        <th class="min-w-150px">Source Column</th>
                                        <th class="min-w-50px">Source Value</th>
                                        <th class="min-w-150px">Related Record</th>
                                        <th class="pr-4 min-w-200px text-end rounded-end">Actions</th>
                                    </tr>
                                </thead>
                                {{-- <thead>
                                    <tr class="fw-bold text-muted">
                                        <th>ID</th>
                                        <th>Source Table</th>
                                        <th>Target Table</th>
                                        <th>Missing Field</th>
                                        <th>Source Column</th>
                                        <th>Source Value</th>
                                        <th>Related Record</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead> --}}
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody>
                                    <!-- Missing logs will be populated here -->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Body-->
                </div>



                {{-- <div style="text-align: center;" class="card my-4 p-3 container rounded content-container card-body">
                    <h2 class="pt-4">Resolution Type</h2>
                    <div class="pb-6 pt-2">
                    <select onchange="location = this.value;" class="form-control bg-light">
                        <option value="">Select Resolution</option>
                        <option value="{{ route('duplicates') }}">Duplicates</option>
                        <option value="{{ route('failedInserts') }}">Failed Inserts</option>
                        <option value="{{ route('unknownFixes') }}">Unmatched Fixes</option>
                    </select>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>

    {{-- Modal Structure in HTML --}}
    <!-- Bootstrap Modal -->

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="editModalLabel">Edit Records</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <!-- Content will be loaded here via JavaScript -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light hover-scale" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success hover-scale" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Modal Scripts --}}
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    {{-- JavaScript to Handle the Modal --}}
    <script>
        function showEditModal() {
            const checkedCheckboxes = document.querySelectorAll('.widget-9-check:checked');

            let modalBody = document.querySelector('#editModal .modal-body');
            modalBody.innerHTML = ''; // Clear previous content

            checkedCheckboxes.forEach((checkbox, index) => {

                // Assuming each checkbox has a data-record-id attribute
                let recordId = checkbox.getAttribute('data-record-id');

                // Fetch the record data. This could be from an array, an object, or a server request
                let recordData = getRecordDataById(recordId); // Implement this function based on your data source

                // Create a div to show the record data
                let div = document.createElement('div');
                div.innerHTML = `Record ${index + 1}: <input type='text' value='${recordData}' />`;
                modalBody.appendChild(div);




                // For each checked checkbox, create an element to edit
                // This is a simple example, you can customize it based on your needs
                let div = document.createElement('div');
                div.innerHTML = `Record ${index + 1}: <input type='text' value='Edit Record ${index + 1}' />`;
                modalBody.appendChild(div);
            });

            // Show the modal
            $('#editModal').modal('show');

        }
    </script>


    <!-- jQuery and Bootstrap 5 Bundle -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch modules
            $.get('/modules', function(data) {
                data.forEach(function(module) {
                    var badge = module.components.some(component => component.transfer_logs_count >
                        0) ? '( ! )' : '';
                    $('#module-select').append('<option value="' + module.id + '">' + module
                        .module_name + ' ' + badge + '</option>');
                });
            });

            // Fetch components when a module is selected
            $('#module-select').change(function() {
                var moduleId = $(this).val();
                $.get('/modules/' + moduleId + '/components', function(data) {
                    $('#component-select').empty().append(
                        '<option disabled selected>Select a component</option>');
                    data.forEach(function(component) {
                        var badge = component.transfer_logs_count > 0 ? ' (' + component
                            .transfer_logs_count + ')' : '';
                        $('#component-select').append('<option value="' + component.id +
                            '">' + component.component_name + ' ' + badge + '</option>');
                    });
                });
            });

            // Fetch and display logs when a component is selected
            $('#component-select').change(function() {
                var moduleId = $('#module-select').val();
                var componentId = $(this).val();
                $.get('/modules/' + moduleId + '/components/' + componentId + '/logs', function(data) {
                    // Clear existing logs
                    $('#unmatched-logs-table tbody').empty();
                    $('#missing-logs-table tbody').empty();

                    // Populate logs
                    data.forEach(function(log) {
                        var relatedRecord = '';
                        if (log.target_record) {
                            for (var key in log.target_record) {
                                var value = log.target_record[key];
                                relatedRecord += '<strong>' + key.charAt(0).toUpperCase() +
                                    key.slice(1).replace('_', ' ') + ':</strong> ' + value +
                                    '<br>';
                            }
                        }

                        // Create new table row
                        var bgColor = (log.id % 2 === 0) ? 'bg-tetiary' : 'bg-secondary';

                        var newRow = '<tr class="fw-bold ' + bgColor +
                            ' m-5 border border-solid">' +
                            '<td>' +
                            '<div class="rounded-start form-check form-check-sm form-check-custom form-check-solid">' +
                            '<input class="form-check-input widget-9-check ml-3" type="checkbox" value="1" />' +
                            '</div> </td>' +
                            '<td>' + log.id + '</td>' +
                            '<td>' + log.source_table + '</td>' +
                            '<td>' + log.target_table + '</td>' +
                            '<td>' + log.missing_field + '</td>' +
                            '<td>' + log.source_column + '</td>' +
                            '<td>' + log.source_value + '</td>' +
                            '<td>' + relatedRecord + '</td>' +
                            '<td class="pr-4 min-w-2000px text-end rounded-end">' +
                            '<form class="fix-form" data-log-id="' + log.id + '">' +
                            '<input type="hidden" name="_token" value="' + $(
                                'meta[name="csrf-token"]').attr('content') + '">' +
                            '<select name="fix_value" class="form-control">';


                        if (log.replacement_values) {
                            var replacement_values = Object.entries(log.replacement_values);
                            replacement_values.forEach(function([id, value]) {
                                newRow += '<option value="' + id + '">' + value +
                                    '</option>';
                            });
                        }
                        newRow += '</select>' +
                            '<button type="submit" class="btn btn-primary mt-3">Fix</button>' +
                            '</form>' +

                            '</td>' +
                            '</tr>';

                        // Append to appropriate table
                        if (log.source_value.trim() === '') {
                            $('#missing-logs-table tbody').append(newRow);
                        } else {
                            $('#unmatched-logs-table tbody').append(newRow);
                        }
                    });
                });
            });
        });

        {{-- JavaScript Function to Count Checked Checkboxes --}}

        function showCheckedCount() {
            // Select all checkboxes with the class 'widget-9-check' that are checked
            const checkedCheckboxes = document.querySelectorAll('.widget-9-check:checked');

            // Count the number of checked checkboxes
            const count = checkedCheckboxes.length;

            // Display an alert with the count
            alert(`You selected ${count} rows.`);
        }
        {{-- Event Listener for the Button --}}
        document.getElementById('countButton').addEventListener('click', showEditModal);


        {{-- Triggering the Function --}}
        document.getElementById('countButton').addEventListener('click', showCheckedCount);




        $(document).on('submit', '.fix-form', function(e) {
            e.preventDefault();

            var form = $(this);
            var logId = form.data('log-id');
            var fixValue = form.find('select[name="fix_value"]').val();

            $.ajax({
                url: '/fixer/fix_log/' + logId,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    fix_value: fixValue
                },
                success: function() {
                    // Remove the fixed row from the table
                    form.closest('tr').remove();
                    swal("Success", "The log has been successfully fixed.", "success");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle errors here
                    swal("Error", "Could not fix the log. Please try again.", "error");
                }
            });
        });
    </script>
@endpush
