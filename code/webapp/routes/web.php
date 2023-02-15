<?php

use App\Models\Department;
use App\Models\Info;
use App\Models\User;
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
    $clientcount = User::count();
    $mentorcount = User::count();
    $departmentcount = Department::count();
    $newscount = Info::count();

    return view('index', [
        'clientcount' => $clientcount,
        'mentorcount' => $mentorcount,
        'departmentcount' => $departmentcount,
        'newscount' => $newscount
    ]);
});

Route::get('/adults', function () {
    return view('adults', [
        'adults' => User::all()
    ]);
});

Route::get('/clients', function () {
    return view('clients', [
        'clients' => User::all()
    ]);
});

Route::get('/departments', function () {
    return view('departments', [
        'departments' => Department::all()
    ]);
});

Route::get('/mails', function () {
    return view('mails', [
        'mails' => User::all()
    ]);
});

Route::get('/mentors', function () {
    return view('mentors', [
        'mentors' => User::all()
    ]);
});

Route::get('/news', function () {
    return view('news', [
        'news' => User::all()
    ]);
});

Route::get('/survey', function () {
    return view('survey');
});

Route::get('/teens', function () {
    return view('teens', [
        'teens' => User::all()
    ]);
});

