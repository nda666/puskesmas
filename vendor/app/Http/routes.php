<?php
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
 */

Route::group(['middleware' => 'puskesmas'], function () {
    Route::auth();
    Route::get('/', ['middleware' => 'guest:pegawai', 'uses' => 'HomeController@index']);

    Route::group(['prefix' => 'administrasi', 'middleware' => 'administrasi:pegawai'], function () {
        Route::get('/', 'Administrasi\DashboardController@getIndex');
        Route::controller('/dashboard', 'Administrasi\DashboardController');
        Route::controller('/pendaftaran', 'Administrasi\PendaftaranController');
        Route::controller('rawat-jalan', 'Administrasi\RawatJalanController');
        Route::get('/logout', 'Auth\AuthController@logout');
        Route::controller('pegawai', 'Administrasi\PegawaiController');
        Route::controller('dokter', 'Administrasi\DokterController');
        Route::controller('poli', 'Administrasi\PoliController');
        Route::controller('obat', 'Administrasi\ObatController');
        Route::controller('laporan', 'Administrasi\LaporanController');
        Route::controller('profile', 'Auth\ProfileController');
        });

    Route::group(['prefix' => 'konsultan', 'middleware' => 'konsultan:pegawai'], function () {
        Route::get('/', 'Konsultan\DashboardController@getIndex');
        Route::controller('/dashboard', 'Konsultan\DashboardController');
        Route::controller('/rawat-jalan', 'Konsultan\KonsultasiController');
        Route::controller('profile', 'Auth\ProfileController');
        Route::get('/logout', 'Auth\AuthController@logout');
    });

    // Prefix dokter
    Route::group(['prefix' => 'dokter', 'middleware' => 'dokter:pegawai'], function () {
        Route::get('/', 'Dokter\DashboardController@getIndex');
        Route::controller('/dashboard', 'Dokter\DashboardController');
        Route::controller('/rawat-jalan', 'Dokter\TindakanController');
        Route::controller('profile', 'Auth\ProfileController');
        Route::get('/logout', 'Auth\AuthController@logout');
    });

    Route::group(['prefix' => 'apoteker', 'middleware' => 'apoteker:pegawai'], function () {
        Route::get('/', 'Apoteker\DashboardController@getIndex');
        Route::controller('/dashboard', 'Apoteker\DashboardController');
        Route::controller('/rawat-jalan', 'Apoteker\ResepController');
        Route::controller('/obat', 'Apoteker\ObatController');
        Route::controller('profile', 'Auth\ProfileController');
        Route::get('/logout', 'Auth\AuthController@logout');
    });
});
