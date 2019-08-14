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
<?= $this->load->view('modal/add_categoria.php','',true); ?>
<script src="assets/js/piexif.js"></script>
<script>
$(document).ready(function() {
    var add_cat = $("form").html();
    var form2 = $("#teste").clone();

    
    $(document).on('click', '#btnAdd', function(e) {                                        
        abrir_modal("Adicionar Nova Categoria",add_cat);
        return false;
    });



});
</script>