<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Usuario {

    // Aqui declaramos uma função para cada operação do CRUD

    // Busca todos os usuários
    public static function buscarTodos() {
        // Primeiro vamos conectar no banco de dados
        // Precisamos importar o PDO antes de criar a classe
        // Como vamos utilizar o arquivo DATABASE, importamos ele também
        $pdo = Database::conectar();
        $sql = "SELECT * FROM usuarios WHERE deleted_at IS NULL";
        return $pdo->query($sql)->fetchAll();
    }

    // Busca um usuário pelo ID
    public static function find($id) {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id AND deleted_at IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Busca um usuário pelo email
    public static function findEmail($email) {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM usuarios WHERE email = :email AND deleted_at IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Insere um novo usuário
    public static function salvar($dados) {
        try{
            $pdo = Database::conectar();
            
            $senha_criptografada = password_hash($dados['senha'], PASSWORD_BCRYPT);

            $sql ="INSERT INTO usuarios (nome, genero, cpf, data_nascimento, celular, rua, numero, complemento, bairro, cidade, cep, estado, email, nivel_acesso, senha)";
            $sql .= " VALUES (:nome, :genero, :cpf, :data_nascimento, :celular, :rua, :numero, :complemento, :bairro, :cidade, :cep, :estado, :email, :nivel_acesso, :senha)";

            // Prepara o SQL para ser inserido no BD e limpa códigos maliciosos
            $stmt = $pdo->prepare($sql);

            // Passa as variáveis para o SQL
            $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':genero', $dados['genero'], PDO::PARAM_STR);
            $stmt->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
            $stmt->bindParam(':data_nascimento', $dados['data_nascimento']);
            $stmt->bindParam(':celular', $dados['celular'], PDO::PARAM_STR);
            $stmt->bindParam(':rua', $dados['rua'], PDO::PARAM_STR);
            $stmt->bindParam(':numero', $dados['numero'], PDO::PARAM_STR);
            $stmt->bindParam(':complemento', $dados['complemento'], PDO::PARAM_STR);
            $stmt->bindParam(':bairro', $dados['bairro'], PDO::PARAM_STR);
            $stmt->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
            $stmt->bindParam(':cep', $dados['cep'], PDO::PARAM_STR);
            $stmt->bindParam(':estado', $dados['estado'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $dados['email'], PDO::PARAM_STR);
            $stmt->bindParam(':nivel_acesso', $dados['nivel_acesso'], PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);


        } catch (PDOException $e) {
            echo "Erro ao salvar usuário: " . $e->getMessage();
            exit;
        }
        
        return $stmt->execute();
    }

    // Atualiza um usuário existente
    public static function update($id, $dados) {
        $pdo = Database::conectar();

        // Verifica se a senha foi fornecida para atualização
        if (!empty($dados['senha'])) {
            $sql = "UPDATE usuarios SET
                nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento,
                celular = :celular, rua = :rua, numero = :numero,
                complemento = :complemento, bairro = :bairro, cidade = :cidade,
                cep = :cep, estado = :estado, email = :email,
                tipo = :tipo, senha = :senha, updated_at = NOW()
                WHERE id_usuario = :id";

            $senha_hash = password_hash($dados['senha'], PASSWORD_DEFAULT);

        } else {
            $sql = "UPDATE usuarios SET
                nome = :nome, cpf = :cpf, data_nascimento = :data_nascimento,
                celular = :celular, rua = :rua, numero = :numero,
                complemento = :complemento, bairro = :bairro, cidade = :cidade,
                cep = :cep, estado = :estado, email = :email,
                tipo = :tipo, updated_at = NOW()
                WHERE id_usuario = :id";
        }

        $stmt = $pdo->prepare($sql);

        // Associa os parâmetros
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
        $stmt->bindParam(':data_nascimento', $dados['data_nascimento']);
        $stmt->bindParam(':celular', $dados['celular'], PDO::PARAM_STR);
        $stmt->bindParam(':rua', $dados['rua'], PDO::PARAM_STR);
        $stmt->bindParam(':numero', $dados['numero'], PDO::PARAM_STR);
        $stmt->bindParam(':complemento', $dados['complemento'], PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $dados['bairro'], PDO::PARAM_STR);
        $stmt->bindParam(':cidade', $dados['cidade'], PDO::PARAM_STR);
        $stmt->bindParam(':cep', $dados['cep'], PDO::PARAM_STR);
        $stmt->bindParam(':estado', $dados['estado'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $dados['email'], PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $dados['tipo'], PDO::PARAM_STR);

        if (!empty($dados['senha'])) {
            $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        }

        return $stmt->execute();
    }

    // Exclusão lógica (soft delete)
    public static function softDelete($id) {
        $pdo = Database::conectar();
        $sql = "UPDATE usuarios SET deleted_at = NOW() WHERE id_usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Exclusão física (não recomendada para produção)
    public static function fisicalDelete($id) {
        $pdo = Database::conectar();
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}