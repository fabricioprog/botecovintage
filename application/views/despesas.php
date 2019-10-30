<style>
    .pn-relatorio {
        margin-top: 10px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card pn-rel-total">
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dt_inicio" class="bmd-label-floating">Data/Hora Início</label>
                                <input require autocomplete="off" type="text" class="form-control" name="dt_inicio" value="<?= isset($input_dt_inicio) ? $input_dt_inicio : "" ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group is-focused">
                                <label for="dt_fim" class="bmd-label-floating">Data/Hora Fim</label>
                                <input require autocomplete="off" type="text" class="form-control" name="dt_fim" value="<?= isset($input_dt_fim) ? $input_dt_fim : "" ?>" required>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="cd_categoria" class="bmd-label-floating">Categoria</label>
                                <select class="form-control" name="cd_categoria">
                                    <option value=''>Selecione</option>
                                    <?php foreach ($categorias as $cat) {
                                        $selected = "";
                                        if ($cat->ci_categoria == $inputs['cd_categoria']) {
                                            $selected = "selected";
                                        }
                                        ?>
                                        <option value='<?= $cat->ci_categoria ?>' <?= $selected ?>><?= $cat->nm_categoria ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label> </label>
                            <button type="submit" class="btn  btn-raised btn-block btn-success">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php if (isset($relatorio_detalhado)) { ?>
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
                            <?php foreach ($relatorio_detalhado as $prod) { ?>
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

<?= $this->load->view('modal/add_despesa.php', array("id" => 'md_add_despesa'), true); ?>

<script>
    $(document).ready(function() {
        $.datetimepicker.setLocale('pt-BR');

        var md_add_despesa = $("#md_add_despesa").html();
        $("#md_add_despesa").remove();

        

        var data = new Date();
        $("input[name='dt_inicio']").datetimepicker({
            format: 'd/m/Y H:i',
            maxDate: data.toLocaleDateString() + " " + data.toLocaleTimeString(),
        });

        $("input[name='dt_fim']").datetimepicker({
            format: 'd/m/Y H:i',
            maxDate: data.toLocaleDateString() + " " + data.toLocaleTimeString(),
        });

        $("#btn_add").click(function() {
            let data = new Date();
            abrir_modal('Adicionar Despesa', md_add_despesa, true);
            $("input[name='dt_despesa']").datetimepicker({
                format: 'd/m/Y H:i',
                maxDate: data.toLocaleDateString() + " " + data.toLocaleTimeString(),
            });            
            $("#myModal").find('input[name="valor"]').mask('000.000,00', {
                reverse: true
            });

            $("input[name='dt_despesa']").val(data.toLocaleDateString() + " " + data.toLocaleTimeString());                
            
        });

        $("#btn_add").click();

        if ($("input[name='dt_fim']").val() == "") {
            $("input[name='dt_fim']").val(data.toLocaleDateString() + " " + data.toLocaleTimeString())
        }

    });
</script>