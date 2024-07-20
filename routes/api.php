<?php



use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingReportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseCatagoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseReportController;
use App\Http\Controllers\GymnasiumController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerPickupController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;







// =============================================new ==================================================================
use App\Http\Controllers\GymnasiamController;
use App\Http\Controllers\OwnerPickupReportController;
use App\Http\Controllers\profitAndLossController;
use App\Models\ExpenseCatagory;
use App\Models\ExpenseReport;
use App\Models\Gymnasium;

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
// ===============================================new from chat cpt===================================

// Route::apiResource('/customers', CustomerController::class)->middleware('web');
Route::apiResource('/customers', CustomerController::class);




// Authenticated routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Route group for admin/super-admin roles
    Route::middleware('role:super-admin|manager')->group(function () {



        // Route::apiResource('/roles', RoleController::class);
        // Route::post('/roles/{roleId}/addPermissionToRole', [RoleController::class, 'addPermissionToRole']);
        // Route::post('/roles/{roleId}/givePermissionToRole', [RoleController::class, 'givePermissionToRole']);
        // Route::apiResource('/permissions', PermissionController::class);
        // Route::apiResource('/users', UserController::class);
        // Route::apiResource('/bookings', BookingController::class);


    });

    // Route for halls resource (no role check)
});



Route::apiResource('/roles', RoleController::class);
Route::post('/roles/{roleId}/addPermissionToRole', [RoleController::class, 'addPermissionToRole']);
Route::post('/roles/{roleId}/givePermissionToRole', [RoleController::class, 'givePermissionToRole']);
Route::apiResource('/permissions', PermissionController::class);
Route::apiResource('/users', UserController::class);
Route::apiResource('/bookings', BookingController::class);
Route::apiResource('/payments', PaymentController::class);
Route::apiResource('/expenses', ExpenseController::class);
Route::apiResource('/expenseCategories', ExpenseCatagoryController::class); # be care here i have solved this problem by adding some codes on appServiceProvider like boot() and route::model...
#the problem where here that when we write /expenseCategories as route so it will generete the parameter by the name of expenseCategory as Model instanse no what you write like this public function show(ExpenseCatagory $expenseCatagory here here here expenseCatagory )

Route::apiResource('/owners', OwnerController::class);
Route::apiResource('/ownerPickups', OwnerPickupController::class);
Route::apiResource('/gymnasia', GymnasiumController::class);
Route::apiResource('/halls', HallController::class);




Route::apiResource('/expenseReports', ExpenseReportController::class);
Route::get('expenseReports/{data}', [ExpenseReportController::class, 'getExpenseByCategory']);

// =========
// Route::apiResource('/ownerPickupReports', OwnerPickupReportController::class);
// ========
Route::apiResource('/ownerPickupReports', OwnerPickupReportController::class);
Route::post('ownerPickupReports/', [OwnerPickupReportController::class, 'getOwnerPickupReportAll']);
// Route::get('ownerPickupReports/', [OwnerPickupReportController::class, 'getOwnerPickupReportByOwner']);


// Route::get('/getExpensesByCategory{name}', [ExpenseReportController::class, 'getExpensesByCategory']);
// Route::get('/reports', [ExpenseReportController::class, 'getExpensesByCatagory']);
Route::post('test', [ExpenseReportController::class, 'test']);

// =====================test==========================================================
// Route::post('reports', [ExpenseReportController::class, 'getExpenseByCategory']);
// Route::get('reports', [ExpenseReportController::class, 'getExpenseByCategory']);
// =====================test==========================================================
Route::apiResource('/bookingReports', BookingReportController::class);
Route::apiResource('/profitAndLosses', profitAndLossController::class);


// Public route for customers (no authentication required)





// ===============================================new from chat cpt===================================

// Route::group(['middleware' => ['role:super-admin|admin']], function() {

// });




// Route::apiResource('/roles', RoleController::class);
// Route::Post('/roles/{roleId}/addPermissionToRole', [RoleController::class,"addPermissionToRole"]);
// Route::Post('/roles/{roleId}/givePermissionToRole', [RoleController::class,"givePermissionToRole"]);
// Route::apiResource('/permissions', PermissionController::class);
// Route::apiResource('/users', UserController::class);
// Route::apiResource('/customers', CustomerController::class);
// Route::apiResource('/bookings', BookingController::class);
// Route::apiResource('/payments', PaymentController::class);
// Route::apiResource('/expenses', ExpenseController::class);
// Route::apiResource('/expenseCatagories', ExpenseCatagoryController::class);
// Route::apiResource('/owners', OwnerController::class);
// Route::apiResource('/ownerPickups', OwnerPickupController::class);
// Route::apiResource('/gymnasia', GymnasiumController::class);#---------
// // Route::delete('/gymnasia/{id}', [GymnasiumController::class,'destroy']);
// Route::post('gymnasia/{gymnasium}', [GymnasiumController::class, 'updateGymnasium']);

// // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     //     return $request->user();
//     // });
//     // gymnasia

//     // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     //     Route::apiResource('/customers', CustomerController::class);

//     // });




//     Route::group(['middleware'=>['auth:sanctum']],function () {
//         // Route::apiResource('/customers', CustomerController::cla ss);

//         Route::post('logout', [AuthController::class, 'logout']);
//         Route::apiResource('/halls', HallController::class);


// });


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


    // Route::apiResource('/gymnasiams', GymnasiamController::class); have to be deleted
