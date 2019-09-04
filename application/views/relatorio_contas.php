<style>
.pn-relatorio {
    margin-top: 10px;
}

.pn-rel-total {
    min-height: 188px;
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
                                <label for="dt_fim" class="bmd-label-floating">Data/Hora Início</label>
                                <input require autocomplete="off" type="text" class="form-control" name="dt_inicio"
                                    value="<?= isset($input_dt_inicio)?$input_dt_inicio:"" ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group is-focused">
                                <label for="dt_fim" class="bmd-label-floating">Data/Hora Fim</label>
                                <input require autocomplete="off" type="text" class="form-control" name="dt_fim"
                                    value="<?= isset($input_dt_fim)?$input_dt_fim:"" ?>" required>

                            </div>
                        </div>
                        <div class="col-md-5 offset-md-7">
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
                    <?php if(isset($relatorio_geral)) {  ?>
                    <div class="col-md-6">
                        <p> Faturamento: <strong><?= $relatorio_geral->total ?> </strong> </p>
                        <p> Débito: <strong><?= $relatorio_geral->debito ?> </strong> </p>
                        <p> Crédito: <strong><?= $relatorio_geral->credito ?> </strong> </p>
                        <p> Dinheiro: <strong><?= $relatorio_geral->dinheiro ?> </strong> </p>
                        <p> Cover: <strong> <?= $cover ?> </strong> </p>
                    </div>
                    <div class="col-md-6">
                        <p> Contas Encerradas: <strong><?= $relatorio_geral->contas_encerradas ?> </strong> </p>
                        <p> Permanencia Média : <strong><?= $relatorio_geral->permanencia_media ?> </strong> </p>
                        <p> Consumo Médio : <strong><?= $relatorio_geral->consumo_medio ?> </strong> </p>
                        <p> 10% : <strong><?= $relatorio_geral->dez_porcento ?> </strong> </p>
                    </div>
                    <?php }else{ ?>
                    <div class="alert alert-info" role="alert">
                        Escolha o Intervalo de tempo que deseja analisar as mesas, serão analisado apenas mesas <strong>
                            encerradas </strong>.
                    </div>
                    <?php } ?>
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
    var data = new Date();
    $("input[name='dt_inicio']").datetimepicker({
        format: 'd/m/Y H:i',
        maxDate:data.toLocaleDateString() + " " + data.toLocaleTimeString(),
    });

    $("input[name='dt_fim']").datetimepicker({
        format: 'd/m/Y H:i',
        maxDate:data.toLocaleDateString() + " " + data.toLocaleTimeString(),
    });

    
    if ($("input[name='dt_fim']").val() == "") {
        $("input[name='dt_fim']").val(data.toLocaleDateString() + " " + data.toLocaleTimeString())
    }

});
</script>