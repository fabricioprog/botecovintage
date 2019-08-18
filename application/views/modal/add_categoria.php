<div id="<?= $id ?>">
    <form method="POST" hidden enctype="multipart/form-data" >
        <div class="form-group">
            <label for="categoria" class="bmd-label-floating">Categoria</label>
            <input type="text" class="form-control" name="categoria">
            <span class="bmd-help">Digite aqui o Nome da Categoria</span>
        </div>
        <div class="form-group">
            <label for="descricao" class="bmd-label-floating">Descrição</label>
            <textarea class="form-control" name="descricao" rows="3"></textarea>
        </div>
        <div class="form-group">            
            <label class="btn btn-outline-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Imagem              
            <input type="file" class="form-control-file" name="imagem" id="upload_imagem" hidden>
            
            </label>            
        </div>
        <div id='preview_img' hidden>
            <img src="" class="img-fluid rounded" id="img" height="150">
        </div>
    </form>
</div>