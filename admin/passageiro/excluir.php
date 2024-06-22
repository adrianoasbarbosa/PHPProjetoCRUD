<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Passageiro.php';
$pa = new Passageiro();

$pa->setId($id);
$pa->crud(0);
?>

<meta http-equiv="refresh" content="0.1;URL=?p=passageiro/listar">