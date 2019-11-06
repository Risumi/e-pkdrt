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
Route::get('/kasus','KasusController@view')->name('kasus');
Route::get('/kasus/new','KasusController@viewtambah')->name('kasusBaru');
Route::get('/kasus/{id}','KasusController@viewedit')->name('kasusEdit');
Route::get('/kasus/korban/new','KasusController@viewtambahkorban')->name('korbanBaru');
Route::get('/kasus/pelaku/new','KasusController@viewtambahpelaku')->name('pelakuBaru');
Route::get('/kasus/korban/pelayanan/new','KasusController@viewtambahpelayanan')->name('pelayananBaru');
Route::get('/kasus/korban/rujukan/new','KasusController@viewtambahrujukan')->name('rujukanBaru');
Route::get('/kasus/pelaku/penanganan/new','KasusController@viewtambahpenanganan')->name('penangananBaru');
