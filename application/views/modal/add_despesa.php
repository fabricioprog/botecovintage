<div id="<?= $id ?>">
    <form name="<?= $id ?>" method="POST" hidden enctype="multipart/form-data">
        <div class="row">
            <div id="md-alert">
                <div class="alert alert-success" role="alert">
                    <strong id="alert-msg"></strong>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <label for="cd_categoria" class="bmd-label-floating">Categoria</label>
                    <select class="form-control" name="cd_categoria" required>
                        <option value=''>Selecione</option>
                        <?php foreach ($categorias as $cat) {
                            $selected = "";
                            if (!empty($inputs['cd_categoria']) && $cat->ci_categoria == $inputs['cd_categoria']) {
                                $selected = "selected";
                            }
                            ?>
                            <?php $bold = $cat->fl_apenas_despesa == 't' ?  'style="font-weight: bold"' : '' ?>
                            <option <?= $bold ?> value='<?= $cat->ci_categoria ?>' <?= $selected ?>> <?= $cat->nm_categoria  ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group is-focused">
                    <label for="dt_despesa" class="bmd-label-floating">Data</label>
                    <input require autocomplete="off" type="text" class="form-control" name="dt_despesa" value="<?= isset($input_dt_fim) ? $input_dt_fim : "" ?>" required>
                </div>
            </div>
            <div class="col-md-7">
                <label for="ds_despesa" class="bmd-label-floating">Descrição</label>
                <textarea require autocomplete="off" type="text" class="form-control" name="ds_despesa" required></textarea>
            </div>
            <div class="col-md-4">
                <label for="valor" class="bmd-label-floating">Valor</label>
                <input require autocomplete="off" type="text" class="form-control" name="valor" value="" required>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).on('click', '#myModal #btn_confirmar', function() {
        $form = $("#myModal").find('form')[0];
        var data = new FormData($form);
        add_despesa(data);
        return false;
    });

    $(document).on('hidden.bs.modal', '#myModal', function(e) {
        $(document).off('click', '#btn_confirmar');
        modal_set_confirmar('Salvar');
    });


    function add_despesa(despesa) {

        $.ajax({
            type: "POST",
            url: "despesa/add_despesa",
            data: despesa,
            dataType: "text",
            processData: false,
            contentType: false,
            error: function(res) {
                anima_confirma("#md-alert", 'danger', 1000, "Erro ao adicionar despesa");
            },
            success: function(data) {
                anima_confirma("#md-alert", 'success', 1000, "Despesa adicionada com Sucesso!!");
            },
        });
    }
</script>