<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <title>Gerador de Recibo</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" type="text/css" rel="stylesheet" />
        <link href="_assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="_assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="_assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>   
        <link href="_assets/global/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css"/>        
        <link href="_assets/global/css/components.css" type="text/css" rel="stylesheet" />
        <link href="_assets/global/css/plugins.css" type="text/css" rel="stylesheet" />
        <link href="_assets/admin/layout/css/themes/darkblue.css" type="text/css" rel="stylesheet" />
        <link href="_assets/admin/layout/css/custom.css" type="text/css" rel="stylesheet" />
        <script src="_assets/global/plugins/jquery.min.js" type="text/javascript"></script>    
        <script src="_assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="_assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript" ></script>
        <script src="_assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.pt-BR.js" type="text/javascript" ></script>
        <script src="_assets/global/plugins/input_mask/jquery.inputmask.js" type="text/javascript"></script>    
        <script src="_assets/global/plugins/maskmoney/dist/jquery.maskMoney.min.js" type="text/javascript"></script>    
        <script src="_assets/admin/layout/scripts/ValorExtenso.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var extenso = new Extenso();

                // DatePicker
                $('[data-rel^="datepicker"]').datepicker({
                    autoclose: true,
                    language: "pt-BR",
                    format: "dd/mm/yyyy",
                    todayHighlight: true
                }).inputmask("99/99/9999");

                $('[data-rel^="Money"]').maskMoney({prefix: '', allowNegative: false, thousands: '.', decimal: ',', affixesStay: false});

                $('input[name="valor"]').blur(function () {
                    var valor = $(this).val();
                    valor = valor.replace('.', '');
                    var exp = valor.split(',');

                    if (parseInt(exp[1]) > 0) {
                        valor = exp[0] + "," + exp[1];
                    } else {
                        valor = exp[0];
                    }

                    $('input[name="importancia"]').val(extenso.interpret(valor));
                });


                $('input[name="documento"]').focus(function () {
                    // Remove Mascara
                    $(this).inputmask('remove');

                }).blur(function () {
                    var value = $(this).val();
                    value = value.replace(/[^0-9]/g, '');

                    if (value.length === 11) {
                        $(this).inputmask('999.999.999-99');
                    } else {
                        $(this).inputmask('99.999.999/9999-99');
                    }
                });

                $('form[name="FormRecibo"]').submit(function (e) {
                    e.preventDefault();
                    var dados = $(this).serialize();
                    var width = $(window).width();
                    var heigt = $(window).height();

                    window.open('recibo2.php?' + decodeURIComponent(dados), '', 'width=' + width + ',height=' + heigt + '');

                });

            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row col-sm-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption caption font-green-sharp">
                            <span class="icon-notebook"></span>
                            <span class="caption-subject bold uppercase">Gerador de Recibo</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <form action="" method="post" name="FormRecibo" class="form form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3">Valor R$:</label>
                                <div class="col-sm-4">
                                    <input type="text" name="valor" class="form-control" data-rel="Money" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Rebeci (emos):</label>
                                <div class="col-sm-9">
                                    <input type="text" name="recebi" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">CPF/CNPJ:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="documento" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Endereço:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="endereco" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Importância de:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="importancia" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Referente:</label>
                                <div class="col-sm-9">
                                    <textarea name="referente" class="form-control" rows="5" required ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3">Data do Recebimento:</label>
                                <div class="col-sm-4">
                                    <input type="text" name="data" class="form-control" data-rel="datepicker" required />
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" name="gerar" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; Gerar Recibo</button>
                                    <button type="reset" name="reinciar" class="btn btn-danger"><i class="fa fa-refresh"></i>&nbsp; Reiniciar</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>                       
        </div>

        <div class="page-footer">
            <div class="page-footer-inner" style="text-align: center;">Desenvolvido por: <a href="mailto:Adão Ferreira <ramos_adao@hotmail.com>">Adão Ferreira</a></div>
        </div>        

    </body>
</html>
