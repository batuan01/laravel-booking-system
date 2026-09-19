<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Customer
Route::get('/services', 'ServiceController@index')->name('services.index');
Route::get('/services/{service}', 'ServiceController@show')->name('services.show');

// Admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
    Route::resource('services', 'Admin\ServiceController');
    Route::resource('staff', 'Admin\StaffController');
    Route::resource('working-hours', 'Admin\WorkingHourController');
    Route::resource('bookings', 'Admin\BookingController');
});
