<main class="painel-conteiner m-4">
        <h1>Editar usuário</h1>

        <form action="/usuarios/atualizar?id=<?= $usuario['id_usuario'] ?>" method="POST">
			<div class="row">
				<div class="mb-3 col-sm">
					<label for="nome" class="form-label">Nome completo</label>
					<input type="text" class="form-control" id="nome" name="nome" value="<?= $usuario['nome'] ?>" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="email" class="form-label">E-mail</label>
					<input type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?>" required>
				</div>
			</div>

			<div class="row">
				<div class="mb-3 col-sm">
					<label for="cpf" class="form-label">CPF</label>
					<input type="text" class="form-control" id="cpf" name="cpf" value="<?= $usuario['cpf'] ?>" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="telefone" class="form-label">Telefone</label>
					<input type="tel" class="form-control" id="telefone" name="celular" value="<?= $usuario['celular'] ?>" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="nascimento" class="form-label">Data de nascimento</label>
					<input type="date" class="form-control" id="nascimento" name="nascimento" value="<?= $usuario['data_nascimento'] ?>" required>
				</div>
			</div>

			<div class="row">
				<div class="mb-3 col-sm">
					<label for="genero" class="form-label">Gênero</label>
					<select class="form-select" id="genero" name="genero" required>
						<option value="masculino" <?= $usuario['genero'] === 'masculino' ? 'selected' : '' ?>>Masculino</option>
						<option value="feminino" <?= $usuario['genero'] === 'feminino' ? 'selected' : '' ?>>Feminino</option>
						<option value="outro" <?= $usuario['genero'] === 'outro' ? 'selected' : '' ?>>Outro</option>
						<option value="nao-informado" <?= $usuario['genero'] === 'nao-informado' ? 'selected' : '' ?>>Prefiro não informar</option>
					</select>
				</div>

				<div class="mb-3 col-sm-9">
					<label for="logradouro" class="form-label">Logradouro</label>
					<input type="text" class="form-control" id="logradouro" name="logradouro" value="<?= $usuario['rua'] ?>" required>
				</div>
				
				<div class="mb-3 col-sm-1">
					<label for="numero" class="form-label">Número</label>
					<input type="text" class="form-control" id="numero" name="numero" value="<?= $usuario['numero'] ?>" required>
				</div>
			</div>

			<div class="row">
				<div class="mb-3 col-sm-6">
					<label for="complemento" class="form-label">Complemento</label>
					<input type="text" class="form-control" id="complemento" name="complemento" value="<?= $usuario['complemento'] ?>">
				</div>
			
				<div class="mb-3 col-sm">
					<label for="cidade" class="form-label">Cidade</label>
					<input type="text" class="form-control" id="cidade" name="cidade" value="<?= $usuario['cidade'] ?>" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="bairro" class="form-label">Bairro</label>
					<input type="text" class="form-control" id="bairro" name="bairro" value="<?= $usuario['bairro'] ?>" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="estado" class="form-label">Estado</label>
					<select class="form-select" id="estado" name="estado">
						<?php
                        $estados = ['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'];
                        foreach ($estados as $uf):
                        ?>
                            <option value="<?= $uf ?>" <?= $usuario['estado'] === $uf ? 'selected' : '' ?>><?= $uf ?></option>
                        <?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="mb-3">
                <label for="tipo" class="form-label">Tipo de usuário</label>
                <select class="form-select" id="nivel_acesso" name="nivel_acesso" required>
                    <option value="Administrador" <?= $usuario['nivel_acesso'] === 'Administrador' ? 'selected' : '' ?>>Administrador(a)</option>
                    <option value="Funcionário" <?= $usuario['nivel_acesso'] === 'Funcionário' ? 'selected' : '' ?>>Funcionário(a)</option>
                    <option value="Cliente" <?= $usuario['nivel_acesso'] === 'Cliente' ? 'selected' : '' ?>>Cliente</option>
                </select>
            </div>

			<div class="row">
				<div class="mb-3 col-sm">
					<label for="senha" class="form-label">Senha (nova)</label>
					<input type="password" class="form-control" id="senha" name="senha" required>
				</div>

				<div class="mb-3 col-sm">
					<label for="confirmacao-senha" class="form-label">Confirmar senha</label>
					<input type="password" class="form-control" id="confirmacao-senha" name="confirmacao-senha" required>
				</div>
			</div>

            <a href="/usuarios" class="btn btn-secondary">Voltar</a>
			<button type="reset" class="btn btn-danger me-2">Limpar</button>
			<button type="submit" class="btn btn-success">Salvar alterações</button>
        </form>


