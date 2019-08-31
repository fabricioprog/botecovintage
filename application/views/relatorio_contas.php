<style>
.pn-relatorio {
    margin-top: 10px;
}

.pn-rel-total {
    min-height: 230px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
            <i class="fa fa-file-o"></i> Relatório de Contas Encerredas
            <span class="pull-right">
                <a href="<?= base_url('mesas') ?>" id="btnVoltar">
                    <button type="button" class="btn btn-md btn-outline-success ">
                        <i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i>
                    </button>
                </a>
            </span>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card pn-rel-total">
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria" class="bmd-label-floating">Data/Hora Início</label>
                                <input require autocomplete="off" type="text" class="form-control" name="dt_inicio">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group is-focused">
                                <label for="categoria" class="bmd-label-floating">Data/Hora Fim</label>
                                <input require autocomplete="off" type="text" class="form-control" name="dt_fim">

                            </div>
                        </div>
                        <div class="col-md-12 align-self-center">
                            <button type="submit" class="btn btn-raised btn-block  btn-success">GErar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p> <strong> Faturamento Total </strong> R$ 00,00 </p>
                        <p> <strong> Em Débito </strong> R$ 00,00 </p>
                        <p> <strong> Em Dinheiro </strong> R$ 00,00 </p>
                        <p> <strong> Contas Encerradas: </strong> 123123 </p>
                        <p class='text-success'> <strong> Contas Abertas: </strong> 0 </p>
                    </div>
                    <div class="col-md-6">
                        <p> <strong> Cover: </strong> R$ 00,00 </p>
                        <p> <strong> Permanencia Média : </strong> 00:00 </p>
                        <p> <strong> Mais Vendido : <br> </strong> Produto X </p>
                        <p> <strong> Menos Vendido : <br> </strong> Produto Y</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(isset($relatorio_detalhado)){ ?>
<div class="row pn-relatorio">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th width="50%">Produto</th>
                            <th width="10%">Qtd</th>                            
                            <th width="15%">Unidade</th>                            
                            <th width="15%">Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($relatorio_detalhado as $prod){ ?>
                        <tr>
                            <td><?= $prod->nm_produto ?></td>
                            <td><?= $prod->quantidade ?></td>
                            <td><?= $prod->lbl_valor_venda ?></td>                            
                            <td><?= $prod->lbl_total ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } ?>



<script>
$(document).ready(function() {
    $.datetimepicker.setLocale('pt-BR');
    $("input[name='dt_inicio']").datetimepicker({
        format: 'd/m/Y H:i'
    });

    $("input[name='dt_fim']").datetimepicker({
        format: 'd/m/Y H:i'
    });

    var data = new Date();
    $("input[name='dt_fim']").val(data.toLocaleDateString() + " " + data.toLocaleTimeString())
});
</script>