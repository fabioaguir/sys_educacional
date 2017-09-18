<?php

namespace SerEducacional\Http\Controllers\Relatorios\Alunos;

use Illuminate\Http\Request;

use SerEducacional\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use SerEducacional\Http\Requests;
use Yajra\Datatables\Datatables;
use SerEducacional\Uteis\GerarPDF;


class FixaDoAlunoController extends Controller
{

    /**
     * @param $alunoId
     */
    public function index($alunoId)
    {

        $dados = $this->dados($alunoId);

        // Retorno do template e dados do documento
        $view = \View::make("relatorios.alunos.views.fixadoaluno", compact('dados'));

        $view_content = $view->render();

        $pdf = new GerarPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $urlImagemTopo = base_path("/public/img/logo_redape_igarassu.png");
        $urlImagemRodape = base_path("/public/img/logo_redape_igarassu.png");

        // Setando os parametros dinâmicos para montar o calendário
        //$pdf->setTitulo("FIXA DO ALUNO");
        $pdf->setUrlImagemTopo($urlImagemTopo);
        $pdf->setUrlImagemRodape($urlImagemRodape);

        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('Fixa do aluno');
        $pdf->SetSubject('');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('dejavusans', '', 9, '', true);

        $pdf->AddPage();

        $pdf->writeHTML($view_content, true, false, true, false, '');

        $pdf->Output('fixa_do_aluno.pdf');
    }


    /**
     * @param $alunoId
     */
    public function dados($alunoId)
    {

        $aluno = \DB::table('edu_alunos')
            ->leftJoin('gen_cgm', 'gen_cgm.id', '=', 'edu_alunos.cgm_id')
            ->leftJoin('gen_endereco', 'gen_endereco.id', '=', 'gen_cgm.endereco_id')
            ->leftJoin('gen_bairros', 'gen_bairros.id', '=', 'gen_endereco.bairro_id')
            ->leftJoin('gen_cidades', 'gen_cidades.id', '=', 'gen_bairros.cidades_id')
            ->leftJoin('gen_estados', 'gen_estados.id', '=', 'gen_cidades.estados_id')
            ->leftJoin('gen_estado_civil', 'gen_estado_civil.id', '=', 'gen_cgm.estado_civil_id')
            ->leftJoin('gen_sexo', 'gen_sexo.id', '=', 'gen_cgm.sexo_id')
            ->leftJoin('gen_nacionalidade', 'gen_nacionalidade.id', '=', 'gen_cgm.nacionalidade_id')
            ->where('edu_alunos.id', $alunoId)
            ->select([
                'edu_alunos.codigo',
                'gen_cgm.nome',
                'gen_cgm.pai',
                'gen_cgm.mae',
                \DB::raw('DATE_FORMAT(gen_cgm.data_nascimento,"%d/%m/%Y") as data_nascimento'),
                'gen_estado_civil.nome as estado_civil',
                'gen_sexo.nome as sexo',
                'gen_nacionalidade.nome as nacionalidade',
                'gen_cgm.naturalidade',
                'gen_cgm.email',
                'gen_cgm.fone',
                'gen_cgm.fone2',
                \DB::raw('DATE_FORMAT(gen_cgm.data_cadastramento,"%d/%m/%Y") as data_cadastramento'),

                'gen_endereco.logradouro',
                'gen_endereco.numero',
                'gen_endereco.complemento',
                'gen_endereco.cep',
                'gen_bairros.nome as bairro',
                'gen_cidades.nome as cidade',
                'gen_estados.nome as estado',

                'gen_cgm.cpf',
                'gen_cgm.rg',
                'gen_cgm.numero_nis',
            ])->first();

        return $aluno;
    }
}
