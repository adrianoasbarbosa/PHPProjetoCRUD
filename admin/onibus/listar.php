<h3>Lista de Ônibus</h3>
<a class="btn btn-outline-primary float-right mt-4 my-4" href="?p=onibus/salvar">Adicionar</a>
<br><br>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Modelo</th>
            <th scope="col">Lugares</th>
            <th scope="col">Destino</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once '../class/Onibus.php';
        $onibus = new Onibus();
        $dados = $onibus->listar(NULL);

        if (!empty($dados)) {
            foreach ($dados as $mostrar) {
        ?>
                <tr>
                    <th scope="row"><?= $mostrar['id'] ?></th>
                    <td><?= $mostrar['modelo'] ?></td>
                    <td><?= $mostrar['lugares'] ?></td>
                    <td><?= $mostrar['destino'] ?></td>
                    <td>
                        <a href="?p=onibus/salvar&id=<?= $mostrar['id'] ?>" class="btn btn-primary" title="Editar registro">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="?p=onibus/excluir&id=<?= $mostrar['id'] ?>" class="btn btn-danger" data-confirm="Excluir registro?" title="Excluir registro">
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