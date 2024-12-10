<?php

include_once "environment.php";
include_once "vendor/autoload.php";

use App\Router\Router;



$router = new Router();


//Rutas de páginas estáticas
$router->addRoute('get','/',function(){
    include_once DIRECTORIO_VISTAS."informacion.php";
});



//Rutas enlazadas a controladores, lógica de la aplicación
//Usuarios
//$router->addRoute('get','/users',[\App\Controller\UsuarioController::class,'index']);


//Usuario API
//$router->addRoute('post','/api/users/{id}',[\App\Controller\UsuarioController::class,'store']);

$router->resolver($_SERVER['REQUEST_METHOD'],$_SERVER['REQUEST_URI']);

