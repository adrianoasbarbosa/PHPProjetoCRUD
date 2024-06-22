<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Aluno.php';
$al = new Aluno();

$al->setId($id);
$al->crud(0);
?>

<meta http-equiv="refresh" content="0.1;URL=?p=aluno/listar">