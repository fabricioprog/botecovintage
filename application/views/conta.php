<style>
#pnCategorias {
    display: none;
}

#pnProdutos {}

.pnConta {
    margin-top: 20px;    
}

#btnAdd,
#btnFinalizar {
    margin-left: 15px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
            <i class="fa fa-th-large"></i> Mesa <?= $mesa_id ?>
            <button id="btnFinalizar" type="button" class="btn btn-md btn-outline-success  btn-rounded pull-right">
                <i class="fa fa-check" aria-hidden="true"></i>
                </span>
            </button>
            <a href="<?= base_url('mesas') ?>" id="btnVoltar"><span class="pull-right">
                    <button type="button" class="btn btn-md btn-outline-success pull-right">
                        <i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i></span>
                </button>
            </a>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label> <strong> Código : </strong> <?= $conta_mesa_info->ci_conta ?></label><br>
                        <label> <strong> Início : </strong> <?= $conta_mesa_info->dt_inicio ?></label><br>
                    </div>
                    <div class="col-md-6 align-self-center">
                        <button type="button" class="btn btn-raised btn-success pull-right">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            Fechar Conta
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-8 pnConta">
        <div class="card">
            <div class="card-body">
                <div class="row" id="pnCategorias">
                    <?php foreach($categorias as $cat){  ?>
                    <div class="col-md-4">
                        <div class="card btn btn-primary text-left btn-categoria">
                            <img class="card-img-top img-fluid rounded mx-auto d-block" src="<?= $cat->imagem ?>"
                                alt="Card image cap" style="padding:10px 10px 0px 10px">
                            <div class="card-body">
                                <h5 class="card-title"><?= $cat->nm_categoria ?></h5>
                                <p class="card-text"><?= $cat->ds_categoria ?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <div class="col-md-12" id="pnProdutos">
                    <table id="tbProdutos">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Produto</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Teste 1</td>
                                <td>Teste 2</td>
                                <td>Teste 3</td>
                            </tr>
                            <tr>
                                <td>Teste 1</td>
                                <td>Teste 2</td>
                                <td>Teste 3</td>
                            </tr>
                            <tr>
                                <td>Teste 1</td>
                                <td>Teste 2</td>
                                <td>Teste 3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 pnConta">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table id="tbConta">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>qtd</th>
                                    <th>Unt</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Prod X</td>
                                    <td> 10 </td>
                                    <td> RS 1,00 </td>
                                    <td> RS 10,00 </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
                        <div class="form-group">
                            
                            <label for="produto" class="bmd-label-floating">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                Inínio
                            </label>
                            <input id="data" autocomplete="off" type="text" class="form-control" name="produto">
                            <span class="bmd-help">diga a data</span>
                        </div> -->

<script>
$(document).ready(function() {
    jQuery.datetimepicker.setLocale('pt-BR');

    $('#tbProdutos').DataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "language": {
            url: '<?= base_url('')?>assets/json/dataTablesBR.json'
        },
    });

    $('#tbConta').DataTable({
        "ordering": false,
        "searching": false,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "language": {
            url: '<?= base_url('')?>assets/json/dataTablesBR.json'
        },
    });

    //$('#data').datetimepicker();

    $(".btn-categoria").click(function() {
        console.log("click");
        $('#pnCategorias').fadeOut('200', function() {
            $('#pnProdutos').fadeIn('200');
        });
    });

    $("#btn-reservar").click(function() {
        $('.cards').fadeOut('200', function() {
            $("#card-reservar").fadeIn();
        });
    });

    /*function montar_tabela(data) {
    faltas = data;
    $tabela = $("#tbfj").DataTable();
    $tabela.destroy();
    $tabela = $("#tbfj").DataTable({
        "pageLength": 100,
        "order": [[1, "asc"]],
        bAutoWidth: false,
        "language": {url: 'assets/js/dataTablesBR.json'},
        "data": data,
        "columns": [
            {"data": "cd_aluno"},
            {"data": "nm_aluno"},
            {   
                "render": function ( data, type, row ) {                    
                return row.ds_ofertaitem + "|" + row.ds_turma;
            }
            },

            {"data": "dt_inicio"},
            {"data": "dt_fim"},
            {"data": "nm_motivo"}
        ],
        "fnRowCallback": function (nRow, aData, iDisplayIndex) {            
            $(nRow).attr("data-falta", aData.ci_falta_justificada);            
            $('td:eq(0)', nRow).html("<img src='http://registrofotografico.seduc.ce.gov.br/wsdiretorturma/api/registroFotografico/image/nonCheck/" + aData.cd_aluno + "' width='50px' height='50px' class='img img-rounded img-responsive' /> ");
            return nRow;
        },
        columnDefs: [
            { type: 'date-uk', targets: 3 },
            { type: 'date-uk', targets: 4 },
            {"sWidth": "10%", "aTargets": [0]},
            {"sWidth": "30%", "aTargets": [1]},
            {"sWidth": "30%", "aTargets": [2]},
            {"sWidth": "10%", "aTargets": [3]},
            {"sWidth": "10%", "aTargets": [4]},
            {"sWidth": "10%", "aTargets": [5]},
        ], "fnDrawCallback": function () {
        }
    });*/

});
</script>