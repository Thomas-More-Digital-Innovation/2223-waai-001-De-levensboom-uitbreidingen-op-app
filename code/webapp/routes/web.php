<?php

use App\Http\Controllers\AdultController;
use App\Http\Controllers\AdultInfoContentController;
use App\Http\Controllers\TeenInfoContentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepartmentController as ControllersDepartmentController;
use App\Models\Department;
use App\Models\Info;
use App\Models\User;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TeenController;
use App\Http\Controllers\TreePartController;
use App\Http\Controllers\UserController as ControllersUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    $clientcount = User::where("user_type_id", 2)->count();
    $mentorcount = User::where("user_type_id", 1)
        ->orWhere("user_type_id", 3)
        ->count();
    $departmentcount = Department::count();
    $newscount = Info::where("section_id", 3)->count();

    return view("index", [
        "clientcount" => $clientcount,
        "mentorcount" => $mentorcount,
        "departmentcount" => $departmentcount,
        "newscount" => $newscount,
        "user" => User::all(),
        "currentUser" => auth()->user(),
    ]);
})
    ->middleware(["auth", "verified"])
    ->name("home");

Route::middleware("auth", "verified")->group(function () {
    Route::Resources([
        "clients" => ClientController::class,
        "mentors" => MentorController::class,
        "departments" => ControllersDepartmentController::class,
        "adults" => AdultController::class,
        "teens" => TeenController::class,
        "news" => NewsController::class,
        "mails" => MailController::class,
        "surveys" => SurveyController::class,
        "user" => ControllersUserController::class,
        "adultInfoContents" => AdultInfoContentController::class,
        "teenInfoContents" => TeenInfoContentController::class,
        "treePart" => TreePartController::class,
    ]);
    Route::get("adults/{adult}/updateOrder", [
        AdultController::class,
        "updateOrder",
    ])->name("adults.updateOrder");
    Route::get("adults/{adult}/edit/updateOrder", [
        AdultInfoContentController::class,
        "updateOrder",
    ])->name("adultInfoContents.updateOrder");
    Route::get("teens/{teen}/updateOrder", [
        TeenController::class,
        "updateOrder",
    ])->name("teens.updateOrder");
    Route::get("teens/{teen}/edit/updateOrder", [
        TeenInfoContentController::class,
        "updateOrder",
    ])->name("teenInfoContents.updateOrder");
    Route::get("clients/sendSurvey/{id}", [
        ClientController::class,
        "sendSurvey",
    ])->name("clients.sendSurvey");
});

require_once __DIR__ . "/auth.php";
