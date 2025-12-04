<?php
namespace App\Controllers;

use App\Models\Usuario;

/**
 * Controller responsável por gerenciar as ações relacionadas aos usuários
 * Controla as regras de negócio e validações necessárias
 */
class UsuarioController {

    /**
     * Lista todos os usuários cadastrados no sistema
     * Busca os dados através do Model e passa para a view de listagem
     */
    public function listar(){
        // Busca todos os usuários através do Model
        $lista_usuarios = Usuario::buscarTodos();

        // Renderiza a view passando os dados encontrados
        // Função render declarada no index.php
        render("usuarios/lista_usuarios.php", [
        'title' => "Lista de Usuários",
        'usuarios' =>$lista_usuarios      
        ]);
    }

    /**
     * Processa o cadastro de um novo usuário
     */
    public function salvar() {
    // Tratamento dos dados do formulário
    // FILTER_SANITIZE_SPECIAL_CHARS remove caracteres especiais 
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

    // Validação do nível de acesso, garante que não seja nulo
    if (empty($dados['nivel_acesso'])) {
        $dados['nivel_acesso'] = 'Cliente';
    }

    // Armazena os erros de validação
    $erros = [];

    // Valida o nome completo e garante que tenha mais de 3 caracteres
    if (empty($dados['nome'])) {
        $erros[] = 'O campo NOME não pode ficar em branco!';
    } else if (strlen($dados['nome']) < 4) {
        $erros[] = 'O campo NOME deve ter mais que 3 caracteres!';
    }

    // Criptografia da senha do usuario para salvar no banco de dados
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
        $id = Usuario::salvar($dados);
        header('Location: /usuarios');
        exit; 
    } else {
        $_SESSION['erros'] = $erros;
        $_SESSION['dados'] = $dados;
        }
    }

    /**
     * Carrega o formulário de edição preenchido com os dados do usuário
     */
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

    /**
     * Atualiza os dados do usuario editado
     * Faz as mesmas validações da função salvar
     */
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

    /**
     * Exclui um usuário do sistema
     * Apenas deleção lógica, sendo possível ver também a data de exclusão
     */
    public function excluir() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id) {
            Usuario::excluir($id);
        }

        header('Location: /usuarios');
        exit;
    }
}