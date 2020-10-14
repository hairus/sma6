<?php

use App\Http\Controllers\ApiController;
use App\Notifications\TaskComplate;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\Notifiable;


Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('admin/exim', 'adminSmaController@exim');
    Route::get('admin/exportSiswa', 'adminSmaController@exportSiswa');
    Route::post('admin/ImportSiswa', 'adminSmaController@ImportSiswa');
    Route::get('admin/exportGuru', 'adminSmaController@exportGuru');
    Route::post('admin/ImportGuru', 'adminSmaController@ImportGuru');

    /** set kelas */
    Route::get('/admin/kelas', 'adminSmaController@kelas');
    Route::post('/admin/ck', 'adminSmaController@ck');
    Route::delete('/admin/del', 'adminSmaController@delKelas');
});

//=================ROUTE GURU =============================//
Route::group(['middleware' => ['guru']], function () {
    Route::get('guru', 'guruSmaController@index');
    Route::get('guru/plhKls', 'guruSmaController@plhKls');
    Route::post('guru/plhKls', 'guruSmaController@kelas_id');
    Route::get('guru/kelas/{id}', 'guruSmaController@redirect');
    Route::post('guru/upload', 'guruSmaController@upload');
    Route::get('guru/allUpload', 'guruSmaController@allUpload');
    Route::get('guru/delUpload/{id}', 'guruSmaController@delUpload');
});


//================= ROUTE siswa yang ngabsen =================================//
Route::group(['middleware' => ['murid']], function () {
    Route::get('siswa', 'siswaController@index');
    Route::get('siswa/download', 'siswaController@download');
});

/*============= siba =======================*/
Route::group(['middleware' => ['siba']], function () {
    Route::get('/sibA/index', 'Siba1Controller@formKosong');
    Route::post('/sibA/bio', 'Siba1Controller@formBiodata');
    Route::get('/sibA/tampil', 'Siba1Controller@tampilview');
    Route::post('/sibA/bio1', 'Siba1Controller@updateForm');
});
