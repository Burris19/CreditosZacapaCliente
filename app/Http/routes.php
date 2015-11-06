<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//// Authentication routes...
//Route::get('login', 'Auth\AuthController@getLogin');
//Route::post('login', 'Auth\AuthController@postLogin');
//Route::get('logout', 'Auth\AuthController@getLogout');
//
//// Registration routes...
//Route::get('register', 'Auth\AuthController@getRegister');
//Route::post('register', 'Auth\AuthController@postRegister');

Route::group(['prefix' => '/', 'namespace' => 'Admin','middleware' => 'auth'], function() {
    Route::get('', [
        'as' => 'home', function() {
            return redirect()->to('clientes');
        }
    ]);

    Route::resource('clientes','ClientesController');
    Route::resource('pagos','PagosController');

});

Route::controllers([
    'auth' => 'Authentication\AuthController'
]);
