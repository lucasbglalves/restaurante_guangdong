<?php
namespace App\Controllers;

use App\Models\Usuario;

class UsuarioController {

    //Busca os usuarios e chama a tela de listar
    public function listar(){
        //Chama a model e a função que busca os dados e armazena na var
        $lista_usuarios = Usuario::buscarTodos();

        render("usuarios/lista_usuarios.php", [
        'title' => "Lista de Usuários",
        'usuarios' =>$lista_usuarios      
        ]);
    }

    public function salvar() {
    //Limpa os dados, remove tudo que não for texto puro
    $dados = [
        'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
        'nome_social' => filter_input(INPUT_POST, 'nome_social', FILTER_SANITIZE_SPECIAL_CHARS),
        'genero' => filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS),
        'cpf' => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS),
        'rg' => filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_SPECIAL_CHARS),
        'data_nascimento' => filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_SPECIAL_CHARS),
        // o campo no formulário se chama "celular"
        'celular' => filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS),
        'rua' => filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_SPECIAL_CHARS),
        'numero' => filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS),
        'complemento' => filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_SPECIAL_CHARS),
        'bairro' => filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS),
        'cidade'=> filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS),
        'cep'=> filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS),
        'estado' => filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS),
        'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS),
        'nivel_acesso' => filter_input(INPUT_POST, 'nivel_acesso', FILTER_SANITIZE_SPECIAL_CHARS),
        'senha' => filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW)
    ];

    // garante que nivel_acesso nunca seja nulo e respeita o ENUM do banco
    if (empty($dados['nivel_acesso'])) {
        $dados['nivel_acesso'] = 'Cliente';
    }

    //cria a lista de erros
    $erros = [];

    //Verifica se o nome está vazio
    if (empty($dados['nome'])) {
        $erros[] = 'O campo NOME não pode ficar em branco!';
    } else if (strlen($dados['nome']) < 4) {//Verifica se o nome tem menos de 4 letras
        $erros[] = 'O campo NOME deve ter mais que 3 caracteres!';
    }

    // Senha: valida e mantém o valor "puro" para o Model fazer o hash
    $senha_raw = $dados['senha'];
    $senha_conf = filter_input(INPUT_POST, 'confirmacao-senha', FILTER_UNSAFE_RAW);

    if (empty($senha_raw)) {
        $erros[] = 'O campo SENHA não pode ficar em branco!';
    } elseif ($senha_raw !== $senha_conf) {
        $erros[] = 'A confirmação de senha não confere.';
    } elseif (strlen((string)$senha_raw) < 6) {
        $erros[] = 'A senha deve ter ao menos 6 caracteres.';
    }

    //Se não houver erros salva e vai para a tela de LISTAGEM
    if (empty($erros)) {
        $id = Usuario::salvar($dados);
       header('Location: /usuarios');
    } else {
        print_r($erros);
        print_r($dados);
        //Se houver erros, volta para o FORMULÁRIO
        $_SESSION['erros'] = $erros;
        $_SESSION['dados'] = $dados;
      //  header('Location: /usuarios/inserir');
        }
    }

    // Mostra o formulário para editar um usuário
    public function editar() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /usuarios');
            exit;
        }

        $usuario = Usuario::buscarPorId($id);

        if (!$usuario) {
            header('Location: /usuarios');
            exit;
        }

        render('usuarios/form_usuarios_editar.php', [
            'title' => 'Editar Usuário',
            'usuario' => $usuario
        ]);
    }

    // Atualiza os dados de um usuário
    public function atualizar() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            header('Location: /usuarios');
            exit;
        }

        $dados = [
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'nome_social' => filter_input(INPUT_POST, 'nome_social', FILTER_SANITIZE_SPECIAL_CHARS),
            'genero' => filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS),
            'cpf' => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS),
            'rg' => filter_input(INPUT_POST, 'rg', FILTER_SANITIZE_SPECIAL_CHARS),
            'data_nascimento' => filter_input(INPUT_POST, 'nascimento', FILTER_SANITIZE_SPECIAL_CHARS),
            'celular' => filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS),
            'rua' => filter_input(INPUT_POST, 'logradouro', FILTER_SANITIZE_SPECIAL_CHARS),
            'numero' => filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS),
            'complemento' => filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_SPECIAL_CHARS),
            'bairro' => filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS),
            'cidade'=> filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS),
            'cep'=> filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS),
            'estado' => filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS),
            'nivel_acesso' => filter_input(INPUT_POST, 'nivel_acesso', FILTER_SANITIZE_SPECIAL_CHARS),
            'senha' => filter_input(INPUT_POST, 'senha', FILTER_UNSAFE_RAW)
        ];

        $erros = [];

        if (empty($dados['nome'])) {
            $erros[] = 'O campo NOME não pode ficar em branco!';
        } else if (strlen($dados['nome']) < 4) {
            $erros[] = 'O campo NOME deve ter mais que 3 caracteres!';
        }

        $senha_raw = $dados['senha'];
        $senha_conf = filter_input(INPUT_POST, 'confirmacao-senha', FILTER_UNSAFE_RAW);

        if (empty($senha_raw)) {
            $erros[] = 'O campo SENHA não pode ficar em branco!';
        } elseif ($senha_raw !== $senha_conf) {
            $erros[] = 'A confirmação de senha não confere.';
        } elseif (strlen((string)$senha_raw) < 6) {
            $erros[] = 'A senha deve ter ao menos 6 caracteres.';
        }

        if (empty($erros)) {
            Usuario::atualizar($id, $dados);
            header('Location: /usuarios');
        } else {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;
            header('Location: /usuarios/editar?id=' . $id);
        }
    }

    // Exclui (lógico) um usuário
    public function excluir() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            Usuario::excluir($id);
        }

        header('Location: /usuarios');
    }
}