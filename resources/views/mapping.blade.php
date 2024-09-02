@extends('layouts.app2')

@push('styles')
    <title>Database Mapping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Select2 CSS -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" /> --}}

    <!-- Head -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Before closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>


    <!-- Add the jQuery CDN here -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <style>
        .select2-container--open {
            z-index: 1055 !important;
            /* Must be higher than modal's z-index which is often 1050 */
        }
    </style>
@endpush

@section('content')
    {{-- START - Mapping  --}}
    <div class="rounded bg-secondary mx-8">
        <h1 class="my-9" style="margin-left: auto; margin-right: auto; width: fit-content;">Database Mapping</h1>

        <div class="modal fade" id="addWarehouseModal" tabindex="-1" role="dialog" aria-labelledby="addWarehouseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addWarehouseModalLabel">Add Warehouse</h5>
                        <x-button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"
                            id="btnAddWarehouse" text="Add Warehouse">
                            <span aria-hidden="true">&times;</span>
                        </x-button>
                    </div>
                    <div class="modal-body">
                        <form id="addWarehouseForm">
                            <!-- Existing Fields -->
                            <div class="mb-3">
                                <label for="bu" class="form-label">Bu</label>
                                <select id="bu" name="bu_id" class="form-select select2">
                                    @foreach ($bus as $bu)
                                        <option value="{{ $bu->id }}" data-name="{{ $bu->bu_name }}">
                                            {{ $bu->id }}-{{ $bu->bu_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- New Fields -->
                            <div class="mb-3">
                                <label for="site" class="form-label">Site ID</label>
                                <select id="site" name="site_id" class="form-select select2">
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}" data-name="{{ $site->site_name }}">
                                            {{ $site->id }}-{{ $site->site_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="short_code" class="form-label">Short Code</label>
                                <input type="text" id="short_code" name="short_code" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" id="description" name="description" required class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address ID</label>
                                <select id="address" name="address_id" class="form-select select2">
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}" data-name="{{ $address->address_name }}">
                                            {{ $address->id }}-{{ $address->address_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="intransit_warehouse" class="form-label">Intransit Warehouse</label>
                                <select id="intransit_warehouse" name="intransit_warehouse" class="form-select select2">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <x-button type="submit" class="btn-dark" id="btnAddingWarehouse" text="Adding Warehouse">Add
                                Warehouse</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Address Modal -->
        <div class="modal fade" id="addAddressModal" tabindex="-1" role="dialog" aria-labelledby="addAddressModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAddressModalLabel">Add Address</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addAddressForm">
                            <input type="text" id="addressName" name="addressName" placeholder="Address Name"
                                required>
                            <button type="submit" class="btn btn-dark">Add Address</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4 mx-8">
            <div class="card-body">
                <div class="mb-4">
                    <h3>Select Preset</h3>

                    <!-- Start form -->
                    <form method="POST" action="" id="delete-form">
                        @csrf
                        @method('DELETE')

                        <select class="form-select" id="preset-select" required name="preset">
                            <option selected>Choose...</option>
                            @foreach ($presets as $preset)
                                <option value="{{ $preset->id }}">{{ $preset->id }} - {{ $preset->name }} -
                                    [{{ $preset->description }}]</option>
                            @endforeach
                        </select>

                        <x-button type="submit" id="delete-preset-button" class="btn-dark mt-2"
                            text="Delete Preset">Delete
                            Preset</x-button>
                        <a id="toggle-button" class="btn btn-primary mt-2">Create Preset</a>
                    </form>
                    <!-- End form -->
                </div>
            </div>
        </div>

        <div id="preset-form-container" class="card mb-4 mx-8" style="display: none;">
            <div class="card-body">
                <form id="preset-form" class="mb-4">
                    <h3>Create Preset</h3>

                    <div class="mb-3">
                        <label for="source-erp-system" class="form-label">Source ERP System</label>
                        <select id="source-erp-system" class="form-select" data-control="select2" data-placeholder="Select an option">
                            @foreach ($erp_systems as $erp_system)
                                <option value="{{ $erp_system->id }}" data-name="{{ $erp_system->name }}">
                                    {{ $erp_system->id }}-{{ $erp_system->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="system" class="form-label">System</label>
                        <select id="system" class="form-select" data-control="select2" data-placeholder="Select an option">
                            @foreach ($systems as $system)
                                <option value="{{ $system->id }}" data-name="{{ $system->system_name }}">
                                    {{ $system->id }}-{{ $system->system_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="company" class="form-label">Company</label>
                        <select id="company" class="form-select" data-control="select2" data-placeholder="Select an option">
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" data-name="{{ $company->name }}">
                                    {{ $company->id }}-{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bu" class="form-label">Bu</label>
                        <select id="bu" class="form-select" data-control="select2" data-placeholder="Select an option">
                            @foreach ($bus as $bu)
                                <option value="{{ $bu->id }}" data-name="{{ $bu->bu_name }}">
                                    {{ $bu->id }}-{{ $bu->bu_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="warehouse" class="form-label">Warehouse</label>
                        <select id="warehouse" class="form-select" data-control="select2" data-placeholder="Select an option">
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" data-name="{{ $warehouse->name }}">
                                    {{ $warehouse->id }}-{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal"
                            data-bs-target="#addWarehouseModal" disabled>Add Warehouse</button>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <select id="address" class="form-select" data-control="select2" data-placeholder="Select an option">
                            @foreach ($addresses as $address)
                                <option value="{{ $address->id }}" data-name="{{ $address->name }}">
                                    {{ $address->id }}-{{ $address->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal"
                            data-bs-target="#addAddressModal" disabled>Add Address</button>
                    </div>
                    <div class="mb-3">
                        <label for="presetName">Preset Name</label>
                        <input type="text" class="form-control" id="presetName"
                            placeholder="Name for Preset (Optional)">
                    </div>
                    
                    <button type="submit" class="btn btn-dark">Save Preset</button>
                </form>
            </div>
        </div>

        <div class="card mb-8 mx-8">
            <div class="card-body">
                <form id="mapping-form" class="mb-4">
                    <div class="row">
                        <div class="col">
                            <h2 class="mb-5" style="text-decoration: underline;">Source</h2>
                            <div class="mb-3">
                                <label for="source-db" class="form-label">Database</label>
                                <select class="form-select" id="source-db">
                                    <option selected>Choose...</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="source-table" class="form-label">Table</label>
                                <select class="form-select" id="source-table">
                                    <option selected>Choose...</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="source-column" class="form-label">Column</label>
                                <select class="form-select" id="source-column">
                                    <option selected>Choose...</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <h2 class="mb-5" style="text-decoration: underline;">Target</h2>
                            <div class="mb-3">
                                <label for="target-db" class="form-label">Database</label>
                                <select class="form-select" id="target-db">
                                    <option selected>Choose...</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="target-table" class="form-label">Table</label>
                                <select class="form-select" id="target-table">
                                    <option selected>Choose...</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="target-column" class="form-label">Column</label>
                                <select class="form-select" id="target-column">
                                    <option selected>Choose...</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="model-select" class="form-label">Model Corresponding With Table</label>
                                <select class="form-select" id="model-select">
                                    <option value="" disabled selected>Choose...</option>
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}" data-table="{{ $model->model_table }}">
                                            {{ $model->model_name }}</option>
                                    @endforeach
                                </select>
                                <!-- Add New Model Link -->
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addModelModal">Add New
                                    Model</a>
                            </div>
                        </div>
                    </div>
                    <x-button type="submit" class="btn-dark" id="btnSaveMapping" text="Save Mapping">Save
                        Mapping</x-button>
                </form>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="border: gray solid 2px;">
                            <div class="card-header">
                                <h1 class="mt-5">Source Mappings</h1>
                            </div>
                            <div class="card-body" id="source-mappings-card-body">
                                <div id="source-column-mappings"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="border: gray solid 2px;">
                            <div class="card-header">
                                <h1 class="mt-5">Target Mappings</h1>
                            </div>
                            <div class="card-body" id="target-mappings-card-body">
                                <div id="target-column-mappings"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New Model Modal -->
        <div class="modal fade" id="addModelModal" tabindex="-1" role="dialog" aria-labelledby="addModelModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModelModalLabel">Add New Model</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Modal Body with Form to Add New Model -->
                        <form id="addModelForm">
                            <div class="form-group">
                                <label for="modelName">Model Name</label>
                                <input type="text" class="form-control" id="modelName"
                                    placeholder="Enter model name">
                            </div>
                            <div class="form-group">
                                <label for="modelTable">Model Table</label>
                                <input type="text" class="form-control" id="modelTable"
                                    placeholder="Enter model table">
                            </div>

                            <div class="form-group">
                                <label for="modelModule">Module</label>
                                <select id="modelModule" class="form-control">
                                    <option value="" selected disabled>Choose...</option>
                                    <!-- Populate with actual modules from your database -->
                                    @foreach ($modules as $module)
                                        <option value="{{ $module->id }}" data-name="{{ $module->module_name }}">
                                            {{ $module->module_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="modelComponent">Component</label>
                                <select id="modelComponent" class="form-control">
                                    <option value="" selected disabled>Choose...</option>
                                    <!-- Populate with actual components from your database -->
                                    @foreach ($components as $component)
                                        <option value="{{ $component->id }}"
                                            data-name="{{ $component->component_name }}">
                                            {{ $component->component_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveModel">Save</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- <form action="#">
            <!--begin::Card-->
            <div class="card mb-7">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Compact form-->
                    <div class="d-flex align-items-center">
                        <!--begin::Input group-->
                        <div class="position-relative w-md-400px me-md-2">
                            <i
                                class="ki-duotone ki-magnifier fs-3 text-gray-500 position-absolute top-50 translate-middle ms-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" class="form-control form-control-solid ps-10" name="search"
                                value="" placeholder="Search" />
                        </div>
                        <!--end::Input group-->
                        <!--begin:Action-->
                        <div class="d-flex align-items-center">
                            <button type="submit" class="btn btn-primary me-5">Search</button>
                            <a id="kt_horizontal_search_advanced_link" class="btn btn-link" data-bs-toggle="collapse"
                                href="#kt_advanced_search_form">Advanced Search</a>
                        </div>
                        <!--end:Action-->
                    </div>
                    <!--end::Compact form-->
                    <!--begin::Advance form-->
                    <div class="collapse" id="kt_advanced_search_form">
                        <!--begin::Separator-->
                        <div class="separator separator-dashed mt-9 mb-6"></div>
                        <!--end::Separator-->
                        <!--begin::Row-->
                        <div class="row g-8 mb-8">
                            <!--begin::Col-->
                            <div class="col-xxl-7">
                                <label class="fs-6 form-label fw-bold text-dark">Tags</label>
                                <input type="text" class="form-control form-control form-control-solid" name="tags"
                                    value="products, users, events" />
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xxl-5">
                                <!--begin::Row-->
                                <div class="row g-8">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <label class="fs-6 form-label fw-bold text-dark">Team Type</label>
                                        <!--begin::Select-->
                                        <select class="form-select form-select-solid" data-control="select2"
                                            data-placeholder="In Progress" data-hide-search="true">
                                            <option value=""></option>
                                            <option value="1">Not started</option>
                                            <option value="2" selected="selected">In Progress</option>
                                            <option value="3">Done</option>
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <label class="fs-6 form-label fw-bold text-dark">Select Group</label>
                                        <!--begin::Radio group-->
                                        <div class="nav-group nav-group-fluid">
                                            <!--begin::Option-->
                                            <label>
                                                <input type="radio" class="btn-check" name="type" value="has"
                                                    checked="checked" />
                                                <span
                                                    class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">All</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label>
                                                <input type="radio" class="btn-check" name="type" value="users" />
                                                <span
                                                    class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">Users</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label>
                                                <input type="radio" class="btn-check" name="type" value="orders" />
                                                <span
                                                    class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">Orders</span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Radio group-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row g-8">
                            <!--begin::Col-->
                            <div class="col-xxl-7">
                                <!--begin::Row-->
                                <div class="row g-8">
                                    <!--begin::Col-->
                                    <div class="col-lg-4">
                                        <label class="fs-6 form-label fw-bold text-dark">Min. Amount</label>
                                        <!--begin::Dialer-->
                                        <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000"
                                            data-kt-dialer-max="50000" data-kt-dialer-step="1000"
                                            data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                            <!--begin::Decrease control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                data-kt-dialer-control="decrease">
                                                <i class="ki-duotone ki-minus-circle fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                            <!--end::Decrease control-->
                                            <!--begin::Input control-->
                                            <input type="text" class="form-control form-control-solid border-0 ps-12"
                                                data-kt-dialer-control="input" placeholder="Amount" name="manageBudget"
                                                readonly="readonly" value="$50" />
                                            <!--end::Input control-->
                                            <!--begin::Increase control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                data-kt-dialer-control="increase">
                                                <i class="ki-duotone ki-plus-circle fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                            <!--end::Increase control-->
                                        </div>
                                        <!--end::Dialer-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4">
                                        <label class="fs-6 form-label fw-bold text-dark">Max. Amount</label>
                                        <!--begin::Dialer-->
                                        <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000"
                                            data-kt-dialer-max="50000" data-kt-dialer-step="1000"
                                            data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                            <!--begin::Decrease control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                data-kt-dialer-control="decrease">
                                                <i class="ki-duotone ki-minus-circle fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                            <!--end::Decrease control-->
                                            <!--begin::Input control-->
                                            <input type="text" class="form-control form-control-solid border-0 ps-12"
                                                data-kt-dialer-control="input" placeholder="Amount" name="manageBudget"
                                                readonly="readonly" value="$100" />
                                            <!--end::Input control-->
                                            <!--begin::Increase control-->
                                            <button type="button"
                                                class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                data-kt-dialer-control="increase">
                                                <i class="ki-duotone ki-plus-circle fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                            <!--end::Increase control-->
                                        </div>
                                        <!--end::Dialer-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-4">
                                        <label class="fs-6 form-label fw-bold text-dark">Team Size</label>
                                        <input type="text" class="form-control form-control form-control-solid"
                                            name="city" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xxl-5">
                                <!--begin::Row-->
                                <div class="row g-8">
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <label class="fs-6 form-label fw-bold text-dark">Category</label>
                                        <!--begin::Select-->
                                        <select class="form-select form-select-solid" data-control="select2"
                                            data-placeholder="In Progress" data-hide-search="true">
                                            <option value=""></option>
                                            <option value="1">Not started</option>
                                            <option value="2" selected="selected">Select</option>
                                            <option value="3">Done</option>
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-lg-6">
                                        <label class="fs-6 form-label fw-bold text-dark">Status</label>
                                        <div class="form-check form-switch form-check-custom form-check-solid mt-1">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexSwitchChecked" checked="checked" />
                                            <label class="form-check-label" for="flexSwitchChecked">Active</label>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Advance form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </form> --}}
    </div>

    {{-- END - Mapping  --}}
@endsection

@push('scripts')
    <!-- Include Select2 JS -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: 'resolve' // This helps with adjusting the width of select elements
            });
        });
    </script>

    <script>
        $('#your-select-element').select2({
            ajax: {
                url: 'path-to-your-data-source',
                dataType: 'json',
                // Additional AJAX parameters go here
            },
            // other settings
        });
    </script>


    {{-- This is for the Preset form --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const presetForm = document.getElementById("preset-form");
            const presetSelect = document.getElementById("preset-select");
            const erpSystemSelect = document.getElementById("source-erp-system");
            const systemSelect = document.getElementById("system");
            const companySelect = document.getElementById("company");
            const buSelect = document.getElementById("bu");
            const warehouseSelect = document.getElementById("warehouse");
            const addressSelect = document.getElementById("address");

            presetForm.addEventListener("submit", function(event) {


                // Get the selected option texts
                const erpSystemName = erpSystemSelect.options[erpSystemSelect.selectedIndex].getAttribute(
                    'data-name');
                const systemName = systemSelect.options[systemSelect.selectedIndex].getAttribute(
                    'data-name');
                const companyName = companySelect.options[companySelect.selectedIndex].getAttribute(
                    'data-name');
                const buName = buSelect.options[buSelect.selectedIndex].getAttribute('data-name');
                const warehouseName = warehouseSelect.value ? warehouseSelect.options[warehouseSelect
                    .selectedIndex].getAttribute('data-name') : "";
                const addressName = addressSelect.value ? addressSelect.options[addressSelect.selectedIndex]
                    .getAttribute('data-name') : "";

                const presetName = document.getElementById("presetName");



                const formData = {
                    name: presetName.value ? presetName.value : 'No_Name',
                    source_erp_system_id: erpSystemSelect.value,
                    system_id: systemSelect.value,
                    company_id: companySelect.value,
                    bu_id: buSelect.value,
                    warehouse_id: warehouseSelect.value ? warehouseSelect.value :
                    null, // Handle case where value is an empty string
                    address_id: addressSelect.value ? addressSelect.value :
                    null, // Handle case where value is an empty string
                    description: `${erpSystemName} => ${systemName} => ${companyName}  =>  ${buName} => ${warehouseName} => ${addressName}` // Name generated from selected options
                };


                /*for (let key in formData) {
                    if (formData[key] === "") {
                        formData[key] = null;
                    }
                }*/

                fetch("/save-preset", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error("Failed to save the preset.");
                        }
                    })
                    .then(data => {
                        alert("Preset saved successfully");

                        // Now refresh the preset-select dropdown
                        fetch("/presets")
                            .then(response => {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error("Failed to fetch the presets.");
                                }
                            })
                            .then(presetsData => {
                                // Clear the preset-select dropdown
                                $('#preset-select').empty();

                                // Add a placeholder option
                                $('#preset-select').append($('<option>', {
                                    value: "",
                                    text: "Choose..."
                                }));

                                // Add the fetched presets to the preset-select dropdown
                                presetsData.forEach(preset => {
                                    $('#preset-select').append($('<option>', {
                                        value: preset.id,
                                        text: preset.id + " - " + preset.name +
                                            " - [" + preset.description + "]"
                                    }));
                                });

                                // Refresh the select2
                                $('#preset-select').trigger('change');
                            })
                            .catch(error => {
                                console.error("Error:", error);
                                alert("An error occurred while fetching the presets.");
                            });
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("An error occurred while saving the preset.");
                    });


            });

            presetSelect.addEventListener("change", function() {
                const presetId = this.value;

                if (presetId !== 'placeholder') {
                    fetch(`/preset/${presetId}`)
                        .then(response => {
                            if (response.ok) {
                                return response.json();
                            } else {
                                throw new Error("Failed to fetch the preset.");
                            }
                        })
                        .then(data => {
                            console.log(data); // log the fetched data
                            erpSystemSelect.value = data.source_erp_system_id;
                            systemSelect.value = data.system_id;
                            companySelect.value = data.company_id;
                            buSelect.value = data.bu_id;
                            warehouseSelect.value = data.warehouse_id;
                            addressSelect.value = data.address_id;
                            presetName.value = data.name;

                            // Trigger the change event to update select2
                            $(erpSystemSelect).trigger('change');
                            $(systemSelect).trigger('change');
                            $(companySelect).trigger('change');
                            $(buSelect).trigger('change');
                            $(warehouseSelect).trigger('change');
                            $(addressSelect).trigger('change');

                            // log the current value of the select elements
                            console.log('Source ERP System:', erpSystemSelect.value);
                            console.log('System:', systemSelect.value);
                            console.log('Company:', companySelect.value);
                            console.log('BU:', buSelect.value);
                            console.log('Warehouse:', warehouseSelect.value);
                            console.log('Address:', addressSelect.value);
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("An error occurred while fetching the preset.");
                        });
                }
            });


        });
    </script>

    {{-- END-- This is for the Preset form --}}

    {{-- START-- This is for the DELETE Preset form --}}
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('preset-select').addEventListener('change', function() {
                document.getElementById('delete-form').action = '/presets/' + this.value;
            });
        });


        document.querySelector('#delete-preset-button').addEventListener('click', function(event) {

            let presetId = document.getElementById('preset-select').value;
            if (presetId) {
                fetch('/presets/' + presetId, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                }).then(json => {
                    if (json.status === 'success') {
                        location.reload(); // Reload the page after deletion
                    }
                }).catch(error => {
                    console.error('Error:', error);
                });

            } else {
                alert('Please select a preset to delete');
            }
        });
    </script>
    {{-- END-- This is for the DELETE Preset form --}}

    {{-- This is for the Mapping form --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const erpSystemSelect = document.getElementById("source-erp-system");
            const presetSelect = document.getElementById("preset-select");
            const systemSelect = document.getElementById("system");
            const companySelect = document.getElementById("company");
            const buSelect = document.getElementById("bu");
            const warehouseSelect = document.getElementById("warehouse");
            const addressSelect = document.getElementById("address");

            const sourceDbSelect = document.getElementById("source-db");
            const sourceTableSelect = document.getElementById("source-table");
            const sourceColumnSelect = document.getElementById("source-column");
            const targetDbSelect = document.getElementById("target-db");
            const targetTableSelect = document.getElementById("target-table");
            const targetColumnSelect = document.getElementById("target-column");
            const mappingForm = document.getElementById("mapping-form");

            const databases = {
                "ACopySysproCompanyBC": 'mysql1', //This is where I name the databases
                "1office_0_2": '1office',
                "GBAData": 'gbadata',


            };

            function populateDatabaseSelect(selectElement) {
                for (const dbName in databases) {
                    const option = new Option(dbName, databases[dbName]);
                    selectElement.add(option);
                }
            }

            function populateTableSelect(dbConnection, tableSelectElement) {
                tableSelectElement.innerHTML = "";
                const placeholderOption = new Option("Select table", "placeholder", true, true);
                placeholderOption.disabled = true;
                tableSelectElement.add(placeholderOption);

                fetch(`/tables/${dbConnection}`)
                    .then(response => response.json())
                    .then(tables => {
                        tables.forEach(table => {
                            const tableName = Object.values(table)[0];
                            const option = new Option(tableName, tableName);
                            tableSelectElement.add(option);
                        });
                    });
            }

            let sourceColumns = [];
            let targetColumns = [];

            function populateSourceColumnSelect(tableName) {
                return new Promise((resolve, reject) => {
                    const selectedDbConnection = sourceDbSelect.value;
                    const selectedDbName = sourceDbSelect.options[sourceDbSelect.selectedIndex].text;
                    if (!tableName) {
                        sourceColumnSelect.innerHTML = "";
                        resolve();
                    } else {
                        fetch(`/columns/${selectedDbConnection}/${tableName}`)
                            .then(response => response.json())
                            .then(columns => {
                                sourceColumnSelect.innerHTML = "";
                                sourceColumns = columns;
                                columns.forEach(column => {
                                    const option = new Option(column, column);
                                    const isMapped = mappings.some(
                                        mapping => mapping.source_db === selectedDbName &&
                                        mapping.source_table === tableName && mapping
                                        .source_column === column
                                    );
                                    if (isMapped) {
                                        option.style.color = "red";
                                    }
                                    sourceColumnSelect.add(option);
                                });
                                resolve();
                            })
                            .catch(error => {
                                console.error('Error fetching source columns:', error);
                                reject(error);
                            });
                    }
                });
            }

            function populateTargetColumnSelect(tableName) {
                return new Promise((resolve, reject) => {
                    const selectedDbConnection = targetDbSelect.value;
                    const selectedDbName = targetDbSelect.options[targetDbSelect.selectedIndex].text;
                    if (!tableName) {
                        targetColumnSelect.innerHTML = "";
                        resolve();
                    } else {
                        fetch(`/columns/${selectedDbConnection}/${tableName}`)
                            .then(response => response.json())
                            .then(columns => {
                                targetColumnSelect.innerHTML = "";
                                targetColumns = columns;
                                columns.forEach(column => {
                                    const option = new Option(column, column);
                                    const isMapped = mappings.some(
                                        mapping => mapping.target_db === selectedDbName &&
                                        mapping.target_table === tableName && mapping
                                        .target_column === column
                                    );
                                    if (isMapped) {
                                        option.style.color = "red";
                                    }
                                    targetColumnSelect.add(option);
                                });
                                resolve();
                            })
                            .catch(error => {
                                console.error('Error fetching target columns:', error);
                                reject(error);
                            });
                    }
                });
            }



            function fetchMappings() {
                return fetch("/mappings")
                    .then(response => response.json())
                    .then(data => {
                        return data;
                    })
                    .catch(error => {
                        console.error("Failed to fetch mappings: ", error);
                        return [];
                    });
            }

            function displayColumnMappings(tableName, isSource) {
                const columnMappingsContainer = isSource ?
                    document.getElementById("source-column-mappings") :
                    document.getElementById("target-column-mappings");

                columnMappingsContainer.innerHTML = "";

                if (!tableName) {
                    return;
                }

                const selectedDbOption = isSource ?
                    sourceDbSelect.options[sourceDbSelect.selectedIndex] :
                    targetDbSelect.options[targetDbSelect.selectedIndex];
                const selectedDb = selectedDbOption.text;

                const filteredMappings = mappings.filter(mapping =>
                    (isSource ? mapping.source_table : mapping.target_table) === tableName &&
                    (isSource ? mapping.source_db : mapping.target_db) === selectedDb
                );

                // Add console.log statement for filteredMappings here
                console.log("Filtered Mappings: ", filteredMappings);

                const allColumns = isSource ? sourceColumns : targetColumns;
                const mappedColumns = filteredMappings.map(mapping => isSource ? mapping.source_column : mapping
                    .target_column);
                const unmappedColumns = allColumns.filter(column => !mappedColumns.includes(column));

                const mappedList = document.createElement("ul");
                filteredMappings.forEach(mapping => {
                    const listItem = document.createElement("li");
                    listItem.textContent = isSource ?
                        `${mapping.source_column} -> ${mapping.target_table}.${mapping.target_column}  ` :
                        `${mapping.target_column} <- ${mapping.source_table}.${mapping.source_column}  `;

                    console.log('All Columns:', allColumns);
                    console.log('Mapped Columns:', mappedColumns);
                    console.log('Unmapped Columns:', unmappedColumns);

                    // Create delete button
                    const deleteButton = document.createElement("button");
                    deleteButton.textContent = "Delete"; // Change the text to 'x'
                    deleteButton.className = "btn btn-dark"; // Assign class 'btn btn-dark' to the button

                    deleteButton.addEventListener("click", function() {
                        // Delete request
                        // Fetch request to delete the mapping
                        fetch(`/delete-mapping/${mapping.id}`, {
                                method: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector(
                                        'meta[name="csrf-token"]').content
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    return response.json();
                                } else {
                                    throw new Error("Failed to delete the mapping.");
                                }
                            })
                            .then(() => {
                                alert("Mapping deleted successfully");
                                // Fetch mappings again
                                fetch("/mappings")
                                    .then(response => response.json())
                                    .then(newMappings => {
                                        mappings =
                                            newMappings; // Update the mappings list with fresh data from the server
                                        // Refresh both source and target mappings cards
                                        displayColumnMappings(sourceTableSelect.value,
                                            true);
                                        displayColumnMappings(targetTableSelect.value,
                                            false);
                                    });
                            })
                            .catch(error => {
                                console.error("Error:", error);
                                alert("An error occurred while deleting the mapping.");
                            });

                    });

                    listItem.appendChild(deleteButton);
                    mappedList.appendChild(listItem);
                });

                const unmappedList = document.createElement("ul");
                unmappedColumns.forEach(column => {
                    const listItem = document.createElement("li");
                    listItem.textContent = column;
                    unmappedList.appendChild(listItem);
                });

                const mappedTitle = document.createElement("h4");
                mappedTitle.textContent = "Mapped Columns";
                const unmappedTitle = document.createElement("h4");
                unmappedTitle.textContent = "Unmapped Columns";

                columnMappingsContainer.appendChild(mappedTitle);
                columnMappingsContainer.appendChild(mappedList);
                columnMappingsContainer.appendChild(unmappedTitle);
                columnMappingsContainer.appendChild(unmappedList);
            }


            let mappings = [];

            populateDatabaseSelect(sourceDbSelect);
            populateDatabaseSelect(targetDbSelect);

            //This is to set the default selected database to '1office'
            Array.from(targetDbSelect.options).forEach(function(optionElement) {
                if (optionElement.value === '1office') {
                    optionElement.selected = true;
                }
            });

            populateTableSelect(sourceDbSelect.value, sourceTableSelect);
            populateTableSelect(targetDbSelect.value, targetTableSelect);

            fetchMappings().then((newMappings) => {
                mappings = newMappings; // Populate the mappings variable initially
            });


            // fetch("/mappings")
            //     .then(response => response.json())
            //     .then(data => {
            //         mappings = data;
            //     });

            sourceDbSelect.addEventListener("change", function() {
                const dbConnection = this.value;
                populateTableSelect(dbConnection, sourceTableSelect);
            });

            targetDbSelect.addEventListener("change", function() {
                const dbConnection = this.value;
                populateTableSelect(dbConnection, targetTableSelect);
            });


            sourceTableSelect.addEventListener("change", function() {
                console.log('Source table select changed');
                const tableName = this.value;
                if (tableName !== 'placeholder') {
                    fetchMappings().then((newMappings) => {
                        console.log('Mappings fetched successfully');
                        mappings = newMappings;
                        populateSourceColumnSelect(tableName)
                            .then(() => {
                                console.log('Source columns fetched successfully');
                                displayColumnMappings(tableName, true);
                            })
                            .catch((error) => {
                                console.error('Failed to fetch source columns:', error);
                            });
                    }).catch((error) => {
                        console.error('Failed to fetch mappings:', error);
                    });
                }
            });

            targetTableSelect.addEventListener("change", function() {
                const tableName = this.value;
                if (tableName !== 'placeholder') {
                    fetchMappings().then((newMappings) => {
                        console.log('Mappings fetched successfully');
                        mappings = newMappings;
                        populateTargetColumnSelect(tableName)
                            .then(() => {
                                console.log('Target columns fetched successfully');
                                displayColumnMappings(tableName, false);
                            })
                            .catch((error) => {
                                console.error('Failed to fetch target columns:', error);
                            });
                    }).catch((error) => {
                        console.error('Failed to fetch mappings:', error);
                    });
                }
            });





            mappingForm.addEventListener("submit", function(event) {


                console.log('Preset value:', presetSelect.value);
                // Checking sourceDb, sourceTable and sourceColumn
                if (sourceDbSelect.value === "Choose..." || sourceTableSelect.value === "placeholder" ||
                    sourceColumnSelect.value === "Choose...") {
                    alert("Please make sure all source fields are selected.");
                    return;
                }

                // Checking targetDb, targetTable and targetColumn
                if (targetDbSelect.value === "Choose..." || targetTableSelect.value === "placeholder" ||
                    targetColumnSelect.value === "Choose...") {
                    alert("Please make sure all target fields are selected.");
                    return;
                }

                // Checking preset
                if (presetSelect.value === "Choose...") {
                    alert("Please select a preset.");
                    return;
                }

                // Checking model
                let modelSelect = document.getElementById('model-select');
                if (modelSelect.value === "" || modelSelect.value === "Choose...") {
                    alert("Please select a model.");
                    return;
                }


                const formData = {
                    system_id: systemSelect.value,
                    company_id: companySelect.value,
                    bu_id: buSelect.value,
                    source_erp_system_id: erpSystemSelect.value,

                    source_db: sourceDbSelect.options[sourceDbSelect.selectedIndex].text,
                    source_table: sourceTableSelect.value,
                    source_column: sourceColumnSelect.value,
                    target_db: targetDbSelect.options[targetDbSelect.selectedIndex].text,
                    target_table: targetTableSelect.value,
                    target_column: targetColumnSelect.value,
                    database_presets_id: presetSelect.value,
                    oo_model_id: modelSelect.value
                };

                console.log('all the mapings data Saiza:', formData);

                // I should probably add a database check too in here
                const mappingExists = mappings.some(mapping => {
                    return (
                        mapping.source_table === formData.source_table &&
                        mapping.source_column === formData.source_column &&
                        mapping.target_table === formData.target_table &&
                        mapping.target_column === formData.target_column
                    );
                });

                if (mappingExists) {
                    alert("This mapping already exists.");
                    return;
                }

                fetch("/save-mapping", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error("Failed to save the mapping.");
                        }
                    })
                    .then(data => {
                        // Re-fetch mappings from the server
                        fetch("/mappings")
                            .then(response => response.json())
                            .then(newMappings => {
                                mappings =
                                    newMappings; // Update the mappings list with fresh data from the server
                                alert("Mapping saved successfully");
                                populateSourceColumnSelect(sourceTableSelect.value);
                                populateTargetColumnSelect(targetTableSelect.value);
                                displayColumnMappings(sourceTableSelect.value,
                                    true); // Refresh the source mappings card
                                displayColumnMappings(targetTableSelect.value,
                                    false); // Refresh the target mappings card
                            })
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("An error occurred while saving the mapping.");
                    });
            });
        });



        document.getElementById('target-table').addEventListener('change', function(event) {
            let targetTable = event.target.value;
            let modelSelect = document.getElementById('model-select');
            let options = modelSelect.options;

            for (let i = 0; i < options.length; i++) {
                if (options[i].getAttribute('data-table') === targetTable) {
                    modelSelect.selectedIndex = i;
                    break;
                }
            }
        });

        // This is for the add model modal

        document.getElementById('saveModel').addEventListener('click', function(event) {


            // Get form values
            let modelName = document.getElementById('modelName').value;
            let modelTable = document.getElementById('modelTable').value;
            let modelComponent = document.getElementById('modelComponent').value;
            let modelModule = document.getElementById('modelModule').value;

            // Create new model
            fetch('/api/models', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                body: JSON.stringify({
                    model_name: modelName,
                    model_table: modelTable,
                    component_id: modelComponent,
                    module_id: modelModule
                })
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            }).then(json => {
                // Add new model to model dropdown
                let modelSelect = document.getElementById('model-select');
                let option = document.createElement('option');
                option.value = json.id; // Replace with actual model ID from response
                option.text = modelName;
                option.setAttribute('data-table', modelTable);
                modelSelect.add(option);

                // Close modal
                var myModalEl = document.getElementById('addModelModal');
                var modal = bootstrap.Modal.getInstance(myModalEl);
                modal.hide();

                // Reset form
                document.getElementById('addModelForm').reset();

                // Show SweetAlert
                Swal.fire(
                    'Model Saved',
                    'Your new model has been saved.',
                    'success'
                )
            }).catch(error => {
                console.error('Error:', error);
                Swal.fire(
                    'Error',
                    'An error occurred while saving your model.',
                    'error'
                )
            });
        });
    </script>
    <!-- Bootstrap Bundle with Popper.js -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleButton = document.getElementById("toggle-button");
            const presetFormContainer = document.getElementById("preset-form-container");

            toggleButton.addEventListener("click", function() {
                if (presetFormContainer.style.display === "none" || presetFormContainer.style.display ===
                    "") {
                    presetFormContainer.style.display = "block";
                } else {
                    presetFormContainer.style.display = "none";
                }
            });
        });
    </script>
@endpush
