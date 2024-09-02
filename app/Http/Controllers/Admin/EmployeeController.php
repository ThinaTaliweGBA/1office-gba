<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Bu;
use App\Models\EmploymentType;
use App\Models\Person;
use App\Models\JobDescription;
use App\Models\EmployeeRole;
use App\Models\Company;
use App\Models\Employee;




class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all BUs the user has
        $user = Auth::user();
        

        $businessUnits =  $user->bus;
        $businessUnitsids = $user->bus->pluck('id');
       
        $roles = EmployeeRole::whereIn('bu_id', $businessUnitsids)->get();
        $employmentTypes = EmploymentType::all();
        $persons = Person::all();
        $jobDescriptions = JobDescription::all();
       
        $companies = Company::all();

        $employees = Employee::whereIn('bu_id', $businessUnitsids)->get();

        return view('admin.employee.index', compact('businessUnits', 'employmentTypes', 'persons', 'jobDescriptions', 'roles', 'companies', 'employees'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->person_id = $request->person_id;
        $employee->first_name = $request->first_name ?? null;
        $employee->last_name = $request->last_name ?? null;
        $employee->call_name = $request->call_name ?? null;
        $employee->emp_number = $request->emp_number ?? null;
        $employee->bu_id = $request->bu_id;
        $employee->employment_type_id = $request->employment_type_id;
        $employee->start_date = $request->start_date ? \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->start_date)->format('Y-m-d H:i:s') : null;
        $employee->end_date = $request->end_date ? \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->end_date)->format('Y-m-d H:i:s') : null;
        $employee->job_description_id = $request->job_description_id;
        $employee->employee_role_id = $request->role_id;
        $employee->company_id = $request->company_id;
        $employee->shiftwork = $request->shiftwork ? 1 : 0;
        $employee->standard_starttime = $request->standard_starttime ?? null;
        $employee->standard_endtime = $request->standard_endtime ?? null;
    
        $employee->save();
    
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }
    
   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        return response()->json([
            'id' => $employee->id,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'call_name' => $employee->call_name,
            'emp_number' => $employee->emp_number,
            'bu_id' => $employee->bu_id,
            'employment_type_id' => $employee->employment_type_id,
            'person_id' => $employee->person_id,
            'start_date' => $employee->start_date,
            'end_date' => $employee->end_date,
            'job_description_id' => $employee->job_description_id,
            'role_id' => $employee->employee_role_id,
            'company_id' => $employee->company_id,
            'shiftwork' => $employee->shiftwork,
            'standard_starttime' => $employee->standard_starttime,
            'standard_endtime' => $employee->standard_endtime,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->call_name = $request->call_name;
        $employee->emp_number = $request->emp_number;
        $employee->bu_id = $request->bu_id;
        $employee->employment_type_id = $request->employment_type_id;
        $employee->start_date = $request->start_date;
        $employee->end_date = $request->end_date;
        $employee->job_description_id = $request->job_description_id;
        $employee->employee_role_id = $request->role_id;
        $employee->company_id = $request->company_id;
        $employee->shiftwork = $request->shiftwork ? 1 : 0;
        $employee->standard_starttime = $request->standard_starttime;
        $employee->standard_endtime = $request->standard_endtime;

        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    }
}
