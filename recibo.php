<?php
$valor = filter_input(INPUT_GET, 'valor');
$recebi = filter_input(INPUT_GET, 'recebi');
$doc = filter_input(INPUT_GET, 'documento');
$addr = filter_input(INPUT_GET, 'endereco');
$importancia = filter_input(INPUT_GET, 'importancia');
$ref = filter_input(INPUT_GET, 'referente');
$data = filter_input(INPUT_GET, 'data');


$html = '<div class="recibo">
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
                            <td align="right"><div class="border" style="padding:8px 16px;"><h3>R$ '.$valor.'</h3></div></td>
                        </tr>
                        <tr><td align="center" colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td colspan="2">Recebi(emos) de <b>'.$recebi.'</b>, CPF/CNPJ nº <b>'.$doc.'</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">Endereço <b>'. $addr.'</b></td>                            
                        </tr>
                        <tr>
                            <td colspan="2">A importância de <b>'. $importancia.'</b></td>                          
                        </tr>
                        <tr>
                            <td colspan="2">Referente <b>'. $ref.'</b></td>                      
                        </tr>
                        <tr>
                            <td align="center" colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">Para maior clareza firmamos o presente recibo</td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">Goiânia, '. $data.'</td>
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
        </div>';


require './_lib/mpdf60/mpdf.php';

$pdf = new mPDF('utf-8', 'A4');  
$pdf->SetDisplayMode('fullpage');

$stylesheet  = file_get_contents('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
$stylesheet .= file_get_contents(__DIR__."/_assets/global/css/components.css");
$stylesheet .= file_get_contents(__DIR__.'/_assets/admin/layout/css/custom.css');

$pdf->WriteHTML($stylesheet, 1);
$pdf->WriteHTML($html, 2);
$pdf->Output('Recibo.pdf', 'I');

exit();
