<?php
//formatando data
//$data = \DateTime::createFromFormat('Y-m-d', $date[0]);
?>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title></title>
    <style type="text/css" class="init">

        body {
            font-family: arial;
        }

        .table-assinatura, .table-assinatura th, .table-assinatura td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .text {
            font-size: 8px;
        }

        table {
            width: 100%;
            border: 1px solid #444;
        }
    </style>
    <link href="" rel="stylesheet" media="screen">
</head>

<body>
<div class="page">

    <h4 style="text-align: center">FIXA DO ALUNO</h4>

    <br /><br />
    <h4>DADOS GERAIS</h4>

    <table>
        <tr>
            <td colspan="2"><span class="text"><b>Código:</b> {{ $dados->codigo }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Nome:</b> {{ $dados->nome }}</span></td>
            <td><span class="text"><b>E-mail:</b> {{ $dados->email }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Pai:</b> {{ $dados->pai }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Mãe:</b> {{ $dados->mae }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Data de nascimento:</b> {{ $dados->data_nascimento }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Estado civil:</b> {{ $dados->estado_civil }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Sexo:</b> {{ $dados->sexo }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Nacionalidade:</b> {{ $dados->nacionalidade }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Naturalidade:</b> {{ $dados->naturalidade }}</span></td>
        </tr>
    </table>

    <h4>ENDEREÇO</h4>
    <table>
        <tr>
            <td><span class="text"><b>Endereço:</b> {{ $dados->logradouro }}</span></td>
            <td><span class="text"><b>Cidade:</b> {{ $dados->cidade }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Complemento:</b> {{ $dados->complemento }}</span></td>
            <td><span class="text"><b>Estado:</b> {{ $dados->estado }}</span></td>
        </tr>
        <tr>
            <td><span class="text"><b>Bairro:</b> {{ $dados->bairro }}</span></td>
            <td><span class="text"><b>CEP:</b> {{ $dados->cep }}</span></td>
        </tr>
    </table>

    <h4>DOCUMENTOS</h4>

    <table>
        <tr>
            <td><span class="text"><b>CPF:</b> {{ $dados->cpf }}</span></td>
            <td><span class="text"><b>Identidade:</b> {{ $dados->rg }}</span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="text"><b>N. NIS.:</b> {{ $dados->numero_nis }}</span></td>
        </tr>
    </table>



</div>


</body>
</html>