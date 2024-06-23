<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Viagem.php';
$viagem = new Viagem();

$viagem->setId($id);
$viagem->crud(2); // Assuming 2 is the code for deletion, adjust if necessary
?>

<meta http-equiv="refresh" content="0.1;URL=?p=viagem/listar">