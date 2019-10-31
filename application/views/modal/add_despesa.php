<div id="<?= $id ?>">
    <form name="<?= $id ?>" method="POST" hidden>
        <div class="row">
            <div class="col-md-12">
                <div id="md-alert" style="display:none">
                    <div class="" role="alert">
                        <strong id="alert-msg"></strong>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
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
        <button id="btn-confirmar-pagamento" type='submit' hidden>
    </form>
</div>
<script>
    $(document).on('click', '#myModal #btn_confirmar', function() {
        $("#btn-confirmar-pagamento").trigger('click');
        return false;
    });

    $(document).on('hidden.bs.modal', '#myModal', function(e) {
        $(document).off('click', '#btn_confirmar');
        $('#myModal').off('submit', 'form[name="<?= $id ?>"]');
        modal_set_confirmar('Salvar');
    });

    $(document).on("submit",'form[name="<?= $id ?>"]', function(e) {
        e.preventDefault();
        add_despesa();
        return false;
    });


    function add_despesa() {
        $form = $("#myModal").find('form')[0];
        var data = new FormData($form);        
        $.ajax({
            type: "POST",
            url: "despesa/add_despesa",
            data: data,
            dataType: "text",
            processData: false,
            contentType: false,
            error: function(res) {
                mostrar_confirmacao('danger', "Erro");
            },
            success: function(data) {
                mostrar_confirmacao('success', "Despesa adicionada com Sucesso!!");
            },
        });
        return false;
    }

    function mostrar_confirmacao(tipo, mensagem) {
        $alert = $(document).find('#myModal #md-alert');

        $alert.removeClass();
        $alert.addClass("alert alert-" + tipo);
        $alert.find("#alert-msg").text(mensagem);
        $(document).find('#myModal #md-alert').slideDown("fast").delay(2000).slideUp('fast');
        let data = $("input[name='dt_despesa']").val();
        $('form[name="<?= $id ?>"]').trigger("reset");
        $("input[name='dt_despesa']").val(data);

    }
</script>