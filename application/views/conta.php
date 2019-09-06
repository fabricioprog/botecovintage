<style>
.tb-body {
    padding: 10px 0px 10px 0px;
}


#pnProdutos {
    display: none;
}

.dataTables_scrollHeadInner,
.dataTables_scrollHeadInner table {
    width: 100% !important;
}

tbody tr {
    cursor: pointer;
}

#tbProdutos {
    width: 100%;
}

#tbConta {
    width: 100%;
}


.btn-categoria {
    min-height: 180px;
}


.btn-categoria img {
    max-height: 140px;
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
            <a href="<?= base_url('mesas') ?>" id="btnVoltar">
                <span class="pull-right">
                    <button type="button" class="btn btn-md btn-outline-success pull-right">
                        <i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i></span>
                </button>
            </a>
        </p>
    </div>

</div>

<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label> <strong> Código : </strong> <?= $conta_mesa_info->ci_conta ?></label><br>
                        <label> <strong> Início : </strong> <?= $conta_mesa_info->dt_inicio ?></label><br>
                        <div class="checkbox">
                            <label style="color:black">
                                <input name="fl_dez_porcento" type="checkbox" checked> 10%
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <a href="<?= base_url('conta/report/'.$conta_mesa_info->ci_conta) ?>" target='_blank'>
                            <button type="button" class="btn btn-raised btn-info btn-block pull-right">
                                <i class="fa fa-file" aria-hidden="true"></i>
                                Fechar Conta
                            </button>
                        </a>
                        <button id="btn-encerrar-conta" type="button"
                            class="btn btn-raised btn-block btn-success pull-right">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            Encerrar
                        </button>
                        <input name="cd_conta" id="cd_conta" type="hidden" value="<?= $conta_mesa_info->ci_conta;?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-top:10px">
            <div class="card-body">
                <div class="row" id="pnCategorias">
                    <?php foreach($categorias as $cat){  ?>
                    <div class="col-md-4">
                        <div data-id="<?= $cat->ci_categoria ?>" class="card btn btn-primary text-left btn-categoria">
                            <img class="card-img-top img-fluid rounded mx-auto d-block" src="<?= $cat->imagem ?>"
                                alt="Card image cap" style="padding:10px 10px 0px 10px">
                            <div class="card-body">
                                <strong class="card-title"><?= $cat->nm_categoria ?></strong>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-12" id="pnProdutos">
                    <table id="tbProdutos" class="row-border hover table dt-responsive no-footer" cellspacing="0"
                        style="width:100%;">
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
                        <table id="tbConta" class="row-border hover table dt-responsive no-footer">
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
                <div class="row" style='margin-top:10px'>
                    <div class='col-12'>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th width='33%'><strong>Conta</strong></th>
                                    <th width='33%'><strong>10%</strong></th>
                                    <th width='33%'><strong>Total</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row"><strong id="conta_soma"></strong></td>
                                    <td><strong id="conta_dez_porcento"></strong></td>
                                    <td><strong id="conta_total"></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="header_produtos" hidden>
    <div class="form-group">
        <button type="button" class="btn btn-block btn-categorias btn-raised btn-info">
            <i class="fa fa-reply" aria-hidden="true"></i>
            Categorias
        </button>
    </div>
</div>

<?= $this->load->view('modal/encerrar_conta.php',array("id"=>'md_encerrar_conta'),true); ?>

<script>
$(document).ready(function() {
    jQuery.datetimepicker.setLocale('pt-BR');
    $modal = $("#myModal");
    var conteudo = $("#md_encerrar_conta").html();
    $("#md_encerrar_conta").remove();
    var conta = $("#cd_conta").val();

    var dataTableConfig = {
        "scrollCollapse": true,
        "paging": false,
        "pageLength": 1000,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "language": {
            "url": "<?=base_url('')?>assets/json/dataTablesBR.json",
        }
    }

    var tb_produtos = montar_produtos(dataTableConfig);
    var tb_pedidos = montar_conta(dataTableConfig);

    att_conta(conta);


    $('input[name="fl_dez_porcento"]').change(function() {
        let fl_dez_porcento = $(this).is(':checked');
        let cd_conta = $('input[name="cd_conta"]').val();
        recalcula_dez_porcento(cd_conta, fl_dez_porcento);
    });


    $(".btn-categoria").click(function() {
        let id = $(this).data('id');

        tb_produtos.search('').draw();

        $('#pnCategorias').fadeOut('10', function() {
            $('#pnProdutos').fadeIn('10'); 
            $('div.dataTables_filter input').focus();           
        });
        att_produtos(id);
        

    });

    $('#tbConta').on('click', 'tr', function() {
        let produto = $(this).find('td:eq(0)').text();
        produto = "<strong>" + produto + "</strong>";
        let titulo = "<span class= 'text-danger'> Remoção de Pedido </strong>";
        let id_produto = $(this).data('id');
        modal_set_confirmar("SIM");
        abrir_modal(titulo, "Tem certeza que deseja remover " + produto + " ? ", false);
        $modal.on('click', '#btn_confirmar', function() {
            remover_produto_conta(id_produto, conta);
            $modal.modal('hide');
        });

    });


    $(document).on("click", ".btn-categorias", function() {
        $('#pnProdutos').fadeOut('10', function() {
            $('#pnCategorias').fadeIn('10', function() {
                tb_produtos.clear();
                tb_produtos.draw();
            });
        });

    });

    $("#btn-reservar").click(function() {
        $('.cards').fadeOut('200', function() {
            $("#card-reservar").fadeIn();
        });
    });


    $("#btn-encerrar-conta").click(function() {
        abrir_modal('Encerrar Conta', conteudo, true);
        $("#myModal").find('input, #md-lbl-total, #md-lbl-soma').mask('000.000,00', {
            reverse: true
        });
        var lbl_total = $("#conta_total").text();
        var total = $(document).find("#conta_total").data('valor');
        $(document).find('#md-lbl-total').text(lbl_total);
        $(document).find('#md-lbl-total').data('valor', total);
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
                tb_pedidos.rows.add(pedidos.lista);
                tb_pedidos.draw();
                let somatorio = pedidos.somatorio;
                att_info_conta(pedidos)
                anima_confirma('success', 1000, "Pedido Adicionado com Sucesso!!!");
            },
        });

    });


    function remover_produto_conta(produto, conta) {
        $.ajax({
            type: "GET",
            url: "<?=base_url('')?>conta/remover_produto_conta/" + produto + "/" + conta,
            dataType: "json",
            error: function(res) {
                console.log("erro");
                console.log(res);
            },
            success: function(pedidos) {
                att_info_conta(pedidos);
                anima_confirma('success', 4000, "Produto Removido com Sucesso!");
            },
        });
    }

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

    function recalcula_dez_porcento(conta, fl_dez_porcento) {
        $.ajax({
            type: "GET",
            url: "<?=base_url('')?>conta/recalcula_dez_porcento_conta/" + conta + "/" + fl_dez_porcento,
            dataType: "json",
            error: function(res) {
                console.log("erro");
                console.log(res);
            },
            success: function(pedidos_conta) {
                att_info_conta(pedidos_conta);
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
            success: function(pedidos_conta) {
                att_info_conta(pedidos_conta);
                if (pedidos_conta.info.fl_dez_porcento == 'f') {
                    $('input[name="fl_dez_porcento"]').removeAttr('checked');
                }
            },
        });
    }

    function att_info_conta(pedidos_conta) {
        tb_pedidos.clear();
        tb_pedidos.rows.add(pedidos_conta.lista);
        tb_pedidos.draw();
        let somatorio = pedidos_conta.somatorio;
        if (pedidos_conta.info.fl_dez_porcento == 'f') {
            somatorio.total = somatorio.lbl_soma;
            somatorio.lbl_dez_porcento = '';
            somatorio.lbl_soma = '';
            somatorio.valor_total = somatorio.soma;
        }

        $("#conta_soma").html(somatorio.lbl_soma);
        $("#conta_dez_porcento").html(somatorio.lbl_dez_porcento);
        $("#conta_total").html(somatorio.total);
        $("#conta_total").data('valor', somatorio.valor_total);
    }

    function montar_conta(dataTableConfig) {
        var generico = JSON.parse(JSON.stringify(dataTableConfig));
        var conta = {
            "scrollY": "450px",
            "searching": false,
            "aoColumns": [{
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
            ],
            "columnDefs": [{
                    "sWidth": "50%",
                    "aTargets": [0]
                },
                {
                    "sWidth": "5%",
                    "aTargets": [1]
                },
                {
                    "sWidth": "20%",
                    "aTargets": [2]
                },
                {
                    "sWidth": "25%",
                    "aTargets": [3]
                },
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $(nRow).attr("data-id", aData.ci_produto);
                return nRow;
            },

        }
        let merge = Object.assign(generico, conta);
        return $('#tbConta').DataTable(merge);
    }



    function montar_produtos(dataTableConfig) {
        var generico = JSON.parse(JSON.stringify(dataTableConfig));
        var produtos = {
            dom: "<'row'<'btn-voltar col-md-4 col-xs-12'><'col-md-8'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "scrollY": 350,
            "order": [
                [1, "asc"]
            ],
            "aoColumns": [{
                    "data": 'ci_produto'
                },
                {
                    "data": 'nm_produto'
                },
                {
                    "data": 'lbl_valor_venda'
                }
            ],
            "columnDefs": [{
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
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $(nRow).attr("data-id", aData.ci_produto);
                $('td:eq(0)', nRow).html("<img src='" + aData.img_produto +
                    "' width='50px' height='10px' class='img-fluid' /> ");
                return nRow;
            },
            "fnInitComplete": function(e) {
                $btn_voltar = $('.header_produtos').clone();
                $btn_voltar.removeAttr('hidden');
                $("#pnProdutos").find(".btn-voltar").html($btn_voltar.html());
                $($btn_voltar).bootstrapMaterialDesign();                                
            },
        }
        let merge = Object.assign(generico, produtos);

        return $("#tbProdutos").DataTable(merge);

    }



});
</script>