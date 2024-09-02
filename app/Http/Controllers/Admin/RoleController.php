<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\PersonStatusNotification;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:role list', ['only' => ['index', 'show']]);
        $this->middleware('can:role create', ['only' => ['create', 'store']]);
        $this->middleware('can:role edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:role delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->get();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
            'name' => 'required|string|max:255|unique:' . config('permission.table_names.roles', 'roles') . ',name',
            ]
        );
        $role = Role::create($request->all());
        if (!empty($request->permissions)) {
            $role->givePermissionTo($request->permissions);
        }



            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Create Role', 'A Role has been created.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        return redirect()->route('role.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');
        return view('admin.role.show', compact('role', 'permissions', 'roleHasPermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $roleHasPermissions = array_column(json_decode($role->permissions, true), 'id');
        return view('admin.role.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Role         $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate(
            [
            'name' => 'required|string|max:255|unique:' . config('permission.table_names.roles', 'roles') . ',name,' . $role->id,
            ]
        );
        $role->update($request->all());
        $permissions = $request->permissions ?? [];
        $role->syncPermissions($permissions);



            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Role Update', 'A Role has been updated.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        return redirect()->route('role.index')
            ->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Role Delete', 'A Role has been deleted.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        return redirect()->route('role.index')
            ->with('success', 'Role deleted successfully');
    }
}
