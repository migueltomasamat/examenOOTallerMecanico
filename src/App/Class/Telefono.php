<?php

namespace App\Class;

class Telefono
{
    private string $prefijo;
    private string $numero;

    public function __construct(string $prefijo,string$numero)
    {
        $this->prefijo=$prefijo;
        $this->numero=$numero;
    }

    public function getPrefijo(): string
    {
        return $this->prefijo;
    }

    public function setPrefijo(string $prefijo): Telefono
    {
        //TODO almacenar el prefijo siguiendo un estándar +34, +1-349
        $this->prefijo = $prefijo;
        return $this;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): Telefono
    {
        $this->numero = $numero;
        return $this;
    }


    //Espacio para la funciones definidas por el programador

    public static function comprobarPrefijo(string $prefijo):bool{

        //TODO implementar la funcion para comprobar un prefijo de teléfono
        return false;
    }

    public function obtenerTelefonoFormateado():string
    {
        //TODO implementar la función para unir dos teléfonos según un formato (+34) 657 245 378
        return "telefono formateado";
    }
}