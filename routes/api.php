<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {

    //route login
    Route::post('/login', [App\Http\Controllers\Api\Admin\LoginController::class, 'index', ['as' => 'admin']]);

    //group route with middleware "auth:api_admin"
    Route::group(['middleware' => 'auth:api_admin'], function () {

        //data user
        Route::get('/user', [App\Http\Controllers\Api\Admin\LoginController::class, 'getUser', ['as' => 'admin']]);

        //refresh token JWT
        Route::get('/refresh', [App\Http\Controllers\Api\Admin\LoginController::class, 'refreshToken', ['as' => 'admin']]);

        //logout
        Route::post('/logout', [App\Http\Controllers\Api\Admin\LoginController::class, 'logout', ['as' => 'admin']]);
    });
});

Route::prefix('mitra')->group(function () {

    //route register
    Route::post('/register', [App\Http\Controllers\Api\Mitra\AuthController::class, 'register', ['as' => 'mitra']]);

    //route login
    Route::post('/login', [App\Http\Controllers\Api\Mitra\AuthController::class, 'login', ['as' => 'mitra']]);

    //route addBarber
    Route::post('/add-barber', [App\Http\Controllers\Api\Mitra\BarberController::class, 'addBarber', ['as' => 'mitra']]);

    //route updateBarber
    Route::post('/update-barber/{id}', [App\Http\Controllers\Api\Mitra\BarberController::class, 'updateBarber', ['as' => 'mitra']]);

    //route getBarber
    Route::get('/get-barber/{id}', [App\Http\Controllers\Api\Mitra\BarberController::class, 'getBarber', ['as' => 'mitra']]);

    //route addLayanan
    Route::post('/add-layanan', [App\Http\Controllers\Api\Mitra\LayananController::class, 'addLayanan', ['as' => 'mitra']]);

    //route updateLayanan
    Route::post('/update-layanan/{id}', [App\Http\Controllers\Api\Mitra\LayananController::class, 'updateLayanan', ['as' => 'mitra']]);

    //route deleteLayanan
    Route::delete('/delete-layanan/{id}', [App\Http\Controllers\Api\Mitra\LayananController::class, 'deleteLayanan', ['as' => 'mitra']]);

    //route getLayanan
    Route::get('/get-layanan/{id}', [App\Http\Controllers\Api\Mitra\LayananController::class, 'getLayanan', ['as' => 'mitra']]);

    //route getLayananByBarber
    Route::get('/get-layanan-by-barber/{id}', [App\Http\Controllers\Api\Mitra\LayananController::class, 'getLayananByBarber', ['as' => 'mitra']]);

    //route listAntrian
    Route::get('/list-antrian/{id}', [App\Http\Controllers\Api\Mitra\AntrianController::class, 'listAntrian', ['as' => 'mitra']]);

    //route detailAntrian
    Route::get('/detail-antrian/{id}', [App\Http\Controllers\Api\Mitra\AntrianController::class, 'detailAntrian', ['as' => 'mitra']]);

    //route updateAntrian
    Route::post('/update-antrian/{id}', [App\Http\Controllers\Api\Mitra\AntrianController::class, 'updateAntrian', ['as' => 'mitra']]);

    //route deleteAntrian
    Route::delete('/delete-antrian/{id}', [App\Http\Controllers\Api\Mitra\AntrianController::class, 'deleteAntrian', ['as' => 'mitra']]);
});


Route::prefix('user')->group(function () {

    //route register
    Route::post('/register', [App\Http\Controllers\Api\User\UserController::class, 'register', ['as' => 'user']]);

    //route login
    Route::post('/login', [App\Http\Controllers\Api\User\UserController::class, 'login', ['as' => 'user']]);

    //route listBarber
    Route::get('/list-barber', [App\Http\Controllers\Api\User\BarberController::class, 'listBarber', ['as' => 'user']]);

    //route detailBarber
    Route::get('/detail-barber/{id}', [App\Http\Controllers\Api\User\BarberController::class, 'detailBarber', ['as' => 'user']]);

    //route addAntrian
    Route::post('/add-antrian', [App\Http\Controllers\Api\User\AntrianController::class, 'addAntrian', ['as' => 'user']]);

    //route listAntrian
    Route::get('/list-antrian/{id}', [App\Http\Controllers\Api\User\AntrianController::class, 'listAntrian', ['as' => 'user']]);
});
