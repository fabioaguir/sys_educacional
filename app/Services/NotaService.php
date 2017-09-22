<?php

namespace SerEducacional\Services;

use SerEducacional\Entities\FormaAvaliacao;
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
     * @param TurmaRepository $turmaRepository
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

        $formaAvaliacao = \DB::table('edu_formas_avaliacoes')
            ->where('tipo_resultado_id', '1')->select(['*'])->first();

        for ($i = 0; $i < count($data['disciplinas']); $i++) {

            $dados['turma_id']      = $data['turma'];
            $dados['aluno_id']      = $data['aluno'];
            $dados['periodo_id']    = $data['periodo'];
            $dados['disciplina_id'] = $data['disciplinas'][$i];

            # tratando as notas caso venham vazia
            $dados['nota_ativ1']        = $data['nota_ativ1'][$i] ? $this->arredondamentoNotas($data['nota_ativ1'][$i]) : null;
            $dados['nota_ativ2']        = $data['nota_ativ2'][$i] ? $this->arredondamentoNotas($data['nota_ativ2'][$i]) :  null;
            $dados['nota_ativ3']        = $data['nota_ativ3'][$i] ? $this->arredondamentoNotas($data['nota_ativ3'][$i]) : null;
            $dados['nota_verif_aprend'] = $data['nota_verif_aprend'][$i] ? $this->arredondamentoNotas($data['nota_verif_aprend'][$i]) : null;
            $dados['media']             = $data['media'][$i] ? $data['media'][$i] : null;
            $dados['recup_paralela']    = $data['recup_paralela'][$i] ? $this->arredondamentoNotas($data['recup_paralela'][$i])  :  null;
            $dados['nota_para_recup']   = $data['nota_para_recup'][$i] ? $data['nota_para_recup'][$i] : null;


            # calculando a média caso as 3 antas de atividade sejam calculadas
            if($data['nota_ativ1'][$i] && $data['nota_ativ2'][$i]
                && $data['nota_ativ3'][$i] && $dados['nota_verif_aprend']) {

                $nota = ($data['nota_ativ1'][$i] + $data['nota_ativ2'][$i] + $data['nota_ativ3'][$i] + $dados['nota_verif_aprend']) / 4;

                $dados['media']  = $this->arredondamentoNotas($nota);

            }

            // Salva ou edita a nota
            if(isset($data['idNota'][$i]) && $data['idNota'][$i]) {
                #Editando o registro pincipal
                $nota =  $this->repository->update($dados, $data['idNota'][$i]);
            } else {
                #Salvando o registro pincipal
                $nota =  $this->repository->create($dados);
            }

            # pega o maior valor entre a média e recuperação paralela e define a média final do aluno
            if($nota->media && $nota->recup_paralela) {
                $nota->nota_para_recup = max($nota->media, $nota->recup_paralela);
                $nota->save();
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
     * @param $valor
     * @return float
     * Função para arredondamento das notas
     */
    public function arredondamentoNotas($valor)
    {
        for ($i = 0; $i < 100; $i++) {

            $media = round(number_format($valor, 2, '.', ' '), 1);
            $exp = explode('.', $media);

            if (count($exp) > 1) {
                if ($exp[1] == 5 || $exp[1] == 0) {
                    return $media;
                    break;
                } else if ($exp[1] < 5 && $exp[1] != 0) {
                    $media = $media + 0.1;
                } else if ($exp[1] > 5 && $exp[1] != 0) {
                    return round(number_format($media, 2, '.', ' '));
                }

                $valor = $media;
            } else {
                return $valor;
            }

        }
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function consultar(array $data)
    {

        # Pegando o usuário autenticado
        $user = Auth::user();

        // Pegando a data atual
        $date = new \Datetime("NOW");
        $date = $date->format('Y-m-d');

        // Pegando a turma
        $turma = $this->turmaRepository->find($data['turma']);

        // Pegando o período ao qual está sendo inserido a nota do aluno
        $periodo = \DB::table('edu_periodos_avaliacao')
            ->where('calendarios_id', $turma->calendario_id)
            ->where('periodos_id', $data['periodo'])
            ->select([
                'data_fechamento'
            ])->first();

        // Valida se p usuário é um professor
        if ($user->tipo_usuario_id == 4) {

            // Valida se a data de fechamento do período já passou. foi encerrada
            if(strtotime($periodo->data_fechamento) < strtotime($date)) {
                return ['msg' => 'A data de fechamento do período já encerrou', 'return' => array()];
            }

        }

        # Trazendo as notas do aluno
        $notas = $this->getNotasAluno($data);

        #retorno
        return ['msg' => 'success', 'return' => $notas];
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