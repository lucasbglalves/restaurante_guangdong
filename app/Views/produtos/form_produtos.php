
    <main class="painel-conteiner m-4">
        <h1>Cadastrar prato</h1>

        <form action="/listagem-produtos.html" method="POST">
            <div class="row">
                <div class="mb-3 col-sm-2">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="GDN-001" required>
                </div>

                <div class="mb-3 col-sm">
                    <label for="categoria" class="form-label">Categoria</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="Entrada, Principal, Bebida..." required>
                </div>
                
                <div class="mb-3 col-sm">
                    <label for="modelo" class="form-label">Nome do prato</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Yakimeshi de Frango" required>
                </div>
                
                <div class="mb-3 col-sm-2">
                    <label for="ano" class="form-label">Tempo preparo (min)</label>
                    <input type="number" class="form-control" id="ano" name="ano" placeholder="15" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea rows="5" class="form-control" id="descricao" name="descricao" placeholder="Ingredientes e observações..." required></textarea>
            </div>

            <div class="row">
                <div class="mb-3 col-sm">
                    <label for="quantidade" class="form-label">Porções disponíveis</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="10" required>
                </div>
                
                <div class="mb-3 col-sm">
                    <label for="valor" class="form-label">Preço (R$)</label>
                    <input type="number" step="0.01" class="form-control" id="valor" name="valor" placeholder="R$ 28,90" required>
                </div>
                
                <div class="mb-3 col-sm">
                <label for="categoria-select" class="form-label">Tipo</label>
                <select class="form-select" id="categoria-select" required>
                    <option value="entrada">Entrada</option>
                    <option value="principal">Prato Principal</option>
                    <option value="sobremesa">Sobremesa</option>
                    <option value="bebida">Bebida</option>
                    <option value="acompanhamento">Acompanhamento</option>
                </select>
            </div>
            </div>

            <a href="listagem-produtos.html" class="btn btn-secondary me-2">Voltar</a>
            <button type="reset" class="btn btn-danger me-2">Limpar</button>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </main>
