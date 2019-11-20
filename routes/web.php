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
Route::post('/','HomeController@viewFilter')->name('home');
Route::post('/report','ReportController@report');

Route::group(['prefix' => 'kasus'], function () {
    Route::get('','KasusController@view')->name('kasus');
    Route::get('new','KasusController@viewtambah')->name('kasusBaru');
    Route::post('new','KasusController@tambahKasus');

    // Route::get('lapor','KasusController@lapor')->name('kasusBaru');

    Route::group(['prefix' => 'edit'], function () {
        Route::group(['prefix' => '{idKasus}'], function () {
            Route::get('','KasusController@viewedit')->name('kasusEdit');                 
            Route::post('','KasusController@editKasus');
            Route::get('/print','KasusController@printkasus');
            Route::group(['prefix' => 'korban'], function () {
                Route::get('new','KasusController@viewtambahkorban');
                Route::post('new','KasusController@tambahKorban');
                Route::group(['prefix' => '{idKorban}'], function () {
                    Route::get('','KasusController@vieweditkorban')->name('korbanEdit');
                    Route::post('','KasusController@editkorban');
                    Route::get('pelayanan/new','KasusController@viewtambahpelayanan');
                    Route::post('pelayanan/new','KasusController@tambahPelayanan');
                    Route::get('rujukan/new','KasusController@viewtambahrujukan');
                    Route::post('rujukan/new','KasusController@tambahRujukan');
                });
            });    
            Route::group(['prefix' => 'pelaku'], function () {                
                Route::get('new','KasusController@viewtambahpelaku')->name('pelakuBaru');
                Route::post('new','KasusController@tambahPelaku');
                Route::group(['prefix' => '{idPelaku}'], function () {
                    Route::post('','KasusController@editPelaku');
                    Route::get('','KasusController@vieweditpelaku')->name('pelakuEdit');                
                    Route::get('penanganan/new','KasusController@viewtambahpenanganan')->name('penangananBaru');                
                    Route::post('penanganan/new','KasusController@tambahPenanganan');
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