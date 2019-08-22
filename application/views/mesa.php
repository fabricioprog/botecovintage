<style>
.pnForm {
    padding-top: 10px;
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
            <i class="fa fa-th-large"></i> teste <?= $mesa_id ?>
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
                        <button type="button" class="btn btn-md btn-block ocupado">
                            <i class="fa fa-sign-in fa-lg"></i> 1 </span>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-md btn-block reservado">
                            <i class="fa fa-clock-o fa-lg"></i> 2 </span>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-md btn-block bloqueado">
                            <i class="fa fa-times-circle-o fa-lg"></i> 3 </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row pnForm">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p class="g4 h4 text-primary">
                            <i class="fa fa-clock-o fa-lg"></i>                            
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {


});
</script>