<?php
namespace App\Controllers;

use App\Models\Produto;

/**
 * Controller para gerenciar produtos do cardápio
 * Implementa as mesmas funcionalidades do UsuarioController mas para produtos
 */
class ProdutoController {

    /**
     * Lista todos os produtos cadastrados
     */
    public function listar() {
        $lista_produtos = Produto::buscarTodos();

        render("produtos/lista_produtos.php", [
            'title' => "Cardápio",
            'produtos' => $lista_produtos
        ]);
    }

    /**
     * Processa o cadastro de um novo produto
     * Valida os campos obrigatórios antes de salvar
     */
    public function salvar() {
        // Filtra os dados do formulário
        $dados = [
            'codigo' => filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS),
            'nome_produto' => filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_SPECIAL_CHARS),
            'categoria' => filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS),
            'preco' => filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
        ];

        $erros = [];

        // Validação de campos obrigatórios
        if (empty($dados['codigo'])) {
            $erros[] = 'O campo CÓDIGO não pode ficar em branco!';
        }

        if (empty($dados['nome_produto'])) {
            $erros[] = 'O campo NOME DO PRATO não pode ficar em branco!';
        }

        if (empty($dados['categoria'])) {
            $erros[] = 'O campo CATEGORIA não pode ficar em branco!';
        }

        // Validação especial para preço: precisa ser um número válido
        // Verifico se é null, vazio ou se não é numérico
        if ($dados['preco'] === null || $dados['preco'] === '' || !is_numeric($dados['preco'])) {
            $erros[] = 'O campo PREÇO deve ser um número válido!';
        }

        if (empty($erros)) {
            Produto::salvar($dados);
            header('Location: /produtos');
        } else {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;
            header('Location: /produtos/inserir');
        }
    }

    /**
     * Carrega o formulário de edição com os dados do produto
     * Mesma lógica do método editar() do UsuarioController
     */
    public function editar() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /produtos');
            exit;
        }

        $produto = Produto::buscarPorId($id);

        if (!$produto) {
            header('Location: /produtos');
            exit;
        }

        render('produtos/form_produtos_editar.php', [
            'title' => 'Editar Produto',
            'produto' => $produto
        ]);
    }

    /**
     * Atualiza um produto existente
     * Reutiliza as mesmas validações do método salvar()
     */
    public function atualizar() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /produtos');
            exit;
        }

        $dados = [
            'codigo' => filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_SPECIAL_CHARS),
            'nome_produto' => filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_SPECIAL_CHARS),
            'categoria' => filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS),
            'preco' => filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
        ];

        $erros = [];

        if (empty($dados['codigo'])) {
            $erros[] = 'O campo CÓDIGO não pode ficar em branco!';
        }

        if (empty($dados['nome_produto'])) {
            $erros[] = 'O campo NOME DO PRATO não pode ficar em branco!';
        }

        if (empty($dados['categoria'])) {
            $erros[] = 'O campo CATEGORIA não pode ficar em branco!';
        }

        if ($dados['preco'] === null || $dados['preco'] === '' || !is_numeric($dados['preco'])) {
            $erros[] = 'O campo PREÇO deve ser um número válido!';
        }

        if (empty($erros)) {
            Produto::atualizar($id, $dados);
            header('Location: /produtos');
        } else {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;
            header('Location: /produtos/editar?id=' . $id);
        }
    }

    /**
     * Exclui um produto do banco de dados
     * Diferente dos usuários, fazemos deleção física
     * porque produtos podem ser removidos definitivamente sem problema
     */
    public function excluir() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            Produto::excluir($id);
        }

        header('Location: /produtos');
        exit;
    }
}



