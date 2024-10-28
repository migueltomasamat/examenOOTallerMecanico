<?php
include_once "Class/Usuario.php";
include_once "Class/Enum/TipoUsuario.php";
include_once "Class/Telefono.php";

use Class\Usuario;
use Class\Enum\TipoUsuario;
use Class\Telefono;
echo "Esto son ejemplos de orientado a objetos en PHP";


$usuario = new Usuario();

//Esta es la forma de acceder a un array si este está establecido con vi
$arrayReservas=$usuario->getReservas();
$arrayReservas[]="hola";

$usuario->setReservas($arrayReservas);

$usuario->reservas[]="adios";

echo "<br>";
print_r($usuario->reservas);

$usuario->setUsername("charlie")
    ->setNombre("Carlos")
    ->setApellidos("González Martinez")
    ->setDni("12345678A");

$usuario->setTipo(TipoUsuario::ADMIN);

$telefono = new Telefono("+34","658121314");

$usuario->telefonos[]=$telefono;

echo "<br>";
print_r($usuario->telefonos);

echo "<br>";
var_dump($usuario);

phpinfo();