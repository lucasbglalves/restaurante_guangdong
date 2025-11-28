<?php
namespace App\Models;

use PDO;
use App\Core\Database;
use PDOException;

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

            $stmt->execute(); 
            //Retorna o ID de registro no BD
            return (int) $pdo->lastInsertId();


        } catch (PDOException $e) {
            echo "Erro ao salvar usuário: " . $e->getMessage();
            exit;
        }
    }
}