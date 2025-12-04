<?php
namespace App\Models;

use PDO;
use App\Core\Database;
use PDOException;

/**
 * Responsável pelas operações de banco de dados relacionadas a usuários
 */
class Usuario {

    /**
     * Busca todos os usuários ativos no sistema e não mostra os deletados logicamente
     */
    public static function buscarTodos() {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM usuarios WHERE deleted_at IS NULL";
        return $pdo->query($sql)->fetchAll();
    }

  
    public static function buscarPorId(int $id) {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id AND deleted_at IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Função para salvar um novo usuário e criptografia da senha para salvar no banco de dados
     */
    public static function salvar($dados) {
        try{
            $pdo = Database::conectar();
            
            $senha_criptografada = password_hash($dados['senha'], PASSWORD_BCRYPT);

            $sql ="INSERT INTO usuarios (nome, genero, cpf, data_nascimento, celular, rua, numero, complemento, bairro, cidade, cep, estado, email, nivel_acesso, senha)";
            $sql .= " VALUES (:nome, :genero, :cpf, :data_nascimento, :celular, :rua, :numero, :complemento, :bairro, :cidade, :cep, :estado, :email, :nivel_acesso, :senha)";

            $stmt = $pdo->prepare($sql);

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
            $stmt->bindParam(':senha', $senha_criptografada);

            $stmt->execute(); 
            
            return (int) $pdo->lastInsertId();

        } catch (PDOException $e) {
            echo "Erro ao salvar usuário: " . $e->getMessage();
            exit;
        }
    }

    /**
     * Função para atualizar os dados do usuario editado
     */
    public static function atualizar(int $id, $dados) {
        try {
            $pdo = Database::conectar();

            $senha_criptografada = password_hash($dados['senha'], PASSWORD_BCRYPT);

            $sql = "UPDATE usuarios SET 
                        nome = :nome,
                        genero = :genero,
                        cpf = :cpf,
                        data_nascimento = :data_nascimento,
                        celular = :celular,
                        rua = :rua,
                        numero = :numero,
                        complemento = :complemento,
                        bairro = :bairro,
                        cidade = :cidade,
                        cep = :cep,
                        estado = :estado,
                        email = :email,
                        nivel_acesso = :nivel_acesso,
                        senha = :senha
                    WHERE id_usuario = :id";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
            $stmt->bindParam(':senha', $senha_criptografada);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
            exit;
        }
    }

    /**
     * Deleção logica de um usuario
     */
    public static function excluir(int $id) {
        try {
            $pdo = Database::conectar();
            $sql = "UPDATE usuarios SET deleted_at = NOW() WHERE id_usuario = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir usuário: " . $e->getMessage();
            exit;
        }
    }
}