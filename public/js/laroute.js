(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"index","name":"index","action":"SerEducacional\Http\Controllers\DefaultController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaFisica\/index","name":"pessoaFisica.index","action":"SerEducacional\Http\Controllers\PessoaFisicaController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaFisica\/grid","name":"pessoaFisica.grid","action":"SerEducacional\Http\Controllers\PessoaFisicaController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaFisica\/create","name":"pessoaFisica.create","action":"SerEducacional\Http\Controllers\PessoaFisicaController@create"},{"host":null,"methods":["POST"],"uri":"pessoaFisica\/store","name":"pessoaFisica.store","action":"SerEducacional\Http\Controllers\PessoaFisicaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaFisica\/edit\/{id}","name":"pessoaFisica.edit","action":"SerEducacional\Http\Controllers\PessoaFisicaController@edit"},{"host":null,"methods":["POST"],"uri":"pessoaFisica\/update\/{id}","name":"pessoaFisica.update","action":"SerEducacional\Http\Controllers\PessoaFisicaController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaFisica\/destroy\/{id}","name":"pessoaFisica.destroy","action":"SerEducacional\Http\Controllers\PessoaFisicaController@destroy"},{"host":null,"methods":["POST"],"uri":"pessoaFisica\/findBairro","name":"pessoaFisica.findBairro","action":"SerEducacional\Http\Controllers\PessoaFisicaController@findBairro"},{"host":null,"methods":["POST"],"uri":"pessoaFisica\/findCidade","name":"pessoaFisica.findCidade","action":"SerEducacional\Http\Controllers\PessoaFisicaController@findCidade"},{"host":null,"methods":["POST"],"uri":"pessoaFisica\/searchCpf","name":"pessoaFisica.searchCpf","action":"SerEducacional\Http\Controllers\PessoaFisicaController@searchCpf"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaJuridica\/index","name":"pessoaJuridica.index","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaJuridica\/grid","name":"pessoaJuridica.grid","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaJuridica\/create","name":"pessoaJuridica.create","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@create"},{"host":null,"methods":["POST"],"uri":"pessoaJuridica\/store","name":"pessoaJuridica.store","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaJuridica\/edit\/{id}","name":"pessoaJuridica.edit","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@edit"},{"host":null,"methods":["POST"],"uri":"pessoaJuridica\/update\/{id}","name":"pessoaJuridica.update","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"pessoaJuridica\/destroy\/{id}","name":"pessoaJuridica.destroy","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@destroy"},{"host":null,"methods":["POST"],"uri":"pessoaJuridica\/findBairro","name":"pessoaJuridica.findBairro","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@findBairro"},{"host":null,"methods":["POST"],"uri":"pessoaJuridica\/findCidade","name":"pessoaJuridica.findCidade","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@findCidade"},{"host":null,"methods":["POST"],"uri":"pessoaJuridica\/searchCnpj","name":"pessoaJuridica.searchCnpj","action":"SerEducacional\Http\Controllers\PessoaJuridicaController@searchCnpj"},{"host":null,"methods":["GET","HEAD"],"uri":"funcao\/index","name":"funcao.index","action":"SerEducacional\Http\Controllers\FuncaoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"funcao\/grid","name":"funcao.grid","action":"SerEducacional\Http\Controllers\FuncaoController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"funcao\/create","name":"funcao.create","action":"SerEducacional\Http\Controllers\FuncaoController@create"},{"host":null,"methods":["POST"],"uri":"funcao\/store","name":"funcao.store","action":"SerEducacional\Http\Controllers\FuncaoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"funcao\/edit\/{id}","name":"funcao.edit","action":"SerEducacional\Http\Controllers\FuncaoController@edit"},{"host":null,"methods":["POST"],"uri":"funcao\/update\/{id}","name":"funcao.update","action":"SerEducacional\Http\Controllers\FuncaoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"funcao\/destroy\/{id}","name":"funcao.destroy","action":"SerEducacional\Http\Controllers\FuncaoController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"escola\/index","name":"escola.index","action":"SerEducacional\Http\Controllers\EscolaController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"escola\/grid","name":"escola.grid","action":"SerEducacional\Http\Controllers\EscolaController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"escola\/create","name":"escola.create","action":"SerEducacional\Http\Controllers\EscolaController@create"},{"host":null,"methods":["POST"],"uri":"escola\/store","name":"escola.store","action":"SerEducacional\Http\Controllers\EscolaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"escola\/edit\/{id}","name":"escola.edit","action":"SerEducacional\Http\Controllers\EscolaController@edit"},{"host":null,"methods":["POST"],"uri":"escola\/update\/{id}","name":"escola.update","action":"SerEducacional\Http\Controllers\EscolaController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"escola\/destroy\/{id}","name":"escola.destroy","action":"SerEducacional\Http\Controllers\EscolaController@destroy"},{"host":null,"methods":["POST"],"uri":"escola\/findBairro","name":"escola.findBairro","action":"SerEducacional\Http\Controllers\EscolaController@findBairro"},{"host":null,"methods":["POST"],"uri":"escola\/findCidade","name":"escola.findCidade","action":"SerEducacional\Http\Controllers\EscolaController@findCidade"},{"host":null,"methods":["GET","HEAD"],"uri":"escola\/curso\/gridCursos\/{id}","name":"escola.curso.gridCursos","action":"SerEducacional\Http\Controllers\EscolaCursoController@gridCursos"},{"host":null,"methods":["POST"],"uri":"escola\/curso\/select2","name":"escola.curso.select2","action":"SerEducacional\Http\Controllers\EscolaCursoController@cursosSelect2"},{"host":null,"methods":["POST"],"uri":"escola\/curso\/adicionarCursos","name":"escola.curso.adicionarCursos","action":"SerEducacional\Http\Controllers\EscolaCursoController@adicionarCursos"},{"host":null,"methods":["POST"],"uri":"escola\/curso\/removerCurso\/{idEscolaCurso}","name":"escola.curso.removerCurso","action":"SerEducacional\Http\Controllers\EscolaCursoController@removerCurso"},{"host":null,"methods":["GET","HEAD"],"uri":"escola\/turno\/gridTurnos\/{idEscolaCurso}","name":"escola.turno.gridTurnos","action":"SerEducacional\Http\Controllers\EscolaCursoTurnoController@gridTurnos"},{"host":null,"methods":["POST"],"uri":"escola\/turno\/select2","name":"escola.turno.select2","action":"SerEducacional\Http\Controllers\EscolaCursoTurnoController@turnosSelect2"},{"host":null,"methods":["POST"],"uri":"escola\/turno\/adicionarTurnos","name":"escola.turno.adicionarTurnos","action":"SerEducacional\Http\Controllers\EscolaCursoTurnoController@adicionarTurnos"},{"host":null,"methods":["POST"],"uri":"escola\/turno\/removerTurno","name":"escola.turno.removerTurno","action":"SerEducacional\Http\Controllers\EscolaCursoTurnoController@removerTurno"},{"host":null,"methods":["GET","HEAD"],"uri":"servidor\/index","name":"servidor.index","action":"SerEducacional\Http\Controllers\ServidorController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"servidor\/grid","name":"servidor.grid","action":"SerEducacional\Http\Controllers\ServidorController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"servidor\/create","name":"servidor.create","action":"SerEducacional\Http\Controllers\ServidorController@create"},{"host":null,"methods":["POST"],"uri":"servidor\/store","name":"servidor.store","action":"SerEducacional\Http\Controllers\ServidorController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"servidor\/edit\/{id}","name":"servidor.edit","action":"SerEducacional\Http\Controllers\ServidorController@edit"},{"host":null,"methods":["POST"],"uri":"servidor\/update\/{id}","name":"servidor.update","action":"SerEducacional\Http\Controllers\ServidorController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"servidor\/destroy\/{id}","name":"servidor.destroy","action":"SerEducacional\Http\Controllers\DisciplinasController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/index","name":"disciplina.index","action":"SerEducacional\Http\Controllers\DisciplinasController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/grid","name":"disciplina.grid","action":"SerEducacional\Http\Controllers\DisciplinasController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/create","name":"disciplina.create","action":"SerEducacional\Http\Controllers\DisciplinasController@create"},{"host":null,"methods":["POST"],"uri":"disciplina\/store","name":"disciplina.store","action":"SerEducacional\Http\Controllers\DisciplinasController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/edit\/{id}","name":"disciplina.edit","action":"SerEducacional\Http\Controllers\DisciplinasController@edit"},{"host":null,"methods":["POST"],"uri":"disciplina\/update\/{id}","name":"disciplina.update","action":"SerEducacional\Http\Controllers\DisciplinasController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/destroy\/{id}","name":"disciplina.destroy","action":"SerEducacional\Http\Controllers\DisciplinasController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/index","name":"curso.index","action":"SerEducacional\Http\Controllers\CursosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/grid","name":"curso.grid","action":"SerEducacional\Http\Controllers\CursosController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/create","name":"curso.create","action":"SerEducacional\Http\Controllers\CursosController@create"},{"host":null,"methods":["POST"],"uri":"curso\/store","name":"curso.store","action":"SerEducacional\Http\Controllers\CursosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/edit\/{id}","name":"curso.edit","action":"SerEducacional\Http\Controllers\CursosController@edit"},{"host":null,"methods":["POST"],"uri":"curso\/update\/{id}","name":"curso.update","action":"SerEducacional\Http\Controllers\CursosController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/destroy\/{id}","name":"curso.destroy","action":"SerEducacional\Http\Controllers\CursosController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"cargo\/index","name":"cargo.index","action":"SerEducacional\Http\Controllers\CargosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cargo\/grid","name":"cargo.grid","action":"SerEducacional\Http\Controllers\CargosController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"cargo\/create","name":"cargo.create","action":"SerEducacional\Http\Controllers\CargosController@create"},{"host":null,"methods":["POST"],"uri":"cargo\/store","name":"cargo.store","action":"SerEducacional\Http\Controllers\CargosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"cargo\/edit\/{id}","name":"cargo.edit","action":"SerEducacional\Http\Controllers\CargosController@edit"},{"host":null,"methods":["POST"],"uri":"cargo\/update\/{id}","name":"cargo.update","action":"SerEducacional\Http\Controllers\CargosController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"cargo\/destroy\/{id}","name":"cargo.destroy","action":"SerEducacional\Http\Controllers\CargosController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"dependencia\/index","name":"dependencia.index","action":"SerEducacional\Http\Controllers\DependenciasController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"dependencia\/grid","name":"dependencia.grid","action":"SerEducacional\Http\Controllers\DependenciasController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"dependencia\/create","name":"dependencia.create","action":"SerEducacional\Http\Controllers\DependenciasController@create"},{"host":null,"methods":["POST"],"uri":"dependencia\/store","name":"dependencia.store","action":"SerEducacional\Http\Controllers\DependenciasController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"dependencia\/edit\/{id}","name":"dependencia.edit","action":"SerEducacional\Http\Controllers\DependenciasController@edit"},{"host":null,"methods":["POST"],"uri":"dependencia\/update\/{id}","name":"dependencia.update","action":"SerEducacional\Http\Controllers\DependenciasController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"dependencia\/destroy\/{id}","name":"dependencia.destroy","action":"SerEducacional\Http\Controllers\DependenciasController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"instituicao\/edit","name":"instituicao.edit","action":"SerEducacional\Http\Controllers\InstituicaosController@edit"},{"host":null,"methods":["POST"],"uri":"instituicao\/update\/{id}","name":"instituicao.update","action":"SerEducacional\Http\Controllers\InstituicaosController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"curriculo\/index","name":"curriculo.index","action":"SerEducacional\Http\Controllers\CurriculosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"curriculo\/grid","name":"curriculo.grid","action":"SerEducacional\Http\Controllers\CurriculosController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"curriculo\/create","name":"curriculo.create","action":"SerEducacional\Http\Controllers\CurriculosController@create"},{"host":null,"methods":["POST"],"uri":"curriculo\/store","name":"curriculo.store","action":"SerEducacional\Http\Controllers\CurriculosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"curriculo\/edit\/{id}","name":"curriculo.edit","action":"SerEducacional\Http\Controllers\CurriculosController@edit"},{"host":null,"methods":["POST"],"uri":"curriculo\/update\/{id}","name":"curriculo.update","action":"SerEducacional\Http\Controllers\CurriculosController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"curriculo\/destroy\/{id}","name":"curriculo.destroy","action":"SerEducacional\Http\Controllers\CurriculosController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"curriculo\/gridSerie\/{id}","name":"curriculo.gridSerie","action":"SerEducacional\Http\Controllers\CurriculoDisciplinaController@gridSerie"},{"host":null,"methods":["GET","HEAD"],"uri":"curriculo\/gridAdicionarDisciplina\/{idCurriculoSerie}","name":"curriculo.gridAdicionarDisciplina","action":"SerEducacional\Http\Controllers\CurriculoDisciplinaController@grid"},{"host":null,"methods":["POST"],"uri":"curriculo\/disciplna\/select2","name":"curriculo.disciplina.select2","action":"SerEducacional\Http\Controllers\CurriculoDisciplinaController@disciplinasSelect2"},{"host":null,"methods":["POST"],"uri":"curriculo\/adicionarDisciplina","name":"curriculo.adicionarDisciplina","action":"SerEducacional\Http\Controllers\CurriculoDisciplinaController@adicionarDisciplina"},{"host":null,"methods":["POST"],"uri":"curriculo\/removerDisciplina","name":"curriculo.removerDisciplina","action":"SerEducacional\Http\Controllers\CurriculoDisciplinaController@removerDisciplina"},{"host":null,"methods":["GET","HEAD"],"uri":"modalidadeEnsino\/index","name":"modalidadeEnsino.index","action":"SerEducacional\Http\Controllers\ModalidadeEnsinoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"modalidadeEnsino\/grid","name":"modalidadeEnsino.grid","action":"SerEducacional\Http\Controllers\ModalidadeEnsinoController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"modalidadeEnsino\/create","name":"modalidadeEnsino.create","action":"SerEducacional\Http\Controllers\ModalidadeEnsinoController@create"},{"host":null,"methods":["POST"],"uri":"modalidadeEnsino\/store","name":"modalidadeEnsino.store","action":"SerEducacional\Http\Controllers\ModalidadeEnsinoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"modalidadeEnsino\/edit\/{id}","name":"modalidadeEnsino.edit","action":"SerEducacional\Http\Controllers\ModalidadeEnsinoController@edit"},{"host":null,"methods":["POST"],"uri":"modalidadeEnsino\/update\/{id}","name":"modalidadeEnsino.update","action":"SerEducacional\Http\Controllers\ModalidadeEnsinoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"modalidadeEnsino\/destroy\/{id}","name":"modalidadeEnsino.destroy","action":"SerEducacional\Http\Controllers\ModalidadeEnsinoController@destroy"},{"host":null,"methods":["POST"],"uri":"modalidadeEnsino\/uniqueNome","name":"modalidadeEnsino.uniqueNome","action":"SerEducacional\Http\Controllers\ModalidadeEnsinoController@uniqueNome"},{"host":null,"methods":["POST"],"uri":"modalidadeEnsino\/uniqueCodigo","name":"modalidadeEnsino.uniqueCodigo","action":"SerEducacional\Http\Controllers\ModalidadeEnsinoController@uniqueCodigo"},{"host":null,"methods":["GET","HEAD"],"uri":"nivelEnsino\/index","name":"nivelEnsino.index","action":"SerEducacional\Http\Controllers\NivelEnsinoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"nivelEnsino\/grid","name":"nivelEnsino.grid","action":"SerEducacional\Http\Controllers\NivelEnsinoController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"nivelEnsino\/create","name":"nivelEnsino.create","action":"SerEducacional\Http\Controllers\NivelEnsinoController@create"},{"host":null,"methods":["POST"],"uri":"nivelEnsino\/store","name":"nivelEnsino.store","action":"SerEducacional\Http\Controllers\NivelEnsinoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"nivelEnsino\/edit\/{id}","name":"nivelEnsino.edit","action":"SerEducacional\Http\Controllers\NivelEnsinoController@edit"},{"host":null,"methods":["POST"],"uri":"nivelEnsino\/update\/{id}","name":"nivelEnsino.update","action":"SerEducacional\Http\Controllers\NivelEnsinoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"nivelEnsino\/destroy\/{id}","name":"nivelEnsino.destroy","action":"SerEducacional\Http\Controllers\NivelEnsinoController@destroy"},{"host":null,"methods":["POST"],"uri":"nivelEnsino\/uniqueNome","name":"nivelEnsino.uniqueNome","action":"SerEducacional\Http\Controllers\NivelEnsinoController@uniqueNome"},{"host":null,"methods":["POST"],"uri":"nivelEnsino\/uniqueCodigo","name":"nivelEnsino.uniqueCodigo","action":"SerEducacional\Http\Controllers\NivelEnsinoController@uniqueCodigo"},{"host":null,"methods":["GET","HEAD"],"uri":"calendario\/index","name":"calendario.index","action":"SerEducacional\Http\Controllers\CalendariosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"calendario\/grid","name":"calendario.grid","action":"SerEducacional\Http\Controllers\CalendariosController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"calendario\/create","name":"calendario.create","action":"SerEducacional\Http\Controllers\CalendariosController@create"},{"host":null,"methods":["POST"],"uri":"calendario\/store","name":"calendario.store","action":"SerEducacional\Http\Controllers\CalendariosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"calendario\/edit\/{id}","name":"calendario.edit","action":"SerEducacional\Http\Controllers\CalendariosController@edit"},{"host":null,"methods":["POST"],"uri":"calendario\/update\/{id}","name":"calendario.update","action":"SerEducacional\Http\Controllers\CalendariosController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"calendario\/destroy\/{id}","name":"calendario.destroy","action":"SerEducacional\Http\Controllers\CalendariosController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"calendario\/gridPeriodo\/{id}","name":"calendario.gridPeriodo","action":"SerEducacional\Http\Controllers\PeriodoAvaliacaosController@grid"},{"host":null,"methods":["POST"],"uri":"calendario\/getPeriodo\/{id}","name":"calendario.getPeriodo","action":"SerEducacional\Http\Controllers\PeriodoAvaliacaosController@getPeriodo"},{"host":null,"methods":["POST"],"uri":"calendario\/storePeriodo","name":"calendario.storePeriodo","action":"SerEducacional\Http\Controllers\PeriodoAvaliacaosController@store"},{"host":null,"methods":["POST"],"uri":"calendario\/validarDataCalendario","name":"calendario.validarDataCalendario","action":"SerEducacional\Http\Controllers\PeriodoAvaliacaosController@validarDataCalendario"},{"host":null,"methods":["GET","HEAD"],"uri":"aluno\/index","name":"aluno.index","action":"SerEducacional\Http\Controllers\AlunoController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"aluno\/grid","name":"aluno.grid","action":"SerEducacional\Http\Controllers\AlunoController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"aluno\/create","name":"aluno.create","action":"SerEducacional\Http\Controllers\AlunoController@create"},{"host":null,"methods":["POST"],"uri":"aluno\/store","name":"aluno.store","action":"SerEducacional\Http\Controllers\AlunoController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"aluno\/edit\/{id}","name":"aluno.edit","action":"SerEducacional\Http\Controllers\AlunoController@edit"},{"host":null,"methods":["POST"],"uri":"aluno\/update\/{id}","name":"aluno.update","action":"SerEducacional\Http\Controllers\AlunoController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"aluno\/destroy\/{id}","name":"aluno.destroy","action":"SerEducacional\Http\Controllers\AlunoController@destroy"},{"host":null,"methods":["POST"],"uri":"aluno\/findBairro","name":"aluno.findBairro","action":"SerEducacional\Http\Controllers\AlunoController@findBairro"},{"host":null,"methods":["POST"],"uri":"aluno\/findCidade","name":"aluno.findCidade","action":"SerEducacional\Http\Controllers\AlunoController@findCidade"},{"host":null,"methods":["POST"],"uri":"aluno\/searchCpf","name":"aluno.searchCpf","action":"SerEducacional\Http\Controllers\AlunoController@searchCpf"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"index","action":"SerEducacional\Http\Controllers\Authentication\LoginController@login"},{"host":null,"methods":["POST"],"uri":"attempt","name":"attempt","action":"SerEducacional\Http\Controllers\Authentication\LoginController@attempt"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"SerEducacional\Http\Controllers\Authentication\LoginController@logout"}],
            prefix: '/sereducacional/public/index.php',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

