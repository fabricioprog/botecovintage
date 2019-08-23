<style>
.pnForm {
    padding-top: 10px;
}

.btn-adjust {
    margin-top: 30px;
}

.cards {
    // display: none;
}

.livre {
    background-color: rgba(205, 254, 218, 1);
}

.ocupado {
    background-color: rgba(255, 250, 193, 1);
}

.reservado {
    background-color: rgba(205, 205, 254, 1);
}

.bloqueado {
    background-color: rgba(254, 205, 205, 1)
}

#btnAdd,
#btnVoltar {
    margin-left: 15px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
            <i class="fa fa-th-large"></i> Mesa <?= $mesa_id ?>
            <button id="btnAdd" type="button" class="btn btn-md btn-outline-success  btn-rounded pull-right">
                <i class="fa fa-plus" aria-hidden="true"></i>
                </span>
            </button>
            <a href="<?= base_url('mesas') ?>" id="btnVoltar"><span class="pull-right">
                    <button type="button" class="btn btn-md btn-outline-success pull-right">
                        <i class="fa fa-share fa-flip-horizontal" aria-hidden="true"></i></span>
                </button>
            </a>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="<?=base_url('conta/add_conta/').$mesa_id ?>">
                            <button type="button" id="btn-ocupar" class="btn btn-md btn-block ocupado">
                                <i class="fa fa-sign-in fa-lg"></i> Abrir
                            </button>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <button type="button" id="btn-reservar" class="btn btn-md btn-block reservado">
                            <i class="fa fa-clock-o fa-lg"></i> Reservar
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" id="btn-bloquear" class="btn btn-md btn-block bloqueado">
                            <i class="fa fa-times-circle-o fa-lg"></i> Bloquear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row pnForm">
    <div class="col-md-12">
        <div class="card cards" id="card-reservar">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <p class="g4 h4 text-primary">
                            <i class="fa fa-clock-o fa-lg"></i> Reservar Mesa
                        </p>
                    </div>
                    <div class='col-md-9'>
                        <div class="form-group">
                            <label for="cliente" class="bmd-label-floating">Nome do Cliente</label>
                            <input type="text" class="form-control" name="nm_cliente">
                            <span class="bmd-help">Digite o nome do Cliente</span>
                        </div>
                    </div>
                    <div class='col-md-3'>
                        <div class="form-group">
                            <label for="cliente" class="bmd-label-floating">Mesas</label>
                            <input type="text" class="form-control" name="qtd_mesas">
                            <span class="bmd-help">Quantidade de mesas reservadas</span>
                        </div>
                    </div>
                    <div class='col-md-4'>
                        <div class="form-group">
                            <label for="cliente" class="bmd-label-floating">Contato 1</label>
                            <input type="text" class="form-control" name="nm_cliente">
                            <span class="bmd-help">DIgite aqui um telefone pra contato</span>
                        </div>
                    </div>
                    <div class='col-4'>
                        <div class="form-group">
                            <label for="cliente" class="bmd-label-floating">Contato 2</label>
                            <input type="text" class="form-control" name="nm_cliente">
                            <span class="bmd-help">DIgite aqui um telefone pra contato</span>
                        </div>
                    </div>
                    <div class='col-4'>
                        <div class="form-group align-bottom">
                            <button type="button" id="btn-bloquear" class="btn  btn-block btn-adjust livre">
                                Reservar Agora </span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
<script>
$(document).ready(function() {
    $("#btn-reservar").click(function() {
        $('.cards').fadeOut('200', function() {
            $("#card-reservar").fadeIn();
        });
    });

});
</script>