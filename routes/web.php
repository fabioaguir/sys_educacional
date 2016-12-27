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
        Route::post('searchCpf', ['as' => 'searchCpf', 'uses' => 'PessoaFisicaController@searchCpf']);
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
        Route::post('searchCnpj', ['as' => 'searchCnpj', 'uses' => 'PessoaJuridicaController@searchCnpj']);
    });
    # Fim rotas cgm

    # Rotas de funcao
    Route::group(['prefix' => 'funcao', 'as' => 'funcao.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'FuncaoController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'FuncaoController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'FuncaoController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'FuncaoController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'FuncaoController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'FuncaoController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'FuncaoController@destroy']);
    });

    # Rotas de escola
    Route::group(['prefix' => 'escola', 'as' => 'escola.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'EscolaController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'EscolaController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'EscolaController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'EscolaController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'EscolaController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'EscolaController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'EscolaController@destroy']);

        # Rotas para endereço
        Route::post('findBairro', ['as' => 'findBairro', 'uses' => 'EscolaController@findBairro']);
        Route::post('findCidade', ['as' => 'findCidade', 'uses' => 'EscolaController@findCidade']);

        # Rotas para cursos
        Route::get('curso/gridCursos/{id}', ['as' => 'curso.gridCursos', 'uses' => 'EscolaCursoController@gridCursos']);
        Route::post('curso/select2', ['as' => 'curso.select2', 'uses' => 'EscolaCursoController@cursosSelect2']);
        Route::post('curso/adicionarCursos', ['as' => 'curso.adicionarCursos', 'uses' => 'EscolaCursoController@adicionarCursos']);
        Route::post('curso/removerCurso/{idEscolaCurso}', ['as' => 'curso.removerCurso', 'uses' => 'EscolaCursoController@removerCurso']);

        # Rotas para turnos
        Route::get('turno/gridTurnos/{idEscolaCurso}', ['as' => 'turno.gridTurnos', 'uses' => 'EscolaCursoTurnoController@gridTurnos']);
        Route::post('turno/select2', ['as' => 'turno.select2', 'uses' => 'EscolaCursoTurnoController@turnosSelect2']);
        Route::post('turno/adicionarTurnos', ['as' => 'turno.adicionarTurnos', 'uses' => 'EscolaCursoTurnoController@adicionarTurnos']);
        Route::post('turno/removerTurno', ['as' => 'turno.removerTurno', 'uses' => 'EscolaCursoTurnoController@removerTurno']);
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

    # ROtas do Cargos
    Route::group(['prefix' => 'cargo', 'as' => 'cargo.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'CargosController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'CargosController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'CargosController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'CargosController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CargosController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'CargosController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'CargosController@destroy']);
    });

    # ROtas do série
    Route::group(['prefix' => 'dependencia', 'as' => 'dependencia.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'DependenciasController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'DependenciasController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'DependenciasController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'DependenciasController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'DependenciasController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'DependenciasController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'DependenciasController@destroy']);
    });

    # ROtas do série
    Route::group(['prefix' => 'instituicao', 'as' => 'instituicao.'], function () {
        Route::get('edit', ['as' => 'edit', 'uses' => 'InstituicaosController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'InstituicaosController@update']);
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

        # Rotas de disciplinas do currículo
        Route::get('gridSerie/{id}', ['as' => 'gridSerie', 'uses' => 'CurriculoDisciplinaController@gridSerie']);
        Route::get('gridAdicionarDisciplina/{idCurriculoSerie}', ['as' => 'gridAdicionarDisciplina', 'uses' => 'CurriculoDisciplinaController@grid']);
        Route::post('disciplna/select2', ['as' => 'disciplina.select2', 'uses' => 'CurriculoDisciplinaController@disciplinasSelect2']);
        Route::post('adicionarDisciplina', ['as' => 'adicionarDisciplina', 'uses' => 'CurriculoDisciplinaController@adicionarDisciplina']);
        Route::post('removerDisciplina', ['as' => 'removerDisciplina', 'uses' => 'CurriculoDisciplinaController@removerDisciplina']);
    });

    # Rotas de Modalidade de ensino
    Route::group(['prefix' => 'modalidadeEnsino', 'as' => 'modalidadeEnsino.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'ModalidadeEnsinoController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'ModalidadeEnsinoController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'ModalidadeEnsinoController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'ModalidadeEnsinoController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ModalidadeEnsinoController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'ModalidadeEnsinoController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'ModalidadeEnsinoController@destroy']);

        Route::post('uniqueNome', ['as' => 'uniqueNome', 'uses' => 'ModalidadeEnsinoController@uniqueNome']);
        Route::post('uniqueCodigo', ['as' => 'uniqueCodigo', 'uses' => 'ModalidadeEnsinoController@uniqueCodigo']);
    });

    # Rotas de Modalidade de ensino
    Route::group(['prefix' => 'nivelEnsino', 'as' => 'nivelEnsino.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'NivelEnsinoController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'NivelEnsinoController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'NivelEnsinoController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'NivelEnsinoController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'NivelEnsinoController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'NivelEnsinoController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'NivelEnsinoController@destroy']);

        Route::post('uniqueNome', ['as' => 'uniqueNome', 'uses' => 'NivelEnsinoController@uniqueNome']);
        Route::post('uniqueCodigo', ['as' => 'uniqueCodigo', 'uses' => 'NivelEnsinoController@uniqueCodigo']);
    });

    # Rotas de Calendários
    Route::group(['prefix' => 'calendario', 'as' => 'calendario.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'CalendariosController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'CalendariosController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'CalendariosController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'CalendariosController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CalendariosController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'CalendariosController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'CalendariosController@destroy']);

        # rotas para períodos de avaliação
        Route::get('gridPeriodo/{id}', ['as' => 'gridPeriodo', 'uses' => 'PeriodoAvaliacaosController@grid']);
        Route::post('getPeriodo/{id}', ['as' => 'getPeriodo', 'uses' => 'PeriodoAvaliacaosController@getPeriodo']);
        Route::post('storePeriodo', ['as' => 'storePeriodo', 'uses' => 'PeriodoAvaliacaosController@store']);
        Route::post('validarDataCalendario', ['as' => 'validarDataCalendario', 'uses' => 'PeriodoAvaliacaosController@validarDataCalendario']);
        Route::post('updatePeriodo/{id}', ['as' => 'updatePeriodo', 'uses' => 'PeriodoAvaliacaosController@update']);
        Route::post('removerPeriodo/{id}', ['as' => 'removerPeriodo', 'uses' => 'PeriodoAvaliacaosController@destroy']);

        # rotas para eventos
        Route::get('gridEvento/{id}', ['as' => 'gridEvento', 'uses' => 'EventosController@grid']);
        Route::post('getTipoEvento/{id}', ['as' => 'getTipoEvento', 'uses' => 'EventosController@getTipoEvento']);
        Route::post('getDiaLetivo/{id}', ['as' => 'getDiaLetivo', 'uses' => 'EventosController@getDiaLetivo']);
        Route::post('storeEvento', ['as' => 'storeEvento', 'uses' => 'EventosController@store']);
        Route::post('updateEvento/{id}', ['as' => 'updateEvento', 'uses' => 'EventosController@update']);
        Route::post('removerEvento/{id}', ['as' => 'removerEvento', 'uses' => 'EventosController@destroy']);
        Route::post('getDiaSemana', ['as' => 'getDiaSemana', 'uses' => 'EventosController@getDiaSemana']);
    });

    #Rotas das formas de avaliações
    Route::group(['prefix' => 'formaAvaliacao', 'as' => 'formaAvaliacao.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'FormaAvaliacoesController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'FormaAvaliacoesController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'FormaAvaliacoesController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'FormaAvaliacoesController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'FormaAvaliacoesController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'FormaAvaliacoesController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'FormaAvaliacoesController@destroy']);

        # Rotas para niveis de alfabetizacao
        Route::get('nivelAlfabetizacao/grid/{id}', ['as' => 'nivelAlfabetizacao.grid', 'uses' => 'FormaAvaliacoesController@gridNiveis']);
        Route::post('nivelAlfabetizacao/store', ['as' => 'nivelAlfabetizacao.store', 'uses' => 'FormaAvaliacoesController@storeNivel']);
        Route::post('nivelAlfabetizacao/destroy/{id}', ['as' => 'nivelAlfabetizacao.destroy', 'uses' => 'FormaAvaliacoesController@destroyNivel']);
    });

    Route::group(['prefix' => 'aluno', 'as' => 'aluno.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'AlunoController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'AlunoController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'AlunoController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'AlunoController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'AlunoController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'AlunoController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'AlunoController@destroy']);

        Route::post('findBairro', ['as' => 'findBairro', 'uses' => 'AlunoController@findBairro']);
        Route::post('findCidade', ['as' => 'findCidade', 'uses' => 'AlunoController@findCidade']);
        Route::post('searchCpf', ['as' => 'searchCpf', 'uses' => 'AlunoController@searchCpf']);
    });

    # Rotas dos tipos de eventos
    Route::group(['prefix' => 'tipoEvento', 'as' => 'tipoEvento.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'TipoEventosController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'TipoEventosController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'TipoEventosController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'TipoEventosController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'TipoEventosController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'TipoEventosController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'TipoEventosController@destroy']);
    });

    # Rotas dos usuários
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'UserController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'UserController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'UserController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'UserController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'UserController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'UserController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'UserController@destroy']);
    });

    # Rotas dos perfís
    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'RoleController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'RoleController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'RoleController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'RoleController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'RoleController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'RoleController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'RoleController@destroy']);
    });

    # Rotas de procedimentos de avaliação
    Route::group(['prefix' => 'procedimentoAvaliacao', 'as' => 'procedimentoAvaliacao.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'ProcedimentoAvaliacaoController@index']);
        Route::get('grid', ['as' => 'grid', 'uses' => 'ProcedimentoAvaliacaoController@grid']);
        Route::get('create', ['as' => 'create', 'uses' => 'ProcedimentoAvaliacaoController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'ProcedimentoAvaliacaoController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ProcedimentoAvaliacaoController@edit']);
        Route::post('update/{id}', ['as' => 'update', 'uses' => 'ProcedimentoAvaliacaoController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'ProcedimentoAvaliacaoController@destroy']);

        # Rotas de procedimentos
        Route::group(['prefix' => 'procedimento', 'as' => 'procedimento.'], function () {
            Route::get('index', ['as' => 'index', 'uses' => 'ProcedimentoController@index']);
            Route::get('loadFields', ['as' => 'loadFields', 'uses' => 'ProcedimentoController@getLoadFields']);
            Route::get('grid/{id}', ['as' => 'grid', 'uses' => 'ProcedimentoController@grid']);
            Route::post('store', ['as' => 'store', 'uses' => 'ProcedimentoController@store']);
            Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ProcedimentoController@edit']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'ProcedimentoController@update']);
            Route::post('destroy/{id}', ['as' => 'destroy', 'uses' => 'ProcedimentoController@destroy']);
        });
    });
});

# ROtas de autenticação
Route::group(['middleware' => 'web'], function () {
    Route::get('login', ['as' => 'index', 'uses' => 'Authentication\LoginController@login']);
    Route::post('attempt', ['as' => 'attempt', 'uses' => 'Authentication\LoginController@attempt']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Authentication\LoginController@logout']);
});