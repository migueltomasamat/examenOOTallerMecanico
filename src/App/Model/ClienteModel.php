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

        //Creación de la consulta SQL de los clientes.
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

        /* Creación de la consulta Telefono */
        $sqltelefono= "INSERT INTO phone(phoneprefix,phonenumber,useruuid)
                        VALUES (:prefijo,:numero,:uuid_usuario)";

        $sentenciaPreparada= $conexion->prepare($sql);
        $sentenciaPreparadaTelefono = $conexion->prepare($sqltelefono);

        //Enlazado de parámetros dentro de la consulta
        $sentenciaPreparada->bindValue("uuid",$cliente->getUuid());
        $sentenciaPreparada->bindValue("usuario",$cliente->getUsuario());
        $sentenciaPreparada->bindValue("nombre",$cliente->getNombre());
        $sentenciaPreparada->bindValue("direccion",$cliente->getDireccion());
        $sentenciaPreparada->bindValue("abierto",$cliente->isAbierto());
        $sentenciaPreparada->bindValue("coste",$cliente->getCoste());

        //Ejecución de la consulta contra la base de datos
        //Necesitamos guardar el usuario antes de guardar el telefono para que la FK funcione
        $sentenciaPreparada->execute();

        //Realizamos un bucle para guardar todos los telefonos asociados
        foreach ($cliente->getTelefonos() as $telefono){
            $sentenciaPreparadaTelefono->bindValue("prefijo",$telefono->getPrefijo());
            $sentenciaPreparadaTelefono->bindValue("numero",$telefono->getNumero());
            $sentenciaPreparadaTelefono->bindValue("uuid_usuario",$cliente->getUuid());
            $sentenciaPreparadaTelefono->execute();
        }

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