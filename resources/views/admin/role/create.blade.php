@extends('layouts.app2')
@section('row_content')

        <div class="modal-body mx-lg-5 my-7">
            <div class="modal-header">
                <h1 class="fw-bold mt-6 center-content" style="margin-left: auto; margin-right: auto; width: fit-content;">
                    {{ __('Create Role') }}</h1>

            </div>
            <form method="POST" action="{{ route('role.store') }}" id="kt_modal_add_role_form" class="form">
                @csrf
                <div class="row">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="name" class="form-label fs-5 fw-bold">{{ __('Name') }}</label>
                                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                                            class="form-control form-control-lg" />
                                        @if ($errors->any())
                                            <ul class="text-danger fw-semibold">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="fs-4 fw-bold border-bottom pb-2 mb-4">
                                            Select Permissions
                                        </h3>
                                        <div class="row">
                                            @forelse ($permissions as $permission)
                                                <div class="col-3 mb-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $permission->name }}" class="form-check-input">
                                                        <label class="form-check-label">{{ $permission->name }}</label>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center text-muted">No permissions available</div>
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="text-center pt-4">
                                        <button type='submit' class='btn btn-success me-2'>
                                            {{ __('Create') }}
                                        </button>
                                        <button type="reset" class="btn btn-danger">Clear</button>
                                        <button type="button" class="btn btn-secondary me-2" onclick="history.back()">Back</button>
                                    </div>
                                </div>
                            </div>
                    </div>


            </form>
        </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Check if there's a success message in the session
            @if (Session::has('success'))
                // Trigger the SweetAlert
                Swal.fire({
                    text: "{{ Session::get('success') }}",
                    icon: "info",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            @endif
        });
    </script>
@endpush
