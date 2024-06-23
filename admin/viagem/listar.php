<h3>Lista de Viagens</h3>
<a class="btn btn-outline-primary float-right mt-4 my-4" href="?p=viagem/salvar">Add</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Ônibus</th>
            <th scope="col">Passageiro</th>
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
                    <th scope="row"><?= htmlspecialchars($mostrar['id']) ?></th>
                    <td><?= htmlspecialchars($mostrar['onibus_nome']) ?></td>
                    <td><?= htmlspecialchars($mostrar['passageiro_nome']) ?></td>
                    <td><?= htmlspecialchars($mostrar['data_viagem']) ?></td>
                    <td>
                        <a href="?p=viagem/salvar&id=<?= htmlspecialchars($mostrar['id']) ?>" class="btn btn-primary" title="Editar registro">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=viagem/excluir&id=<?= htmlspecialchars($mostrar['id']) ?>" class="btn btn-danger" data-confirm="Excluir registro?" title="Excluir registro">
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