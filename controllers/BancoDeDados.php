<?php
$host = '192.168.100.86';
$db = 'db_api';
$user = 'root';
$pass = 'password';
$charset = 'utf8mb4';  

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";  
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
