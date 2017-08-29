<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\NotaParecerRepository;
use SerEducacional\Entities\NotaParecer;

class NotaParecerService
{
    use TraitService;
    
    /**
     * @var NotaParecerRepository
     */
    private $repository;

    /**
     * @param NotaParecerRepository $repository
     */
    public function __construct(NotaParecerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return NotaParecer
     * @throws \Exception
     */
    public function store(array $data) : NotaParecer
    {

        if (isset($data['id']) && $data['id'] != "") {
            #Editando o registro pincipal
            $nota =  $this->repository->update($data, $data['id']);
        } else {
            #Salvando o registro pincipal
            $nota =  $this->repository->create($data);
        }

        #Verificando se foi criado no banco de dados
        if(!$nota) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $nota;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function consultar(array $data)
    {

        # Trazendo as notas do aluno
        $nota = \DB::table('edu_notas_parecer')
            ->where('edu_notas_parecer.turma_id', $data['turma'])
            ->where('edu_notas_parecer.aluno_id', $data['aluno'])
            ->where('edu_notas_parecer.periodo_id', $data['periodo'])
            ->select([
                'edu_notas_parecer.id',
                'edu_notas_parecer.parecer',
            ])->first();

        #retorno
        return $nota;
    }

    /**
     * @param int $id
     * @return array
     */
    public function loadFields(int $id)
    {

        # Trazendo os alunos da turma
        $alunos = \DB::table('edu_alunos')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
            ->join('edu_historico', 'edu_alunos.id', '=', 'edu_historico.aluno_id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_historico.turma_id')
            ->where('edu_turmas.id', $id)
            ->where('edu_historico.situacao_matricula_id', '1')
            ->orderBy('gen_cgm.nome', 'ASC')
            ->select([
                'gen_cgm.nome',
                'edu_alunos.id'
            ])->get();

        # Trazendo os alunos os períodos
        $periodos = \DB::table('edu_periodos_avaliacao')
            ->join('edu_periodos', 'edu_periodos.id', '=', 'edu_periodos_avaliacao.periodos_id')
            ->join('edu_calendarios', 'edu_calendarios.id', '=', 'edu_periodos_avaliacao.calendarios_id')
            ->join('edu_turmas', 'edu_calendarios.id', '=', 'edu_turmas.calendario_id')
            ->where('edu_turmas.id', $id)
            ->orderBy('edu_periodos.nome', 'ASC')
            ->select([
                'edu_periodos.nome',
                'edu_periodos.id'
            ])->get();

        #retorno
        return ['alunos' => $alunos, 'periodos' => $periodos];
    }
}