<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\EmployeeRoleController;
use App\Http\Controllers\Admin\JobDescriptionController;

/**
 * Admin routes group.
 */
Route::group(
    [
        'prefix' => 'admin',
        'middleware' => ['auth'],
    ],
    function () {
        /**
         * Resource routes for user management.
         */
        Route::resource('user', UserController::class);

        /**
         * Resource routes for permission management.
         */
        Route::resource('permission', PermissionController::class);

        /**
         * Resource routes for role management.
         */
        Route::resource('role', RoleController::class);

        /**
         * Route for displaying account information edit form.
         */
        Route::get('edit-account-info', [UserController::class, 'accountInfo'])->name('admin.account.info');

        /**
         * Route for storing updated account information.
         */
        Route::post('edit-account-info', [UserController::class, 'accountInfoStore'])->name('admin.account.info.store');

        /**
         * Route for storing updated password.
         */
        Route::post('change-password', [UserController::class, 'changePasswordStore'])->name('admin.account.password.store');


        
        //Employee Routes
        Route::resource('employee', EmployeeController::class);
        Route::get('employees/create/{id}', [EmployeeController::class, 'create'])->name('employee.create');
        


        //Employee Role Routes
        Route::resource('employeerole', EmployeeRoleController::class);
        Route::get('employeerole/create/{id}', [EmployeeRoleController::class, 'create'])->name('employeerole.create');
        Route::post('employeerole/storemodal', [EmployeeRoleController::class, 'storeModal'])->name('employeerole.storemodal');




        //Employee Role Routes
        Route::resource('jobdescriptions', JobDescriptionController::class);
        Route::get('jobdescriptions/create/{id}', [JobDescriptionController::class, 'create'])->name('employeerole.create');



        /**
         * Route for displaying admin home page.
         */
        Route::get('/', function () {
            // $layout = config('layout.current');
            return view('home');
        })->name('admin.home');

        /**
         * Route for displaying the homepage.
         */
    },
);
