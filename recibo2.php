<?php
$valor = filter_input(INPUT_GET, 'valor');
$recebi = filter_input(INPUT_GET, 'recebi');
$doc = filter_input(INPUT_GET, 'documento');
$addr = filter_input(INPUT_GET, 'endereco');
$importancia = filter_input(INPUT_GET, 'importancia');
$ref = filter_input(INPUT_GET, 'referente');
$data = filter_input(INPUT_GET, 'data');

function DataExt($Data, $horas = false) {
    $Data = implode("-",  array_reverse(explode('/',$Data)));
    
    $meses = [
        '01' => 'janeiro',
        '02' => 'fevereiro',
        '03' => 'março',
        '04' => 'abril',
        '05' => 'maio',
        '06' => 'junho',
        '07' => 'julho',
        '08' => 'agosto',
        '09' => 'setembro',
        '10' => 'outubro',
        '11' => 'novembro',
        '12' => 'dezembro'
    ];
    $dia = date('d', strtotime($Data));
    $mes = date('m', strtotime($Data));
    $ano = date('Y', strtotime($Data));

    $ext = "{$dia} de {$meses[$mes]} de {$ano}";
    $hrs = date("H:i:s", strtotime($Data));
    
    return ($horas ? $ext . " às " . $hrs : $ext);
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recibo</title>
        <link href="_assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="_assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>               
        <link href="_assets/global/css/components.css" type="text/css" rel="stylesheet" />
        <link href="_assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>        
        <link href="_assets/admin/layout/css/themes/darkblue.css" type="text/css" rel="stylesheet" />        
        <link href="_assets/admin/layout/css/custom.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div class="recibo">
            <div class="portlet">
                <div class="portlet-body">
                    <table  class="table">
                        <tr>
                            <td>
                                <img src="logo.png" width="220" />
                            </td>
                            <td>
                                <h4>EDUCAR DISTRIBUIDORA DE LIVROS LTDA</h4>
                                <p>Rua 70 Nº 647 - Setor Central</p>
                                <p>Goiânia - GO - CEP: 74055-120</p>
                                <p>CNPJ: 05.559.177/0001-46</p>
                            </td>
                        </tr>
                        <tr><td align="center" colspan="2">&nbsp;</td></tr>
                        <tr><td align="center" colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td><h1 class="bold">RECIBO</h1></td>
                            <td align="right"><h3><b><span class="border">R$  <?= $valor;?></span></b></h3></td>
                        </tr>
                        <tr><td align="center" colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td colspan="2">Recebi(emos) de <b><?= $recebi; ?></b>, CPF/CNPJ nº <b><?= $doc; ?></b></td>
                        </tr>
                        <?php
                        if(!empty($addr)):
                           echo "<tr><td colspan=\"2\">Endereço <b>{$addr}</b></td></tr>";
                        endif;
                        ?>                        
                        <tr>
                            <td colspan="2">A importância de <b><?= ucfirst($importancia); ?></b></td>                          
                        </tr>
                        <tr>
                            <td colspan="2">Referente a <b><?= $ref; ?></b></td>                      
                        </tr>
                        <tr>
                            <td align="center" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">Para maior clareza firmamos o presente recibo</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">Goiânia, <?= DataExt($data); ?></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">
                                <p>&nbsp;</p>
                                ________________________________________________________________________
                            </td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2" valign="top">Assinatura e Carimbo</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </body>
</html>