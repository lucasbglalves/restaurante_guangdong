<?php
namespace App\Controllers;

use App\Models\Produto;

class ProdutoController {

    // Lista os produtos e chama a tela de listar
    public function listar() {
        $lista_produtos = Produto::buscarTodos();

        render("produtos/lista_produtos.php", [
            'title' => "Cardápio",
            'produtos' => $lista_produtos
        ]);
    }

    // Salva um novo produto
    public function salvar() {
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
            Produto::salvar($dados);
            header('Location: /produtos');
        } else {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;
            header('Location: /produtos/inserir');
        }
    }

    // Mostra o formulário para editar um produto
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

    // Atualiza os dados de um produto
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

    // Exclui um produto
    public function excluir() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            Produto::excluir($id);
        }

        header('Location: /produtos');
    }
}



