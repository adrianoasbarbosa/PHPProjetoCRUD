<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Equipe.php';
$eq = new Equipe();

$eq->setId($id);
$eq->crud(0);
?>

<meta http-equiv="refresh" content="0.1;URL=?p=equipe/listar">