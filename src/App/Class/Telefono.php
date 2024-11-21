<?php

namespace App\Class;
use JsonSerializable;

class Telefono implements JsonSerializable
{
    private string $prefijo;
    private string $numero;

    public function __construct(string$numero,string $prefijo="34")
    {
        $this->prefijo=$prefijo;
        $this->numero=$numero;
    }

    public function getPrefijo(): ?string
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

    public static function crearTelefonoDesdeString(string $telefono):?Telefono{
        $telefonoSinEspacios = trim($telefono);
        $numero= Telefono::obtenerNumeroDeUnString($telefonoSinEspacios);
        $prefijo = Telefono::obtenerPrefijoDeUnString($telefonoSinEspacios);

        if ($prefijo==null && $numero==null){
            return null;
        }elseif($numero==null){
            return null;
        }elseif($prefijo==null){
            return new Telefono($numero);
        }else{
            return new Telefono($numero,$prefijo);
        }



    }

    public static function crearTelefonosDesdeUnArray(array $telefonos):array{
        $arrayObjetosTelefono=[];
        foreach ($telefonos as $telefono){
            $arrayObjetosTelefono[]=new Telefono($telefono['phonenumber'],$telefono['phoneprefix']);
        }
        return $arrayObjetosTelefono;
    }

    private static function obtenerNumeroDeUnString(string $telefono):?string{
        $telefonoSinEspacios=trim($telefono);
        if (strlen($telefonoSinEspacios)<9){
            return null;
        }elseif(strlen($telefonoSinEspacios)==9){
            return $telefonoSinEspacios;
        }else{
            return substr($telefonoSinEspacios,-9);

        }
    }

    private static function obtenerPrefijoDeUnString(string $telefono):?string{

        if (strlen($telefono)>9){
            $telefonoSinEspacios=trim($telefono);
            $posicionDondeEmpiezaElTelefono = strlen($telefonoSinEspacios)-9;
            $prefijo=substr($telefonoSinEspacios,0,$posicionDondeEmpiezaElTelefono);
            $prefijoSinMierdas="";

            for($i=0;$i<strlen($prefijo);$i++){
                if (is_numeric($prefijo[$i])){
                    $prefijoSinMierdas.=$prefijo[$i];
                }
            }

            return $prefijoSinMierdas;
        }else {
            return null;
        }
    }
    public function jsonSerialize(): array
    {
        return [
            'prefijo'=>$this->prefijo,
            'numero'=>$this->numero
        ];
    }
}