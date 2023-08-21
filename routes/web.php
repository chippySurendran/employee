<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Auth::routes();
Auth::routes(['register' => false]);

/*21-08-2023 Authentication ... */

Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'App\Http\Controllers\Auth\LoginController@login');

Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/companies',App\Http\Controllers\CompanyController::class);
Route::resource('/employees',App\Http\Controllers\EmployeeController::class);
Route::get('/companies_get',[App\Http\Controllers\CompanyController::class,'getCompany']);
Route::get('/employees_get',[App\Http\Controllers\EmployeeController::class,'getEmployees']);
});

