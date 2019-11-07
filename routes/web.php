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

Route::get('/','HomeController@view')->name('home');

Route::group(['prefix' => 'kasus'], function () {
    Route::get('','KasusController@view')->name('kasus');
    Route::get('new','KasusController@viewtambah')->name('kasusBaru');
    Route::post('new','KasusController@tambahKasus');

    Route::group(['prefix' => 'edit'], function () {
        Route::group(['prefix' => '{idKasus}'], function () {
            Route::get('','KasusController@viewedit')->name('kasusEdit');     
            Route::post('','KasusController@editKasus');
            Route::group(['prefix' => 'korban'], function () {
                Route::get('new','KasusController@viewtambahkorban')->name('korbanBaru');
                Route::group(['prefix' => '{idKorban}'], function () {
                    Route::get('','KasusController@vieweditkorban')->name('korbanEdit');
                    Route::get('pelayanan/new','KasusController@viewtambahpelayanan')->name('pelayananBaru');
                    Route::get('rujukan/new','KasusController@viewtambahrujukan')->name('rujukanBaru');
                });
            });    
            Route::group(['prefix' => 'pelaku'], function () {
                Route::get('new','KasusController@viewtambahpelaku')->name('pelakuBaru');
                Route::group(['prefix' => '{idPelaku}'], function () {
                    Route::get('','KasusController@vieweditpelaku')->name('pelakuEdit');                
                    Route::get('penanganan/new','KasusController@viewtambahpenanganan')->name('penangananBaru');                
                });            
            });    
        });
    });
});

// korban/1
// korban/1/pelayanan/new
// korban/1/rujukan/new
// korban/new

// pelaku/1
// pelaku/1/penanganan/new