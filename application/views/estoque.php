<?php alert(); ?>
<div class="card">
    <div class="card-body">
        <table class='table'>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Estoque</th>
                    <th>Limite</th>
                    <th>Atualizar</th>

                </tr>
            </thead>
            <tbody>
                <?php for($i=0;$i<10;$i++){ ?>
                <tr>
                    <td width="40%"> Nome do Produto </td>
                    <td width="5%">
                        <input style='padding:5px'  size="3" maxlength="3" type="numeric" />

                    </td>
                    <td width="5%">
                        <input style='padding:5px' size="3" maxlength="3" type="numeric" /> </td>
                    <td width="5%">
                        <button class="btn btn-success active" role="button" aria-pressed="true"><i
                                class="fa fa-check fa-sm" aria-hidden="true"></i></button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function() {


});
</script>