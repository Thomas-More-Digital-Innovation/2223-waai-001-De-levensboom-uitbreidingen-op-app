<?php

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
    return view('index');
});

Route::get('/adults', function () {
    return view('adults');
});

Route::get('/clients', function () {
    return view('clients');
});

Route::get('/departments', function () {
    return view('departments');
});

Route::get('/mails', function () {
    return view('mails');
});

Route::get('/mentors', function () {
    return view('mentors');
});

Route::get('/news', function () {
    return view('news');
});

Route::get('/survey', function () {
    return view('survey');
});

Route::get('/teens', function () {
    return view('teens');
});

