<?php
namespace App\Models;

use PDO;
use App\Core\Database;
use PDOException;

class Produto {

    // Lista todos os produtos
    public static function buscarTodos() {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM produtos ORDER BY criado_em DESC";
        return $pdo->query($sql)->fetchAll();
    }

    // Busca um único produto pelo ID
    public static function buscarPorId(int $id) {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM produtos WHERE id_produtos = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Insere um novo produto
    public static function salvar($dados) {
        try {
            $pdo = Database::conectar();

            $sql = "INSERT INTO produtos (codigo, nome_produto, categoria, preco)
                    VALUES (:codigo, :nome_produto, :categoria, :preco)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':codigo', $dados['codigo'], PDO::PARAM_STR);
            $stmt->bindParam(':nome_produto', $dados['nome_produto'], PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $dados['categoria'], PDO::PARAM_STR);
            $stmt->bindParam(':preco', $dados['preco']);

            $stmt->execute();

            return (int) $pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro ao salvar produto: " . $e->getMessage();
            exit;
        }
    }

    // Atualiza um produto existente
    public static function atualizar(int $id, $dados) {
        try {
            $pdo = Database::conectar();

            $sql = "UPDATE produtos SET
                        codigo = :codigo,
                        nome_produto = :nome_produto,
                        categoria = :categoria,
                        preco = :preco
                    WHERE id_produtos = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':codigo', $dados['codigo'], PDO::PARAM_STR);
            $stmt->bindParam(':nome_produto', $dados['nome_produto'], PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $dados['categoria'], PDO::PARAM_STR);
            $stmt->bindParam(':preco', $dados['preco']);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar produto: " . $e->getMessage();
            exit;
        }
    }

    // Exclui um produto (remoção definitiva)
    public static function excluir(int $id) {
        try {
            $pdo = Database::conectar();
            $sql = "DELETE FROM produtos WHERE id_produtos = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao excluir produto: " . $e->getMessage();
            exit;
        }
    }
}



