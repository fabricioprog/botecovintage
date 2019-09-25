<script src="http://192.168.0.2:3000/socket.io/socket.io.js"></script>

<style>
.my-card {
    margin-bottom: 20px;
    cursor: pointer;
}

.my-card-body {
    padding-right: 14px;
}

.my-card-image {
    max-height: 100px;
}

.my-card-content {
    padding: 10px 10px 10px 0px;
}

.alerta-sucesso {
    background-color: rgba(0, 255, 0, 0.7) !important;
}

.div-mesa {
    background-color: rgba(200, 200, 200, 1);
}

.nr_mesa {
    font-size: 50px;
    font-weight: bold;    
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
                <div class='col-6 align-self-center '>
                    <strong>
                        <h3 class="nm_produto"> </h3>
                        <p class="obs"> </p>
                    </strong>
                </div>
                <div class='col-2 div-mesa rounded-right row'>
                    
                        <label class='nr_mesa align-self-center '> </label>
                    
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

function add_pedido_cozinha(pedido, mod_pedido, som) {
    if (som) {
        play();
    }
    let novo_pedido = $(mod_pedido).clone();
    $(novo_pedido).attr("data-id", pedido.ci_pedido_cozinha);
    let img_pedido = "<img src='" + pedido.img_produto + "' class='img-fluid' />";
    $(novo_pedido).find('.img_produto').html(img_pedido);
    $(novo_pedido).find('.img_produto img').removeAttr("width");
    $(novo_pedido).find('.img_produto img').removeAttr("height");
    $(novo_pedido).find('.nr_mesa').html(pedido.cd_mesa);
    $(novo_pedido).find('.nm_produto').html(pedido.nm_produto);
    if (pedido.ds_observacao != undefined && pedido.ds_observacao.trim() != '') {
        $(novo_pedido).find('.obs').html(pedido.ds_observacao);
    }
    $("#pedidos").append(novo_pedido);
    $("#pedidos").find('div').fadeIn(200);
}

function add_pedidos_init(pedidos, modelo_pedido) {
    if (pedidos.length > 0 && pedidos != null) {
        pedidos.forEach(function(pedido) {
            add_pedido_cozinha(pedido, modelo_pedido, false);
        });
    }
}


$(document).ready(function() {

    var mod_pedido = $("#modelo_pedido").html();
    add_pedidos_init( <?= $pedidos ?> , mod_pedido);

    $("#modelo_pedido").remove();

    var socket = io('http://192.168.0.2:3000/');

    $('body').on('click', '.pedido', function() {
        var pedido = $(this);
        if (pedido.find('.card').hasClass('alerta-sucesso')) {
            let ci_pedido_cozinha = pedido.data('id');
            socket.emit('pedido feito', ci_pedido_cozinha);
        } else {
            pedido.find('.card').addClass('alerta-sucesso');
        }

    });

    socket.on('add pedido', function(pedido) {
        add_pedido_cozinha(pedido, mod_pedido, true);
    });


    socket.on('pedido feito', function(ci_pedido_cozinha) {
        let pedido = $(document).find('.pedido[data-id="' + ci_pedido_cozinha + '"]');
        pedido.fadeOut(200, function() {
            pedido.remove();
        });
    });


    $('#btn-teste').click(function() {
        socket.emit('add pedido', 'teste');
    })

});
</script>