<?php

require_once '../configApi/db.php'; 

if ($conn) {
    echo "Conexão bem-sucedida!<br>";  
} else {
    echo "Falha na conexão.<br>";  
}

$stmt = $conn->query("SELECT VERSION()");

echo 'MySQL Version: ' . $stmt->fetchColumn();
