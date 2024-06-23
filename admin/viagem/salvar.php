<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Viagem.php';

$viagem = new Viagem();
$titulo = "Cadastrar";

if (isset($id)) {
    $viagem->setId($id);
    $dados = $viagem->listar($id);
    if (!empty($dados)) {
        foreach ($dados as $mostrar) {
            $id_onibus = $mostrar['id_onibus'];
            $id_passageiro = $mostrar['id_passageiro'];
            $data_viagem = $mostrar['data_viagem'];
        }
        $titulo = "Editar";
    }
}
?>

<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        <?= $titulo ?> Viagem
    </h3>
</div>

<div class="col-sm-12">
    <div class="card shadow">
        <form method="post" name="frmsalvar" id="frmsalvar" class="m-3">
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    ID do Ônibus
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtid_onibus" name="txtid_onibus" placeholder="Digite o ID do ônibus" value="<?= isset($id_onibus) ? $id_onibus : "" ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    ID do Passageiro
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtid_passageiro" name="txtid_passageiro" placeholder="Digite o ID do passageiro" value="<?= isset($id_passageiro) ? $id_passageiro : "" ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Data da Viagem
                </label>
                <div class="col-sm-12">
                    <input type="date" class="form-control" id="txtdata_viagem" name="txtdata_viagem" value="<?= isset($data_viagem) ? $data_viagem : "" ?>" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-<?= isset($id) ? "success" : "primary" ?> m-3" name="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" id="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" value="<?= isset($id) ? "Editar" : "Salvar" ?>" />
                    <a class="btn btn-danger" href="?p=viagem/listar"><i class="bi bi-arrow-return-left"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $id_onibus = filter_input(INPUT_POST, 'txtid_onibus');
    $id_passageiro = filter_input(INPUT_POST, 'txtid_passageiro');
    $data_viagem = filter_input(INPUT_POST, 'txtdata_viagem');

    $viagem->setId(null);
    $viagem->setIdOnibus($id_onibus);
    $viagem->setIdPassageiro($id_passageiro);
    $viagem->setDataViagem($data_viagem);

    echo '<div class="alert alert-primary mt-3" role="alert">'
        . $viagem->crud(0)
        . '</div>';
}
if (filter_input(INPUT_POST, 'btneditar')) {
    $id_onibus = filter_input(INPUT_POST, 'txtid_onibus');
    $id_passageiro = filter_input(INPUT_POST, 'txtid_passageiro');
    $data_viagem = filter_input(INPUT_POST, 'txtdata_viagem');

    $viagem->setIdOnibus($id_onibus);
    $viagem->setIdPassageiro($id_passageiro);
    $viagem->setDataViagem($data_viagem);

    echo '<div class="alert alert-primary mt-3" role="alert">'
        . $viagem->crud(1)
        . '</div>';
}
?>