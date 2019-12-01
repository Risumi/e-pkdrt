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
Route::get('/login','AuthController@viewLogin');
Route::post('/login','AuthController@login');
Route::get('/download-pdf','AuthController@downloadPdf');
Route::get('/download-apk','AuthController@downloadApk');

// Route::get('nyoba','KasusController@nyoba');
// Route::post('nyoba','KasusController@nyobaNew');

Route::post('kasus/new','KasusController@tambahKasus');
Route::post('/kelurahan','KasusController@getKelurahan');
Route::post('/kelurahannew','KasusController@getKelurahanData');
Route::group(['middleware' => 'App\Http\Middleware\IsLogin'], function(){
    Route::post('/report','ReportController@report');
    Route::get('/logout','AuthController@logout');
    Route::group(['prefix' => 'kasus'], function () {
        Route::get('','KasusController@view')->name('kasus');
        // Route::get('new','KasusController@viewtambah')->name('kasusBaru');
        // Route::post('new','KasusController@tambahKasus');

        // Route::get('lapor','KasusController@lapor')->name('kasusBaru');
        Route::delete('delete/{idKasus}', 'KasusController@deleteKasus')->name('kasusDelete');
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
});
Route::get('kasus/new','KasusController@viewtambah')->name('kasusBaru');