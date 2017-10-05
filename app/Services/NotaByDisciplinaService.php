<?php

namespace SerEducacional\Services;

use SerEducacional\Entities\FormaAvaliacao;
use SerEducacional\Repositories\NotaRepository;
use SerEducacional\Entities\Nota;
use SerEducacional\Repositories\TurmaRepository;
use Illuminate\Support\Facades\Auth;

class NotaByDisciplinaService
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


        $formaAvaliacao = \DB::table('edu_formas_avaliacoes')
            ->where('tipo_resultado_id', '1')->select(['*'])->first();

        foreach($data as $chave => $valor) {

            $explode = (explode("-", $chave));

            if (count($explode) > 1) {

                $campo          = $explode[0]; # Pega o id do aluno
                $aluno          = $explode[1]; # Pega o id do aluno
                $disciplina     = $explode[2]; # Pega o id da disciplina
                $periodo        = $explode[3]; # Pega o id do período
                $turma          = $explode[4]; # Pega o id da turma
                $idNota         = isset($explode[5]) ? $explode[5] : ""; # Pega o id da nota caso tenha
                $valorNota      = $valor ? $this->arredondamentoNotas($valor) : null; # Pega a nota

                # Valida se o aluno já possui registro de notas para os dados informados
                $notas = \DB::table('edu_notas')
                    ->where('edu_notas.turma_id', $turma)
                    ->where('edu_notas.aluno_id', $aluno)
                    ->where('edu_notas.periodo_id', $periodo)
                    ->where('edu_notas.disciplina_id', $disciplina)
                    ->select([
                        'edu_notas.id',
                    ])->first();

                if ($notas) {

                    #Editando o registro pincipal
                    $nota =  $this->repository->update([$campo => $valorNota], $notas->id);

                } else {

                    $dados[$campo]          = $valorNota;
                    $dados['turma_id']      = $turma;
                    $dados['aluno_id']      = $aluno;
                    $dados['periodo_id']    = $periodo;
                    $dados['disciplina_id'] = $disciplina;

                    #Salvando o registro pincipal
                    $nota =  $this->repository->create($dados);
                }

                # calculando a média caso as 3 antas de atividade sejam calculadas
                if($nota->nota_ativ1 && $nota->nota_ativ2
                    && $nota->nota_ativ3 && $nota->nota_verif_aprend) {



                    $media = ($nota->nota_ativ1 + $nota->nota_ativ2 + $nota->nota_ativ3 + $nota->nota_verif_aprend) / 4;
                    $nota->media  = $this->arredondamentoNotas($media);
                }

                # pega o maior valor entre a média e recuperação paralela e define a média final do aluno
                if($nota->media && $nota->recup_paralela) {
                    $nota->nota_para_recup = max($nota->media, $nota->recup_paralela);
                }

                // Dando save em notas para caso de alteração da média e nota de recuperação
                $nota->save();
            }

        }


        #Verificando se foi criado no banco de dados
        if(!$nota) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }


        #Retorno
        return $nota;
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

        # Trazendo os alunos da turma
        $alunos = \DB::table('edu_alunos')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
            ->join('edu_historico', 'edu_alunos.id', '=', 'edu_historico.aluno_id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_historico.turma_id')
            ->where('edu_turmas.id', $data['turma'])
            ->where('edu_historico.situacao_matricula_id', '1')
            ->orderBy('gen_cgm.nome', 'ASC')
            ->select([
                'gen_cgm.nome',
                'edu_alunos.id'
            ])->get();


        foreach ($alunos as $chave => $aluno) {

            # Trazendo as notas do aluno
            $notas = \DB::table('edu_notas')
                ->where('edu_notas.turma_id', $data['turma'])
                ->where('edu_notas.aluno_id', $aluno->id)
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

            // Inserindo quantidade de exemplares disponível em cada registro de acervo
            $arrayTemp = (array) $alunos[$chave];
            $alunos[$chave] = (object) array_merge($arrayTemp, ['notas' => $notas] );

            $arrayTemp2 = (array) $alunos[$chave];
            $alunos[$chave] = (object) array_merge($arrayTemp2, ['disciplina' => $data['disciplina']] );

        }

        //dd($alunos[1]);

        return $alunos;
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