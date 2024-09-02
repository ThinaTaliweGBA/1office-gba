@extends('layouts.app2')

@section('row_content')
<div class="card mb-10">
  <!--begin::Header-->
  <div class="card-header border-0 pt-5">
    <h3 class="card-title align-items-start flex-column">
      {{-- <span class="card-label fw-bold fs-3 mb-1">Dependants</span> --}}
      <h2 class="my-9" style="margin-left: auto; margin-right: auto; width: fit-content;">All Dependants</h2>
      {{-- <p class="text-muted mt-1 fw-semibold fs-7">See All Dependants.</p> --}}
    </h3>
  </div>
  <!--end::Header-->
        <div class="table-responsive px-4 pb-4">

          <table class="table table-flush" id="datatable-search">
            {{-- <input name="daterange" class="form-control" style="width: 14em;" /><br> --}}
            <thead class="thead-light">
        <tr class="fw-bold text-muted bg-light p-3">
          <th class="text-start rounded-start">Name</th>
          <th>Surname</th>
          <th>ID Number</th>
          <th>Date Of Birth</th>
          <th>Gender</th>
          <th>Main Member</th>
          <th>Age</th>
          <th class="text-center rounded-end">Manage</th>
        </tr>
      </thead>
            <tbody>
              @foreach ($dependants as $dependant)
              <tr>
                <td class="text-sm font-weight-normal pt-3">{{$dependant->personDep->first_name}}</td>
                <td class="text-sm font-weight-normal pt-3">{{$dependant->personDep->last_name}}</td>
                <td class="text-sm font-weight-normal pt-3">{{$dependant->personDep->id_number}}</td>
                <td class="text-sm font-weight-normal pt-3">{{substr($dependant->personDep->birth_date,0,10)}}</td>
                <td class="text-sm font-weight-normal pt-3">{{$dependant->personDep->gender_id}}</td>
                <td class="text-sm font-weight-normal pt-3"><a
                    href="/view-member/{{$dependant->personMain->membership->first()->id}}">{{$dependant->personMain->screen_name}}</a>
                </td>
                @php
                $age = ageFromDOB($dependant->personDep->birth_date);
                @endphp

                <td class="text-sm fw-bolder my-2 pt-2 px-2 badge badge-sm" style="background-color: {{$age < 15 ? '#28a745' : ($age < 20 ? '#ffc107' : '#dc3545')}}; color: white;">
                  {{$age}}
                </td>



                <td class="text-sm text-center w-5 font-weight-normal">
                  <a class="btn btn-link text-success text-gradient mx-3 mb-0"
                    href="/view-member/{{$dependant->personMain->membership->first()->id}}#pills-dependants"><i class="bi bi-eye-fill"></i>View</a>
                  <a class="btn btn-link text-warning text-gradient mx-3 mb-0"
                    href="/edit-member/{{$dependant->personMain->membership->first()->id}}"><i class="bi bi-pencil-fill"></i>Edit</a>
                </td>

              </tr>
              @endforeach

            </tbody>
          </table>
        </div>
      </div>
@endsection
