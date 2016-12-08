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

Route::group(['prefix' => 'curso', 'as' => 'curso.'], function () {
    Route::get('index', ['as' => 'index', 'uses' => 'CursosController@index']);
    Route::get('grid', ['as' => 'grid', 'uses' => 'CursosController@grid']);
    Route::get('create', ['as' => 'create', 'uses' => 'CursosController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'CursosController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CursosController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'CursosController@update']);
    Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'CursosController@destroy']);
});

Route::group(['prefix' => 'curriculo', 'as' => 'curriculo.'], function () {
    Route::get('index', ['as' => 'index', 'uses' => 'CurriculosController@index']);
    Route::get('grid', ['as' => 'grid', 'uses' => 'CurriculosController@grid']);
    Route::get('create', ['as' => 'create', 'uses' => 'CurriculosController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'CurriculosController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CurriculosController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'CurriculosController@update']);
    Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'CurriculosController@destroy']);
});

/*Route::get('index', ['as' => 'index', 'uses' => 'OperadorController@index']);
    Route::get('grid', ['as' => 'grid', 'uses' => 'OperadorController@grid']);
    Route::get('create', ['as' => 'create', 'uses' => 'OperadorController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'OperadorController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'OperadorController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'OperadorController@update']);*/

