<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\DependantsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get(
    '/user', function (Request $request) {
        return $request->user();
    }
);

Route::get('/users', [UserController::class, 'index']);

// Add this line
Route::post('/models', 'App\Http\Controllers\ModelController@store');




Route::middleware(['verify.secret.key'])->group(function () {
    // Your routes here
    Route::get('/reporting', [ReportsController::class, 'getReport']);
});


Route::get('/dependants', [DependantsController::class, 'indexx']);


