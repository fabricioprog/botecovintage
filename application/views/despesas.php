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
                                <input require autocomplete="off" type="text" class="form-control" name="dt_inicio" value="<?= isset($inputs['dt_inicio']) ? $inputs['dt_inicio'] : "" ?>" required>
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
                                    <option value=''>Todas</option>
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
                    <table class='table'>
                        <thead>
                            <tr>
                                <th width="65%">Descrição</th>
                                <th width="15%">Categoria</th>
                                <th class="text-center" width="10%">Data</th>
                                <th class="text-right" width="5%">Valor </th>
                                <th width="5%">Remover </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($relatorio_detalhado as $despesa) { ?>
                                <tr>
                                    <td><?= $despesa->ds_despesa ?></td>
                                    <td><?= $despesa->nm_categoria ?></td>
                                    <td class="text-center"><?= $despesa->dt_despesa ?></td>
                                    <td class="text-right"><?= $despesa->valor_moeda ?></td>
                                    <td>
                                        <button data-id="<?= $despesa->ci_despesa ?>" type="button" class="btn btn-raised btn-danger pull-right btn-excluir">
                                            <i class="fa fa-trash fa-xs"></i>
                                        </button>
                                    </td>

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


        $(".btn-excluir").click(function() {
            let id = $(this).data('id');
            $btn = $(this);            
            $.get("<?=base_url('despesa')?>/remover_despesa/"+id, function(data) {
                $btn.parents('tr').find('td').fadeOut('slow', function() {
                    anima_confirma("#alert", 'success', 3000, 'Despesa Removida com sucesso');
                    $(this).remove();
                });
            });


        });


        if ($("input[name='dt_fim']").val() == "") {
            $("input[name='dt_fim']").val(data.toLocaleDateString() + " " + data.toLocaleTimeString())
        }

    });
</script>