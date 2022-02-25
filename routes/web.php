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
    /*************************************** Sections **************************************/
    Route::resource('produits', 'ProduitController', ['except' => ['edit', 'show', 'create']]);
    Route::post('restore/{id}', 'ProduitController@resore')->name('restore');
    /*************************************** End Sections **********************************/
    /*************************************** Sections **************************************/
    Route::resource('factures', 'FactureController');
    Route::get('section/{id}', 'FactureController@getProduct')->name('section.getProducts'); // fill select product from section
    /*************************************** End Sections **********************************/

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('roles', 'RoleController');
        Route::resource('users', 'UserController');
    });


    Route::get('/test', function () {
        return view('factures.empty');
    });
    Route::get('/{page}', 'AdminController@index');
});





Route::get('/home', 'HomeController@index')->name('home');
