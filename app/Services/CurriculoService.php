<?php

namespace SerEducacional\Services;

use Doctrine\Instantiator\Exception\InvalidArgumentException;
use SerEducacional\Repositories\CurriculoRepository;
use SerEducacional\Entities\Curriculo;
use SerEducacional\Repositories\SerieRepository;

class CurriculoService
{
    use TraitService;
    
    /**
     * @var CurriculoRepository
     */
    private $repository;

    /**
     * @var SerieRepository
     */
    private $serieRepository;

    /**
     * CurriculoService constructor.
     * @param CurriculoRepository $repository
     * @param SerieRepository $serieRepository
     */
    public function __construct(CurriculoRepository $repository, SerieRepository $serieRepository)
    {
        $this->repository = $repository;
        $this->serieRepository = $serieRepository;
    }

    /**
     * @param array $data
     * @return Curriculo
     * @throws \Exception
     */
    public function store(array $data) : Curriculo
    {
        # Regras de negócios
        $this->tratamentoCampos($data);
        $this->tratamentoAtivo($data);

        #Salvando o registro pincipal
        $curriculo =  $this->repository->create($data);

        #Verificando se foi criado no banco de dados
        if(!$curriculo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        # Regras de negócios
        $this->tratamentoSeries($data, $curriculo);

        #Retorno
        return $curriculo;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Curriculo
     * @throws \Exception
     */
    public function update(array $data, int $id) : Curriculo
    {
        # Regras de negócios
        $this->tratamentoCampos($data);
        $this->tratamentoAtivo($data);
        
        #Atualizando no banco de dados
        $curriculo = $this->repository->update($data, $id);

        #Verificando se foi atualizado no banco de dados
        if(!$curriculo) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        # Regras de negócios
        $this->tratamentoSeries($data, $curriculo);

        #Retorno
        return $curriculo;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id)
    {
        # Recuperando o currículo
        $curriculo = $this->repository->find($id);

        # Removendo as séries
        $curriculo->series()->detach();

        #deletando o curso
        $result = $this->repository->delete($id);

        # Verificando se a execução foi bem sucessida
        if(!$result) {
            throw new \Exception('Ocorreu um erro ao tentar remover o curso!');
        }

        #retorno
        return true;
    }

    /**
     * @param $data
     * @return mixed
     */
    private function tratamentoAtivo($data)
    {
        # Executando a query
        return \DB::table('curriculos')
            ->where('curso_id', (int) $data['curso_id'])
            ->update(['ativo' => 0]);
    }

    /**
     * @param $data
     * @param $curriculo
     * @return bool
     * @throws \Exception
     */
    private function tratamentoSeries($data, $curriculo)
    {
        # Validand as entradas
        if(!isset($data['serie_inicial_id']) || !isset($data['serie_final_id'])) {
            throw new \Exception('Série inicial ou Série final não informada');
        }

        # Recuperando os dados do array
        $serieInicial = $data['serie_inicial_id'];
        $serieFinal   = $data['serie_final_id'];

        # Validando o range dos campos
        if(($serieInicial == $serieFinal) || ($serieInicial > $serieFinal)) {
            throw new \Exception('Você deve informar uma série final maior que a série inicial');
        }

        # Recuperando as séries no banco de dados
        $series = $this->serieRepository->findWhere([['id' , '>=', $serieInicial], ['id', '<=', $serieFinal]]);

        # Validando as séries retornadas do banco de dados
        if(!$series || count($series) == 0) {
            throw new \Exception('Séries não encontradas, contate o suporte!');
        }

        # Verificando se o currículo já possui séries
        if(count($curriculo->series) > 0) {
            # Recuperando a primeira e ultima série
            $firstSerie = $curriculo->series->first();
            $lastSerie  = $curriculo->series->last();

            # Verificando se o ranger de série é diferente
            if(($series->first()->id != $firstSerie->id) || ($series->last()->id != $lastSerie->id)) {
                # Removendo as disciplinas das séries e séries do curriculo
                //$curriculo->series->disciplinas->detach();
                $curriculo->series()->detach();
            }
        }

        # Percorrendo as séries retornadas do banco
        foreach($series as $serie) {
            # Vinculando ao currículo
            $curriculo->series()->attach($serie->id);
        }

        # retorno
        return true;
    }
}