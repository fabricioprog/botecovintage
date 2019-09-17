<script src="http://192.168.0.2:3000/socket.io/socket.io.js"></script>

<style>
.my-card {
    margin-bottom: 20px;
    cursor: pointer;
}

.my-card-image {
    max-height: 100px;
}

.my-card-content {
    padding: 10px 10px 10px 0px;
}
</style>

<?php alert(); ?>


<audio id="audio">
    <source src="<?=base_url('assets/som/sms-alert-1-daniel_simon.mp3')?>" type="audio/mp3" />
</audio>
<div id="pedidos" class="row">
</div>


<div id="modelo_pedido">
    <div class='pedido col-md-6' style="display:none">
        <div class="card my-card">
            <div class="row">
                <div class='col-4 text-center align-self-center img_produto'>
                </div>
                <div class='col-8 my-card-content align-self-center '>
                    <strong>
                        <h3 class="nm_produto"> </h3>
                        <p class="nr_mesa"> </p>
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
audio = document.getElementById('audio');

function play() {
    audio.pause();
    audio.currentTime = 0;
    audio.play();
}


$(document).ready(function() {    
    var mod_pedido = $("#modelo_pedido").html();
    $("#modelo_pedido").remove();

    var pedido = 0;

    var socket = io('http://192.168.0.2:3000/');

    $('body').on('click', '.pedido', function() {
        let pedido = $(this);
        pedido.fadeOut(200, function() {
            pedido.remove();
        });
    });

    socket.on('add pedido', function(produto) {
        
        play();
        let novo_pedido = $(mod_pedido).clone();
        $(novo_pedido).find('.img_produto').html(produto.img);
        $(novo_pedido).find('.img_produto img').removeAttr("width");
        $(novo_pedido).find('.img_produto img').removeAttr("height");
        $(novo_pedido).find('.nr_mesa').html("MESA: " + produto.mesa);
        $(novo_pedido).find('.nm_produto').html(produto.nome);
        $("#pedidos").append(novo_pedido);
        $("#pedidos").find('div').fadeIn(200);
    });


    $('#btn-teste').click(function() {
        socket.emit('add pedido', 'teste');
    })

});
</script>