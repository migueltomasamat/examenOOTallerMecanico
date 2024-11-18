<?php

include_once "environment.php";
include_once "vendor/autoload.php";

use App\Router\Router;
use App\Controller\UsuarioController;
use App\Controller\ClienteController;

$router = new Router();


//Rutas de páginas estáticas
$router->addRoute('get','/',function(){
    include_once DIRECTORIO_VISTAS."landing.php";
});
$router->addRoute('get','/about',function(){
    include_once DIRECTORIO_VISTAS."about.php";
});
$router->addRoute('get','/login',function(){
    include_once DIRECTORIO_VISTAS . "login.php";
});

$router->addRoute('get','/services',function(){
    include_once DIRECTORIO_VISTAS . "services.php";
});

$router->addRoute('get','/contact',function(){
    include_once DIRECTORIO_VISTAS."contacto.php";
});


//Rutas enlazadas a controladores, lógica de la aplicación
//Usuarios
$router->addRoute('get','/users',[\App\Controller\UsuarioController::class,'index']);
$router->addRoute('get','/users/create',[\App\Controller\UsuarioController::class,'create']);
$router->addRoute('post','/users',[\App\Controller\UsuarioController::class,'store']);
$router->addRoute('get','/users/{id}/edit',[\App\Controller\UsuarioController::class,'edit']);
$router->addRoute('put','/users/{id}',[\App\Controller\UsuarioController::class,'update']);
$router->addRoute('get','/users/{id}',[\App\Controller\UsuarioController::class,'show']);
$router->addRoute('delete','/users/{id}',[\App\Controller\UsuarioController::class,'destroy']);

//Usuario API
$router->addRoute('post','/api/users',[\App\Controller\UsuarioController::class,'store']);

//Clientes
$router->addRoute('get','/clients',[\App\Controller\ClienteController::class,'index']);
$router->addRoute('get','/clients/create',[\App\Controller\ClienteController::class,'create']);
$router->addRoute('post','/clients',[\App\Controller\ClienteController::class,'store']);
$router->addRoute('get','/clients/{id}/edit',[\App\Controller\ClienteController::class,'edit']);
$router->addRoute('put','/clients/{id}',[\App\Controller\ClienteController::class,'update']);
$router->addRoute('get','/clients/{id}',[\App\Controller\ClienteController::class,'show']);
$router->addRoute('delete','/clients/{id}',[\App\Controller\ClienteController::class,'destroy']);

//Reservas
$router->addRoute('get','/bookings',[\App\Controller\ReservasController::class,'index']);
$router->addRoute('get','/bookings/create',[\App\Controller\ReservasController::class,'create']);
$router->addRoute('post','/bookings',[\App\Controller\ReservasController::class,'store']);
$router->addRoute('get','/bookings/{id}/edit',[\App\Controller\ReservasController::class,'edit']);
$router->addRoute('put','/bookings/{id}',[\App\Controller\ReservasController::class,'update']);
$router->addRoute('get','/bookings/{id}',[\App\Controller\ReservasController::class,'show']);
$router->addRoute('delete','/bookings/{id}',[\App\Controller\ReservasController::class,'destroy']);

$router->resolver($_SERVER['REQUEST_METHOD'],$_SERVER['REQUEST_URI']);