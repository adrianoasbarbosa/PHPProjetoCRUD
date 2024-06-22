<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Produto.php';
$p = new Produto();

$p->setId($id);
$p->crud(0);
?>

<meta http-equiv="refresh" content="0.1;URL=?p=produto/listar">