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


class JobDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roleColumns = [
            'sales_role' => 'Sales Role',
            'operation_role' => 'Operation Role',
            'purchase_role' => 'Purchase Role',
            'admin_role' => 'Admin Role',
            'finance_role' => 'Finance Role',
            'accounting_role' => 'Accounting Role',
            'hr_role' => 'HR Role',
            'tech_role' => 'Technical Role',
            'rnd_role' => 'Research and Development Role'
        ];

        // Get all BUs the user has
        $user = Auth::user();
        

        $businessUnits =  $user->bus;
        $businessUnitsids = $user->bus->pluck('id');
       
        $roles = EmployeeRole::whereIn('bu_id', $businessUnitsids)->get();
  
        // Get job descriptions and roles for the user's BUs
        $jobdescriptions = JobDescription::whereIn('bu_id', $businessUnitsids)->get();

        return view('admin.employee.jobDescription.index', compact('businessUnits', 'jobdescriptions', 'roles', 'roleColumns'));
        
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
        $jobDescription = new JobDescription();
        $jobDescription->name = $request->jobdescription_name;
        $jobDescription->description = $request->jobdescription_description;
        $jobDescription->pre_amble = $request->jobdescription_preamble;
        $jobDescription->bu_id = $request->bu_id;
        $jobDescription->employee_role_id = $request->role_id;

        $jobDescription->save();

        
        return redirect()->route('jobdescriptions.index')->with('success', 'Job Description created successfully.');
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
        $jobdescription = JobDescription::find($id);
    
        return response()->json([
            'id' => $jobdescription->id,
            'name' => $jobdescription->name,
            'description' => $jobdescription->description,
            'preamble' => $jobdescription->pre_amble,
            'bu_id' => $jobdescription->bu_id,
            'role_id' => $jobdescription->role_id,
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jobDescription = JobDescription::find($id);

        $jobDescription->name = $request->jobdescription_name;
        $jobDescription->description = $request->jobdescription_description;
        $jobDescription->pre_amble = $request->jobdescription_preamble;
        $jobDescription->bu_id = $request->bu_id;
        $jobDescription->role_id = $request->role_id;

        $jobDescription->save();

        return redirect()->route('jobdescriptions.index')->with('success', 'Job Description updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jobDescription = JobDescription::find($id);
        $jobDescription->delete();

        return redirect()->route('jobdescriptions.index')->with('success', 'Job Description deleted successfully.');
    }
}
