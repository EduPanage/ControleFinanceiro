<?php
require_once '../config/db.php'; 
require_once '../controllers/TransController.php'; 
require_once '../Router.php'; 

$router = new Router();
$TransController = new TransactionController($conn);

header("Content-type: application/json; charset=UTF-8");

// Definindo as rotas para as operações de transaçoes
$router->add('POST', '/USUARIO', [$TransController, 'createUser']);  
$router->add('GET', '/USUARIO', [$TransController, 'listUsers']);    
$router->add('PUT', '/USUARIO/{id}', [$TransController, 'updateUser']); 
$router->add('DELETE', '/USUARIO/{id}', [$TransController, 'deleteUser']);  

$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathItens = explode("/", $requestedPath);
$requestedPath = "/" . $pathItens[2] . ($pathItens[3] ? "/" . $pathItens[3] : '');

$router->dispatch($requestedPath);
