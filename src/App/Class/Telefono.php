<?php

namespace App\Class;

class Telefono
{
    private string $prefijo;
    private string $numero;

    public function __construct(string$numero,string $prefijo="+34")
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

        return isset($prefijos[$prefijo])?true:false;
    }

    public function obtenerTelefonoFormateado():string
    {
        //TODO implementar la función para unir dos teléfonos según un formato (+34) 657 245 378
        return "telefono formateado";
    }

    public static function crearTelefonoDesdeString(string $telefono):Telefono{
        $telefonoSinEspacios = trim($telefono);
        $numero= Telefono::obtenerNumeroDeUnString($telefonoSinEspacios);
        $prefijo = Telefono::obtenerPrefijoDeUnString($telefonoSinEspacios);
        return new Telefono($numero,$prefijo);
    }

    private static function obtenerNumeroDeUnString(string $telefono):string{

        return "falso";
    }

    private static function obtenerPrefijoDeUnString(string $telefono):string{


        return "falso";
    }
}