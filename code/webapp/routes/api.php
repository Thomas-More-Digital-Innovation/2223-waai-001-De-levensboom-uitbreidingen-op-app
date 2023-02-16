<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\DepartmentListController;
use App\Http\Controllers\Api\UserTypeController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\SectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Need database for this to work
// Die guy maakt een controller aan om alles naar de database van CRUD te sturen
// Via die controller wordt de api geschreven
// Deze controller heeft ook authorisatie en rules(validation) 
 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResources([
        'department' => DepartmentController::class,
        'departmentList' => DepartmentListController::class,
        'userType' => UserTypeController::class,
        'info' => InfoController::class,
        'section' => SectionController::class,
    ]);
});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

