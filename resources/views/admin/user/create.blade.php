@extends('layouts.app2')

@push('style')
    <style>
        /* Dark theme */
        [data-bs-theme=dark] textt {
            color: beige !important;
        }

        /* Light theme */
        [data-bs-theme=light] textt {
            color: Black !important;
        }

        button {
            background-color: #0a3622 !important;
        }
    </style>
@endpush

@section('row_content')
    <div class="card shadow">
        <div class="modal-content rounded">
            <div class="modal-header" id="kt_modal_add_user_header">
                <h2 class="fw-bold my-6 mx-auto">
                    {{ __('Create New User') }}</h2>
                @if ($errors->any())
                    <ul class="fv-row mb-7">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
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
            <div class="modal-body mx-3">
                <form id="kt_modal_add_user_form" class="form my-2 row" method="POST" action="{{ route('user.store') }}">
                    @csrf
                    <div class="col-8 border border-secondary rounded bg-secondary">
                        <div class="mx-auto">
                            <h3 class="text-center">User Details</h3>
                        </div>
                        {{-- <div class="mb-2">
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="{{ old('name') }}" />
                        </div> --}}
                        <div class="form-floating my-4 bold-placeholder">
                            <input type="text" class="form-control" name="name" id="Name" value=""
                                placeholder="" required="" value="{{ old('name') }}">
                            <label for="Name" class="required fs-4 text-gray-600">{{ __('Name') }}</label>
                        </div>

                        {{-- <div class="mb-2">
                            <label class="required fw-semibold fs-6 mb-2">{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="{{ old('email') }}" />
                        </div> --}}

                        <div class="form-floating  @error('Email') is-invalid focused is-focused  @enderror mt-3 mb-0">
                            <input type="email" class="form-control" name="email" id="Email"
                                value="{{ old('Email') }}" placeholder="">
                            <label for="Email" class="required fs-4 text-gray-600">Email Address</label>
                        </div>
                        @error('Email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-4 rounded">
                        <div class="mb-1">
                            <h3 class="fw-bold">{{ __('Roles') }}</h3>
                            <div class="d-flex flex-column">

                                @forelse ($roles as $role)
                                    <!--begin::Input row-->
                                    <div class="d-flex fv-row">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid">
                                            <!--begin::Label-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                                    class="form-check-input me-3 border border-secondary btn-outlined-secondary shadow-sm">
                                                <label class="textt">{{ $role->name }}</label>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                    <!--end::Input row-->
                                    <div class='separator separator-dashed my-5'></div>
                                @empty
                                    ----
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <button type='submit' class='btn bg-success'>
                            {{ __('Create') }}
                        </button>
                        <x-button id="btnCancel" class="btn-secondary" type="back" text="Cancel"
                            url="{{ url()->previous() }}"></x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
