<?php

namespace SerEducacional\Http\Controllers\Relatorios;

use Illuminate\Http\Request;

use SerEducacional\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Yajra\Datatables\Datatables;


class LoadFieldsReportsController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCalendarios()
    {

        $calendarios = \DB::table('edu_calendarios')
            ->where('status_id', '=', '1')
            ->select([
                'edu_calendarios.id',
                'edu_calendarios.nome'
            ])->get();

        return response()->json($calendarios);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTurmaByCalendario(Request $request)
    {
        $escola = \Session::get('escola')->id;

        $turmas = \DB::table('edu_turmas')
            ->join('edu_series', 'edu_series.id', '=', 'edu_turmas.serie_id')
            ->where('edu_turmas.escola_id', $escola)
            ->where('edu_turmas.calendario_id', $request->get('calendario_id'))
            ->select([
                'edu_turmas.id',
                \DB::raw('CONCAT(edu_turmas.nome, " - " , edu_series.nome) as nome'),
            ])->get();

        return response()->json($turmas);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAlunosByTurma(Request $request)
    {

        $alunos = \DB::table('edu_historico')
            ->join('edu_alunos', 'edu_alunos.id', '=', 'edu_historico.aluno_id')
            ->join('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
            ->where('edu_historico.turma_id', $request->get('turma_id'))
            ->where('edu_historico.situacao_matricula_id', '1')
            ->groupBy('edu_historico.turma_id', 'edu_alunos.id', 'gen_cgm.nome')
            ->orderBy('gen_cgm.nome', 'DESC')
            ->select([
                'edu_alunos.id',
                'gen_cgm.nome'
            ])->get();

        return response()->json($alunos);

    }
}
