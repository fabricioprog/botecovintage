<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
            <i class="fa fa-archive"></i> Gerenciar Produtos
            <button id="btnAdd"  style="margin-left: 30px; type="button" class="btn btn-md btn-outline-success pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            <a href="<?= base_url('mesas') ?>"  id="btnVoltar"><span class="pull-right">
                    <button type="button" class="btn btn-md btn-outline-success pull-right">
                        <i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i></span>
                </button>
            </a> 
        </p>
    </div>
</div>
<div class="card">
    <div class="card-body" id="imgs">
        <div class="row">
            <?php foreach($categorias as $cat){  ?>
            <div class="col-md-4">
                <a href="<?= base_url("produtos?categoria=".$cat->ci_categoria) ?>">
                    <div class="card btn btn-primary text-left">
                        <img class="card-img-top img-fluid rounded mx-auto d-block" src="<?= $cat->imagem ?>"
                            alt="Card image cap" style="padding:10px 10px 0px 10px">
                        <div class="card-body">
                            <h5 class="card-title"><?= $cat->nm_categoria ?></h5>
                            <p class="card-text"><?= $cat->ds_categoria ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?= $this->load->view('modal/add_categoria.php',array("id"=>'md_categoria'),true); ?>
<script>
$(document).ready(function() {
    var add_cat = $('#md_categoria').html();
    $(document).on('click', '#btnAdd', function(e) {
        abrir_modal("Adicionar Nova Categoria", add_cat, true);
        return false;
    });


    var imagens = $('#imgs').find('img').toArray();

    /*imagens.forEach(function(img){
        $(img).attr('src' , resizeImage($(img).attr('src'))) 
        
    });*/


    $("#myModal").on('change', 'input[type="file"]', function(e) {
        $form = $("#myModal").find('form')[0];
        var data = new FormData($form);
        $.ajax({
            type: "POST",
            url: "produtos/get_imagem_convertida",
            data: data,
            dataType: "text",
            processData: false,
            contentType: false,
            error: function(res) {
                console.log("erro");
                console.log(res);
            },
            success: function(data) {
                $("#img").attr("src", data);
                $("#myModal").find("#preview_img").removeAttr('hidden');
            },
        });

    })


    $("#myModal").on('click', '#btn_confirmar', function() {
        $form = $("#myModal").find('form')[0];
        var data = new FormData($form);
        $.ajax({
            type: "POST",
            url: "produtos/add_categoria",
            data: data,
            dataType: "html",
            processData: false,
            contentType: false,
            error: function(res) {
                console.log("erro");
                console.log(res);
            },
            success: function(data) {
                location.reload()
            },
        });
    });
});
</script>