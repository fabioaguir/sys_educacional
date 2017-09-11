<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\NotaRepository;
use SerEducacional\Entities\Nota;
use SerEducacional\Repositories\TurmaRepository;
use Illuminate\Support\Facades\Auth;

class NotaService
{
    use TraitService;
    
    /**
     * @var NotaRepository
     */
    private $repository;

    /**
     * @var TurmaRepository
     */
    private $turmaRepository;

    /**
     * @param NotaRepository $repository
     */
    public function __construct(NotaRepository $repository,
                                TurmaRepository $turmaRepository)
    {
        $this->repository      = $repository;
        $this->turmaRepository = $turmaRepository;
    }

    /**
     * @param array $data
     * @return Nota
     * @throws \Exception
     */
    public function store(array $data)
    {

        $dados = [];
        $nota = null;

        for ($i = 0; $i < count($data['disciplinas']); $i++) {

            $dados['turma_id']      = $data['turma'];
            $dados['aluno_id']      = $data['aluno'];
            $dados['periodo_id']    = $data['periodo'];
            $dados['disciplina_id'] = $data['disciplinas'][$i];

            # tratando as notas caso venham vazia
            $dados['nota_ativ1']        = $data['nota_ativ1'][$i] ? $data['nota_ativ1'][$i] : null;
            $dados['nota_ativ2']        = $data['nota_ativ2'][$i] ? $data['nota_ativ2'][$i] :  null;
            $dados['nota_ativ3']        = $data['nota_ativ3'][$i] ? $data['nota_ativ3'][$i] : null;
            $dados['nota_verif_aprend'] = $data['nota_verif_aprend'][$i] ? $data['nota_verif_aprend'][$i] : null;
            $dados['media']             = $data['media'][$i] ? $data['media'][$i] : null;
            $dados['recup_paralela']    = $data['recup_paralela'][$i] ? $data['recup_paralela'][$i] :  null;
            $dados['nota_para_recup']   = $data['nota_para_recup'][$i] ? $data['nota_para_recup'][$i] : null;

            # calculando a média caso as 3 antas de atividade sejam calculadas
            if($data['nota_ativ1'][$i] && $data['nota_ativ2'][$i] && $data['nota_ativ3'][$i]) {
                $media = ($data['nota_ativ1'][$i] + $data['nota_ativ2'][$i] + $data['nota_ativ3'][$i]) / 3;
                $dados['media'] = number_format($media, 2, '.', ' ');
            }

            if(isset($data['idNota'][$i]) && $data['idNota'][$i]) {
                #Editando o registro pincipal
                $nota =  $this->repository->update($dados, $data['idNota'][$i]);
            } else {
                #Salvando o registro pincipal
                $nota =  $this->repository->create($dados);
            }

        }

        #Verificando se foi criado no banco de dados
        if(!$nota) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        # Trazendo as notas do aluno
        $notas = $this->getNotasAluno($data);

        #Retorno
        return $notas;
    }


    /**
     * @param array $data
     * @return mixed
     */
    public function consultar(array $data)
    {

        # Trazendo as notas do aluno
        $notas = $this->getNotasAluno($data);

        #retorno
        return $notas;
    }

    /**
     * @param array $data
     * @return mixed
     */
    private function getNotasAluno(array $data)
    {
        # Trazendo as notas do aluno
        $rows = \DB::table('edu_notas')
            ->where('edu_notas.turma_id', $data['turma'])
            ->where('edu_notas.aluno_id', $data['aluno'])
            ->where('edu_notas.periodo_id', $data['periodo'])
            ->whereIn('edu_notas.disciplina_id', $data['disciplinas'])
            ->select([
                'edu_notas.id',
                'edu_notas.nota_ativ1',
                'edu_notas.nota_ativ2',
                'edu_notas.nota_ativ3',
                'edu_notas.nota_verif_aprend',
                'edu_notas.media',
                'edu_notas.recup_paralela',
                'edu_notas.nota_para_recup',
                'edu_notas.disciplina_id'
            ])->get();

        return $rows;
    }


    /**
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function loadFields(int $id)
    {
        # Recuperando a turma
        $turma = $this->turmaRepository->find($id);

        # Pegando o usuário autenticado
        $user = Auth::user();

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


        if ($turma->professor_unico_id == 2 ||
            ($user->tipo_usuario_id == 1 || $user->tipo_usuario_id == 2 || $user->tipo_usuario_id == 3)) {

            # Pegando as disciplnas
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

        } else {

            # Pegando as disciplnas
            $disciplinas = \DB::table('edu_disciplinas')
                ->join('edu_horarios', 'edu_disciplinas.id', '=', 'edu_horarios.disciplinas_id')
                ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_horarios.turmas_id')
                ->join('edu_servidor', 'edu_servidor.id', '=', 'edu_horarios.servidor_id')
                ->where('edu_turmas.id', $id)
                ->where('edu_servidor.id', $user->edu_servidor_id)
                ->groupBy('edu_disciplinas.id', 'edu_disciplinas.nome')
                ->orderBy('edu_disciplinas.nome', 'ASC')
                ->select([
                    'edu_disciplinas.nome',
                    'edu_disciplinas.id'
                ])->get();
        }

        #retorno
        return ['alunos' => $alunos, 'periodos' => $periodos, 'disciplinas' => $disciplinas];
    }
}