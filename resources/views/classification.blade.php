<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Classification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="container mt-5">

        <h2>Classification</h2>
        <div class="card mb-4">
            <div class="card-header">Settings</div>
            <div class="card-body">
                <form id="bu-selection-form" class="row" method="POST"
                    action="{{ route('users.updateCurrentBu') }}">
                    @csrf
                    <div class="form-group col-12">
                        <label for="businessUnits">Select Current Business Unit:</label>
                        <select id="businessUnits" class="form-control" name="current_bu_id">
                            {{-- @foreach ($businessUnits as $bu)
                                <option value="{{ $bu->id }}" {{ Auth::user()->currentBu()->id == $bu->id ? 'selected' : '' }}>{{ $bu->bu_name }}</option>
                            @endforeach --}}
                        </select>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary mt-3">Select</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Customers
                <div class="float-end">
                    <label for="filter">Filter by Classification:</label>
                    <select id="filter" class="form-control">
                        <option selected>All</option>
                        {{-- @foreach ($customerClassTypes as $classType)
                        @foreach ($classType->classTypeLists as $classTypeList)
                            <option value="{{ $classTypeList->id }}">{{ $classType->name }} - {{ $classTypeList->name }}</option>
                        @endforeach
                    @endforeach --}}

                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Legal Name</th>
                                <th>Country</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="data-table-body">
                            {{-- @foreach ($customers as $customer)
                                <tr data-classifications="{{ json_encode($customer->customerClasses) }}">
                                    <td>{{$customer->id}}</td>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->legal_name}}</td>
                                    <td>{{$customer->country->name}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary classify-button" data-id="{{$customer->id}}" data-bs-toggle="modal" data-bs-target="#classifyModal">Classify</button>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="classifyModal" tabindex="-1" aria-labelledby="classifyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="classifyModalLabel">Classify Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-header">Add New Classification</div>
                        <div class="card-body">
                            <div class="form-group col-12">
                                <label for="customerClassType">Customer Class Type</label>
                                <select id="customerClassType" class="form-control customerClassType">
                                    <option selected="selected">Choose...</option>
                                    {{-- @foreach ($customerClassTypes as $classType)
                                        <option value="{{ $classType->id }}">{{ $classType->name }}</option>
                                    @endforeach --}}
                                </select>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addCustomerClassTypeModal">Add
                                    new class type</a> <!-- New Link -->
                            </div>
                            <div class="form-group col-12">
                                <label for="customerClassTypeList">Customer Class Type List</label>
                                <select id="customerClassTypeList"
                                    class="form-control mb-2 customerClassTypeList"></select>
                                <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#addCustomerClassTypeListModal">Add new class type list</a>
                                <!-- New Link -->
                            </div>

                            <button type="button" class="btn btn-primary mt-2 save-btn">Save</button>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">Current Classification</div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Class Type</th>
                                        <th>Class Type List</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="classificationArea"></tbody>
                            </table>
                        </div>
                    </div>
                    <div id="classificationArea"></div>
                </div>
                <div class="modal-footer" style="justify-content:center">
                    <h6 style="text-align:center">Note: Only users with special permissions may use this!</h6>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Customer Class Type Modal -->
    <div class="modal fade" id="addCustomerClassTypeModal" tabindex="-1"
        aria-labelledby="addCustomerClassTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerClassTypeModalLabel">Add Customer Class Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCustomerClassTypeForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="customer_class_type_name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="customer_class_type_description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Add Customer Class Type List Modal -->
    <div class="modal fade" id="addCustomerClassTypeListModal" tabindex="-1"
        aria-labelledby="addCustomerClassTypeListModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerClassTypeListModalLabel">Add Customer Class Type List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCustomerClassTypeListForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="customer_class_type_list_name" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_class_type_id">Customer Class Type</label>
                            <select class="form-control" id="customer_class_type_id" required></select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                searching: true, // enable search box
                paging: true, // enable pagination
                info: true, // display table info
                lengthChange: true // allow entries change
            });

            var getClassTypeListUrl = "{{ url('get-class-type-list') }}";
            var currentCustomerId = null;

            $('.classify-button').on('click', function() {
                currentCustomerId = $(this).data('id');
                let classifications = $(this).closest('tr').data('classifications');
                let classificationArea = $('#classificationArea');
                classificationArea.empty(); // Clear the area

                // Populate the table with classifications
                classifications.forEach(function(classification) {
                    let row = '<tr>';
                    row += '<td>' + classification.customer_class_type.name + '</td>';
                    row += '<td>' + classification.customer_class_type_list.name + '</td>';
                    row +=
                        '<td><button type="button" class="btn btn-danger delete-classification-btn" data-id="' +
                        classification.id + '">Delete</button></td>';
                    row += '</tr>';
                    classificationArea.append(row);
                });
            });

            // Fetch customer class type list when a class type is selected
            $('#customerClassType').on('change', function() {
                let classTypeId = $(this).val();
                let select = $(this).closest('.modal').find('#customerClassTypeList');

                // Clear the select
                select.empty();

                // Fetch the class type list
                $.get(getClassTypeListUrl + '/' + classTypeId, function(data) {
                    // Add the default option
                    select.append('<option selected>Choose...</option>');

                    // Add the new options
                    $.each(data, function(index, value) {
                        select.append('<option value="' + value.id + '">' + value.name +
                            '</option>');
                    });
                });
            });

            // Save the classification when the "Save" button is clicked
            $('.save-btn').on('click', function(e) {
                e.preventDefault();
                let classTypeId = $('#customerClassType').val();
                let classTypeListId = $('#customerClassTypeList').val();
                let data = {
                    _token: $("meta[name='csrf-token']").attr('content'),
                    customerId: currentCustomerId,
                    classTypeId: classTypeId,
                    classTypeListId: classTypeListId
                };

                $.post("{{ route('customer_classes.store') }}", data)
                    .done(function(response) {
                        Swal.fire(
                            'Success',
                            'The classification was saved successfully!',
                            'success'
                        );

                        // Update the classification table
                        let classificationArea = $('#classificationArea');
                        classificationArea.empty(); // Clear the area

                        // Fetch the updated classifications
                        $.get("{{ url('customer_classes/customer') }}/" + currentCustomerId, function(
                            classifications) {
                            // Populate the table with classifications
                            classifications.forEach(function(classification) {
                                let row = '<tr>';
                                row += '<td>' + classification.customer_class_type
                                    .name + '</td>';
                                row += '<td>' + classification.customer_class_type_list
                                    .name + '</td>';
                                row +=
                                    '<td><button type="button" class="btn btn-danger delete-classification-btn" data-id="' +
                                    classification.id + '">Delete</button></td>';
                                row += '</tr>';
                                classificationArea.append(row);
                            });
                        });

                        // Clear the Customer Class Type and Customer Class Type List dropdowns
                        $('#customerClassType').val('');
                        $('#customerClassTypeList').val('');

                        // Set the Customer Class Type dropdown to its default option
                        $('#customerClassType option:first-child').prop('selected', true);
                    })
                    .fail(function() {
                        Swal.fire(
                            'Error',
                            'There was an error saving the classification.',
                            'error'
                        );
                    });
            });

            // This is for the DELETE buttons in classification modal
            $('body').on('click', '.delete-classification-btn', function() {
                let btn = $(this);
                let classificationId = btn.data('id');
                let deleteUrl = "{{ route('customer_classes.destroy', 'id') }}".replace('id',
                    classificationId);

                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: {
                        _token: $("meta[name='csrf-token']").attr('content')
                    },
                    success: function(response) {
                        Swal.fire(
                            'Deleted!',
                            'The classification has been deleted.',
                            'success'
                        );
                        // Remove the row from the table
                        btn.closest('tr').remove();
                    },
                    error: function() {
                        Swal.fire(
                            'Error',
                            'There was an error deleting the classification.',
                            'error'
                        );
                    }
                });
            });
        });

        $('#filter').on('change', function() {
            let filterValue = parseInt($(this).val());
            if (filterValue === 'All') {
                // If "All" is selected, show all rows
                $('tbody#data-table-body tr').show();
            } else {
                // Otherwise, only show rows that have the selected class type list
                $('tbody#data-table-body tr').each(function() {
                    let classifications = $(this).data('classifications');
                    let containsClassTypeList = classifications.some(function(classification) {
                        return classification.customer_class_type_list.id === filterValue;
                    });
                    if (containsClassTypeList) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });

        // These are for the nested modals
        $('#addCustomerClassTypeListModal').on('show.bs.modal', function(e) {
            // Fetch the list of available customer class types and populate the dropdown
            $.get('customer-class-types', function(data) {
                var select = $('#customer_class_type_id');
                select.empty();
                $.each(data, function(index, customerClassType) {
                    select.append($('<option/>', {
                        value: customerClassType.id,
                        text: customerClassType.name
                    }));
                });
            });
        });

        $('#addCustomerClassTypeForm').on('submit', function(e) {
            e.preventDefault();

            var name = $('#customer_class_type_name').val();
            var description = $('#customer_class_type_description').val();

            $.ajax({
                type: 'POST',
                url: 'customer-class-types', // Replace with your actual API endpoint
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // Add this line
                    name: name,
                    description: description
                },
                success: function(data) {
                    Swal.fire({ // This is where you show the SweetAlert2 success message
                        title: 'Success!',
                        text: 'Customer class type saved successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    // Close the modal
                    $('#addCustomerClassTypeModal').modal('hide');

                    // Refresh the dropdown in the main modal
                    $.ajax({
                        type: 'GET',
                        url: 'customer-class-types', // Replace with the endpoint to fetch all customer class types
                        success: function(data) {
                            var $dropdown = $('#customerClassType');
                            $dropdown.empty(); // Clear old options first
                            $.each(data, function(index, classType) {
                                // Append each new class type as an option
                                $dropdown.append($('<option>', {
                                    value: classType.id,
                                    text: classType.name
                                }));
                            });
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) { // Add error handling
                    if (jqXHR.status ===
                        409
                    ) { // Assuming the server returns a 409 conflict status if the item already exists
                        Swal.fire({
                            title: 'Error!',
                            text: 'Customer class type already exists.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while saving the customer class type.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });

        $('#addCustomerClassTypeListForm').on('submit', function(e) {
            e.preventDefault();

            var name = $('#customer_class_type_list_name').val();
            var customer_class_type_id = $('#customer_class_type_id').val();

            $.ajax({
                type: 'POST',
                url: 'customer-class-type-lists', // Replace with your actual API endpoint
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF protection
                    name: name,
                    customer_class_type_id: customer_class_type_id
                },
                success: function(data) {
                    Swal.fire({ // Success message
                        title: 'Success!',
                        text: 'Customer class type list saved successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    // Close the modal
                    $('#addCustomerClassTypeListModal').modal('hide');

                    // Refresh the dropdown in the main modal
                    // ...
                },
                error: function(jqXHR, textStatus, errorThrown) { // Error handling
                    if (jqXHR.status === 409) { // Conflict status, indicating the item already exists
                        Swal.fire({
                            title: 'Error!',
                            text: 'Customer class type list already exists.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while saving the customer class type list.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>

{{-- @extends('layouts.app2')

@section('row_content')
    <div class="card">
        <!--begin::Body-->
        <div class="card-body p-lg-17">
            <!--begin::Phone-->
            <div class="bg-light card-rounded d-flex flex-column flex-center flex-center p-10 h-100">
                <!--begin::Subtitle-->
                <h1 class="text-dark fw-bold my-5">Under Serious Construction</h1>
                <!--end::Subtitle-->
                <!--begin::Number-->
                <img src="{{ asset('giphy.gif') }}" alt="working">
                <!--end::Number-->

            </div>
            <!--end::Phone-->
        </div>
        <!--end::Body-->
    </div>
@endsection --}}
