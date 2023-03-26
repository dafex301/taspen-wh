<?php

use App\Http\Controllers\LaporanController;
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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    // Dashboard Routes
    Route::get('/', 'DashboardController@index')->name('dashboard.index');

    // Guest Routes
    Route::group(['middleware' => ['guest']], function () {
        // Register Routes
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        // Login Routes
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    // Auth Routes
    Route::group(['middleware' => ['auth']], function () {
        // Pengadaan Routes
        Route::get('/pengadaan/create', 'PengadaanController@create')->name('pengadaan.create');
        Route::get('/pengadaan/detail/{id}', 'PengadaanController@show')->name('pengadaan.detail');
        Route::get('/pengadaan/history', 'PengadaanController@history')->name('pengadaan.history');
        Route::post('/pengadaan', 'PengadaanController@store')->name('pengadaan.store');

        // Permintaan Routes
        Route::get('/permintaan/create', 'PermintaanController@create')->name('permintaan.create');
        Route::get('/permintaan/detail/{id}', 'PermintaanController@show')->name('permintaan.detail');
        Route::get('/permintaan/history', 'PermintaanController@history')->name('permintaan.history');
        Route::post('/permintaan', 'PermintaanController@store')->name('permintaan.store');

        // Logout
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });

    // Admin Routes
    Route::group(['middleware' => ['admin']], function () {
        // User Routes
        Route::get('/admin/akun', 'UserController@index')->name('user.index');
        Route::post('/admin/akun', 'UserController@store')->name('user.store');
        Route::put('/admin/akun/{id}', 'UserController@update')->name('user.update');
        Route::delete('/admin/akun/{id}', 'UserController@destroy')->name('user.destroy');

        // Kategori Routes
        Route::get('/admin/kategori', 'KategoriController@index')->name('kategori.index');
        Route::post('/admin/kategori', 'KategoriController@store')->name('kategori.store');
        Route::put('/admin/kategori/{id}', 'KategoriController@update')->name('kategori.update');
        Route::delete('/admin/kategori/{id}', 'KategoriController@destroy')->name('kategori.destroy');
    });
});
