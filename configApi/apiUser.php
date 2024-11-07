<?php
require_once '../configApi/db.php';
require_once '../config/db_api.sql';
require_once '../models/manage.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$user = new User($conn);

//Definindo as rotas referentes ao usuario
switch ($method) {
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['action']) && $data['action'] === 'createUser') {
            $name = $data['name'] ?? null;
            $email = $data['email'] ?? null;
            $password = $data['password'] ?? null;

            if ($name && $email && $password) {
                $user->createUser($name, $email, $password);
                echo json_encode(["message" => "Usuário criado com sucesso"]);
            } else {
                echo json_encode(["error" => "Dados incompletos"]);
            }
        }
        break;

    case 'GET':
        if (isset($_GET['userId'])) {
            $userId = $_GET['userId'];
            $userData = $user->listUsers($userId);
            echo json_encode($userData);
        } else {
            $users = $user->listUsers();
            echo json_encode($users);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $userId = $data['userId'] ?? null;
        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;

        if ($userId && $name && $email) {
            $user->updateUser($userId, $name, $email);
            echo json_encode(["message" => "Usuário atualizado com sucesso"]);
        } else {
            echo json_encode(["error" => "Dados incompletos"]);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        $userId = $data['userId'] ?? null;

        if ($userId) {
            $user->removeUser($userId);
            echo json_encode(["message" => "Usuário excluído com sucesso"]);
        } else {
            echo json_encode(["error" => "ID do usuário não fornecido"]);
        }
        break;

    default:
        echo json_encode(["error" => "Método não suportado"]);
        break;
}
