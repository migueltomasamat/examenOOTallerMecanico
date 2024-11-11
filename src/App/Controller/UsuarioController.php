<?php

namespace App\Controller;
use App\Class\Usuario;
use App\Controller\InterfaceController;
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
        //Guardaría en la base de datos el usuario
        var_dump($_POST);


        //Validación del usuario
        var_dump(Usuario::filtrarDatosUsuario($_POST));


        //Creación del usuario
        echo "Función para guardar un usuario";
    }

    //GET /users/{id_usuario}/edit
    public function edit($id){
        //Mostraría un formulario con los datos del usuario
        echo "Formulario para editar los datos del usuario $id";

    }


    //PUT /users/{id_usuario}
    public function update($id){
        //Guardaría los datos modificados del usuario
        echo "Función para actualizar los datos en la BD del usuario $id";

    }


    //GET /users/{id_usuario}
    public function show($id){
        //Mostraría los datos de un solo usuario
        echo "Mostar los datos del usuario $id";
    }


    //DELETE /users/{id_usuario}
    public function destroy($id){
        //Borrar los datos de un usuario
        echo "Función para borrar los datos del usuario $id";
    }

}