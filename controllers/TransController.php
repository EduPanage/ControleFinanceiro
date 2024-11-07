<?php
require_once '../models/manage.php';

class TransactionController
{
    private $transaction;

    public function __construct($db)
    {
        $this->transaction = new Transaction($db);
    }

    // Método para listar todas as transações de um usuário
    public function list($userId)
    {
        try {
            if (isset($userId)) {
                $transactions = $this->transaction->listTransacoes($userId);
                echo json_encode($transactions);
            } else {
                http_response_code(400);
                echo json_encode(["message" => "ID do usuário não fornecido."]);
            }
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao buscar as transações."]);
        }
    }

    // Método para criar uma nova transação
    public function create()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->userId) && isset($data->value) && isset($data->type)) {
            try {
                $this->transaction->createTransacao($data->userId, $data->value, $data->type);

                http_response_code(201);
                echo json_encode(["message" => "Transação criada com sucesso."]);
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar a transação."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // Método para buscar uma transação por ID
    public function getById($id)
    {
        if (isset($id)) {
            try {
                $transaction = $this->transaction->listTransacoes($id);
                if ($transaction) {
                    echo json_encode($transaction);
                } else {
                    http_response_code(404);
                    echo json_encode(["message" => "Transação não encontrada."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao buscar a transação."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID da transação não fornecido."]);
        }
    }

    // Método para atualizar uma transação
    public function update($id)
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($id) && isset($data->value) && isset($data->type)) {
            try {
                $count = $this->transaction->updateTransacao($id, $data->value, $data->type);
                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Transação atualizada com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao atualizar a transação."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar a transação."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados incompletos."]);
        }
    }

    // Método para deletar uma transação
    public function delete($id)
    {
        if (isset($id)) {
            try {
                $count = $this->transaction->RemoveTransacao($id);

                if ($count > 0) {
                    http_response_code(200);
                    echo json_encode(["message" => "Transação deletada com sucesso."]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Erro ao deletar a transação."]);
                }
            } catch (\Throwable $th) {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao deletar a transação."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "ID da transação não fornecido."]);
        }
    }
}
?>
