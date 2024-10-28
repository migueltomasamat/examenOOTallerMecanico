<?php

//include_once "View/landing.php";

echo "estoy en el index";

$router = new \Router\Router();

$router->addRoute('get','/',\Controller\UsuarioController::class,'index()');