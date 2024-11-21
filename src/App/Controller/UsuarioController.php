<?php

namespace App\Controller;
use App\Class\Usuario;
use App\Controller\InterfaceController;
use App\Excepcions\DeleteUserException;
use App\Excepcions\ReadUserException;
use App\Model\UsuarioModel;
use Ramsey\Uuid\Uuid;
include_once "InterfaceController.php";


class UsuarioController implements InterfaceController
{

    //GET /users
    public function index(){
        include_once __DIR__."/../View/Users/indexUser.php";
    }

    //GET /users/create
    public function create(){
        //Aquí mostraríamos el formulario de registro
        include_once __DIR__."/../View/Users/createUser.php";

    }

    //POST /users
    public function store(){
        //Validación del usuario
        $errores=Usuario::filtrarDatosUsuario($_POST);
        if (is_array($errores)){
            include_once __DIR__."/../View/Users/errorUser.php";
        }else{
            $usuario=Usuario::crearUsuarioAPartirDeUnArray($_POST);
        }

        $usuario->save();

        //Creación del usuario
        echo json_encode($usuario);
    }

    //GET /users/{id_usuario}/edit
    public function edit($id){
        //Mostraría un formulario con los datos del usuario
        echo "Formulario para editar los datos del usuario $id";

    }


    //PUT /users/{id_usuario}
    public function update($id){
        //Guardaría los datos modificados del usuario
        $usuario = UsuarioModel::leerUsuario($id);

        //Leer de un ficheros de datos los valore de PUT
        //No existe $_PUT

        //Filtraremos esos datos

        //Almacenar los cambios en la base de datos
        try{
            //UsuarioModel::editarUsuario($usuario);
            $usuario->edit();

        }catch (EditUserException $e){
            $e->getMessage();
        }

    }


    //GET /users/{id_usuario}
    public function show($id){
        //Mostraría los datos de un solo usuario
        if (!Uuid::isValid($id)){
            //Mostrar un error id en formato invalido
        }else{
            try{
                UsuarioModel::leerUsuario($id);
            }catch(ReadUserException $e){
                $e->getMessage();
            }

        }
    }


    //DELETE /users/{id_usuario}
    public function destroy($id){
        //Borrar los datos de un usuario
        try {
            UsuarioModel::borrarUsuario($id);
            echo "Borrado correcto";
        }catch (DeleteUserException $e){
            echo $e->getMessage();
        }
    }

}