<?php

use Illuminate\Support\Facades\Route;
use App\Mail\WelcomeMail;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Mail;

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
    return view('home.home');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/sign-in', function () {
    return view('auth.login');
});

Route::get('/sign-up', function () {
    return view('auth.register');
});

//voters pages


//dashboard links
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});