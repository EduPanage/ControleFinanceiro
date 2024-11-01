<?php
require_once '../config/db.php';

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $email, $password)
    {
        $sql = "INSERT INTO Usuarios (nome, email, senha) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    public function AdicionarTransacao($userId, $value, $type)
    {
        $sql = "INSERT INTO Transacoes (id_usuario, valor, tipo) VALUES (:userId, :value, :type)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':type', $type);
        return $stmt->execute();
    }

    public function RemoverTransacao($transactionId)
    {
        $sql = "DELETE FROM Transacoes WHERE id_transacao = :transactionId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':transactionId', $transactionId);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
