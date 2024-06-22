<h3>Lista de Passageiros</h3>
<a class="btn btn-outline-primary float-right mt-4 my-4" href="?p=passageiro/salvar">Add</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Data de Nascimento</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../class/Passageiro.php';
        $pa = new Passageiro();
        $dados = $pa->listar();

        if (!empty($dados)) {
            foreach ($dados as $mostrar) {
        ?>
                <tr>
                    <th scope="row"><?= $mostrar['id'] ?></th>
                    <td><?= $mostrar['nome'] ?></td>
                    <td><?= $mostrar['data_nascimento'] ?></td>
                    <td>
                        <a href="?p=passageiro/salvar&id=<?= $mostrar['id'] ?>" class="btn btn-primary" title="editar registro">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=passageiro/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger" data-confirm="Excluir registro?" title="excluir registro">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="4">Nenhum passageiro encontrado.</td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>