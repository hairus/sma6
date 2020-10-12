<?php

use App\Http\Controllers\ApiController;
use App\Notifications\TaskComplate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\Notifiable;

// Config::set('debugbar.enabled', false);
Route::get('/', function () {
    return view('welcome');
});

// Route::get('admin/read', function () {
//     Auth::user()->unreadNotifications->markAsRead();
//     // Auth::user()->notifications()->delete();

//     return back();
// });


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm');

Auth::routes();
//membuat route nya denah
Route::get('/denah', 'denahController@index');
Route::post('admin/pm', 'adminController@pm');

Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin', function () {
        return view('/admin/layouts');
    });

    /* admin sma 6*/
    Route::get('admin/allUser', 'adminSmaController@index');

});

//=================ROUTE GURU =============================//
Route::group(['middleware' => ['guru']], function () {

});

//================= ROUTE PIKET=================================//
Route::group(['middleware' => ['piket']], function () {

});

//================ ROUTE BK ============================//
Route::group(['middleware' => ['bk']], function () {

});

//=================route nya siswa =============================//
Route::group(['middleware' => ['absen']], function () {

});

//================= ROUTE siswa yang ngabsen =================================//
Route::group(['middleware' => ['murid']], function () {

});

Route::group(['middleware' => ['tu']], function () {

});

/*============= siba =======================*/
Route::group(['middleware' => ['siba']], function () {
    Route::get('/sibA/index', 'Siba1Controller@formKosong');
    Route::post('/sibA/bio', 'Siba1Controller@formBiodata');
    Route::get('/sibA/tampil', 'Siba1Controller@tampilview');
    Route::post('/sibA/bio1', 'Siba1Controller@updateForm');
});

