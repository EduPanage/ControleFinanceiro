<?php
$host = 'localhost';
$db = 'db_api';
$user = 'root';
$pass = 'password';
$charset = 'utf8';

try {

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $conn = new PDO($dsn, $user, $pass, $options);

    echo "Conexão bem-sucedida!<br>";

    $stmt = $conn->query("SELECT VERSION()");
    echo 'Versão do MySQL: ' . $stmt->fetchColumn() . "<br>";
} catch (PDOException $e) {

    echo "Erro na conexão: " . $e->getMessage() . "<br>";
    echo "Código de erro: " . $e->getCode();
}
