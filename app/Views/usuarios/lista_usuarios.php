

        <div style="max-width: 100%; overflow-x: hidden;">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Telefone</th>
						<th>CPF</th>
                        <th>Cidade</th>
                        <th>Status</th>
                        <th class="text-center">Ações</th>
					</tr>
				</thead>
				<tbody>
                    <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= $u['id_usuario'] ?></td>
                        <td><?= $u['nome'] ?></td>
                        <td><?= $u['email'] ?></td>
                        <td><?= $u['celular'] ?></td>
                        <td><?= $u['cpf'] ?></td>
                        <td><?= $u['cidade'] . "-" . $u['estado'] ?></td>
                        <td class="text-center">
                            
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm">Editar</a>
                            <a href="#" class="btn btn-danger btn-sm">Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
				</tbody>
			</table>
        </div>