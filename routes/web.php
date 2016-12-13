<?php

# Middleware de autenticação
Route::group(['middleware' => 'auth'], function () {
    # Rota index
    Route::get('index', ['as' => 'index', 'uses' => 'DefaultController@index']);

    # Rotas do cgm
    Route::group(['prefix' => 'pessoaFisica', 'as' => 'pessoaFisica.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'PessoaFisicaController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'PessoaFisicaController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'PessoaFisicaController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'PessoaFisicaController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'PessoaFisicaController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'PessoaFisicaController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'PessoaFisicaController@destroy']);

        Route::post('findBairro', ['as' => 'findBairro', 'uses' => 'PessoaFisicaController@findBairro']);
        Route::post('findCidade', ['as' => 'findCidade', 'uses' => 'PessoaFisicaController@findCidade']);
    });

    Route::group(['prefix' => 'pessoaJuridica', 'as' => 'pessoaJuridica.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'PessoaJuridicaController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'PessoaJuridicaController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'PessoaJuridicaController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'PessoaJuridicaController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'PessoaJuridicaController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'PessoaJuridicaController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'PessoaJuridicaController@destroy']);

        Route::post('findBairro', ['as' => 'findBairro', 'uses' => 'PessoaJuridicaController@findBairro']);
        Route::post('findCidade', ['as' => 'findCidade', 'uses' => 'PessoaJuridicaController@findCidade']);
    });
    # Fim rotas cgm

    # Rotas do funcao
    Route::group(['prefix' => 'funcao', 'as' => 'funcao.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'FuncaoController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'FuncaoController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'FuncaoController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'FuncaoController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'FuncaoController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'FuncaoController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'FuncaoController@destroy']);
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

Route::group(['prefix' => 'cargo', 'as' => 'cargo.'], function () {
    Route::get('index', ['as' => 'index', 'uses' => 'CargosController@index']);
    Route::get('grid', ['as' => 'grid', 'uses' => 'CargosController@grid']);
    Route::get('create', ['as' => 'create', 'uses' => 'CargosController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'CargosController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CargosController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'CargosController@update']);
    Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'CargosController@destroy']);
});

Route::group(['prefix' => 'serie', 'as' => 'serie.'], function () {
    Route::get('index', ['as' => 'index', 'uses' => 'SeriesController@index']);
    Route::get('grid', ['as' => 'grid', 'uses' => 'SeriesController@grid']);
    Route::get('create', ['as' => 'create', 'uses' => 'SeriesController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'SeriesController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'SeriesController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'SeriesController@update']);
    Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'SeriesController@destroy']);
});


/*Route::get('index', ['as' => 'index', 'uses' => 'OperadorController@index']);
    Route::get('grid', ['as' => 'grid', 'uses' => 'OperadorController@grid']);
    Route::get('create', ['as' => 'create', 'uses' => 'OperadorController@create']);
    Route::post('store', ['as' => 'store', 'uses' => 'OperadorController@store']);
    Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'OperadorController@edit']);
    Route::post('update/{id}', ['as' => 'update', 'uses' => 'OperadorController@update']);*/


# ROtas de autenticação
Route::group(['middleware' => 'web'], function () {
    Route::get('login', ['as' => 'index', 'uses' => 'Authentication\LoginController@login']);
    Route::post('attempt', ['as' => 'attempt', 'uses' => 'Authentication\LoginController@attempt']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Authentication\LoginController@logout']);
});