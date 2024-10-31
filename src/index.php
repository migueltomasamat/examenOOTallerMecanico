<?php

//include_once "View/landing.php";
include_once "environment.php";
include_once "Router/Router.php";
include_once "Controller/UsuarioController.php";
include_once "Controller/ClienteController.php";
include_once "Controller/ReservasController.php";
use Router\Router;
use Controller\UsuarioController;
use Controller\ClienteController;

$router = new Router();


//Mostraria una landing page, una página estática
$router->addRoute('get','/',function(){
    include_once "View/landing.php";
});
$router->addRoute('get','/about',function(){
    include_once "View/about.php";
});

//Rutas enlazadas a controladores, lógica de la aplicación
//Usuarios
$router->addRoute('get','/users',[\Controller\UsuarioController::class,'index']);
$router->addRoute('get','/users/create',[\Controller\UsuarioController::class,'create']);
$router->addRoute('post','/users',[\Controller\UsuarioController::class,'store']);
$router->addRoute('get','/users/{id}/edit',[\Controller\UsuarioController::class,'edit']);
$router->addRoute('put','/users/{id}',[\Controller\UsuarioController::class,'update']);
$router->addRoute('get','/users/{id}',[\Controller\UsuarioController::class,'show']);
$router->addRoute('delete','/users/{id}',[\Controller\UsuarioController::class,'destroy']);

//Clientes
$router->addRoute('get','/clients',[\Controller\ClienteController::class,'index']);
$router->addRoute('get','/clients/create',[\Controller\ClienteController::class,'create']);
$router->addRoute('post','/clients',[\Controller\ClienteController::class,'store']);
$router->addRoute('get','/clients/{id}/edit',[\Controller\ClienteController::class,'edit']);
$router->addRoute('put','/clients/{id}',[\Controller\ClienteController::class,'update']);
$router->addRoute('get','/clients/{id}',[\Controller\ClienteController::class,'show']);
$router->addRoute('delete','/clients/{id}',[\Controller\ClienteController::class,'destroy']);

//Reservas
$router->addRoute('get','/bookings',[\Controller\ReservasController::class,'index']);
$router->addRoute('get','/bookings/create',[\Controller\ReservasController::class,'create']);
$router->addRoute('post','/bookings',[\Controller\ReservasController::class,'store']);
$router->addRoute('get','/bookings/{id}/edit',[\Controller\ReservasController::class,'edit']);
$router->addRoute('put','/bookings/{id}',[\Controller\ReservasController::class,'update']);
$router->addRoute('get','/bookings/{id}',[\Controller\ReservasController::class,'show']);
$router->addRoute('delete','/bookings/{id}',[\Controller\ReservasController::class,'destroy']);

$router->resolver($_SERVER['REQUEST_METHOD'],$_SERVER['REQUEST_URI']);