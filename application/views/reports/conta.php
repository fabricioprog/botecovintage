<style>
@page {
    margin: 0px 0px 0px 5px !important;
    padding: 0px 0px 0px 5px !important;
    flex-wrap: wrap;
}

@font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: normal;
}

#content,
table {
    width: 96%;
}

.info_dinheiro{
    text-align:right;
}
</style>
<div id='content'>
    ----------------<strong>BOTECO VINTAGE</strong>------------<br>
    Endereço: Rua Padre Minguelino, 1159 - Fátima, Fortaleza - CE, CEP: 60040-300 <br>
    Telefone: (85) 996123082 (Rosal) <br>
    Início : <?= $conta->dia_semana . ' '. $conta->dt_inicio ?> <br>
    -------------------------------------------------------
    <table>
        <thead>
            <tr>
                <td width="10%">Qtd.</td>
                <td width="50%">Descrição</td>
                <td class="info_dinheiro"  width="20%">Unitário</td>
                <td class="info_dinheiro" width="20%">Total</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pedidos as $pedido){ ?>
            <tr>
                <td><?= $pedido->quantidade ?> </td>
                <td><?= substr($pedido->nm_produto,0,20); ?> </td>
                <td class="info_dinheiro" ><?= str_replace('R$','', $pedido->lbl_valor_venda);  ?> </td>
                <td class="info_dinheiro"><?= str_replace('R$','', $pedido->lbl_total); ?> </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    -------------------------------------------------------
    <table style="padding-bottom:20px;">
        <tbody>
            <tr>
                <td width="70%"> Conta </td>
                <td class="info_dinheiro" width="30%"><?= $total->lbl_soma ?></td>
            </tr>
            <tr>
                <td width="70%"> 10% </td>
                <td class="info_dinheiro" width="30%"> <?= $conta->fl_dez_porcento=='t'? $total->lbl_dez_porcento : 'R$ 00,00'; ?> </td>
            </tr>
            <tr>
                <td width="70%"> <strong> Total </strong> </td>
                <td class="info_dinheiro" width="30%"> <strong> <?= $conta->fl_dez_porcento=='t'? $total->total: $total->lbl_soma;  ?>  </strong> </td>
            </tr>
        </tbody>
    </table>
</div>