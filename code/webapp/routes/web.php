<?php

use App\Http\Controllers\AdultController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepartmentController as ControllersDepartmentController;
use App\Models\Department;
use App\Models\Info;
use App\Models\User;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TeenController;
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


Route::get('/', function () {
    $clientcount = User::where('user_type_id', 2)->count();
    $mentorcount = User::where('user_type_id', 1)->orWhere('user_type_id', 3)->count();
    $departmentcount = Department::count();
    $newscount = Info::where('section_id', 3)->count();

    return view('index', [
        'clientcount' => $clientcount,
        'mentorcount' => $mentorcount,
        'departmentcount' => $departmentcount,
        'newscount' => $newscount,
        'user' => User::all()
    ]);
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth', 'verified')->group( function () {
    Route::Resources([
        'clients' => ClientController::class,
        'mentors' => MentorController::class,
        'departments' => ControllersDepartmentController::class,
        'adults' => AdultController::class,
        'teens' => TeenController::class,
        'news' => NewController::class,
        'mails' => MailController::class,
        'surveys' => SurveyController::class,
        'user' => ControllersUserController::class,
    ]);
});

Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');

require __DIR__.'/auth.php';

