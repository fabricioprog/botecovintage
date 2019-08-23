<style>
.pnForm {
    padding-top: 10px;
}

#pnProdutos {
    display: none;
}

#pnCategorias, #pnProdutos {
    padding: 20px 0px 20px 0px;
}

.btn-adjust {
    margin-top: 30px;
}

.cards {
    // display: none;
}

.livre {
    background-color: rgba(205, 254, 218, 1);
}

.ocupado {
    background-color: rgba(255, 250, 193, 1);
}

.reservado {
    background-color: rgba(205, 205, 254, 1);
}

.bloqueado {
    background-color: rgba(254, 205, 205, 1)
}

#btnAdd,
#btnFinalizar {
    margin-left: 15px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
            <i class="fa fa-th-large"></i> Teste X
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
                    <div class="col-md-4">
                        Informações A
                        <?php echo "ola";  ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12" style="margin-top:30px;">
        <div class="card cards" id="">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 livre">
                        <div class="row" id="pnCategorias">
                            <?php 
                            $categorias = array(1,2,3,4,5);
                            foreach($categorias as $cat){  ?>
                            <div class="col-md-4">
                                <div class="card btn btn-primary text-left btn-categoria">
                                    <!--<img class="card-img-top img-fluid rounded mx-auto d-block" src="assets/img/"
                                        alt="Card image cap" style="padding:10px 10px 0px 10px">-->
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $cat ?></h5>
                                        <p class="card-text"><?= $cat ?></p>
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
                                        <th>Nome</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Teste 1</td>
                                        <td>Teste 3</td>
                                    </tr>
                                </tbody>
                            </table>
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
                    </div>
                    <div class="col-md-4 ocupado">
                        B
                        <!-- <table id="tbTeste">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nome</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Teste 1</td>
                                    <td>Teste 3</td>
                                </tr>
                            </tbody>
                        </table> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    jQuery.datetimepicker.setLocale('pt-BR');
    
     $('#tbProdutos').DataTable({
         "language": {url: 'assets/json/dataTablesBR.json'},
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