<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Passageiro.php';

$pa = new Passageiro();
$titulo = "Cadastrar";
$nome = '';
$data_nascimento = '';

if (isset($id)) {
    $pa->setId($id);
    $dados = $pa->listar($id);
    if (!empty($dados)) {
        $nome = $dados[0]['nome'];
        $data_nascimento = $dados[0]['data_nascimento'];
    }
    $titulo = "Editar";
}

?>

<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        <?= $titulo ?> Passageiro
    </h3>
</div>

<div class="col-sm-12">
    <div class="card shadow">
        <form method="post" name="frmsalvar" id="frmsalvar" class="m-3">
            <div class="form-group">
                <label for="txtnome" class="col-sm-2 col-form-label">
                    Nome
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Digite o nome" maxlength="100" minlength="3" value="<?= $nome ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="txtdata_nascimento" class="col-sm-2 col-form-label">
                    Data de Nascimento
                </label>
                <div class="col-sm-12">
                    <input type="date" class="form-control" id="txtdata_nascimento" name="txtdata_nascimento" value="<?= $data_nascimento ?>" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-<?= isset($id) ? "success" : "primary" ?> m-3" name="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" id="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" value="<?= isset($id) ? "Editar" : "Salvar" ?>" />
                    <a class="btn btn-danger" href="?p=passageiro/listar"><i class="bi bi-arrow-return-left"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $data_nascimento = filter_input(INPUT_POST, 'txtdata_nascimento');

    $pa->setId(null);
    $pa->setNome($nome);
    $pa->setDataNascimento($data_nascimento);

    echo '<div class="alert alert-primary mt-3" role="alert">'
        . $pa->crud(0) // 0 para inserir
        . '</div>';
}
if (filter_input(INPUT_POST, 'btneditar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $data_nascimento = filter_input(INPUT_POST, 'txtdata_nascimento');

    $pa->setNome($nome);
    $pa->setDataNascimento($data_nascimento);

    echo '<div class="alert alert-primary mt-3" role="alert">'
        . $pa->crud(1) // 1 para atualizar
        . '</div>';
}
?>