<?php

namespace SerEducacional\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \SerEducacional\Repositories\PessoaFisicaRepository::class,
            \SerEducacional\Repositories\PessoaFisicaRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\PessoaJuridicaRepository::class,
            \SerEducacional\Repositories\PessoaJuridicaRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\EnderecoRepository::class,
            \SerEducacional\Repositories\EnderecoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\DisciplinaRepository::class,
            \SerEducacional\Repositories\DisciplinaRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\CursoRepository::class,
            \SerEducacional\Repositories\CursoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\TelefoneRepository::class,
            \SerEducacional\Repositories\TelefoneRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\NivelCursoRepository::class,
            \SerEducacional\Repositories\NivelCursoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\RegimeCursoRepository::class,
            \SerEducacional\Repositories\RegimeCursoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\TipoCursoRepository::class,
            \SerEducacional\Repositories\TipoCursoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\CurriculoRepository::class,
            \SerEducacional\Repositories\CurriculoRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\ServidorRepository::class,
            \SerEducacional\Repositories\ServidorRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\CargoRepository::class,
            \SerEducacional\Repositories\CargoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\FuncaoRepository::class,
            \SerEducacional\Repositories\FuncaoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\SerieRepository::class,
            \SerEducacional\Repositories\SerieRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\EscolaRepository::class,
            \SerEducacional\Repositories\EscolaRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\DependenciaRepository::class,
            \SerEducacional\Repositories\DependenciaRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\TurnoRepository::class,
            \SerEducacional\Repositories\TurnoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\ModalidadeEnsinoRepository::class,
            \SerEducacional\Repositories\ModalidadeEnsinoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\NivelEnsinoRepository::class,
            \SerEducacional\Repositories\NivelEnsinoRepositoryEloquent::class);


        //:end-bindings:
    }
}
