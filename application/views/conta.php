<style>
#pnCategorias {
    display: none;
}

tbody tr {
    cursor: pointer;
}

#tbProdutos,
#tbConta {
    min-height: 400px;
}

.pnConta {
    min-height: 400px;
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
                    <table id="tbProdutos" class="row-border hover">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Produto</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="buscador_custom">
    <div class="form-group">
        <label for="buscar" class="bmd-label-floating">pesquisar</label>
        <input type="text" class="form-control" name="buscar">
        <span class="bmd-help">pesquise um produto</span>
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

    var dataTableConfig = {
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "language": {
            url: '<?= base_url('')?>assets/json/dataTablesBR.json'
        }
    }


    var tb_produtos = montar_produtos(dataTableConfig);

    var tb_pedidos = montar_conta(dataTableConfig);



    $(".btn-categoria").click(function() {
        $('#pnCategorias').fadeOut('200', function() {
            $('#pnProdutos').fadeIn('200');
        });
    });

    $("#btn-reservar").click(function() {
        $('.cards').fadeOut('200', function() {
            $("#card-reservar").fadeIn();
        });
    });


    $("#tbProdutos tbody").on('click', 'tr', function() {
        console.log($(this).data('id'));
    });


    

    var categoria = 5;
    $.ajax({
        type: "GET",
        url: "<?=base_url('')?>produtos/get_produtos_by_categoria/" + categoria,
        dataType: "json",
        error: function(res) {
            console.log("erro");
            console.log(res);
        },
        success: function(data) {
            tb_produtos.clear();
            tb_produtos.rows.add(data);
            tb_produtos.draw();
        },
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

    function montar_conta(dataTableConfig) {
        conta.searching = false;
        return $('#tbConta').DataTable(conta);
    }

    function montar_produtos(dataTableConfig) {
        let produtos = dataTableConfig;
        produtos.aoColumns = [{
                "data": 'ci_produto'
            },
            {
                "data": 'nm_produto'
            },
            {
                "data": 'lbl_valor_venda'
            },
        ]
        produtos.order = [
            [1, "asc"]
        ];
        produtos.pageLength = 5;


        produtos.columnDefs = [{
                "sWidth": "10%",
                "aTargets": [0]
            },
            {
                "sWidth": "70%",
                "aTargets": [1]
            },
            {
                "sWidth": "20%",
                "aTargets": [2]
            },
        ];

        produtos.fnRowCallback = function(nRow, aData, iDisplayIndex) {
            $(nRow).attr("data-id", aData.ci_produto);
            $('td:eq(0)', nRow).html("<img src='" + aData.img_produto +
                "' width='50px' height='10px' class='img-fluid' /> ");
            return nRow;
        };
        return $("#tbProdutos").DataTable(produtos);

    }

});
</script>