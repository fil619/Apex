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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/posts', 'PostController');

Route::get('indirect/sum', 'IndirectController@sum');
Route::get('indirect/total', 'IndirectController@total');
Route::resource('/indirect', 'IndirectController');

Route::resource('/ledger', 'IndirectLedgerController');
Route::resource('/direct', 'DirectController');
Route::resource('/directledger', 'DirectLedgerController');

Route::resource('/viewexpenses', 'viewexpensesController');


Route::get('/autocomplete', 'AutocompleteController@index');
Route::post('/autocomplete/fetch', 'AutocompleteController@fetch')->name('autocomplete.fetch');

Route::get('/autocomplet', 'AutocompletController@index');
Route::post('/autocomplet/fetch', 'AutocompletController@fetch')->name('autocomplet.fetch');
