@extends('layouts.app2')

@section('row_content')


        <div class="modal-dialog mt-8 shadow rounded bg-body">
            <div class="modal-content pt-4">
                <div class="modal-header">
                    <h2 class="fw-bold mx-auto" >
                        {{ __('Update Permission') }}
                    </h2>
                    <a href="{{ route('permission.index') }}" class="btn btn-icon btn-sm btn-active-icon-primary p-2">
                        <i class="bi bi-box-arrow-left fs-3"></i>
                    </a>
                    <script>
                        @if ($errors->any())
                        var errors = [
                            @foreach ($errors->all() as $error)
                            "{{ $error }}",
                            @endforeach
                        ];

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: errors.join('<br/>')
                        });
                        @endif
                    </script>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Notice-->
                    <div class="alert alert-warning d-flex align-items-center mb-9 p-6">
                        <i class="bi bi-exclamation-triangle-fill fs-2tx text-warning me-4"></i>
                        <div class="d-flex flex-grow-1">
                            <div class="fw-semibold">
                                <div class="fs-6 text-gray-700">
                                    <strong class="me-1">Warning!</strong> By editing the permission name, you might break the
                                    system permissions functionality. Please ensure you're absolutely certain before proceeding.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Notice-->
                    <form method="POST" action="{{ route('permission.update', $permission->id) }}" class="form"
                        id="kt_modal_add_permission_form">
                        @csrf
                        @method('PUT')
                        <div class="fv-row mb-3">
                            <label for="name" class="fs-6 fw-semibold form-label mb-2">{{ __('Name') }}</label>
                            <input id="name" type="text" name="name" value="{{ old('name', $permission->name) }}"
                                class="form-control" placeholder="Enter a permission name" required>
                        </div>
                        <div class="text-center pt-3">
                            
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            <a href="{{ route('permission.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


@endsection
