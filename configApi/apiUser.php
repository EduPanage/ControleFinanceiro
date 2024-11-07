<?php
require_once '../config/db.php'; 
require_once '../controllers/UserController.php'; 
require_once '../Router.php'; 

$router = new Router();
$userController = new UserController($conn);

header("Content-type: application/json; charset=UTF-8");

// Definindo as rotas para as operações de usuário
$router->add('POST', '/USUARIO', [$userController, 'createUser']);  
$router->add('GET', '/USUARIO', [$userController, 'listUsers']);    
$router->add('PUT', '/USUARIO/{id}', [$userController, 'updateUser']); 
$router->add('DELETE', '/USUARIO/{id}', [$userController, 'deleteUser']);  

$requestedPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathItens = explode("/", $requestedPath);
$requestedPath = "/" . $pathItens[2] . ($pathItens[3] ? "/" . $pathItens[3] : '');

$router->dispatch($requestedPath);
