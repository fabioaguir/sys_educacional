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
        $rows = \DB::table('alunos')
            ->join('alunos_turmas', function ($join) {
                $join->on(
                    'alunos_turmas.id', '=',
                    \DB::raw('(SELECT turma_atual.id FROM alunos_turmas as turma_atual
                        where turma_atual.alunos_id = alunos.id ORDER BY turma_atual.id DESC LIMIT 1)')
                );
            })
            ->join('cgm', 'cgm.id', '=', 'alunos.cgm_id')
            ->join('turmas', 'turmas.id', '=', 'alunos_turmas.turmas_id')
            ->select([
                'alunos_turmas.id',
                'alunos_turmas.matricula',
                'cgm.nome',
                \DB::raw('DATE_FORMAT(alunos_turmas.data_matricula, "%d/%m/%Y") as data_matricula')
            ])
            ->where('turmas.id', $idTurma);

        #Editando a grid
        return Datatables::of($rows)->make(true);
    }
}