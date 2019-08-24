<style>
#pnCategorias {    
}


#pnProdutos{
    display: none;
}

tbody tr {
    cursor: pointer;
}

#tbProdutos {
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
                        <input id="cd_conta" type="hidden" value="<?= $conta_mesa_info->ci_conta;?>" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7 pnConta">
        <div class="card">
            <div class="card-body">
                <div class="row" id="pnCategorias">
                    <?php foreach($categorias as $cat){  ?>
                    <div class="col-md-4">
                        <div data-id="<?= $cat->ci_categoria ?>" class="card btn btn-primary text-left btn-categoria">
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
    <div class="col-md-5 pnConta">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table id="tbConta" class="row-border hover">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>qtd.</th>
                                <th>unidade</th>
                                <th>Total</th>
                            </tr>
                        </thead>
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

    var conta = $("#cd_conta").val();

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
    att_conta(conta);
    

    $(".btn-categoria").click(function() {
        let id = $(this).data('id');
        att_produtos(id);
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
        var pedido = {};
        pedido.cd_produto = $(this).data('id');
        pedido.cd_conta = $("#cd_conta").val();
        $.ajax({
            type: "POST",
            url: "<?=base_url('')?>Conta/add_produto/",
            data: pedido,
            dataType: "json",
            error: function(res) {
                console.log("erro");
                console.log(res);
            },
            success: function(pedidos) {                
                tb_pedidos.clear();
                tb_pedidos.rows.add(pedidos);
                tb_pedidos.draw();                                
            },
        });

    });


    function att_produtos(categoria) {
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

    }

    function att_conta(conta) {
        $.ajax({
            type: "GET",
            url: "<?=base_url('')?>conta/get_pedidos_conta/" + conta,
            dataType: "json",
            error: function(res) {
                console.log("erro");
                console.log(res);
            },
            success: function(pedidos) {
                console.log(pedidos);
                tb_pedidos.clear();
                tb_pedidos.rows.add(pedidos);
                tb_pedidos.draw();
            },
        });


    }

    function montar_conta(dataTableConfig) {        
        var conta = JSON.parse(JSON.stringify(dataTableConfig));
        conta.searching = false;

        conta.aoColumns = [{
                "data": 'nm_produto'
            },
            {
                "data": 'quantidade'
            },
            {
                "data": 'lbl_valor_venda'
            },
            {
                "data": 'lbl_total'
            },
        ]
        conta.columnDefs = [{
                "sWidth": "50%",
                "aTargets": [0]
            },
            {
                "sWidth": "10%",
                "aTargets": [1]
            },
            {
                "sWidth": "20%",
                "aTargets": [2]
            },
            {
                "sWidth": "20%",
                "aTargets": [3]
            },
        ];

        
        return $('#tbConta').DataTable(conta);
    }

    function montar_produtos(dataTableConfig) {
        var produtos = JSON.parse(JSON.stringify(dataTableConfig));
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