<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Viagem.php';

$viagem = new Viagem();
$viagem->setId($id);

$resultado = $viagem->crud(2); // Supondo que 2 seja o código para exclusão na função CRUD

if ($resultado === "Procedimento ok") {
    header("Location: ?p=viagem/listar");
    exit();
} else {
    echo "Erro ao excluir a viagem";
    header("Refresh: 0.1; URL=?p=viagem/listar");
    exit();
}
