<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\NotaRepository;
use SerEducacional\Entities\Nota;

class NotaService
{
    use TraitService;
    
    /**
     * @var NotaRepository
     */
    private $repository;

    /**
     * @param NotaRepository $repository
     */
    public function __construct(NotaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Nota
     * @throws \Exception
     */
    public function store(array $data) : Nota
    {

        # tratando as notas caso venham vazia
        $data['nota_ativ1'] = $data['nota_ativ1'] ? $data['nota_ativ1'] : null;
        $data['nota_ativ2'] = $data['nota_ativ2'] ? $data['nota_ativ2'] : null;
        $data['nota_ativ3'] = $data['nota_ativ3'] ? $data['nota_ativ3'] : null;
        $data['nota_verif_aprend'] = $data['nota_verif_aprend'] ? $data['nota_verif_aprend'] : null;
        $data['media'] = $data['media'] ? $data['media'] : null;
        $data['recup_paralela'] = $data['recup_paralela'] ? $data['recup_paralela'] : null;
        $data['nota_para_recup'] = $data['nota_para_recup'] ? $data['nota_para_recup'] : null;

        # calculando a média caso as 3 antas de atividade sejam calculadas
        if($data['nota_ativ1'] && $data['nota_ativ2'] && $data['nota_ativ3']) {
            $media = ($data['nota_ativ1'] + $data['nota_ativ2'] + $data['nota_ativ3']) / 3;
            $data['media'] = number_format($media, 2, '.', ' ');
        }

        if(isset($data['idNota']) && $data['idNota']) {
            #Editando o registro pincipal
            $nota =  $this->repository->update($data, $data['idNota']);
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
        $notas = \DB::table('edu_notas')
            ->where('edu_notas.turma_id', $data['turma'])
            ->where('edu_notas.aluno_id', $data['aluno'])
            ->where('edu_notas.periodo_id', $data['periodo'])
            ->where('edu_notas.disciplina_id', $data['disciplina'])
            ->select([
                'edu_notas.id',
                'edu_notas.nota_ativ1',
                'edu_notas.nota_ativ2',
                'edu_notas.nota_ativ3',
                'edu_notas.nota_verif_aprend',
                'edu_notas.media',
                'edu_notas.recup_paralela',
                'edu_notas.nota_para_recup',
            ])->first();

        #retorno
        return $notas;
    }

    /**
     * @param int $id
     * @return bool
     * @throws \Exception
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

        # Trazendo os alunos as disciplnas
        $disciplinas = \DB::table('edu_curriculos_series_disciplinas')
            ->join('edu_disciplinas', 'edu_disciplinas.id', '=', 'edu_curriculos_series_disciplinas.disciplina_id')
            ->join('edu_curriculos_series', 'edu_curriculos_series.id', '=', 'edu_curriculos_series_disciplinas.curriculo_serie_id')
            ->join('edu_curriculos', 'edu_curriculos.id', '=', 'edu_curriculos_series.curriculo_id')
            ->join('edu_series', 'edu_series.id', '=', 'edu_curriculos_series.serie_id')
            ->join('edu_turmas', 'edu_series.id', '=', 'edu_turmas.serie_id')
            ->where('edu_turmas.id', $id)
            ->orderBy('edu_disciplinas.nome', 'ASC')
            ->select([
                'edu_disciplinas.nome',
                'edu_disciplinas.id'
            ])->get();

        #retorno
        return ['alunos' => $alunos, 'periodos' => $periodos, 'disciplinas' => $disciplinas];
    }
}