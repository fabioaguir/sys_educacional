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


        $this->app->bind(\SerEducacional\Repositories\InstituicaoRepository::class,
            \SerEducacional\Repositories\InstituicaoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\TurnoRepository::class,
            \SerEducacional\Repositories\TurnoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\ModalidadeEnsinoRepository::class,
            \SerEducacional\Repositories\ModalidadeEnsinoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\NivelEnsinoRepository::class,
            \SerEducacional\Repositories\NivelEnsinoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\AlunoRepository::class,
            \SerEducacional\Repositories\AlunoRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\CalendarioRepository::class,
            \SerEducacional\Repositories\CalendarioRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\StatusRepository::class,
            \SerEducacional\Repositories\StatusRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\DuracaoRepository::class,
            \SerEducacional\Repositories\DuracaoRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\PeriodoAvaliacaoRepository::class,
            \SerEducacional\Repositories\PeriodoAvaliacaoRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\PeriodoRepository::class,
            \SerEducacional\Repositories\PeriodoRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\EventoRepository::class,
            \SerEducacional\Repositories\EventoRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\DiaLetivoRepository::class,
            \SerEducacional\Repositories\DiaLetivoRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\TipoEventoRepository::class,
            \SerEducacional\Repositories\TipoEventoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\FormaAvaliacaoRepository::class,
            \SerEducacional\Repositories\FormaAvaliacaoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\TipoResultadoRepository::class,
            \SerEducacional\Repositories\TipoResultadoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\NivelAlfabetizacaoRepository::class,
            \SerEducacional\Repositories\NivelAlfabetizacaoRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\UserRepository::class,
            \SerEducacional\Repositories\UserRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\RoleRepository::class,
            \SerEducacional\Repositories\RoleRepositoryEloquent::class);

        $this->app->bind(
            \SerEducacional\Repositories\PermissionRepository::class,
            \SerEducacional\Repositories\PermissionRepositoryEloquent::class);        
        
        $this->app->bind(
            \SerEducacional\Repositories\FrequenciaRepository::class,
            \SerEducacional\Repositories\FrequenciaRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\ControleFrequenciaRepository::class,
            \SerEducacional\Repositories\ControleFrequenciaRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\ProcedimentoAvaliacaoRepository::class,
            \SerEducacional\Repositories\ProcedimentoAvaliacaoRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\ProcedimentoRepository::class,
            \SerEducacional\Repositories\ProcedimentoRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\TurmaRepository::class,
            \SerEducacional\Repositories\TurmaRepositoryEloquent::class);
        
        $this->app->bind(
            \SerEducacional\Repositories\TipoAtendimentoRepository::class,
            \SerEducacional\Repositories\TipoAtendimentoRepositoryEloquent::class);
        
        
        //:end-bindings:
    }
}
