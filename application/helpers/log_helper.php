<?php 
function trace($txt){
    echo "<pre> ".var_dump($txt)." </pre>";
}

function get_dinheiro($num,$rs=false){    
    $valor =  number_format($num, 2, ',', '.');
    $valor = $rs? 'R$ '.$valor:$valor;
    echo $valor;
}