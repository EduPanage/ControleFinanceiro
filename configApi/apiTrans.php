<?php
require_once '../config/db.php';
require_once '../config/db_api.sql';
require_once '../models/manage.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$transaction = new Transaction($conn);

// Definindo as rotas referentes às transações
switch ($method) {
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['action']) && $data['action'] === 'createTransaction') {
            $userId = $data['userId'] ?? null;
            $value = $data['value'] ?? null;
            $type = $data['type'] ?? null; // 'entrada' ou 'saida'

            if ($userId && $value && $type) {
                $transaction->createTransacao($userId, $value, $type);
                echo json_encode(["message" => "Transação criada com sucesso"]);
            } else {
                echo json_encode(["error" => "Dados incompletos"]);
            }
        }
        break;

    case 'GET':
        if (isset($_GET['transactionId'])) {
            $transactionId = $_GET['transactionId'];
            $transactionData = $transaction->listTransacoes($transactionId);  // Alterado para o nome correto do método
            echo json_encode($transactionData);
        } elseif (isset($_GET['userId'])) {
            $userId = $_GET['userId'];
            $transactions = $transaction->listTransacoes($userId);  // Nome do método corrigido
            echo json_encode($transactions);
        } else {
            echo json_encode(["error" => "ID da transação ou ID do usuário não fornecido"]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $transactionId = $data['transactionId'] ?? null;
        $value = $data['value'] ?? null;
        $type = $data['type'] ?? null; // 'entrada' ou 'saida'

        if ($transactionId && $value && $type) {
            $transaction->updateTransacao($transactionId, $value, $type);  // Nome do método corrigido
            echo json_encode(["message" => "Transação atualizada com sucesso"]);
        } else {
            echo json_encode(["error" => "Dados incompletos"]);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        $transactionId = $data['transactionId'] ?? null;

        if ($transactionId) {
            $transaction->removeTransacao($transactionId);  // Nome do método corrigido
            echo json_encode(["message" => "Transação excluída com sucesso"]);
        } else {
            echo json_encode(["error" => "ID da transação não fornecido"]);
        }
        break;

    default:
        echo json_encode(["error" => "Método não suportado"]);
        break;
}
?>
