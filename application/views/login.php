<?php $this->load->view('template/imports_head') ?>

<style>
#logo {
    height: 100px;
}
</style>
<div class="container main-content">
    <?php alert(); ?>
    <div class="row">
        <div class='mx-auto col-md-6 col-xs-12'>
            <div class='card'>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="text-primary"> Boteco Vintage </h2>
                            </div>
                            <div class="col-sm-4 col-xs-12 text-center align-self-center">
                                <img src="<?=base_url('assets/img/logo.png')?>" class="img-fluid" id="logo" />
                            </div>
                            <div class="col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <label for="usuario" class="bmd-label-floating">Usuário</label>
                                    <input type="text" class="form-control" name="usuario">
                                </div>
                                <div class="form-group">
                                    <label for="senha" class="bmd-label-floating">Senha</label>
                                    <input type="password" class="form-control" name="senha">
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="reset" class="btn btn-info btn-md rounded active"
                                    role="button">Limpar</button>
                                <button type="submit" class="btn btn-primary btn-md rounded active" role="button">
                                    <i class="fa fa-sign-in" aria-hidden="true"></i> Acessar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {});
</script>