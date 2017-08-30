<?php

namespace SerEducacional\Services;

use SerEducacional\Repositories\FrequenciaRepository;
use SerEducacional\Entities\Frequencia;
use SerEducacional\Repositories\HorarioRepository;

class FrequenciaService
{
    use TraitService;
    
    /**
     * @var FrequenciaRepository
     */
    private $repository;

    /**
     * @var HorarioRepository
     */
    private $horarioRepository;

    /**
     * @param FrequenciaRepository $repository
     */
    public function __construct(FrequenciaRepository $repository, HorarioRepository $horarioRepository)
    {
        $this->repository        = $repository;
        $this->horarioRepository = $horarioRepository;
    }

    /**
     * @param $idTurma
     * @return mixed
     */
    public function loadFields($idTurma)
    {
        $professores = \DB::table('edu_servidor')
            ->join('edu_horarios', 'edu_horarios.servidor_id', '=', 'edu_servidor.id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_horarios.turmas_id')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_servidor.id_cgm')
            ->groupBy('edu_servidor.id', 'gen_cgm.nome')
            ->where('edu_turmas.id', $idTurma)
            ->select([
                'edu_servidor.id as id',
                'gen_cgm.nome as nome',
            ])->get();

        return $professores;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getDisciplinas(array $data)
    {
        $professores = \DB::table('edu_disciplinas')
            ->join('edu_horarios', 'edu_horarios.disciplinas_id', '=', 'edu_disciplinas.id')
            ->join('edu_servidor', 'edu_servidor.id', '=', 'edu_horarios.servidor_id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_horarios.turmas_id')
            ->groupBy('edu_disciplinas.id', 'edu_disciplinas.nome')
            ->where('edu_turmas.id', $data['idTurma'])
            ->where('edu_servidor.id', $data['idProfessor'])
            ->select([
                'edu_disciplinas.id as id',
                'edu_disciplinas.nome as nome',
            ])->get();

        return $professores;
    }

    /**
     * @param array $data
     * @return string
     */
    public function consultar(array $data)
    {

        $alunos = \DB::table('edu_alunos')
            ->join('edu_historico', 'edu_historico.aluno_id', '=', 'edu_alunos.id')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_historico.turma_id')
            ->where('edu_turmas.id', $data['turma'])
            ->select([
                'edu_alunos.id',
                'gen_cgm.nome',
            ])->get();

        $aulas = $this->tratarData($data, $alunos);

        if (isset($aulas['return']) && !$aulas['return']) {
            return $aulas;
        }


        return ['return' => true, 'alunos' => $alunos, 'aulas' => $aulas];
    }


    /**
     * @param array $dados
     * @return array
     */
    private function tratarData(array $dados, &$alunos)
    {
        // Transforma a data inicial informada em um objeto de data
        $dataObjeto = \DateTime::createFromFormat('d/m/Y', $dados['dataInicio']);

        $dataAtual = new \DateTime('now');

        // Datas formato US
        $dataAtualUS  = $dataAtual->format('Y-m-d');
        $dataInicioUS = $dataObjeto->format('Y-m-d');


        // Pega a tada em formato BR
        $data = $dataObjeto->format('d/m/Y');
        $dias = array(); # array para armazenar os dias da semana e aulas do professor informado
        $aulasAluno = array(); // Array para salvar as aulas do professor em cada registro de aluno
        $aulasDias = array(); // Array para salvar os dias e aulas do profesor em cada registro de aluno

        // Pegando dia da semana inicial
        $semana = $this->getDiaDaSemana($data);

        // Validando se a data de ininial se refere a um final de semana
        if($semana == 'Domingo' || $semana == 'Sábado') {
            return ['return' => false, 'msg' => "Este dia se trata de um {$semana}, onde não possui aulas letivas nesse dia"];
        }

        // Validando se a data de ininial é maior que a data atual
        if(strtotime($dataInicioUS) > strtotime($dataAtualUS)) {
            return ['return' => false, 'msg' => "Não será permitido realizar frequência para datas seguintes da data atual"];
        }

        // Faz um loop padrão de 5 dias
        for ($i = 0; $i < 5; $i++) {

            if(($semana != 'Domingo' && $semana != 'Sábado') && (strtotime($dataInicioUS) <= strtotime($dataAtualUS))) {

                // Pegando as aulas do professor por disciplina e turma
                $rows = \DB::table('edu_horarios')
                    ->join('edu_horas', 'edu_horas.id', '=', 'edu_horarios.horas_id')
                    ->join('edu_dias_semana', 'edu_dias_semana.id', '=', 'edu_horarios.dia_semana_id')
                    ->where('edu_horarios.turmas_id', $dados['turma'])
                    ->where('edu_horarios.servidor_id', $dados['professor'])
                    ->where('edu_horarios.disciplinas_id', $dados['disciplina'])
                    ->where('edu_dias_semana.nome', $semana)
                    ->select([
                        'edu_horarios.id',
                        //\DB::raw("CONCAT(DATE_FORMAT(edu_horas.hora_inicial,'%h:%i'),' - ',DATE_FORMAT(edu_horas.hora_final,'%h:%i')) AS nome"),
                        'edu_horas.obs as nome',
                        'edu_horarios.disciplinas_id'
                    ])->get();

                // Validando se veio alguem registro de aula e inserindo numa array
                if(count($rows) > 0) {
                    $dias[$data] = $rows;
                }

            } else {
                break;
            }

            // Pegando o dia seguinte da data informada
            $date = $dataObjeto->add(new \DateInterval("P1D"));
            $data = $date->format('d/m/Y');
            $dataInicioUS = $date->format('Y-m-d');
            $semana = $this->getDiaDaSemana($data);
        }


        // Varre todos os alunos
        foreach ($alunos as $chAluno => $aluno) {

            // Varre todos os dias da semana
            foreach ($dias as $chDia => $dia) {

                // Varre todas as aulas contidas em cada dia da semana
                foreach ($dia as $chAula => $aula) {

                    $diaUS = \DateTime::createFromFormat('d/m/Y', $chDia);

                    // Verifica se o aluno possui registro de falta na aula e no dia percorrido
                    $frequencia = \DB::table('edu_frequencias')
                        ->where('edu_frequencias.aluno_id', $aluno->id)
                        ->where('edu_frequencias.disciplina_id', $aula->disciplinas_id)
                        ->where('edu_frequencias.data', $diaUS->format('Y-m-d'))
                        ->where('edu_frequencias.horario_id', $aula->id)
                        ->first();

                    $aulasAluno[$chAula]['id'] = $aula->id;
                    $aulasAluno[$chAula]['nome'] = $aula->nome;

                    // Caso tenha registro de frequência, para conhecimento de falta ou não
                    // para a aula específica
                    if($frequencia) {
                        $aulasAluno[$chAula]['falta'] = '1';
                    } else {
                        $aulasAluno[$chAula]['falta'] = '0';
                    }

                }

                $aulasDias[$chDia] = $aulasAluno;

                $arrayTemp = (array) $alunos[$chAluno];
                $alunos[$chAluno] = (object) array_merge($arrayTemp, ['aulas' => $aulasDias]);


            }

        }

        return $dias;
    }


    /**
     * @param array $data
     * @return string
     */
    public function consultarByFrequenciaSimples(array $data)
    {

        $alunos = \DB::table('edu_alunos')
            ->join('edu_historico', 'edu_historico.aluno_id', '=', 'edu_alunos.id')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_historico.turma_id')
            ->where('edu_turmas.id', $data['turma'])
            ->select([
                'edu_alunos.id',
                'gen_cgm.nome',
            ])->get();

        $aulas = $this->tratarDataByFrquenciaSimples($data, $alunos);

        if (isset($aulas['return']) && !$aulas['return']) {
            return $aulas;
        }


        return ['return' => true, 'alunos' => $alunos, 'aulas' => $aulas];
    }

    /**
     * @param array $dados
     * @return array
     */
    private function tratarDataByFrquenciaSimples(array $dados, &$alunos)
    {
        // Transforma a data inicial informada em um objeto de data
        $dataObjeto = \DateTime::createFromFormat('d/m/Y', $dados['dataInicio']);

        $dataAtual = new \DateTime('now');

        // Datas formato US
        $dataAtualUS  = $dataAtual->format('Y-m-d');
        $dataInicioUS = $dataObjeto->format('Y-m-d');


        // Pega a tada em formato BR
        $data = $dataObjeto->format('d/m/Y');
        $dias = array(); # array para armazenar os dias da semana e aulas do professor informado
        $aulasAluno = array(); // Array para salvar as aulas do professor em cada registro de aluno
        $aulasDias = array(); // Array para salvar os dias e aulas do profesor em cada registro de aluno

        // Pegando dia da semana inicial
        $semana = $this->getDiaDaSemana($data);

        // Validando se a data de ininial se refere a um final de semana
        if($semana == 'Domingo' || $semana == 'Sábado') {
            return ['return' => false, 'msg' => "Este dia se trata de um {$semana}, onde não possui aulas letivas nesse dia"];
        }

        // Validando se a data de ininial é maior que a data atual
        if(strtotime($dataInicioUS) > strtotime($dataAtualUS)) {
            return ['return' => false, 'msg' => "Não será permitido realizar frequência para datas seguintes da data atual"];
        }

        // Faz um loop padrão de 5 dias
        for ($i = 0; $i < 5; $i++) {

            if(($semana != 'Domingo' && $semana != 'Sábado') && (strtotime($dataInicioUS) <= strtotime($dataAtualUS))) {

                // Pegando as aulas do professor por disciplina e turma
                $rows = \DB::table('edu_horarios')
                    ->join('edu_horas', 'edu_horas.id', '=', 'edu_horarios.horas_id')
                    ->join('edu_dias_semana', 'edu_dias_semana.id', '=', 'edu_horarios.dia_semana_id')
                    ->where('edu_horarios.turmas_id', $dados['turma'])
                    ->where('edu_horarios.servidor_id', $dados['professor'])
                    ->where('edu_dias_semana.nome', $semana)
                    ->select([
                        'edu_horarios.id',
                        //\DB::raw("CONCAT(DATE_FORMAT(edu_horas.hora_inicial,'%h:%i'),' - ',DATE_FORMAT(edu_horas.hora_final,'%h:%i')) AS nome"),
                        'edu_horas.obs as nome',
                        'edu_horarios.disciplinas_id'
                    ])->get();

                // Validando se veio alguem registro de aula e inserindo numa array
                if(count($rows) > 0) {
                    $dias[$data] = $rows;
                }

            } else {
                break;
            }

            // Pegando o dia seguinte da data informada
            $date = $dataObjeto->add(new \DateInterval("P1D"));
            $data = $date->format('d/m/Y');
            $dataInicioUS = $date->format('Y-m-d');
            $semana = $this->getDiaDaSemana($data);
        }


        // Varre todos os alunos
        foreach ($alunos as $chAluno => $aluno) {

            // Varre todos os dias da semana
            foreach ($dias as $chDia => $dia) {

                // Varre todas as aulas contidas em cada dia da semana
                foreach ($dia as $chAula => $aula) {

                    $diaUS = \DateTime::createFromFormat('d/m/Y', $chDia);

                    // Verifica se o aluno possui registro de falta na aula e no dia percorrido
                    $frequencia = \DB::table('edu_frequencias')
                        ->where('edu_frequencias.aluno_id', $aluno->id)
                        ->where('edu_frequencias.data', $diaUS->format('Y-m-d'))
                        ->where('edu_frequencias.horario_id', $aula->id)
                        ->first();

                    $aulasAluno[$chAula]['id'] = $aula->id;
                    $aulasAluno[$chAula]['nome'] = $aula->nome;

                    // Caso tenha registro de frequência, para conhecimento de falta ou não
                    // para a aula específica
                    if($frequencia) {
                        $aulasAluno[$chAula]['falta'] = '1';
                    } else {
                        $aulasAluno[$chAula]['falta'] = '0';
                    }

                }

                $aulasDias[$chDia] = $aulasAluno;

                $arrayTemp = (array) $alunos[$chAluno];
                $alunos[$chAluno] = (object) array_merge($arrayTemp, ['aulas' => $aulasDias]);


            }

        }

        return $dias;
    }

    /**
     * @param $data
     * @return string
     */
    public static function getDiaDaSemana($data)
    {
        $dia_semana = "";

        $dia = substr($data,0,2);

        $mes = substr($data,3,2);

        $ano = substr($data,6,4);

        // Recupera índice do dia da semana
        $diasemana = date("w", mktime(0,0,0,$mes,$dia,$ano) );

        // Retorna o dia da semana por extenso
        switch($diasemana) {

            case"0": $dia_semana = "Domingo"; break;

            case"1": $dia_semana = "Segunda"; break;

            case"2": $dia_semana = "Terça"; break;

            case"3": $dia_semana = "Quarta"; break;

            case"4": $dia_semana = "Quinta"; break;

            case"5": $dia_semana = "Sexta"; break;

            case"6": $dia_semana = "Sábado"; break;

        }

        return $dia_semana;
    }

    /**
     * @param array $data
     * @return Frequencia
     * @throws \Exception
     */
    public function store(array $data) : Frequencia
    {

        $retorno = "";

        foreach($data as $chave => $valor) {

            $dados = (explode("_", $chave));

            if (count($dados) > 2) {

                $aluno     = $dados[1]; # Pega o id do aluno
                $dia       = \DateTime::createFromFormat('d/m/Y', $dados[2]); # Pega a data da frequência
                $horario   = $dados[3]; # Pega o id do horário

                // Busca os dados para frequência contidas no horário informado
                $horario = $this->horarioRepository->find($horario);

                // Preenche os dados da frequência para insert
                $dadosFrequencia['professor_id']    = $horario['servidor_id'];
                $dadosFrequencia['aluno_id']        = $aluno;
                $dadosFrequencia['data']            = $dia->format('Y-m-d');
                $dadosFrequencia['turma_id']        = $horario['turmas_id'];
                $dadosFrequencia['disciplina_id']   = $horario['disciplinas_id'];
                $dadosFrequencia['horario_id']      = $horario['id'];

                $retorno = $this->repository->create($dadosFrequencia);
            }

        }

        #Verificando se foi criado no banco de dados
        if(!$retorno) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $retorno;
    }


    /**
     * @param array $data
     * @return Frequencia
     * @throws \Exception
     */
    public function storeByFrequenciaSimples(array $data) : Frequencia
    {

        $retorno = "";

        foreach($data as $chave => $valor) {

            $dados = (explode("_", $chave));

            if (count($dados) > 2) {

                $aluno     = $dados[1]; # Pega o id do aluno
                $dia       = \DateTime::createFromFormat('d/m/Y', $dados[2]); # Pega a data da frequência
                $horario   = $dados[3]; # Pega o id do horário

                // Busca os dados para frequência contidas no horário informado
                $horario = $this->horarioRepository->find($horario);

                // Preenche os dados da frequência para insert
                $dadosFrequencia['professor_id']    = $horario['servidor_id'];
                $dadosFrequencia['aluno_id']        = $aluno;
                $dadosFrequencia['data']            = $dia->format('Y-m-d');
                $dadosFrequencia['turma_id']        = $horario['turmas_id'];
                $dadosFrequencia['horario_id']      = $horario['id'];

                $retorno = $this->repository->create($dadosFrequencia);
            }

        }

        #Verificando se foi criado no banco de dados
        if(!$retorno) {
            throw new \Exception('Ocorreu um erro ao cadastrar!');
        }

        #Retorno
        return $retorno;
    }
}