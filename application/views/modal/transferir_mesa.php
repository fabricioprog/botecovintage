<div id="<?= $id ?>">
    <form name="<?= $id ?>" method="POST" hidden enctype="multipart/form-data">    
        <div class="row">
            <div class='col-12'>
                <div class="form-group">
                    <label for="mesa" class="bmd-label-floating">Mesa</label>
                    <input autocomplete="off" type="numeric" class="form-control" id="md-mesa" name="mesa">
                    <span class="bmd-help">informe a mesa que deseja transferir</span>
                </div>
            </div>
        </div>
    </form>
</div>
<script>


$(document).on('hidden.bs.modal', '#myModal', function(e) {
    $(document).off('click', '#btn_confirmar');
    $('#myModal').off('submit', 'form[name="<?= $id ?>"]');
    //modal_set_confirmar('Salvar');
});
</script>