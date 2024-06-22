<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Equipe.php';
$eq = new Equipe();
$titulo = "Cadastrar";

if (isset($id)) {
    $eq->setId($id);
    $dados = $eq->listar($id);
    foreach ($dados as $mostrar) {
        $nome_equipe = $mostrar['nome_equipe'];
        $nr_membros = $mostrar['nr_membros'];
    }
    $titulo = "Editar";
}

?>

<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        <?= $titulo ?> Equipe
    </h3>
</div>

<div class="col-sm-12">
    <div class="card shadow">
        <form method="post" name="frmsalvar" id="frmsalvar" class="m-3">
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Nome Equipe
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Digite o nome da equipe" maxlength="50" minlength="3" value="<?= isset($nome_equipe) ? htmlspecialchars($nome_equipe) : '' ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Número de Membros
                </label>
                <div class="col-sm-12">
                    <input type="number" class="form-control" id="txtnrmembros" name="txtnrmembros" placeholder="Digite o número de membros" min="0" value="<?= isset($nr_membros) ? htmlspecialchars($nr_membros) : '0' ?>" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-primary m-3" name="btnsalvar" id="btnsalvar" value="Salvar" />
                    <a class="btn btn-danger" href="?p=equipe/listar"><i class="bi bi-arrow-return-left"></i> Voltar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome_equipe = filter_input(INPUT_POST, 'txtnome');
    $nr_membros = filter_input(INPUT_POST, 'txtnrmembros');

    $eq->setId(null);
    $eq->setNome_equipe($nome_equipe);
    $eq->setNr_membros($nr_membros);

    echo '<div class="alert alert-primary mt-3" role="alert">'
        . $eq->crud(0)
        . '</div>';
}
if (filter_input(INPUT_POST, 'btneditar')) {
    $nome_equipe = filter_input(INPUT_POST, 'txtnome');
    $nr_membros = filter_input(INPUT_POST, 'txtnrmembros');

    $eq->setNome_equipe($nome_equipe);
    $eq->setNr_membros($nr_membros);

    echo '<div class="alert alert-primary mt-3" role="alert">'
        . $eq->crud(1)
        . '</div>';
}
?>