@extends('layouts.app2')
@section('row_content')

            <form method="POST" action="{{ route('role.update', $role->id) }}" class="form">
                @csrf
                @method('PUT')
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            <h1 class="fw-bold mt-6 text-center">{{ __('Update role') }}</h1>
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="name" class="form-label fs-5 fw-bold">{{ __('Name') }}</label>
                                        <input id="name" type="text" name="name"
                                            value="{{ old('name', $role->name) }}" class="form-control form-control-lg" />

                                        @if ($errors->any())
                                            <ul class="text-danger fw-semibold">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                    @unless ($role->name == env('APP_SUPER_ADMIN', 'super-admin'))
                                        <div class="mb-4">
                                            <h3 class="fs-5 fw-bold mb-3">Permissions</h3>
                                            <div class="row">
                                                @forelse ($permissions as $permission)
                                                    <div class="col-md-6 mb-2">
                                                        <div class="form-check">
                                                            <input type="checkbox" name="permissions[]"
                                                                value="{{ $permission->name }}"
                                                                {{ in_array($permission->id, $roleHasPermissions) ? 'checked' : '' }}
                                                                class="form-check-input">
                                                            <label
                                                                class="form-check-label text-black">{{ $permission->name }}</label>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12 text-center text-muted">No permissions available</div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endunless
                                    <div class="text-center pt-4">
                                        <button type='submit' class='btn btn-success me-2'>
                                            {{ __('Update') }}
                                        </button>
                                        <button type="reset" class="btn btn-secondary me-2"
                                            data-kt-roles-modal-action="cancel" onclick="history.back()">Discard</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
    

@endsection
