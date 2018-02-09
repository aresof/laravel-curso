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

Route::middleware(['auth'])->group(function() {
    Route::middleware(['permissions'])->group(function() {
        Route::get('/prohibido',function() {
            return "Estás accediendo a contenido prohibido";
        });
    });
    Route::resource('clients','ClientController', ['except' =>[
        'show', 'edit', 'update', 'delete'
    ]]);
    Route::get('clients/{client}','ClientController@show')->name('clients.show');
    Route::patch('clients/{client}','ClientController@update')->name('clients.update');
    Route::get('clients/{client}/edit','ClientController@edit')->name('clients.edit');

});

Route::get('/home', 'HomeController@index')->name('home');
