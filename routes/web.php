<?php

# Middleware de autenticação
Route::group(['middleware' => 'auth'], function () {
    # Rota index
    Route::get('index', ['as' => 'index', 'uses' => 'DefaultController@index']);

    # Rotas do cgm
    Route::group(['prefix' => 'cgm', 'as' => 'cgm.'], function () {
        Route::get('pessoaFisica/index', ['as' => 'index', 'uses' => 'PessoaFisicaController@index']);
        Route::get('pessoaFisica/create', ['as' => 'create', 'uses' => 'PessoaFisicaController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'PessoaFisicaController@store']);
    });

    #Rotas servidor
    Route::group(['prefix' => 'servidor', 'as' => 'servidor.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'ServidorController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'ServidorController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'ServidorController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'ServidorController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ServidorController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'ServidorController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'DisciplinasController@destroy']);
    });

    # ROtas de disciplinas
    Route::group(['prefix' => 'disciplina', 'as' => 'disciplina.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'DisciplinasController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'DisciplinasController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'DisciplinasController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'DisciplinasController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'DisciplinasController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'DisciplinasController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'DisciplinasController@destroy']);
    });

    # ROtas do curso
    Route::group(['prefix' => 'curso', 'as' => 'curso.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'CursosController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'CursosController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'CursosController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'CursosController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CursosController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'CursosController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'CursosController@destroy']);
    });

    # ROtas do currículo
    Route::group(['prefix' => 'curriculo', 'as' => 'curriculo.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'CurriculosController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'CurriculosController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'CurriculosController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'CurriculosController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CurriculosController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'CurriculosController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'CurriculosController@destroy']);

        # ROtas de disciplinas do currículo
        Route::get('gridAdicionarDisciplina/{id}', ['as' => 'gridAdicionarDisciplina', 'uses' => 'CurriculoDisciplinaController@grid']);
        Route::post('disciplna/select2', ['as' => 'disciplina.select2', 'uses' => 'CurriculoDisciplinaController@disciplinasSelect2']);
        Route::post('adicionarDisciplina', ['as' => 'adicionarDisciplina', 'uses' => 'CurriculoDisciplinaController@adicionarDisciplina']);
        Route::post('removerDisciplina', ['as' => 'removerDisciplina', 'uses' => 'CurriculoDisciplinaController@removerDisciplina']);
    });
});

# ROtas de autenticação
Route::group(['middleware' => 'web'], function () {
    Route::get('login', ['as' => 'index', 'uses' => 'Authentication\LoginController@login']);
    Route::post('attempt', ['as' => 'attempt', 'uses' => 'Authentication\LoginController@attempt']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Authentication\LoginController@logout']);
});