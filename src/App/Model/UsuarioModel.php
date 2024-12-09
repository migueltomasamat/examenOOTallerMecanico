<?php

namespace App\Model;
use App\Class\Telefono;
use App\Class\Usuario;
use App\Excepcions\DeleteUserException;
use App\Excepcions\EditUserException;
use App\Excepcions\ReadUserException;
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
        $sql = "INSERT INTO user(useruuid,
                 usernick,
                 userpass,
                 userdni,
                 useremail,
                 userbirthdate,
                 username,
                 usersurname,
                 useradress,
                 usermark,
                 usercard,
                 userdata,
                 usertype) values(:uuid,:username,:password,:dni,:correoelectronico,STR_TO_DATE(:fechanac,'%d/%m/%Y'),
                              :nombre,:apellidos,:direccion,:calificacion,:tarjetapago,
                              :datosadicionales,:tipo)";

        $sqltelefono= "INSERT INTO phone(phoneprefix,phonenumber,useruuid)
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
        $sentenciaPreparada->bindValue("datosadicionales",json_encode($usuario->getDatosAdicionales()));
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

    public static function borrarUsuario(string $uuidUsuario):bool{
        $conexion = UsuarioModel::conectarBD();

        $sql = "DELETE FROM user WHERE useruuid=?";

        $sentenciaPreparada = $conexion->prepare($sql);

        $sentenciaPreparada->bindValue(1,$uuidUsuario);

        $sentenciaPreparada->execute();

        //Gestionar los errores de ejecución
        if($sentenciaPreparada->rowCount()==0){
            throw new DeleteUserException();
        }else{
            return true;
        }
    }

    public static function leerUsuario($uuidUsuario):?Usuario{
        //Crear una conexión con la base de datos
        $conexion = UsuarioModel::conectarBD();

        //Crear una variable con la sentencia SQL que queremos ejecutar
        $sql = "SELECT useruuid,username,userdni,usersurname,userpass,useremail,useradress,
       DATE_FORMAT(userbirthdate,'%d/%m/%Y') as userbirthdate,
       usernick,usercard,userdata,usertype,usermark FROM user where useruuid=:uuid";

        //Preparar la sentencia a ejecutar
        $sentenciaPreparada=$conexion->prepare($sql);

        //Hacer la asignación de los parametros de la SQL al valor
        $sentenciaPreparada->bindValue('uuid',$uuidUsuario);

        //Ejecutar la consulta con los parametros ya cambiados en la base de datos
        $sentenciaPreparada->execute();

        if($sentenciaPreparada->rowCount()===0){
            //Se ha producido un error
            throw new ReadUserException();
        }else{
            //Leer de la base datos un usuario
            $datosUsuario = $sentenciaPreparada->fetch(PDO::FETCH_ASSOC);

            //Creamos la consulta necesaria para conseguir los telefonos de la tabla phone
            $sqlTelefonos = "SELECT phoneprefix,phonenumber FROM phone WHERE useruuid=?";
            $sentenciaTelefonos = $conexion->prepare($sqlTelefonos);
            $sentenciaTelefonos->execute([$uuidUsuario]);
            $telefonos=
                Telefono::crearTelefonosDesdeUnArray(
                    $sentenciaTelefonos->fetchAll(PDO::FETCH_ASSOC));

            $usuario=Usuario::crearUsuarioAPartirDeUnArray($datosUsuario);
            $usuario->setTelefonos($telefonos);
            return $usuario;
        }

    }

    public static function editarUsuario(Usuario $usuario):?Usuario{
        //Creamos la conexión a la base de datos
        $conexion =UsuarioModel::conectarBD();

        $sql="UPDATE user SET usernick=:usernick,
                     userpass=:userpass,
                     userdni=:userdni,
                     useremail=:useremail,
                     userbirthdate=STR_TO_DATE(:userbirthdate,'%d/%m/%Y'),
                     username=:username,
                     usersurname=:usersurname,
                     useradress=:useradress,
                     usermark=:usermark,
                     usercard=:usercard,
                     userdata=:userdata,
                     usertype=:usertype WHERE useruuid=:useruuid";

        $sentenciaPreparada=$conexion->prepare($sql);

        $sentenciaPreparada->bindValue("useruuid",$usuario->getUuid());
        $sentenciaPreparada->bindValue("usernick",$usuario->getUsername());
        $sentenciaPreparada->bindValue("userpass",$usuario->getPassword());
        $sentenciaPreparada->bindValue("userdni",$usuario->getDni());
        $sentenciaPreparada->bindValue("useremail",$usuario->getCorreoelectronico());
        $sentenciaPreparada->bindValue("userbirthdate",$usuario->getFechanac()->format('d/m/Y'));
        $sentenciaPreparada->bindValue("username",$usuario->getNombre());
        $sentenciaPreparada->bindValue("usersurname",$usuario->getApellidos());
        $sentenciaPreparada->bindValue("useradress",$usuario->getDireccion());
        $sentenciaPreparada->bindValue("usermark",$usuario->getCalificacion());
        $sentenciaPreparada->bindValue("usercard",$usuario->getTarjetaPago());
        $sentenciaPreparada->bindValue("userdata",json_encode($usuario->getDatosAdicionales()));
        $sentenciaPreparada->bindValue("usertype",$usuario->getTipo()->name);

        $sentenciaPreparada->execute();

        if ($sentenciaPreparada->rowCount()==0){
            throw new EditUserException();
        }else{
            return $usuario;
        }
    }

    public static function comprobarUsuario(string $username):false|Usuario{
        $conexion = UsuarioModel::conectarBD();

        $sql = "SELECT useruuid from user where usernick=?";

        $sentenciaPreparada= $conexion->prepare($sql);

        //Forma abreviada de ejecutar una consulta
        $sentenciaPreparada->execute([$username]);

        if ($sentenciaPreparada->rowCount()==0){
            return false;
        }else{
            $datosUsuario = $sentenciaPreparada->fetch(PDO::FETCH_ASSOC);
            return UsuarioModel::leerUsuario($datosUsuario['useruuid']);
        }

    }

    public static function obtenerUsuarios($filas=10000, $filadecomienzo=0):array{
        $conexion= UsuarioModel::conectarBD();

        $sql="SELECT useruuid,
                 usernick,
                 userpass,
                 userdni,
                 useremail,
                 DATE_FORMAT(userbirthdate,'%d/%m/%Y') as userbirthdate,
                 username,
                 usersurname,
                 useradress,
                 usermark,
                 usercard,
                 userdata,
                 usertype FROM user LIMIT ? OFFSET ?";

        $stmt=$conexion->prepare($sql);
        $stmt->bindValue(1,$filas,PDO::PARAM_INT);
        $stmt->bindValue(2,$filadecomienzo,PDO::PARAM_INT);

        $stmt->execute();
        $usuarios=$stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($usuarios as $usuario){
            $usuario=Usuario::crearUsuarioAPartirDeUnArray($usuario);
            $sql = "SELECT phoneprefix,phonenumber FROM phone WHERE useruuid=?";
            $stmt= $conexion->prepare($sql);
            $stmt->execute([$usuario->getuuid()]);
            $telefonos= $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($telefonos as $telefono){
                $arrayTelefonos[]=new Telefono($telefono['phonenumber'],$telefono['phoneprefix']);
            }
            $usuario->setTelefonos($arrayTelefonos);
            $arrayTelefonos=array();
            $arrayUsuarios[]=$usuario;
        }

        return $arrayUsuarios;
    }

    public static function numeroDeUsuarios():?int{
        $conexion=UsuarioModel::conectarBD();

        $resultado=$conexion->query("SELECT count(*) as numusers FROM user");
        $fila= $resultado->fetchAll();
        return $fila[0]['numusers'];


    }

    public static function obtenerUsuarioPorEmail(string $email){
        $conexion=UsuarioModel::conectarBD();

        $sql="SELECT * FROM user where useremail=:email";

        $stmt= $conexion->prepare($sql);

        $stmt->bindValue('email',$email);

        $stmt->execute();

        $resultado=$stmt->fetch();

        return Usuario::crearUsuarioAPartirDeUnArray($resultado);

    }



}