<?php
require_once '../models/manage.php';

class UserController
{
    private $user;

    public function __construct($db)
    {
        $this->user = new User($db);
    }

    // Método para listar todos os usuários
    public function list()
    {
        $users = $this->user->listUsers();
        echo json_encode($users);
    }

    // Método para criar um novo usuário
    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        
        if (isset($data->nome) && isset($data->email) && isset($data->senha)) {
            try {
                $this->user->createUser($data->nome, $data->email, $data->senha);

                http_response_code(201); 
                echo json_encode(["message" => "Usuário criado com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);  
                echo json_encode(["message" => "Erro ao criar o usuário."]);
            }
        } else {
            http_response_code(400);  
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // Método para buscar um usuário por ID
    public function getById($id)
    {
        if (isset($id)) {
            try {
                $user = $this->user->listUsers($id);  
                if ($user) {
                    echo json_encode($user);  
                } else {
                    http_response_code(404); 
                    echo json_encode(["message" => "Usuário não encontrado."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500); 
                echo json_encode(["message" => "Erro ao buscar o usuário."]);
            }
        } else {
            http_response_code(400);  
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // Método para atualizar um usuário
    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        
        if (isset($id) && isset($data->nome) && isset($data->email)) {
            try {
                $count = $this->user->updateUser($id, $data->nome, $data->email);
                if ($count > 0) {
                    http_response_code(200);  
                    echo json_encode(["message" => "Usuário atualizado com sucesso."]);
                } else {
                    http_response_code(500); 
                    echo json_encode(["message" => "Erro ao atualizar o usuário."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);  
                echo json_encode(["message" => "Erro ao atualizar o usuário."]);
            }
        } else {
            http_response_code(400); 
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // Método para deletar um usuário
    public function delete($id)
    {
        if (isset($id)) {
            try {
                $count = $this->user->removeUser($id);

                if ($count > 0) {
                    http_response_code(200); 
                    echo json_encode(["message" => "Usuário deletado com sucesso."]);
                } else {
                    http_response_code(500);  
                    echo json_encode(["message" => "Erro ao deletar o usuário."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);  
                echo json_encode(["message" => "Erro ao deletar o usuário."]);
            }
        } else {
            http_response_code(400); 
            echo json_encode(["message" => "ID do usuário não fornecido."]);
        }
    }
}
