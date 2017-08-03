<?php

namespace SerEducacional\Http\Controllers;

use Illuminate\Http\Request;
use SerEducacional\Repositories\AlunoRepository;
use SerEducacional\Repositories\TurmaRepository;
use Yajra\Datatables\Datatables;

class TurmaAlunoController extends Controller
{
    /**
     * @var TurmaRepository
     */
    private $turmaComplementarRepository;

    /**
     * @var AlunoRepository
     */
    private $alunoRepository;

    /**
     * TurmaAlunoController constructor.
     * @param TurmaRepository $turmaComplementarRepository
     * @param AlunoRepository $alunoRepository
     */
    public function __construct(TurmaRepository $turmaComplementarRepository,
                                AlunoRepository $alunoRepository)
    {
        $this->turmaComplementarRepository = $turmaComplementarRepository;
        $this->alunoRepository = $alunoRepository;
    }

    /**
     * @return mixed
     */
    public function grid($idTurma)
    {
        #Criando a consulta
        $rows = \DB::table('edu_alunos')
            ->join('edu_alunos_turmas', function ($join) {
                $join->on(
                    'edu_alunos_turmas.id', '=',
                    \DB::raw('(SELECT turma_atual.id FROM edu_alunos_turmas as turma_atual
                        where turma_atual.alunos_id = edu_alunos.id ORDER BY turma_atual.id DESC LIMIT 1)')
                );
            })
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
            ->join('edu_turmas', 'edu_turmas.id', '=', 'edu_alunos_turmas.turmas_id')
            ->select([
                'edu_alunos_turmas.id',
                'edu_alunos_turmas.matricula',
                'gen_cgm.nome',
                \DB::raw('DATE_FORMAT(edu_alunos_turmas.data_matricula, "%d/%m/%Y") as data_matricula')
            ])
            ->where('edu_turmas.id', $idTurma);

        #Editando a grid
        return Datatables::of($rows)->make(true);
    }
}