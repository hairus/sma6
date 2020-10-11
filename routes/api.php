<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/admin/user', function () {
//     return response()->json('sip ini dari api:auth');
// });

Route::group(['middleware' => ['auth:api']], function () {
    route::get('admin/user', 'AdminApi@index');
    route::get('admin/AllMapel', 'AdminApi@AllMapel');
    route::post('admin/getSetkd', 'AdminApi@getSetkd');
    route::post('admin/DelSetkd', 'AdminApi@DelSetkd');
    route::get('admin/getGurus', 'AdminApi@getGurus');
    Route::get('admin/logPkpd', 'AdminApi@logPkpd');
});
