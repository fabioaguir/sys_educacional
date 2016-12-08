<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('index', ['as' => 'index', 'uses' => 'DefaultController@index']);

Route::group(['prefix' => 'cgm', 'as' => 'cgm.'], function () {
    Route::get('pessoaFisica/index', ['as' => 'index', 'uses' => 'PessoaFisicaController@index']);
    Route::get('pessoaFisica/create', ['as' => 'create', 'uses' => 'PessoaFisicaController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'PessoaFisicaController@store']);
});

Route::group(['prefix' => 'disciplina', 'as' => 'disciplina.'], function () {
    Route::get('index', ['as' => 'index', 'uses' => 'DisciplinasController@index']);
    Route::get('grid', ['as' => 'grid', 'uses' => 'DisciplinasController@grid']);
    Route::get('create', ['as' => 'create', 'uses' => 'DisciplinasController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'DisciplinasController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'DisciplinasController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'DisciplinasController@update']);
    Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'DisciplinasController@destroy']);
});


/*Route::get('index', ['as' => 'index', 'uses' => 'OperadorController@index']);
    Route::get('grid', ['as' => 'grid', 'uses' => 'OperadorController@grid']);
    Route::get('create', ['as' => 'create', 'uses' => 'OperadorController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'OperadorController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'OperadorController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'OperadorController@update']);*/
