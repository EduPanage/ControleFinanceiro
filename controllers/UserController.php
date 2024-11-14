<?php
require_once '../models/manage.php';

class UserController
{
    private $user;

    public function __construct($db)
    {
        $this->user = new User($db);
    }

    public function list()
    {
        try {
            $users = $this->user->listUsers();
            echo json_encode($users);
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao listar os usuários."]);
        }
    }

    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));
        

        if (isset($data->nome) && isset($data->email) && isset($data->senha)) {
            try {
               
                $hashedPassword = password_hash($data->senha, PASSWORD_DEFAULT);
                $this->user->createUser($data->nome, $data->email, $hashedPassword);

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
            echo json_encode(["message" => "ID do usuário não fornecido."]);
        }
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));
        
    
        if (isset($id) && isset($data->nome) && isset($data->email)) {
            try {
                
                if (isset($data->senha)) {
                    $data->senha = password_hash($data->senha, PASSWORD_DEFAULT);
                }

                $count = $this->user->updateUser($id, $data->nome, $data->email, isset($data->senha) ? $data->senha : null);
                
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

    public function delete($id)
    {
        if (isset($id)) {
            try {
                $user = $this->user->listUsers($id); 
                if (!$user) {
                    http_response_code(404); 
                    echo json_encode(["message" => "Usuário não encontrado."]);
                    return;
                }

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
