
    <main class="painel-conteiner m-4">
        <div class="d-flex mb-3 justify-content-between">
            <h1>Cardápio</h1>
            <a href="/produtos/inserir" class="btn btn-success my-auto">Adicionar prato</a>
        </div>

        <div style="max-width: 100%; overflow-x: hidden;">
			<table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Preço</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $p): ?>
                <tr>
                    <td><?= $p['codigo'] ?></td>
                    <td><?= $p['nome_produto'] ?></td>
                    <td><?= $p['categoria'] ?></td>
                    <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
                    <td class="text-center">
                        <a href="/produtos/editar?id=<?= $p['id_produtos'] ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="/produtos/excluir?id=<?= $p['id_produtos'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
		</div>
    </main>
