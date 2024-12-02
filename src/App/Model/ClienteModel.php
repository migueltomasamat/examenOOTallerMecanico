<?php

namespace App\Model;

use App\Class\Cliente;
use PDO;
use PDOException;

class ClienteModel
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

    public static function guardarCliente(Cliente $cliente){
        // TODO
        //Crear una conexión con la base de datos
        $conexion = ClienteModel::conectarBD();

        //Creación de la consulta SQL
        $sql = "INSERT INTO client(clientuuid,
                 useruuid,
                 clientname,
                 clientaddress,
                 clientisopen,
                 clientcost) values(:clientuuid,
                                    :useruuid,
                                    :clientname,
                                    :clientaddress,
                                    :clientisopen,
                                    :clientcost)";


    }

    public static function borrarCliente(string $uuidCliente):bool{
        // TODO
        //Crear una conexión con la base de datos
        $conexion = ClienteModel::conectarBD();

        return false;
    }

    public static function editarCliente(Cliente $cliente):?Cliente{
        // TODO
        //Crear una conexión con la base de datos
        $conexion = ClienteModel::conectarBD();

        return null;
    }

    public static function leerUsuario($uuidCliente):?Cliente{
        // TODO
        //Crear una conexión con la base de datos
        $conexion = ClienteModel::conectarBD();

        return null;
    }

    public static function comprobarCliente(string $uuidCliente):false|Cliente{
        // TODO
        //Crear una conexión con la base de datos
        $conexion = ClienteModel::conectarBD();

        return false;
    }


}