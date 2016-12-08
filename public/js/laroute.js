(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"api\/user","name":null,"action":"Closure"},{"host":null,"methods":["GET","HEAD"],"uri":"index","name":"index","action":"SerEducacional\Http\Controllers\DefaultController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cgm\/pessoaFisica\/index","name":"cgm.index","action":"SerEducacional\Http\Controllers\PessoaFisicaController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cgm\/pessoaFisica\/create","name":"cgm.create","action":"SerEducacional\Http\Controllers\PessoaFisicaController@create"},{"host":null,"methods":["POST"],"uri":"cgm\/store","name":"cgm.store","action":"SerEducacional\Http\Controllers\PessoaFisicaController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/index","name":"disciplina.index","action":"SerEducacional\Http\Controllers\DisciplinasController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/grid","name":"disciplina.grid","action":"SerEducacional\Http\Controllers\DisciplinasController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/create","name":"disciplina.create","action":"SerEducacional\Http\Controllers\DisciplinasController@create"},{"host":null,"methods":["POST"],"uri":"disciplina\/store","name":"disciplina.store","action":"SerEducacional\Http\Controllers\DisciplinasController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/edit\/{id}","name":"disciplina.edit","action":"SerEducacional\Http\Controllers\DisciplinasController@edit"},{"host":null,"methods":["POST"],"uri":"disciplina\/update\/{id}","name":"disciplina.update","action":"SerEducacional\Http\Controllers\DisciplinasController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"disciplina\/destroy\/{id}","name":"disciplina.destroy","action":"SerEducacional\Http\Controllers\DisciplinasController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/index","name":"curso.index","action":"SerEducacional\Http\Controllers\CursosController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/grid","name":"curso.grid","action":"SerEducacional\Http\Controllers\CursosController@grid"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/create","name":"curso.create","action":"SerEducacional\Http\Controllers\CursosController@create"},{"host":null,"methods":["POST"],"uri":"curso\/store","name":"curso.store","action":"SerEducacional\Http\Controllers\CursosController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/edit\/{id}","name":"curso.edit","action":"SerEducacional\Http\Controllers\CursosController@edit"},{"host":null,"methods":["POST"],"uri":"curso\/update\/{id}","name":"curso.update","action":"SerEducacional\Http\Controllers\CursosController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"curso\/destroy\/{id}","name":"curso.destroy","action":"SerEducacional\Http\Controllers\CursosController@destroy"}],
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

