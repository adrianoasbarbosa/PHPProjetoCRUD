<h3>Lista de Viagens</h3>
<a class="btn btn-outline-primary float-right" href="?p=viagem/salvar">Add</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">ID do Ônibus</th>
            <th scope="col">ID do Passageiro</th>
            <th scope="col">Data da Viagem</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../class/Viagem.php';
        $viagem = new Viagem();
        $dados = $viagem->listar(NULL);
        if (!empty($dados)) {
            foreach ($dados as $mostrar) {
        ?>
                <tr>
                    <th scope="row"><?= $mostrar['id'] ?></th>
                    <td><?= $mostrar['id_onibus'] ?></td>
                    <td><?= $mostrar['id_passageiro'] ?></td>
                    <td><?= $mostrar['data_viagem'] ?></td>
                    <td>
                        <a href="?p=viagem/salvar&id=<?= $mostrar['id'] ?>" class="btn btn-primary" title="Editar registro">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=viagem/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger" data-confirm="Excluir registro?" title="Excluir registro">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>