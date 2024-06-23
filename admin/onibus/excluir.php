<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Onibus.php';
$onibus = new Onibus();

$onibus->setId($id);
$onibus->crud(0);
?>

<meta http-equiv="refresh" content="0.1;URL=?p=onibus/listar">