<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Onibus.php';

$onibus = new Onibus();
$titulo = "Cadastrar";

if (isset($id)) {
    $onibus->setId($id);
    $dados = $onibus->listar($id);
    foreach ($dados as $mostrar) {
        $modelo = $mostrar['modelo'];
        $lugares = $mostrar['lugares'];
        $destino = $mostrar['destino'];
    }
    $titulo = "Editar";
}
?>

<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        <?= $titulo ?> Ônibus
    </h3>
</div>

<div class="col-sm-12">
    <div class="card shadow">
        <form method="post" name="frmsalvar" id="frmsalvar" class="m-3">
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Modelo
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtmodelo" name="txtmodelo" placeholder="Digite o modelo do ônibus" maxlength="100" minlength="3" value="<?= isset($id) ? $modelo : "" ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Lugares
                </label>
                <div class="col-sm-12">
                    <input type="number" class="form-control" id="txtlugares" name="txtlugares" placeholder="Digite o número de lugares" min="1" max="44" value="<?= isset($id) ? $lugares : "" ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Destino
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtdestino" name="txtdestino" placeholder="Digite o destino do ônibus" value="<?= isset($id) ? $destino : "" ?>" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-<?= isset($id) ? "success" : "primary" ?> m-3" name="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" id="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" value="<?= isset($id) ? "Editar" : "Salvar" ?>" />
                    <a class="btn btn-danger" href="?p=ob/listar"><i class="bi bi-arrow-return-left"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $modelo = filter_input(INPUT_POST, 'txtmodelo');
    $lugares = intval(filter_input(INPUT_POST, 'txtlugares')); // Convertendo para inteiro
    $destino = filter_input(INPUT_POST, 'txtdestino');

    if ($lugares < 1) {
        echo '<div class="alert alert-danger mt-3" role="alert">Número de lugares não pode ser menor que 1.</div>';
    } elseif ($lugares > 44) {
        echo '<div class="alert alert-danger mt-3" role="alert">Número de lugares não pode ser maior que 44.</div>';
    } else {
        $onibus->setId(null);
        $onibus->setModelo($modelo);
        $onibus->setLugares($lugares); // Passando o valor convertido para inteiro
        $onibus->setDestino($destino);

        echo '<div class="alert alert-primary mt-3" role="alert">'
            . $onibus->crud(0) // Assumindo que 0 seja o código para operação de salvar
            . '</div>';
    }
}
if (filter_input(INPUT_POST, 'btneditar')) {
    $modelo = filter_input(INPUT_POST, 'txtmodelo');
    $lugares = intval(filter_input(INPUT_POST, 'txtlugares')); // Convertendo para inteiro
    $destino = filter_input(INPUT_POST, 'txtdestino');

    if ($lugares < 1) {
        echo '<div class="alert alert-danger mt-3" role="alert">Número de lugares não pode ser menor que 1.</div>';
    } elseif ($lugares > 44) {
        echo '<div class="alert alert-danger mt-3" role="alert">Número de lugares não pode ser maior que 44.</div>';
    } else {
        $onibus->setModelo($modelo);
        $onibus->setLugares($lugares); // Passando o valor convertido para inteiro
        $onibus->setDestino($destino);

        echo '<div class="alert alert-primary mt-3" role="alert">'
            . $onibus->crud(1) // Assumindo que 1 seja o código para operação de editar
            . '</div>';
    }
}
?>