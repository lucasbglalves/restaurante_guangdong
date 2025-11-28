<main class="painel-conteiner m-4">
        <h1>Cadastrar usuário</h1>

        <form action="/usuarios/salvar" method="POST">
			<div class="row">
				<div class="mb-3 col-sm">
					<label for="nome" class="form-label">Nome completo</label>
					<input type="text" class="form-control" id="nome" name="nome" placeholder="João Silva" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="email" class="form-label">E-mail</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="fulano.detal@email.com" required>
				</div>
			</div>

			<div class="row">
				<div class="mb-3 col-sm">
					<label for="cpf" class="form-label">CPF</label>
					<input type="number" class="form-control" id="cpf" name="cpf" placeholder="123.456.789-0" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="telefone" class="form-label">Telefone</label>
					<input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(14) 9 9123-4567" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="nascimento" class="form-label">Data de nascimento</label>
					<input type="date" class="form-control" id="nascimento" name="nascimento" required>
				</div>
			</div>

			<div class="row">
				<div class="mb-3 col-sm">
					<label for="genero" class="form-label">Gênero</label>
					<select class="form-select" id="genero" name="genero" required>
						<option value="masculino">Masculino</option>
						<option value="feminino">Feminino</option>
						<option value="outro">Outro</option>
						<option value="nao-informado">Prefiro não informar</option>
					</select>
				</div>

				<div class="mb-3 col-sm-9">
					<label for="logradouro" class="form-label">Logradouro</label>
					<input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Avenida Brasil" required>
				</div>
				
				<div class="mb-3 col-sm-1">
					<label for="numero" class="form-label">Número</label>
					<input type="text" class="form-control" id="numero" name="numero" required>
				</div>
			</div>

			<div class="row">
				<div class="mb-3 col-sm-6">
					<label for="complemento" class="form-label">Complemento</label>
					<input type="text" class="form-control" id="complemento" placeholder="Apartamento XYZ" name="complemento">
				</div>
			
				<div class="mb-3 col-sm">
					<label for="cidade" class="form-label">Cidade</label>
					<input type="text" class="form-control" id="cidade" name="cidade" placeholder="São Paulo" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="bairro" class="form-label">Bairro</label>
					<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Jardins" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="estado" class="form-label">Estado</label>
					<select class="form-select" id="estado" name="estado">
						<option value="AC">Acre</option>
						<option value="AL">Alagoas</option>
						<option value="AP">Amapá</option>
						<option value="AM">Amazonas</option>
						<option value="BA">Bahia</option>
						<option value="CE">Ceará</option>
						<option value="DF">Distrito Federal</option>
						<option value="ES">Espírito Santo</option>
						<option value="GO">Goiás</option>
						<option value="MA">Maranhão</option>
						<option value="MT">Mato Grosso</option>
						<option value="MS">Mato Grosso do Sul</option>
						<option value="MG">Minas Gerais</option>
						<option value="PA">Pará</option>
						<option value="PB">Paraíba</option>
						<option value="PR">Paraná</option>
						<option value="PE">Pernambuco</option>
						<option value="PI">Piauí</option>
						<option value="RJ">Rio de Janeiro</option>
						<option value="RN">Rio Grande do Norte</option>
						<option value="RS">Rio Grande do Sul</option>
						<option value="RO">Rondônia</option>
						<option value="RR">Roraima</option>
						<option value="SC">Santa Catarina</option>
						<option value="SP">São Paulo</option>
						<option value="SE">Sergipe</option>
						<option value="TO">Tocantins</option>
					</select>
				</div>
			</div>

			<div class="mb-3">
                <label for="nivel_acesso" class="form-label">Tipo de usuário</label>
                <select class="form-select" id="nivel_acesso" name="nivel_acesso" required>
                    <option value="administrador">Administrador(a)</option>
                    <option value="funcionario">Funcionário(a)</option>
                    <option value="cliente">Cliente</option>
                </select>
            </div>

			<div class="row">
				<div class="mb-3 col-sm">
					<label for="senha" class="form-label">Senha</label>
					<input type="password" class="form-control" id="senha" name="senha" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="confirmacao-senha" class="form-label">Confirmar senha</label>
					<input type="password" class="form-control" id="confirmacao-senha" name="confirmacao-senha" required>
				</div>
			</div>

            <a href="../home.php" class="btn btn-secondary">Voltar</a>
			<button type="reset" class="btn btn-danger me-2">Limpar</button>
			<button type="submit" class="btn btn-success">Salvar</button>
        </form>