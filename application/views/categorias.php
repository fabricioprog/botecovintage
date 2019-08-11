<p class="h4 text-primary">
    <i class="fa fa-archive"></i> Gerenciar Produtos
    <a href="" id="btnAdd"><span class="pull-right"> <i class="fa fa-plus" aria-hidden="true"></i> Nova
            Categoria</span></a>
</p>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <a href="<?= base_url("produtos?categoria=1") ?>" >
                    <div class="card btn btn-primary text-left">
                        <img class="card-img-top img-fluid rounded mx-auto d-block" src="assets/img/bebidas.png"
                            alt="Card image cap" style="padding:10px 10px 0px 10px;width:300px">
                        <div class="card-body">
                            <h5 class="card-title">Bebidas</h5>
                            <p class="card-text">Categoria para bebidas alcolicas</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="">
                    <div class="card btn btn-primary text-left">
                        <img class="card-img-top img-fluid rounded mx-auto d-block" src="assets/img/refrigerentes.jpg"
                            alt="Card image cap" style="padding:10px 10px 0px 10px;width:300px">
                        <div class="card-body">
                            <h5 class="card-title">Refrrigerantes</h5>
                            <p class="card-text">Categoria para bebidas alcolicas</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<form hidden>
    <div class="form-group">
        <label  for="categoria" class="bmd-label-floating">Categoria</label>
        <input type="text" class="form-control" id="categoria">
        <span class="bmd-help">Digite aqui o Nome da Categoria</span>
    </div>
    <div class="form-group">
        <label for="descricao" class="bmd-label-floating">Descrição</label>
        <textarea class="form-control" id="descricao" rows="3"></textarea>
    </div>
</form>


<script src="assets/js/piexif.js"></script>
<script>
$(document).ready(function() {
    $("#myModal").find("#modalTitulo").text("Adicionar Nova Categoria");
    $form = $("form").clone();

    $("*").on('click', '#btnAdd', function(e) {        
        $("#myModal").find("#modalCorpo").html($form);        
        $("#myModal").modal();
        return false;
    });
    

});
</script>