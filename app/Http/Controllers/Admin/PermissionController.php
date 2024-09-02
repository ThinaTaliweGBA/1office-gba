<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

use App\Models\User;
use App\Notifications\PersonStatusNotification;

class PermissionController extends Controller
{


    function __construct()
    {
         $this->middleware('can:permission list', ['only' => ['index','show']]);
         $this->middleware('can:permission create', ['only' => ['create','store']]);
         $this->middleware('can:permission edit', ['only' => ['edit','update']]);
         $this->middleware('can:permission delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::latest()->get();
        return view('admin.permission.index', compact('permissions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Create Permission', 'A user permission has been created.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        return view('admin.permission.create')->with('success', 'Permission created successfully.');
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
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.permissions', 'permissions').',name',
            ]
        );
        Permission::create($request->all());
        return redirect()->route('permission.index')
            ->with('success', 'Permission created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('admin.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Permission   $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate(
            [
            'name' => 'required|string|max:255|unique:'.config('permission.table_names.permissions', 'permissions').',name,'.$permission->id,
            ]
        );
        $permission->update($request->all());


            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Permission Update', 'A user permission has been updated.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        return redirect()->route('permission.index')
            ->with('success', 'Permission updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();


            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('Permission Delete', 'A permission has been deleted.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        return redirect()->route('permission.index')
            ->with('success', 'Permission deleted successfully');
    }
}
