<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('index');
    })->name('index');

    /*************************************** Sections **************************************/
    Route::resource('sections', 'SectionController', ['except' => ['edit', 'show', 'create']]);
    /*************************************** End Sections **********************************/

    Route::get('/{page}', 'AdminController@index');
    Route::get('/test', function () {
        return view('factures.empty');
    });
});





Route::get('/home', 'HomeController@index')->name('home');
