<?php
$id = filter_input(INPUT_GET, 'id');

include_once '../class/Aluno.php';
$al = new Aluno();
$titulo = "Cadastrar";
if (isset($id)) {
    $al->setId($id);
    $dados = $al->listar($id);
    foreach ($dados as $mostrar) {
        $nome = $mostrar['nome'];
        $email = $mostrar['email'];
    }
    $titulo = "Editar";
}

?>
<div class="col-sm-12 mb-4">
    <h3 class="text-primary">
        <?= $titulo ?> Aluno
    </h3>
</div>

<div class="col-sm-12">
    <div class="card shadow">
        <form method="post" name="frmsalvar" id="frmsalvar" class="m-3">
            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    Nome
                </label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="txtnome" name="txtnome" placeholder="Digite seu nome" maxlength="50" minlength="3" value="<?= isset($nome) ? $nome : "" ?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="inputText" class="col-sm-2 col-form-label">
                    E-mail
                </label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Digite seu email" maxlength="50" minlength="3" value="<?= isset($email) ? $email : "" ?>" />
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-<?= isset($id) ? "success" : "primary" ?> m-3" name="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" id="<?= isset($id) ? "btneditar" : "btnsalvar" ?>" value="<?= isset($id) ? "Editar" : "Salvar" ?>" />
                    <a class="btn btn-danger" href="?p=aluno/listar"><i class="bi bi-arrow-return-left"></i> Voltar</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
if (filter_input(INPUT_POST, 'btnsalvar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $email = filter_input(INPUT_POST, 'txtemail');

    $al->setId(null); // Limpa o ID para inserção
    $al->setNome($nome);
    $al->setEmail($email);

    // Exibe mensagem de retorno do método CRUD
    echo '<div class="alert alert-primary mt-3" role="alert">'
        . $al->crud(0) // 0 para inserção
        . '</div>';
}

if (filter_input(INPUT_POST, 'btneditar')) {
    $nome = filter_input(INPUT_POST, 'txtnome');
    $email = filter_input(INPUT_POST, 'txtemail');

    $al->setNome($nome);
    $al->setEmail($email);

    // Exibe mensagem de retorno do método CRUD
    echo '<div class="alert alert-primary mt-3" role="alert">'
        . $al->crud(1) // 1 para atualização
        . '</div>';
}
?>