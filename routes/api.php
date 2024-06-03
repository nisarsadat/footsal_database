<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseCatagoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GymnasiamController;
use App\Http\Controllers\GymnasiumController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerPickupController;
use App\Http\Controllers\PaymentController;
use App\Models\ExpenseCatagory;
use App\Models\Gymnasium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('/customers', CustomerController::class);
Route::apiResource('/halls', HallController::class);
Route::apiResource('/bookings', BookingController::class);
Route::apiResource('/payments', PaymentController::class);
Route::apiResource('/expenses', ExpenseController::class);
Route::apiResource('/expenseCatagories', ExpenseCatagoryController::class);
Route::apiResource('/owners', OwnerController::class);
Route::apiResource('/ownerPickups', OwnerPickupController::class);
Route::apiResource('/gymnasia', GymnasiumController::class);#---------
// Route::delete('/gymnasia/{id}', [GymnasiumController::class,'destroy']);
Route::post('gymnasia/{gymnasium}', [GymnasiumController::class, 'updateGymnasium']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    // gymnasia





    // Route::apiResource('/gymnasiams', GymnasiamController::class); have to be deleted
