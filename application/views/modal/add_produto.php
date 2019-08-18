<div id="<?= $id ?>">
    <form method="POST" hidden enctype="multipart/form-data">
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
            <div class='col-12'>
                <div class="form-group">
                    <label class="btn btn-outline-primary">
                        <i class="fa fa-plus" aria-hidden="true"></i> Imagem
                        <input type="file" class="form-control-file" name="imagem" id="upload_imagem" hidden>
                    </label>
                </div>
            </div>
            <input type='hidden' name="categoria" value="<?= $cd_categoria ?>" />
            <div id='preview_img' hidden>
                <img src="" class="img-fluid rounded" id="img" height="150">
            </div>
        </div>
    </form>
    </div>


    <script>
    $(document).ready(function() {
        $('#valor_venda').mask('000.000.000.000.000,00', {
            reverse: true
        });
    });
    </script>