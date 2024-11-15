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


        //Creación de la consulta SQL
        $sql = "INSERT INTO user(uuid,
                 username,
                 password,
                 dni,
                 correoelectronico,
                 fechanac,
                 nombre,
                 apellidos,
                 direccion,
                 califacion,
                 tarjetapago,
                 datosadicionales,
                 tipo) values(:uuid,:username,:password,:dni,:correoelectronico,STR_TO_DATE(:fechanac,'%d/%m/%Y'),
                              :nombre,:apellidos,:direccion,:calificacion,:tarjetapago,
                              :datosadicionales,:tipo)";

        $sqltelefono= "INSERT INTO telefono(prefijo,numero,uuid_usuario)
                        VALUES (:prefijo,:numero,:uuid_usuario)";

        $sentenciaPreparada= $conexion->prepare($sql);
        $sentenciaPreparadaTelefono = $conexion->prepare($sqltelefono);

        //Enlazado de parámetros dentro de la consulta
        $sentenciaPreparada->bindValue("uuid",$usuario->getUuid());
        $sentenciaPreparada->bindValue("username",$usuario->getUsername());
        $sentenciaPreparada->bindValue("password",$usuario->getPassword());
        $sentenciaPreparada->bindValue("dni",$usuario->getDni());
        $sentenciaPreparada->bindValue("correoelectronico",$usuario->getCorreoelectronico());
        $sentenciaPreparada->bindValue("fechanac",$usuario->getFechanac()->format('d/m/Y'));
        $sentenciaPreparada->bindValue("nombre",$usuario->getNombre());
        $sentenciaPreparada->bindValue("apellidos",$usuario->getApellidos());
        $sentenciaPreparada->bindValue("direccion",$usuario->getDireccion());
        $sentenciaPreparada->bindValue("calificacion",$usuario->getCalificacion());
        $sentenciaPreparada->bindValue("tarjetapago",$usuario->getTarjetaPago());
        $sentenciaPreparada->bindValue("datosadicionales",$usuario->getDatosAdicionales());
        $sentenciaPreparada->bindValue("tipo",$usuario->getTipo()->name);

        //Ejecución de la consulta contra la base de datos
        //Necesitamos guardar el usuario antes de guardar el telefono para que la FK funcione
        $sentenciaPreparada->execute();

        //Realizamos un bucle para guardar todos los telefonos asociados
        foreach ($usuario->getTelefonos() as $telefono){
            $sentenciaPreparadaTelefono->bindValue("prefijo",$telefono->getPrefijo());
            $sentenciaPreparadaTelefono->bindValue("numero",$telefono->getNumero());
            $sentenciaPreparadaTelefono->bindValue("uuid_usuario",$usuario->getUuid());
            $sentenciaPreparadaTelefono->execute();
        }

    }

    public static function borrarUsuario(string $uuidUsuario){

    }

}