<div class="row">
    <div class="col-md-12">
        <p class="h4 text-primary">
            <i class="fa fa-file-o"></i> Relatório de Contas Encerredas
        </p>
        <div class="card">
            <div class="card-body" style="padding: 0px 10px 0px 10px">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="categoria" class="bmd-label-floating">Data/Hora Início</label>
                                <input require autocomplete="off" type="text" class="form-control" name="dt_inicio">
                                <span class="bmd-help">Informa a data inicio encerramento de contas</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="categoria" class="bmd-label-floating">Data/Hora Fim</label>
                                <input require autocomplete="off" type="text" class="form-control" name="dt_fim">
                                <span class="bmd-help">Informa a data fim encerramento de contas</span>
                            </div>
                        </div>
                        <div class="col-md-2 align-self-center">
                            <button type="button" class="btn btn-raised btn-block btn-info">Até agora</button>
                        </div>
                        <div class="col-md-2 align-self-center">
                            <button type="button" class="btn btn-raised btn-block btn-success">GErar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $.datetimepicker.setLocale('pt-BR');
    $("input[name='dt_inicio']").datetimepicker({
        format: 'd/m/Y H:i'
    });

    $("input[name='dt_fim']").datetimepicker({
        format: 'd/m/Y H:i'
    });
});
</script>