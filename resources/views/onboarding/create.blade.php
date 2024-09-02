@extends('layouts.app2')

@section('content')

<div class="container">
    <h2 class="mb-4">New User Boarding</h2>
    <form action="{{ route('boarding.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="col">
                <label for="initials" class="form-label">Initials</label>
                <input type="text" class="form-control" id="initials" name="initials" required>
            </div>
            <div class="col">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="screen_name" class="form-label">Screen Name</label>
                <input type="text" class="form-control" id="screen_name" name="screen_name" required>
            </div>
            <div class="col">
                <label for="id_number" class="form-label">ID Number</label>
                <input type="text" class="form-control" id="id_number" name="id_number" required>
            </div>
            <div class="col">
                <label for="birth_date" class="form-label">Birth Date</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
            </div>
            <div class="col">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="married_status" class="form-label">Marital Status</label>
                <select class="form-select" id="married_status" name="married_status" required>
                    @foreach($maritalStatuses as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="gender_id" class="form-label">Gender</label>
                <select class="form-select" id="gender_id" name="gender_id" required>
                    @foreach($genders as $gender)
                        <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="residence_country_id" class="form-label">Residence Country</label>
                <select class="form-select" id="residence_country_id" name="residence_country_id" required>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


{{-- <div class="container">
    <h2>Create New User</h2>
    <form action="{{ route('onboarding.store') }}" method="post">
        @csrf
        <!-- All your input fields go here -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div> --}}
@endsection
