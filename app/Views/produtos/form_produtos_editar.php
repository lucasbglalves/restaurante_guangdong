    <main class="painel-conteiner m-4">
        <h1>Editar prato</h1>

        <form action="/produtos/atualizar?id=<?= $produto['id_produtos'] ?>" method="POST">
            <div class="row">
                <div class="mb-3 col-sm-2">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?= $produto['codigo'] ?>" required>
                </div>

                <div class="mb-3 col-sm-5">
                    <label for="nome_produto" class="form-label">Nome do prato</label>
                    <input type="text" class="form-control" id="nome_produto" name="nome_produto" value="<?= $produto['nome_produto'] ?>" required>
                </div>

                <div class="mb-3 col-sm-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" value="<?= $produto['categoria'] ?>" required>
                </div>
                
                <div class="mb-3 col-sm-2">
                    <label for="preco" class="form-label">Preço (R$)</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?= $produto['preco'] ?>" required>
                </div>
            </div>

            <a href="/produtos" class="btn btn-secondary me-2">Voltar</a>
            <button type="reset" class="btn btn-danger me-2">Limpar</button>
            <button type="submit" class="btn btn-success">Salvar alterações</button>
        </form>
    </main>


