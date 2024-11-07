<?php
require_once 'configApi/db.php';
require_once 'models/manage.php';

$user = new User($conn);

$user2 = new Transaction(db: $conn);

$user->createUser("João Silva", "joao@email.com", "senha123");

$usuario = $user->listUsers();
print_r($usuario);

$user2->createTransacao(1, 100.00, "entrada");

$transacoes = $user2->listTransacoes(1);
print_r($transacoes);

if (!empty($transacoes)) {
   $ultima_transacao = end($transacoes);
   $user2->RemoveTransacao($ultima_transacao['id_transacao']);
   
   $transacoes_atualizadas = $user2->listTransacoes(1);
   print_r($transacoes_atualizadas);
}

