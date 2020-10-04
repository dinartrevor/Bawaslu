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

Auth::routes();

Route::group([
    'prefix'     => 'contents',
    'namespace'  => 'Contents',
    'middleware' => 'auth'
],
    function () {
        Route::resource('/pegawai','EmployeeController');
        Route::resource('/surat','LetterController');
        Route::get('/cetak_surat/{id}', 'LetterController@cetak_surat')->name('cetak_surat');
        Route::get('/search/pegawai', 'LetterController@action')->name('pegawai_search');

    }
);
Route::group([
    'prefix'     => '/',
    
    'middleware' => 'auth'
],
    function () {

        Route::get('/', 'HomeController@index');
    }
);
