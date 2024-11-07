<?php
require_once '../config/db.php';

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createUser($name, $email, $password)
    {
        $sql = "INSERT INTO Usuarios (nome, email, senha) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    public function removeUser($userId) 
    {
        $sql = "SELECT id_usuario, nome, email FROM Usuarios WHERE id_usuario = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function listUsers() 
    {
        $sql = "SELECT id_usuario, nome, email FROM Usuarios";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $name, $email) 
    {
        $sql = "UPDATE Usuarios SET nome = :name, email = :email WHERE id_usuario = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

}

class Transaction{

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createTransacao($userId, $value, $type)
    {
        $sql = "INSERT INTO Transacoes (id_usuario, valor, tipo) VALUES (:userId, :value, :type)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':type', $type);
        return $stmt->execute();
    }

    public function RemoveTransacao($transactionId)
    {
        $sql = "DELETE FROM Transacoes WHERE id_transacao = :transactionId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':transactionId', $transactionId);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function listTransacoes($userId) 
    {
        $sql = "SELECT * FROM Transacoes WHERE id_usuario = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTransacao($transactionId, $value, $type) 
    {
        $sql = "UPDATE Transacoes SET valor = :value, tipo = :type WHERE id_transacao = :transactionId";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':transactionId', $transactionId);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':type', $type);
        return $stmt->execute();
    }
}

