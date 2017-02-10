<?php

# Middleware de autenticação
Route::group(['middleware' => 'auth'], function () {
    # Rota index
    Route::get('index', ['as' => 'index', 'uses' => 'DefaultController@index']);

    # Rotas do cgm
    Route::group(['prefix' => 'pessoaFisica', 'as' => 'pessoaFisica.'], function () {
        Route::get('index', ['middleware' => 'permission:pessoa.fisica.select', 'as' => 'index', 'uses' => 'PessoaFisicaController@index']);
        Route::get('grid', ['middleware' => 'permission:pessoa.fisica.select', 'as' => 'grid', 'uses' => 'PessoaFisicaController@grid']);
        Route::get('create', ['middleware' => 'permission:pessoa.fisica.store', 'as' => 'create', 'uses' => 'PessoaFisicaController@create']);
        Route::post('store', ['middleware' => 'permission:pessoa.fisica.store', 'as' => 'store', 'uses' => 'PessoaFisicaController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:pessoa.fisica.update', 'as' => 'edit', 'uses' => 'PessoaFisicaController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:pessoa.fisica.update', 'as' => 'update', 'uses' => 'PessoaFisicaController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:pessoa.fisica.destroy', 'as' => 'destroy', 'uses' => 'PessoaFisicaController@destroy']);

        Route::post('findBairro', ['as' => 'findBairro', 'uses' => 'PessoaFisicaController@findBairro']);
        Route::post('findCidade', ['as' => 'findCidade', 'uses' => 'PessoaFisicaController@findCidade']);
        Route::post('searchCpf', ['as' => 'searchCpf', 'uses' => 'PessoaFisicaController@searchCpf']);
    });

    Route::group(['prefix' => 'pessoaJuridica', 'as' => 'pessoaJuridica.'], function () {
        Route::get('index', ['middleware' => 'permission:pessoa.juridica.select', 'as' => 'index', 'uses' => 'PessoaJuridicaController@index']);
        Route::get('grid', ['middleware' => 'permission:pessoa.juridica.select', 'as' => 'grid', 'uses' => 'PessoaJuridicaController@grid']);
        Route::get('create', ['middleware' => 'permission:pessoa.juridica.store', 'as' => 'create', 'uses' => 'PessoaJuridicaController@create']);
        Route::post('store', ['middleware' => 'permission:pessoa.juridica.store', 'as' => 'store', 'uses' => 'PessoaJuridicaController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:pessoa.juridica.update', 'as' => 'edit', 'uses' => 'PessoaJuridicaController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:pessoa.juridica.update', 'as' => 'update', 'uses' => 'PessoaJuridicaController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:pessoa.juridica.destroy', 'as' => 'destroy', 'uses' => 'PessoaJuridicaController@destroy']);

        Route::post('findBairro', ['as' => 'findBairro', 'uses' => 'PessoaJuridicaController@findBairro']);
        Route::post('findCidade', ['as' => 'findCidade', 'uses' => 'PessoaJuridicaController@findCidade']);
        Route::post('searchCnpj', ['as' => 'searchCnpj', 'uses' => 'PessoaJuridicaController@searchCnpj']);
    });
    # Fim rotas cgm

    # Rotas de funcao
    Route::group(['prefix' => 'funcao', 'as' => 'funcao.'], function () {
        Route::get('index', ['middleware' => 'permission:funcao.select', 'as' => 'index', 'uses' => 'FuncaoController@index']);
        Route::get('grid', ['middleware' => 'permission:funcao.select', 'as' => 'grid', 'uses' => 'FuncaoController@grid']);
        Route::get('create', ['middleware' => 'permission:funcao.store', 'as' => 'create', 'uses' => 'FuncaoController@create']);
        Route::post('store', ['middleware' => 'permission:funcao.store', 'as' => 'store', 'uses' => 'FuncaoController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:funcao.update', 'as' => 'edit', 'uses' => 'FuncaoController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:funcao.update', 'as' => 'update', 'uses' => 'FuncaoController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:funcao.destroy', 'as' => 'destroy', 'uses' => 'FuncaoController@destroy']);
    });

    # Rotas de escola
    Route::group(['prefix' => 'escola', 'as' => 'escola.'], function () {
        Route::get('index', ['middleware' => 'permission:escola.select', 'as' => 'index', 'uses' => 'EscolaController@index']);
        Route::get('grid', ['middleware' => 'permission:escola.select', 'as' => 'grid', 'uses' => 'EscolaController@grid']);
        Route::get('create', ['middleware' => 'permission:escola.store', 'as' => 'create', 'uses' => 'EscolaController@create']);
        Route::post('store', ['middleware' => 'permission:escola.store', 'as' => 'store', 'uses' => 'EscolaController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:escola.update', 'as' => 'edit', 'uses' => 'EscolaController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:escola.update', 'as' => 'update', 'uses' => 'EscolaController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:escola.destroy', 'as' => 'destroy', 'uses' => 'EscolaController@destroy']);

        # Rotas para endereço
        Route::post('findBairro', ['as' => 'findBairro', 'uses' => 'EscolaController@findBairro']);
        Route::post('findCidade', ['as' => 'findCidade', 'uses' => 'EscolaController@findCidade']);

        # Rotas para cursos
        Route::get('curso/gridCursos/{id}', ['middleware' => 'permission:escola.add.curso', 'as' => 'curso.gridCursos', 'uses' => 'EscolaCursoController@gridCursos']);
        Route::post('curso/select2', ['middleware' => 'permission:escola.add.curso', 'as' => 'curso.select2', 'uses' => 'EscolaCursoController@cursosSelect2']);
        Route::post('curso/adicionarCursos', ['middleware' => 'permission:escola.add.curso', 'as' => 'curso.adicionarCursos', 'uses' => 'EscolaCursoController@adicionarCursos']);
        Route::post('curso/removerCurso/{idEscolaCurso}', ['middleware' => 'permission:escola.add.curso', 'as' => 'curso.removerCurso', 'uses' => 'EscolaCursoController@removerCurso']);

        # Rotas para turnos
        Route::get('turno/gridTurnos/{idEscolaCurso}', ['middleware' => 'permission:escola.add.curso', 'as' => 'turno.gridTurnos', 'uses' => 'EscolaCursoTurnoController@gridTurnos']);
        Route::post('turno/select2', ['middleware' => 'permission:escola.add.curso', 'as' => 'turno.select2', 'uses' => 'EscolaCursoTurnoController@turnosSelect2']);
        Route::post('turno/adicionarTurnos', ['middleware' => 'permission:escola.add.curso', 'as' => 'turno.adicionarTurnos', 'uses' => 'EscolaCursoTurnoController@adicionarTurnos']);
        Route::post('turno/removerTurno', ['middleware' => 'permission:escola.add.curso', 'as' => 'turno.removerTurno', 'uses' => 'EscolaCursoTurnoController@removerTurno']);
    });

    #Rotas servidor
    Route::group(['prefix' => 'servidor', 'as' => 'servidor.'], function () {
        Route::get('index', ['middleware' => 'permission:servidor.select', 'as' => 'index', 'uses' => 'ServidorController@index']);
        Route::get('grid', ['middleware' => 'permission:servidor.select', 'as' => 'grid', 'uses' => 'ServidorController@grid']);
        Route::get('create', ['middleware' => 'permission:servidor.store', 'as' => 'create', 'uses' => 'ServidorController@create']);
        Route::post('store', ['middleware' => 'permission:servidor.store', 'as' => 'store', 'uses' => 'ServidorController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:servidor.update', 'as' => 'edit', 'uses' => 'ServidorController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:servidor.update', 'as' => 'update', 'uses' => 'ServidorController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:servidor.destroy', 'as' => 'destroy', 'uses' => 'ServidorController@destroy']);
        //unique cpf
        Route::post('searchCpf', ['as' => 'searchCpf', 'uses' => 'ServidorController@searchCpf']);
        //Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'DisciplinasController@destroy']);

        # rotas para telefones
        Route::get('gridTelefone/{id}', ['middleware' => 'permission:servidor.add.telefone', 'as' => 'gridTelefone', 'uses' => 'TelefonesController@grid']);
        Route::post('getTipoTelefone', ['middleware' => 'permission:servidor.add.telefone', 'as' => 'getTipoTelefone', 'uses' => 'TelefonesController@getTipoTelefone']);
        Route::post('storeTelefone', ['middleware' => 'permission:servidor.add.telefone', 'as' => 'storeTelefone', 'uses' => 'TelefonesController@store']);
        Route::post('updateTelefone/{id}', ['middleware' => 'permission:servidor.add.telefone', 'as' => 'updateTelefone', 'uses' => 'TelefonesController@update']);
        Route::post('removerTelefone/{id}', ['middleware' => 'permission:servidor.add.telefone', 'as' => 'removerTelefone', 'uses' => 'TelefonesController@destroy']);

        # rotas para relação de trabalho
        Route::get('gridRelacao/{id}', ['middleware' => 'permission:servidor.add.relacao.trabalho', 'as' => 'gridRelacao', 'uses' => 'RelacaoTrabalhosController@grid']);
        Route::post('storeRelacao', ['middleware' => 'permission:servidor.add.relacao.trabalho', 'as' => 'storeRelacao', 'uses' => 'RelacaoTrabalhosController@store']);
        Route::post('updateRelacao/{id}', ['middleware' => 'permission:servidor.add.relacao.trabalho', 'as' => 'updateRelacao', 'uses' => 'RelacaoTrabalhosController@update']);
        Route::post('removerRelacao/{id}', ['middleware' => 'permission:servidor.add.relacao.trabalho', 'as' => 'removerRelacao', 'uses' => 'RelacaoTrabalhosController@destroy']);
        Route::post('getRegimes', ['middleware' => 'permission:servidor.add.relacao.trabalho', 'as' => 'getRegimes', 'uses' => 'RelacaoTrabalhosController@getRegimes']);
        Route::post('getAreas', ['middleware' => 'permission:servidor.add.relacao.trabalho', 'as' => 'getAreas', 'uses' => 'RelacaoTrabalhosController@getAreas']);
        Route::post('getEnsinos', ['middleware' => 'permission:servidor.add.relacao.trabalho', 'as' => 'getEnsinos', 'uses' => 'RelacaoTrabalhosController@getEnsinos']);
        Route::post('getDisciplinas', ['middleware' => 'permission:servidor.add.relacao.trabalho', 'as' => 'getDisciplinas', 'uses' => 'RelacaoTrabalhosController@getDisciplinas']);

        # rotas para formações
        Route::get('gridFormacao/{id}', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'gridFormacao', 'uses' => 'FormacaosController@grid']);
        Route::post('storeFormacao', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'storeFormacao', 'uses' => 'FormacaosController@store']);
        Route::post('updateFormacao/{id}', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'updateFormacao', 'uses' => 'FormacaosController@update']);
        Route::post('removerFormacao/{id}', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'removerFormacao', 'uses' => 'FormacaosController@destroy']);
        Route::post('getCursos', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'getCursos', 'uses' => 'FormacaosController@getCursos']);
        Route::post('getInstituicoes', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'getInstituicoes', 'uses' => 'FormacaosController@getInstituicoes']);
        Route::post('getSituacoes', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'getSituacoes', 'uses' => 'FormacaosController@getSituacoes']);
        Route::post('getLicenciaturas', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'getLicenciaturas', 'uses' => 'FormacaosController@getLicenciaturas']);
        Route::post('getPos', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'getPos', 'uses' => 'FormacaosController@getPos']);
        Route::post('getOutrosCursos', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'getOutrosCursos', 'uses' => 'FormacaosController@getOutrosCursos']);
        Route::post('edtOutrosCursos', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'edtOutrosCursos', 'uses' => 'FormacaosController@edtOutrosCursos']);
        Route::post('getPosOutrosCursos', ['middleware' => 'permission:servidor.add.formacao', 'as' => 'getPosOutrosCursos', 'uses' => 'FormacaosController@getPosOutrosCursos']);

        # rotas para atividades
        Route::get('gridAtividade/{id}', ['middleware' => 'permission:servidor.add.atividade', 'as' => 'gridAtividade', 'uses' => 'AtividadesController@grid']);
        Route::post('storeAtividade', ['middleware' => 'permission:servidor.add.atividade', 'as' => 'storeAtividade', 'uses' => 'AtividadesController@store']);
        Route::post('updateAtividade/{id}', ['middleware' => 'permission:servidor.add.atividade', 'as' => 'updateAtividade', 'uses' => 'AtividadesController@update']);
        Route::post('removerAtividade/{id}', ['middleware' => 'permission:servidor.add.atividade', 'as' => 'removerAtividade', 'uses' => 'AtividadesController@destroy']);
        Route::post('getFuncoes', ['middleware' => 'permission:servidor.add.atividade', 'as' => 'getFuncoes', 'uses' => 'AtividadesController@getFuncoes']);

        # rotas para alocações
        Route::get('gridAlocacao/{id}', ['middleware' => 'permission:servidor.add.alocacao', 'as' => 'gridAlocacao', 'uses' => 'AlocacaosController@grid']);
        Route::post('storeAlocacao', ['middleware' => 'permission:servidor.add.alocacao', 'as' => 'storeAlocacao', 'uses' => 'AlocacaosController@store']);
        Route::post('removerAlocacao/{id}', ['middleware' => 'permission:servidor.add.alocacao', 'as' => 'removerAlocacao', 'uses' => 'AlocacaosController@destroy']);
        Route::post('getEscolas', ['middleware' => 'permission:servidor.add.alocacao', 'as' => 'getEscolas', 'uses' => 'AlocacaosController@getEscolas']);

        # rotas para disponibilidades
        Route::get('gridDisponibilidade/{id}', ['as' => 'gridDisponibilidade', 'uses' => 'DisponibilidadesController@grid']);
        Route::post('storeDisponibilidade', ['as' => 'storeDisponibilidade', 'uses' => 'DisponibilidadesController@store']);
        Route::post('updateDisponibilidade/{id}', ['as' => 'updateDisponibilidade', 'uses' => 'DisponibilidadesController@update']);
        Route::post('removerDisponibilidade/{id}', ['as' => 'removerDisponibilidade', 'uses' => 'DisponibilidadesController@destroy']);
        Route::post('getDias', ['as' => 'getDias', 'uses' => 'DisponibilidadesController@getDias']);
        Route::post('getHoras', ['as' => 'getHoras', 'uses' => 'DisponibilidadesController@getHoras']);
        Route::post('getTurnos', ['as' => 'getTurnos', 'uses' => 'DisponibilidadesController@getTurnos']);
    });

    # ROtas de disciplinas
    Route::group(['prefix' => 'disciplina', 'as' => 'disciplina.'], function () {
        Route::get('index', ['middleware' => 'permission:disciplina.select', 'as' => 'index', 'uses' => 'DisciplinasController@index']);
        Route::get('grid', ['middleware' => 'permission:disciplina.select', 'as' => 'grid', 'uses' => 'DisciplinasController@grid']);
        Route::get('create', ['middleware' => 'permission:disciplina.store', 'as' => 'create', 'uses' => 'DisciplinasController@create']);
        Route::post('store', ['middleware' => 'permission:disciplina.store', 'as' => 'store', 'uses' => 'DisciplinasController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:disciplina.update', 'as' => 'edit', 'uses' => 'DisciplinasController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:disciplina.update', 'as' => 'update', 'uses' => 'DisciplinasController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:disciplina.destroy', 'as' => 'destroy', 'uses' => 'DisciplinasController@destroy']);
    });

    # ROtas do curso
    Route::group(['prefix' => 'curso', 'as' => 'curso.'], function () {
        Route::get('index', ['middleware' => 'permission:curso.select', 'as' => 'index', 'uses' => 'CursosController@index']);
        Route::get('grid', ['middleware' => 'permission:curso.select', 'as' => 'grid', 'uses' => 'CursosController@grid']);
        Route::get('create', ['middleware' => 'permission:curso.store', 'as' => 'create', 'uses' => 'CursosController@create']);
        Route::post('store', ['middleware' => 'permission:curso.store', 'as' => 'store', 'uses' => 'CursosController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:curso.update', 'as' => 'edit', 'uses' => 'CursosController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:curso.update', 'as' => 'update', 'uses' => 'CursosController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:curso.destroy', 'as' => 'destroy', 'uses' => 'CursosController@destroy']);
    });

    # ROtas do Cargos
    Route::group(['prefix' => 'cargo', 'as' => 'cargo.'], function () {
        Route::get('index', ['middleware' => 'permission:cargo.select', 'as' => 'index', 'uses' => 'CargosController@index']);
        Route::get('grid', ['middleware' => 'permission:cargo.select', 'as' => 'grid', 'uses' => 'CargosController@grid']);
        Route::get('create', ['middleware' => 'permission:cargo.store', 'as' => 'create', 'uses' => 'CargosController@create']);
        Route::post('store', ['middleware' => 'permission:cargo.store', 'as' => 'store', 'uses' => 'CargosController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:cargo.update', 'as' => 'edit', 'uses' => 'CargosController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:cargo.update', 'as' => 'update', 'uses' => 'CargosController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:cargo.destroy', 'as' => 'destroy', 'uses' => 'CargosController@destroy']);
    });

    # ROtas do série
    Route::group(['prefix' => 'dependencia', 'as' => 'dependencia.'], function () {
        Route::get('index', ['middleware' => 'permission:dependencia.select', 'as' => 'index', 'uses' => 'DependenciasController@index']);
        Route::get('grid/{id}', ['middleware' => 'permission:dependencia.select', 'as' => 'grid', 'uses' => 'DependenciasController@grid']);
        Route::get('create', ['middleware' => 'permission:dependencia.store', 'as' => 'create', 'uses' => 'DependenciasController@create']);
        Route::post('store', ['middleware' => 'permission:dependencia.store', 'as' => 'store', 'uses' => 'DependenciasController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:dependencia.update', 'as' => 'edit', 'uses' => 'DependenciasController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:dependencia.update', 'as' => 'update', 'uses' => 'DependenciasController@update']);
        Route::post('destroy/{id}', ['middleware' => 'permission:dependencia.destroy', 'as' => 'destroy', 'uses' => 'DependenciasController@destroy']);
    });

    # ROtas do série
    Route::group(['prefix' => 'instituicao', 'as' => 'instituicao.'], function () {
        Route::get('edit', ['middleware' => 'permission:instituicao.update', 'as' => 'edit', 'uses' => 'InstituicaosController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:instituicao.update', 'as' => 'update', 'uses' => 'InstituicaosController@update']);
    });

    # ROtas do currículo
    Route::group(['prefix' => 'curriculo', 'as' => 'curriculo.'], function () {
        Route::get('index', ['middleware' => 'permission:curriculo.select', 'as' => 'index', 'uses' => 'CurriculosController@index']);
        Route::get('grid', ['middleware' => 'permission:curriculo.select', 'as' => 'grid', 'uses' => 'CurriculosController@grid']);
        Route::get('create', ['middleware' => 'permission:curriculo.store', 'as' => 'create', 'uses' => 'CurriculosController@create']);
        Route::post('store', ['middleware' => 'permission:curriculo.store', 'as' => 'store', 'uses' => 'CurriculosController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:curriculo.update', 'as' => 'edit', 'uses' => 'CurriculosController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:curriculo.update', 'as' => 'update', 'uses' => 'CurriculosController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:curriculo.destroy', 'as' => 'destroy', 'uses' => 'CurriculosController@destroy']);

        # Rotas de disciplinas do currículo
        Route::get('gridSerie/{id}', ['as' => 'gridSerie', 'uses' => 'CurriculoDisciplinaController@gridSerie']);
        Route::get('gridAdicionarDisciplina/{idCurriculoSerie}', ['as' => 'gridAdicionarDisciplina', 'uses' => 'CurriculoDisciplinaController@grid']);
        Route::post('disciplna/select2', ['as' => 'disciplina.select2', 'uses' => 'CurriculoDisciplinaController@disciplinasSelect2']);
        Route::post('adicionarDisciplina', ['as' => 'adicionarDisciplina', 'uses' => 'CurriculoDisciplinaController@adicionarDisciplina']);
        Route::post('removerDisciplina', ['as' => 'removerDisciplina', 'uses' => 'CurriculoDisciplinaController@removerDisciplina']);
    });

    # Rotas de Modalidade de ensino
    Route::group(['prefix' => 'modalidadeEnsino', 'as' => 'modalidadeEnsino.'], function () {
        Route::get('index', ['middleware' => 'permission:modalidade.select', 'as' => 'index', 'uses' => 'ModalidadeEnsinoController@index']);
        Route::get('grid', ['middleware' => 'permission:modalidade.select', 'as' => 'grid', 'uses' => 'ModalidadeEnsinoController@grid']);
        Route::get('create', ['middleware' => 'permission:modalidade.store', 'as' => 'create', 'uses' => 'ModalidadeEnsinoController@create']);
        Route::post('store', ['middleware' => 'permission:modalidade.store', 'as' => 'store', 'uses' => 'ModalidadeEnsinoController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:modalidade.update', 'as' => 'edit', 'uses' => 'ModalidadeEnsinoController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:modalidade.update', 'as' => 'update', 'uses' => 'ModalidadeEnsinoController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:modalidade.destroy', 'as' => 'destroy', 'uses' => 'ModalidadeEnsinoController@destroy']);

        Route::post('uniqueNome', ['as' => 'uniqueNome', 'uses' => 'ModalidadeEnsinoController@uniqueNome']);
        Route::post('uniqueCodigo', ['as' => 'uniqueCodigo', 'uses' => 'ModalidadeEnsinoController@uniqueCodigo']);
    });

    # Rotas de Modalidade de ensino
    Route::group(['prefix' => 'nivelEnsino', 'as' => 'nivelEnsino.'], function () {
        Route::get('index', ['middleware' => 'permission:nivel.select', 'as' => 'index', 'uses' => 'NivelEnsinoController@index']);
        Route::get('grid', ['middleware' => 'permission:nivel.select', 'as' => 'grid', 'uses' => 'NivelEnsinoController@grid']);
        Route::get('create', ['middleware' => 'permission:nivel.store', 'as' => 'create', 'uses' => 'NivelEnsinoController@create']);
        Route::post('store', ['middleware' => 'permission:nivel.store', 'as' => 'store', 'uses' => 'NivelEnsinoController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:nivel.update', 'as' => 'edit', 'uses' => 'NivelEnsinoController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:nivel.update', 'as' => 'update', 'uses' => 'NivelEnsinoController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:nivel.destroy', 'as' => 'destroy', 'uses' => 'NivelEnsinoController@destroy']);

        Route::post('uniqueNome', ['as' => 'uniqueNome', 'uses' => 'NivelEnsinoController@uniqueNome']);
        Route::post('uniqueCodigo', ['as' => 'uniqueCodigo', 'uses' => 'NivelEnsinoController@uniqueCodigo']);
    });

    # Rotas de Calendários
    Route::group(['prefix' => 'calendario', 'as' => 'calendario.'], function () {
        Route::get('index', ['middleware' => 'permission:calendario.select', 'as' => 'index', 'uses' => 'CalendariosController@index']);
        Route::get('grid', ['middleware' => 'permission:calendario.select', 'as' => 'grid', 'uses' => 'CalendariosController@grid']);
        Route::get('create', ['middleware' => 'permission:calendario.store', 'as' => 'create', 'uses' => 'CalendariosController@create']);
        Route::post('store', ['middleware' => 'permission:calendario.store', 'as' => 'store', 'uses' => 'CalendariosController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:calendario.update', 'as' => 'edit', 'uses' => 'CalendariosController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:calendario.update', 'as' => 'update', 'uses' => 'CalendariosController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:calendario.destroy', 'as' => 'destroy', 'uses' => 'CalendariosController@destroy']);

        # rotas para períodos de avaliação
        Route::get('gridPeriodo/{id}', ['middleware' => 'permission:calendario.add.periodo', 'as' => 'gridPeriodo', 'uses' => 'PeriodoAvaliacaosController@grid']);
        Route::post('getPeriodo/{id}', ['middleware' => 'permission:calendario.add.periodo', 'as' => 'getPeriodo', 'uses' => 'PeriodoAvaliacaosController@getPeriodo']);
        Route::post('storePeriodo', ['middleware' => 'permission:calendario.add.periodo', 'as' => 'storePeriodo', 'uses' => 'PeriodoAvaliacaosController@store']);
        Route::post('validarDataCalendario', ['middleware' => 'permission:calendario.add.periodo', 'as' => 'validarDataCalendario', 'uses' => 'PeriodoAvaliacaosController@validarDataCalendario']);
        Route::post('updatePeriodo/{id}', ['middleware' => 'permission:calendario.add.periodo', 'as' => 'updatePeriodo', 'uses' => 'PeriodoAvaliacaosController@update']);
        Route::post('removerPeriodo/{id}', ['middleware' => 'permission:calendario.add.periodo', 'as' => 'removerPeriodo', 'uses' => 'PeriodoAvaliacaosController@destroy']);

        # rotas para eventos
        Route::get('gridEvento/{id}', ['middleware' => 'permission:calendario.add.evento', 'as' => 'gridEvento', 'uses' => 'EventosController@grid']);
        Route::post('getTipoEvento/{id}', ['middleware' => 'permission:calendario.add.evento', 'as' => 'getTipoEvento', 'uses' => 'EventosController@getTipoEvento']);
        Route::post('getDiaLetivo/{id}', ['middleware' => 'permission:calendario.add.evento', 'as' => 'getDiaLetivo', 'uses' => 'EventosController@getDiaLetivo']);
        Route::post('storeEvento', ['middleware' => 'permission:calendario.add.evento', 'as' => 'storeEvento', 'uses' => 'EventosController@store']);
        Route::post('updateEvento/{id}', ['middleware' => 'permission:calendario.add.evento', 'as' => 'updateEvento', 'uses' => 'EventosController@update']);
        Route::post('removerEvento/{id}', ['middleware' => 'permission:calendario.add.evento', 'as' => 'removerEvento', 'uses' => 'EventosController@destroy']);
        Route::post('getDiaSemana', ['middleware' => 'permission:calendario.add.evento', 'as' => 'getDiaSemana', 'uses' => 'EventosController@getDiaSemana']);
    });

    #Rotas das formas de avaliações
    Route::group(['prefix' => 'formaAvaliacao', 'as' => 'formaAvaliacao.'], function () {
        Route::get('index', ['middleware' => 'permission:forma.avaliacao.select', 'as' => 'index', 'uses' => 'FormaAvaliacoesController@index']);
        Route::get('grid', ['middleware' => 'permission:forma.avaliacao.select', 'as' => 'grid', 'uses' => 'FormaAvaliacoesController@grid']);
        Route::get('create', ['middleware' => 'permission:forma.avaliacao.store', 'as' => 'create', 'uses' => 'FormaAvaliacoesController@create']);
        Route::post('store', ['middleware' => 'permission:forma.avaliacao.store', 'as' => 'store', 'uses' => 'FormaAvaliacoesController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:forma.avaliacao.update', 'as' => 'edit', 'uses' => 'FormaAvaliacoesController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:forma.avaliacao.update', 'as' => 'update', 'uses' => 'FormaAvaliacoesController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:forma.avaliacao.destroy', 'as' => 'destroy', 'uses' => 'FormaAvaliacoesController@destroy']);

        # Rotas para niveis de alfabetizacao
        Route::get('nivelAlfabetizacao/grid/{id}', ['as' => 'nivelAlfabetizacao.grid', 'uses' => 'FormaAvaliacoesController@gridNiveis']);
        Route::post('nivelAlfabetizacao/store', ['as' => 'nivelAlfabetizacao.store', 'uses' => 'FormaAvaliacoesController@storeNivel']);
        Route::post('nivelAlfabetizacao/destroy/{id}', ['as' => 'nivelAlfabetizacao.destroy', 'uses' => 'FormaAvaliacoesController@destroyNivel']);
    });

    # Rotas do aluno
    Route::group(['prefix' => 'aluno', 'as' => 'aluno.'], function () {
        Route::get('index', ['middleware' => 'permission:aluno.select', 'as' => 'index', 'uses' => 'AlunoController@index']);
        Route::get('grid', ['middleware' => 'permission:aluno.select', 'as' => 'grid', 'uses' => 'AlunoController@grid']);
        Route::get('create', ['middleware' => 'permission:aluno.store', 'as' => 'create', 'uses' => 'AlunoController@create']);
        Route::post('store', ['middleware' => 'permission:aluno.store', 'as' => 'store', 'uses' => 'AlunoController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:aluno.update', 'as' => 'edit', 'uses' => 'AlunoController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:aluno.update', 'as' => 'update', 'uses' => 'AlunoController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:aluno.destroy', 'as' => 'destroy', 'uses' => 'AlunoController@destroy']);

        Route::post('findBairro', ['as' => 'findBairro', 'uses' => 'AlunoController@findBairro']);
        Route::post('findCidade', ['as' => 'findCidade', 'uses' => 'AlunoController@findCidade']);
        Route::post('searchCpf', ['as' => 'searchCpf', 'uses' => 'AlunoController@searchCpf']);

        # rotas para alunos turmas
        Route::get('gridAlunoTurma/{id}', ['middleware' => 'permission:aluno.matricula', 'as' => 'gridAlunoTurma', 'uses' => 'AlunoTurmasController@grid']);
        Route::post('getTurma', ['middleware' => 'permission:aluno.matricula', 'as' => 'getTurma', 'uses' => 'AlunoTurmasController@getTurma']);
        Route::post('storeAlunoTurma', ['middleware' => 'permission:aluno.matricula', 'as' => 'storeAlunoTurma', 'uses' => 'AlunoTurmasController@store']);
        Route::post('getDadosTurma', ['middleware' => 'permission:aluno.matricula', 'as' => 'getDadosTurma', 'uses' => 'AlunoTurmasController@getDadosTurma']);
       // Route::post('updateTelefone/{id}', ['as' => 'updateTelefone', 'uses' => 'TelefonesController@update']);
       // Route::post('removerTelefone/{id}', ['as' => 'removerTelefone', 'uses' => 'TelefonesController@destroy']);
    });

    # Rotas dos tipos de eventos
    Route::group(['prefix' => 'tipoEvento', 'as' => 'tipoEvento.'], function () {
        Route::get('index', ['middleware' => 'permission:tipo.evento.select', 'as' => 'index', 'uses' => 'TipoEventosController@index']);
        Route::get('grid', ['middleware' => 'permission:tipo.evento.select', 'as' => 'grid', 'uses' => 'TipoEventosController@grid']);
        Route::get('create', ['middleware' => 'permission:tipo.evento.store', 'as' => 'create', 'uses' => 'TipoEventosController@create']);
        Route::post('store', ['middleware' => 'permission:tipo.evento.store', 'as' => 'store', 'uses' => 'TipoEventosController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:tipo.evento.update', 'as' => 'edit', 'uses' => 'TipoEventosController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:tipo.evento.update', 'as' => 'update', 'uses' => 'TipoEventosController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:tipo.evento.destroy', 'as' => 'destroy', 'uses' => 'TipoEventosController@destroy']);
    });

    # Rotas dos perídos de avaliação
    Route::group(['prefix' => 'periodo', 'as' => 'periodo.'], function () {
        Route::get('index', ['middleware' => 'permission:periodo.select', 'as' => 'index', 'uses' => 'PeriodoController@index']);
        Route::get('grid', ['middleware' => 'permission:periodo.select', 'as' => 'grid', 'uses' => 'PeriodoController@grid']);
        //Route::get('grid', ['middleware' => 'permission:periodo.select', 'as' => 'grid', 'uses' => 'PeriodoController@grid']);
        Route::get('create', ['middleware' => 'permission:periodo.store', 'as' => 'create', 'uses' => 'PeriodoController@create']);
        Route::post('store', ['middleware' => 'permission:periodo.store', 'as' => 'store', 'uses' => 'PeriodoController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:periodo.update', 'as' => 'edit', 'uses' => 'PeriodoController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:periodo.update', 'as' => 'update', 'uses' => 'PeriodoController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:periodo.destroy', 'as' => 'destroy', 'uses' => 'PeriodoController@destroy']);
    });

    # Rotas dos usuários
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('index', ['middleware' => 'permission:user.select', 'as' => 'index', 'uses' => 'UserController@index']);
        Route::get('grid', ['middleware' => 'permission:user.select', 'as' => 'grid', 'uses' => 'UserController@grid']);
        Route::get('create', ['middleware' => 'permission:user.store', 'as' => 'create', 'uses' => 'UserController@create']);
        Route::post('store', ['middleware' => 'permission:user.store', 'as' => 'store', 'uses' => 'UserController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:user.update', 'as' => 'edit', 'uses' => 'UserController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:user.update', 'as' => 'update', 'uses' => 'UserController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:user.destroy', 'as' => 'destroy', 'uses' => 'UserController@destroy']);

            # Rotas usuários > alterar senha
            Route::get('alterarSenha', ['as' => 'alterarSenha', 'uses' => 'UserController@alterarSenha']);
            Route::post('searchSenha', ['as' => 'searchSenha', 'uses' => 'UserController@searchSenha']);
            Route::post('novaSenha', ['as' => 'novaSenha', 'uses' => 'UserController@novaSenha']);
            Route::post('atualizarSenha', ['as' => 'atualizarSenha', 'uses' => 'UserController@atualizarSenha']);
    });

    # Rotas dos perfís
    Route::group(['prefix' => 'role', 'as' => 'role.'], function () {
        Route::get('index', ['middleware' => 'permission:role.select', 'as' => 'index', 'uses' => 'RoleController@index']);
        Route::get('grid', ['middleware' => 'permission:role.select', 'as' => 'grid', 'uses' => 'RoleController@grid']);
        Route::get('create', ['middleware' => 'permission:role.store', 'as' => 'create', 'uses' => 'RoleController@create']);
        Route::post('store', ['middleware' => 'permission:role.store', 'as' => 'store', 'uses' => 'RoleController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:role.update', 'as' => 'edit', 'uses' => 'RoleController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:role.update', 'as' => 'update', 'uses' => 'RoleController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:role.destroy', 'as' => 'destroy', 'uses' => 'RoleController@destroy']);
    });

    # Rotas de procedimentos de avaliação
    Route::group(['prefix' => 'procedimentoAvaliacao', 'as' => 'procedimentoAvaliacao.'], function () {
        Route::get('index', ['middleware' => 'permission:procedimento.avaliacao.select', 'as' => 'index', 'uses' => 'ProcedimentoAvaliacaoController@index']);
        Route::get('grid', ['middleware' => 'permission:procedimento.avaliacao.select', 'as' => 'grid', 'uses' => 'ProcedimentoAvaliacaoController@grid']);
        Route::get('create', ['middleware' => 'permission:procedimento.avaliacao.store', 'as' => 'create', 'uses' => 'ProcedimentoAvaliacaoController@create']);
        Route::post('store', ['middleware' => 'permission:procedimento.avaliacao.stpre', 'as' => 'store', 'uses' => 'ProcedimentoAvaliacaoController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:procedimento.avaliacao.update', 'as' => 'edit', 'uses' => 'ProcedimentoAvaliacaoController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:procedimento.avaliacao.update', 'as' => 'update', 'uses' => 'ProcedimentoAvaliacaoController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:procedimento.avaliacao.destroy', 'as' => 'destroy', 'uses' => 'ProcedimentoAvaliacaoController@destroy']);

        # Rotas de procedimentos
        Route::group(['prefix' => 'procedimento', 'as' => 'procedimento.'], function () {
            Route::get('index', ['middleware' => 'permission:procedimento.avaliacao.add.procedimento', 'as' => 'index', 'uses' => 'ProcedimentoController@index']);
            Route::get('loadFields', ['middleware' => 'permission:procedimento.avaliacao.add.procedimento', 'as' => 'loadFields', 'uses' => 'ProcedimentoController@getLoadFields']);
            Route::get('grid/{id}', ['middleware' => 'permission:procedimento.avaliacao.add.procedimento', 'as' => 'grid', 'uses' => 'ProcedimentoController@grid']);
            Route::post('store', ['middleware' => 'permission:procedimento.avaliacao.add.procedimento', 'as' => 'store', 'uses' => 'ProcedimentoController@store']);
            Route::get('edit/{id}', ['middleware' => 'permission:procedimento.avaliacao.add.procedimento', 'as' => 'edit', 'uses' => 'ProcedimentoController@edit']);
            Route::post('update/{id}', ['middleware' => 'permission:procedimento.avaliacao.add.procedimento', 'as' => 'update', 'uses' => 'ProcedimentoController@update']);
            Route::post('destroy/{id}', ['middleware' => 'permission:procedimento.avaliacao.add.procedimento', 'as' => 'destroy', 'uses' => 'ProcedimentoController@destroy']);
        });
    });

    # Rotas das turmas
    Route::group(['prefix' => 'turma', 'as' => 'turma.'], function () {
        Route::get('index', ['middleware' => 'permission:turma.select', 'as' => 'index', 'uses' => 'TurmaController@index']);
        Route::get('grid', ['middleware' => 'permission:turma.select', 'as' => 'grid', 'uses' => 'TurmaController@grid']);
        Route::get('create', ['middleware' => 'permission:turma.store', 'as' => 'create', 'uses' => 'TurmaController@create']);
        Route::post('store', ['middleware' => 'permission:turma.store', 'as' => 'store', 'uses' => 'TurmaController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:turma.update', 'as' => 'edit', 'uses' => 'TurmaController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:turma.update', 'as' => 'update', 'uses' => 'TurmaController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:turma.destroy', 'as' => 'destroy', 'uses' => 'TurmaController@destroy']);
        Route::get('searchCurriculosByCurso/{idCurso}', ['as' => 'searchCurriculosByCurso', 'uses' => 'TurmaController@searchCurriculosByCurso']);
        Route::get('searchSeriesByCurriculo/{idCurriculo}', ['as' => 'searchSeriesByCurriculo', 'uses' => 'TurmaController@searchSeriesByCurriculo']);

        # Modal de disciplinas
        Route::group(['prefix' => 'disciplina', 'as' => 'disciplina.'], function () {
            Route::get('grid/{id}', ['middleware' => 'permission:turma.disciplina', 'as' => 'grid', 'uses' => 'TurmaDisciplinaController@grid']);
            Route::post('select2', ['middleware' => 'permission:turma.disciplina', 'as' => 'select2', 'uses' => 'TurmaDisciplinaController@disciplinasSelect2']);
        });

        # Modal de alunos
        Route::group(['prefix' => 'aluno', 'as' => 'aluno.'], function () {
            Route::get('grid/{idTurma}', ['middleware' => 'permission:turma.aluno', 'as' => 'grid', 'uses' => 'TurmaAlunoController@grid']);
        });

        # Modal de pareceres
        Route::group(['prefix' => 'parecer', 'as' => 'parecer.'], function () {
            Route::get('grid/{idTurma}', ['middleware' => 'permission:turma.parecer', 'as' => 'grid', 'uses' => 'TurmaParecerController@grid']);
            Route::post('select2', ['middleware' => 'permission:turma.parecer', 'as' => 'select2', 'uses' => 'TurmaParecerController@parecerSelect2']);
            Route::post('adicionarParecer', ['middleware' => 'permission:turma.parecer', 'as' => 'adicionarParecer', 'uses' => 'TurmaParecerController@adicionarParecer']);
            Route::post('removerParecer', ['middleware' => 'permission:turma.parecer', 'as' => 'removerParecer', 'uses' => 'TurmaParecerController@removerParecer']);
        });

        # Modal de horários
        Route::group(['prefix' => 'horario', 'as' => 'horario.'], function () {
            Route::get('grid/{idTurma}', ['as' => 'grid', 'uses' => 'HorariosController@grid']);
            Route::post('store', ['as' => 'store', 'uses' => 'HorariosController@store']);
            Route::post('update/{id}', ['as' => 'update', 'uses' => 'HorariosController@update']);
            Route::post('remover/{id}', ['as' => 'remover', 'uses' => 'HorariosController@destroy']);
            Route::post('getDisciplinas', ['as' => 'getDisciplinas', 'uses' => 'HorariosController@getDisciplinas']);
            Route::post('getProfessores', ['as' => 'getProfessores', 'uses' => 'HorariosController@getProfessores']);
            Route::post('getDias', ['as' => 'getDias', 'uses' => 'HorariosController@getDias']);
            Route::post('getHoras', ['as' => 'getHoras', 'uses' => 'HorariosController@getHoras']);
        });
    });

    # Rotas das turmas complementares
    Route::group(['prefix' => 'turmaComplementar', 'as' => 'turmaComplementar.'], function () {
        Route::get('index', ['middleware' => 'permission:turma.complementar.select', 'as' => 'index', 'uses' => 'TurmaComplementarController@index']);
        Route::get('grid', ['middleware' => 'permission:turma.complementar.select', 'as' => 'grid', 'uses' => 'TurmaComplementarController@grid']);
        Route::get('create', ['middleware' => 'permission:turma.complementar.store', 'as' => 'create', 'uses' => 'TurmaComplementarController@create']);
        Route::post('store', ['middleware' => 'permission:turma.complementar.store', 'as' => 'store', 'uses' => 'TurmaComplementarController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:turma.complementar.update', 'as' => 'edit', 'uses' => 'TurmaComplementarController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:turma.complementar.update', 'as' => 'update', 'uses' => 'TurmaComplementarController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:turma.complementar.destroy', 'as' => 'destroy', 'uses' => 'TurmaComplementarController@destroy']);

        # Modal de atividades
        Route::group(['prefix' => 'atividade', 'as' => 'atividade.'], function () {
            Route::get('grid/{idTurmaComplementar}', ['middleware' => 'permission:turma.complementar.add.atividade', 'as' => 'grid', 'uses' => 'TurmaComplementarAtividadeController@grid']);
            Route::post('select2', ['middleware' => 'permission:turma.complementar.add.atividade', 'as' => 'select2', 'uses' => 'TurmaComplementarAtividadeController@atividadeSelect2']);
            Route::post('adicionarAtividade', ['middleware' => 'permission:turma.complementar.add.atividade', 'as' => 'adicionarAtividade', 'uses' => 'TurmaComplementarAtividadeController@adicionarAtividade']);
            Route::post('removerAtividade', ['middleware' => 'permission:turma.complementar.add.atividade', 'as' => 'removerAtividade', 'uses' => 'TurmaComplementarAtividadeController@removerAtividade']);
        });

        # Modal de alunos
        Route::group(['prefix' => 'aluno', 'as' => 'aluno.'], function () {
            Route::get('grid/{idTurmaComplementar}', ['middleware' => 'permission:turma.complementar.add.aluno', 'as' => 'grid', 'uses' => 'TurmaComplementarAlunoController@grid']);
            Route::post('select2', ['middleware' => 'permission:turma.complementar.add.aluno', 'as' => 'select2', 'uses' => 'TurmaComplementarAlunoController@alunosSelect2']);
            Route::post('findNumAlunosMatriculados/{idTurmaComplementar}', ['middleware' => 'permission:turma.complementar.add.aluno', 'as' => 'findNumAlunosMatriculados', 'uses' => 'TurmaComplementarAlunoController@findNumAlunosMatriculados']);
            Route::post('adicionarAtividade', ['middleware' => 'permission:turma.complementar.add.aluno', 'as' => 'adicionarAluno', 'uses' => 'TurmaComplementarAlunoController@adicionarAluno']);
            Route::post('removerAtividade', ['middleware' => 'permission:turma.complementar.add.aluno', 'as' => 'removerAluno', 'uses' => 'TurmaComplementarAlunoController@removerAluno']);
        });
    });

    # Rotas de pareceres
    Route::group(['prefix' => 'parecer', 'as' => 'parecer.'], function () {
        Route::get('index', ['middleware' => 'permission:parecer.select', 'as' => 'index', 'uses' => 'ParecerController@index']);
        Route::get('grid', ['middleware' => 'permission:parecer.select', 'as' => 'grid', 'uses' => 'ParecerController@grid']);
        Route::get('create', ['middleware' => 'permission:parecer.store', 'as' => 'create', 'uses' => 'ParecerController@create']);
        Route::post('store', ['middleware' => 'permission:parecer.store', 'as' => 'store', 'uses' => 'ParecerController@store']);
        Route::get('edit/{id}', ['middleware' => 'permission:parecer.update', 'as' => 'edit', 'uses' => 'ParecerController@edit']);
        Route::post('update/{id}', ['middleware' => 'permission:parecer.update', 'as' => 'update', 'uses' => 'ParecerController@update']);
        Route::get('destroy/{id}', ['middleware' => 'permission:parecer.destroy', 'as' => 'destroy', 'uses' => 'ParecerController@destroy']);
    });
});

# ROtas de autenticação
Route::group(['middleware' => 'web'], function () {
    Route::get('login', ['as' => 'index', 'uses' => 'Authentication\LoginController@login']);
    Route::post('attempt', ['as' => 'attempt', 'uses' => 'Authentication\LoginController@attempt']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Authentication\LoginController@logout']);
});