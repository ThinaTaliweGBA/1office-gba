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



class EmployeeRoleController extends Controller
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
        $employmentTypes = EmploymentType::all();
        $persons = Person::whereHas('user')->get();
        $jobDescriptions = JobDescription::all();
        $roles = EmployeeRole::all();
        $companies = Company::all();

        return view('admin.employee.role.index', compact('businessUnits', 'employmentTypes', 'persons', 'jobDescriptions', 'roles', 'companies', 'roleColumns'));
        
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
    
    public function store(Request $request) {
        $validatedData = $request->validate([
            'employee_role_name' => 'required|string|max:45',
            'employee_role_description' => 'nullable|string|max:255',
            'bu_id' => 'required',
            'sales_role' => 'nullable|boolean',
            'operation_role' => 'nullable|boolean',
            'purchase_role' => 'nullable|boolean',
            'admin_role' => 'nullable|boolean',
            'finance_role' => 'nullable|boolean',
            'accounting_role' => 'nullable|boolean',
            'hr_role' => 'nullable|boolean',
            'tech_role' => 'nullable|boolean',
            'rnd_role' => 'nullable|boolean',
        ]);
    
        // Create a new EmployeeRole instance
        $employeeRole = new EmployeeRole();
        $employeeRole->name = $validatedData['employee_role_name'];
        $employeeRole->description = $validatedData['employee_role_description'] ?? null;
        $employeeRole->bu_id = $validatedData['bu_id'];
        $employeeRole->sales_role = $request->has('sales_role') ? 1 : 0;
        $employeeRole->operation_role = $request->has('operation_role') ? 1 : 0;
        $employeeRole->purchase_role = $request->has('purchase_role') ? 1 : 0;
        $employeeRole->admin_role = $request->has('admin_role') ? 1 : 0;
        $employeeRole->finance_role = $request->has('finance_role') ? 1 : 0;
        $employeeRole->accounting_role = $request->has('accounting_role') ? 1 : 0;
        $employeeRole->hr_role = $request->has('hr_role') ? 1 : 0;
        $employeeRole->tech_role = $request->has('tech_role') ? 1 : 0;
        $employeeRole->rnd_role = $request->has('rnd_role') ? 1 : 0;

        // Save the instance to the database
        $employeeRole->save();
    
        return redirect()->route('employeerole.index')->with('success', 'Role created successfully.');
    }

    public function storeModal(Request $request) {
        $validatedData = $request->validate([
            'employee_role_name' => 'required|string|max:45',
            'employee_role_description' => 'nullable|string|max:255',
            'bu_id' => 'required',
            'sales_role' => 'nullable|boolean',
            'operation_role' => 'nullable|boolean',
            'purchase_role' => 'nullable|boolean',
            'admin_role' => 'nullable|boolean',
            'finance_role' => 'nullable|boolean',
            'accounting_role' => 'nullable|boolean',
            'hr_role' => 'nullable|boolean',
            'tech_role' => 'nullable|boolean',
            'rnd_role' => 'nullable|boolean',
        ]);
    
        // Create a new EmployeeRole instance
        $employeeRole = new EmployeeRole();
        $employeeRole->name = $validatedData['employee_role_name'];
        $employeeRole->description = $validatedData['employee_role_description'] ?? null;
        $employeeRole->bu_id = $validatedData['bu_id'];
        $employeeRole->sales_role = $request->has('sales_role') ? 1 : 0;
        $employeeRole->operation_role = $request->has('operation_role') ? 1 : 0;
        $employeeRole->purchase_role = $request->has('purchase_role') ? 1 : 0;
        $employeeRole->admin_role = $request->has('admin_role') ? 1 : 0;
        $employeeRole->finance_role = $request->has('finance_role') ? 1 : 0;
        $employeeRole->accounting_role = $request->has('accounting_role') ? 1 : 0;
        $employeeRole->hr_role = $request->has('hr_role') ? 1 : 0;
        $employeeRole->tech_role = $request->has('tech_role') ? 1 : 0;
        $employeeRole->rnd_role = $request->has('rnd_role') ? 1 : 0;
    
        // Save the instance to the database
        $employeeRole->save();
    
        // Return a JSON response
        return response()->json([
            'success' => true,
            'role' => [
                'id' => $employeeRole->id,
                'name' => $employeeRole->name,
                'description' => $employeeRole->description,
            ],
        ]);
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
    public function edit(EmployeeRole $employeerole) {
        return response()->json($employeerole);
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmployeeRole $employeerole) {
        $validatedData = $request->validate([
            'employee_role_name' => 'required|string|max:45',
            'employee_role_description' => 'nullable|string|max:255',
            'bu_id' => 'required',
            'sales_role' => 'nullable|boolean',
            'operation_role' => 'nullable|boolean',
            'purchase_role' => 'nullable|boolean',
            'admin_role' => 'nullable|boolean',
            'finance_role' => 'nullable|boolean',
            'accounting_role' => 'nullable|boolean',
            'hr_role' => 'nullable|boolean',
            'tech_role' => 'nullable|boolean',
            'rnd_role' => 'nullable|boolean',
        ]);
    
        $employeerole->name = $validatedData['employee_role_name'];
        $employeerole->description = $validatedData['employee_role_description'] ?? null;
        $employeerole->bu_id = $validatedData['bu_id'];
        $employeerole->sales_role = $request->has('sales_role') ? 1 : 0;
        $employeerole->operation_role = $request->has('operation_role') ? 1 : 0;
        $employeerole->purchase_role = $request->has('purchase_role') ? 1 : 0;
        $employeerole->admin_role = $request->has('admin_role') ? 1 : 0;
        $employeerole->finance_role = $request->has('finance_role') ? 1 : 0;
        $employeerole->accounting_role = $request->has('accounting_role') ? 1 : 0;
        $employeerole->hr_role = $request->has('hr_role') ? 1 : 0;
        $employeerole->tech_role = $request->has('tech_role') ? 1 : 0;
        $employeerole->rnd_role = $request->has('rnd_role') ? 1 : 0;
        $employeerole->save();
    
        return redirect()->route('employeerole.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeRole $employeerole)
    {
        $employeerole->delete();
        return redirect()->route('employeerole.index')->with('success', 'Role deleted successfully.');
    }
}
