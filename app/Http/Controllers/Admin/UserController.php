<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\Admin\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\UserHasBu;

use App\Notifications\PersonStatusNotification;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user list', ['only' => ['index', 'show']]);
        $this->middleware('can:user create', ['only' => ['create', 'store']]);
        $this->middleware('can:user edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:user delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        // $users = $users->latest();

        return view('admin.user.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();


            $user = auth()->user();
            //dd($user);
            if ($user) {
                // Notify the authenticated user about the creation
                $user->notify(new PersonStatusNotification('User Created', 'A new user has been created.'));
            } else {
                // Handle cases where no user is logged in (optional)
                // For example, you could log this situation or handle it as per your application's requirements
                Log::warning('Attempted to send a notification, but no user is logged in.');
            }

        return view('admin.user.create', compact('roles'))->with('success', 'User created successfully.');;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request, UserService $userService)
    {
        // dd($request->all());
        $user = $userService->createUser($request);
        $userWithRoles = $userService->assignRole($request, $user);

        $expiresAt = now()->addDay();

        $userWithRoles->sendWelcomeNotification($expiresAt);

        return redirect()->route('user.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::all();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');
        return view('admin.user.show', compact('user', 'roles', 'userHasRoles'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userHasRoles = array_column(json_decode($user->roles, true), 'id');
        return view('admin.user.edit', compact('user', 'roles', 'userHasRoles'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request->all());
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        $roles = $request->roles ?? [];
        //Siya: Used syncRoles instead of assignRole - Basically Update vs Create
        $user->syncRoles($roles);

            // $user = auth()->user();
            // //dd($user);
            // if ($user) {
            //     // Notify the authenticated user about the creation
            //     $user->notify(new PersonStatusNotification('User Update', 'A user has been updated.'));
            // } else {
            //     // Handle cases where no user is logged in (optional)
            //     // For example, you could log this situation or handle it as per your application's requirements
            //     Log::warning('Attempted to send a notification, but no user is logged in.');
            // }

      
        return redirect()->route('user.index')
        ->with('success', 'User has been updated!');
    }

    //Siya: This is the password set when a user is emailed a "set initial password" email from admin
    public function savePassword(Request $request, User $user)
    {
        // dd($request->all());
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        $user->welcome_valid_until = null;

        // $roles = $request->roles ?? [];
        // //Siya: Used syncRoles instead of assignRole - Basically Update vs Create
        // $user->syncRoles($roles);

        auth()->login($user);

        // return $this->showAddUserInfoForm($user);
        return redirect()->route('onboarding', [
            'email' => $request->email,
            'user' => $user->id,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Delete related records in the users_has_bu table
        UserHasBu::where('users_id', $user->id)->delete();

        // Now delete the user
        $user->delete();

        // Notify the authenticated user about the deletion
        $authUser = auth()->user();

        if ($authUser) {
            $authUser->notify(new PersonStatusNotification('User Delete', 'A user has been deleted.'));
        } else {
            Log::warning('Attempted to send a notification, but no user is logged in.');
        }

        return redirect()->route('user.index')
            ->with('success', 'User has been deleted!');
    }

    public function accountInfo()
    {
        $user = Auth::user();
        return view('admin.user.account_info', compact('user'));
    }

    public function accountInfoStore(Request $request)
    {
        $request->validateWithBag('account', [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . \Auth::user()->id],
        ]);
        $user = \Auth::user()->update($request->except(['_token']));
        if ($user) {
            $message = "Account updated successfully.";
        } else {
            $message = "Error while saving. Please try again.";
        }
        return redirect()->route('admin.account.info')->with('account_message', $message);
    }

    public function changePasswordStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required'],
            'new_password' => ['required', Rules\Password::defaults()],
            'confirm_password' => ['required', 'same:new_password', Rules\Password::defaults()],
        ]);
        $validator->after(function ($validator) use ($request) {
            if ($validator->failed()) {
                return;
            }

            if (!Hash::check($request->input('old_password'), Auth::user()->password)) {
                $validator->errors()->add(
                    'old_password', 'Old password is incorrect.'
                );
            }
        });
        $validator->validateWithBag('password');
        $user = \Auth::user()->update([
            'password' => Hash::make($request->input('new_password')),
        ]);
        if ($user) {
            $message = "Password updated successfully.";
        } else {
            $message = "Error while saving. Please try again.";
        }
        return redirect()->route('admin.account.info')->with('password_message', $message);
    }


    public function bypassAccess(Request $request)
    {
        $bypassPassword = '10111'; // Replace with bypass password
        if ($request->bypass_password === $bypassPassword) {
            session(['bypass_access' => true]);
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['bypass_password' => 'Incorrect password.']);
        }
    }
    
}
