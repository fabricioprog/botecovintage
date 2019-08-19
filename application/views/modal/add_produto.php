<div id="<?= $id ?>">
    <form name="<?= $id ?>" method="POST" hidden enctype="multipart/form-data">
        <div class="row">
            <div class='col-12'>
                <div class="form-group">
                    <label for="produto" class="bmd-label-floating">Nome do Produto</label>
                    <input type="text" class="form-control" name="produto">
                    <span class="bmd-help">Digite aqui o Nome da Produto</span>
                </div>
            </div>
            <div class='col-12'>
                <div class="form-group">
                    <label for="descricao" class="bmd-label-floating">Descrição</label>
                    <textarea class="form-control" name="descricao" rows="3"></textarea>
                    <span class="bmd-help">Digite aqui A descrição do Produto</span>
                </div>
            </div>
            <div class='col-5'>
                <div class="form-group">
                    <label for="valor_venda" class="bmd-label-floating">Venda R$</label>
                    <input type="text" class="form-control" name="valor_venda" id="valor_venda">
                    <span class="bmd-help">Digite aqui o valor da venda</span>
                </div>
            </div>
            <div class='col-7 align-self-center'>
                <button id="btn-excluir" type="button" class="btn btn-raised btn-danger pull-right "
                    style='padding-top:10px'><i class="fa fa-trash fa-2x"></i></button>
            </div>
            <div class='col-12'>
                <div class="form-group">
                    <label class="btn btn-outline-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i> Imagem
                        <input type="file" class="form-control-file" name="imagem" id="upload_imagem" hidden>
                    </label>
                </div>
            </div>
            <input type='hidden' name="categoria" value="<?= $cd_categoria ?>" />
            <input type='hidden' name="id" value="" />
            <div id='preview_img' class="col-12 text-center">
                <img src="" class="img-fluid rounded centered" id="img" height="150">
            </div>
        </div>
    </form>
</div>


<script>
$md_form = $('form[name="<?= $id ?>"]');

function aplicar_js() {
    $("#modalCorpo").find('#valor_venda').mask('000.000,00', {
        reverse: true
    });
}

function limpar_campos() {
    $("#MyModal").find("#modalCorpo").html("");
}

function preencher_campos(id, nome, descricao, valor, imagem) {
    $form = $('#modalCorpo').find('form[name="<?= $id ?>"]');
    $form.find('input[name="id"]').val(id).trigger("change");
    $form.find('input[name="produto"]').val(nome).trigger("change");
    $form.find('textarea[name="descricao"]').html(descricao).trigger("change");
    $form.find('input[name="valor_venda"]').val(valor).trigger("change");
    $form.find("#img").attr("src", imagem);
    $form.find("#preview_img").removeAttr('hidden');
    aplicar_js();
}

$(document).on('click','#btn-excluir',function() {    
    console.log("excluir");
});

$md_form.find('input[name="id"]').change(function() {
    let id = $(this).val();
    if (id) {
        $.ajax({
            type: "POST",
            url: "produtos/get_produto/" + id,
            dataType: "json",
            error: function(res) {
                console.log("erro");
                console.log(res);
            },
            success: function(data) {
                preencher_campos(id, data.nm_produto, data.ds_produto, data.valor_venda, data
                    .img_produto);

            },
        });
    } else {
        limpar_campos();
    }


});
</script>