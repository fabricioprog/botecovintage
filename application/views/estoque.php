<style>
.alerta-urgente {
    background-color: rgba(255, 0, 0, 0.2);
}

.alerta-aviso {
    background-color: rgba(255, 255, 0, 0.2);
}
</style>
<?php alert(); ?>
<div class="card">
    <div class="card-body">
        <form method="GET">
            <div class="row">
                <div class="col-5">
                    <div class="form-group">
                        <label for="cd_categoria" class="bmd-label-floating">Categoria</label>
                        <select class="form-control" name="cd_categoria">
                            <option value=''>Todas</option>
                            <?php foreach($categorias as $cat){ 
                                $selected = "";
                                if($cat->ci_categoria == $inputs['cd_categoria']){
                                    $selected = "selected";
                                }
                                ?>
                            <option value='<?= $cat->ci_categoria ?>' <?= $selected ?>><?= $cat->nm_categoria ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                        <label for="urgencia" class="bmd-label-floating">Grau de Urgência</label>
                        <select class="form-control" name="urgencia" id="tp_pagamento">
                            <?php foreach($grau_urgencia as $index=>$grau){ 
                                $selected = "";
                                if($index == $inputs['urgencia']){
                                    $selected = "selected";
                                }
                                ?>
                            <option value='<?= $index ?>' <?= $selected ?>><?= $grau ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-2 align-self-center">
                    <button type="submit" class="btn btn-raised btn-success">
                        Buscar
                    </button>
                </div>
            </div>
        </form>
        <table id="tbEstoque" class='table'>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Estoque</th>
                    <th>Limite</th>
                    <th>Atualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produtos as $p){ 
                    $class_linha = "";
                    if($p->nr_estoque< $p->nr_limite){
                        $class_linha= 'alerta-aviso';
                    }
                    if(!empty($p->nr_limite) && (empty($p->nr_estoque) || $p->nr_estoque == 0  )){
                        $class_linha= 'alerta-urgente';
                    }
                    ?>
                <tr class="<?= $class_linha ?>">
                    <td width="40%"> <?= $p->nm_produto ?> </td>
                    <td width="5%">
                        <input style='padding:5px' size="3" maxlength="3" type="numeric"
                            value="<?= $p->nr_estoque ?>" />
                    </td>
                    <td width="5%">
                        <input style='padding:5px' size="3" maxlength="3" type="numeric" value="<?= $p->nr_limite ?>" />
                    </td>
                    <td width="5%">
                        <button data-id="<?= $p->ci_produto ?>" class="btn btn-success active btn-att" role="button"
                            aria-pressed="true"><i class="fa fa-check fa-sm" aria-hidden="true"></i></button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() {
    $(".btn-att").click(function() {
        let id = $(this).data('id');
        let estoque = $($(this).parents('tr').find('input')[0]).val();
        let limite = $($(this).parents('tr').find('input')[1]).val();
        $.ajax({
            type: "POST",
            url: "Estoque/update_estoque/" + id + "/" + estoque + "/" + limite,
            dataType: "json",
            error: function(res) {
                //TODO : apresentar mensagem de erro
                console.log("erro");
                console.log(res);
            },
            success: function(data) {
                location.reload();
            },
        });
    });

});
</script>