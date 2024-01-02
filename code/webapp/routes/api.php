<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\UserTypeController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\InfoContentController;
use App\Http\Controllers\Api\SectionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\QuestionListController;
use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserListController;
use App\Http\Controllers\Api\DepartmentListController;

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

Route::middleware("auth:sanctum")->get("/user", function (Request $request) {
    $user = $request->user();
    $mentorDataResponse = app(UserController::class)->getMentorForUser($user->id);

    // Check if the response contains an error message
    $mentorData = json_decode($mentorDataResponse->getContent(), true);

    // Check if 'mentor' key is present in the response, if not, return an empty list
    $mentorList = isset($mentorData['mentor']) ? [$mentorData['mentor']] : [];


    return response()->json([
        "status" => true,
        "user" => $user,
        "mentor" => $mentorList,
    ]);
});



Route::middleware("auth:sanctum")->group(function () {
    Route::apiResources([
        "department" => DepartmentController::class,
        "departmentList" => DepartmentListController::class,
        "userType" => UserTypeController::class,
        "info" => InfoController::class,
        "infoContent" => InfoContentController::class,
        "section" => SectionController::class,
        "role" => RoleController::class,
        "question" => QuestionController::class,
        "questionList" => QuestionListController::class,
        "answer" => AnswerController::class,
        "userList" => UserListController::class,
        "users" => UserController::class,
    ]);
    Route::get("activeList", [
        QuestionListController::class,
        "activeList",
    ]);
});

// No Authentication needed
Route::get("department", [DepartmentController::class, "index"]);
Route::get("info", [InfoController::class, "index"]);
Route::get("infoContent", [InfoContentController::class, "index"]);
Route::get("section", [SectionController::class, "index"]);

Route::post("/auth/register", [AuthController::class, "createUser"]);
Route::post("/auth/login", [AuthController::class, "loginUser"]);
