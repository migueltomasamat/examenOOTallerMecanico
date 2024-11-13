<?php

namespace App\Model;
use App\Class\Usuario;
use PDO;
use PDOException;

class UsuarioModel
{
    private static function conectarBD():?PDO{
        try{
            $conexion = new PDO("mysql:host=".NOMBRE_CONTAINER_DATABASE.";dbname=".NOMBRE_DATABASE
                ,USUARIO_DATABASE,
                PASS_DATABASE);

            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conexion;
        }catch(PDOException $e){
            echo "Fallo de conexión".$e->getMessage();
        }

        return null;
    }

    public static function guardarUsuario(Usuario $usuario){

        //Conexión a la base de datos

        $conexion= UsuarioModel::conectarBD();

        echo $conexion->getAttribute(PDO::ATTR_CONNECTION_STATUS)."<br>";
        echo $conexion->getAttribute(PDO::ATTR_DRIVER_NAME)."<br>";

        //Creación de la consulta SQL


        //Enlazado de parámetros dentro de la consulta


        //Ejecución de la consulta contra la base de datos

    }
}