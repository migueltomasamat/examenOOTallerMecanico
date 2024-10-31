<?php

namespace Controller;
include_once "InterfaceController.php";

class ClienteController implements InterfaceController
{
    //GET /clients
    public function index(){
        //include_once "../View/Users/indexUser.php";
    }

    //GET /clients/create
    public function create(){
        //Aquí mostraríamos el formulario de registro
        echo "Formulario de registro de un cliente";

    }

    //POST /clients
    public function store(){
        //Guardaría en la base de datos el usuario
        echo "Función para guardar un cliente";
    }

    //GET /clients/{id_usuario}/edit
    public function edit($id){
        //Mostraría un formulario con los datos del usuario
        echo "Formulario para editar los datos del cliente $id";

    }


    //PUT /clients/{id_usuario}
    public function update($id){
        //Guardaría los datos modificados del usuario
        echo "Función para actualizar los datos en la BD del cliente $id";

    }


    //GET /clients/{id_usuario}
    public function show($id){
        //Mostraría los datos de un solo usuario
        echo "Mostar los datos del cliente $id";
    }


    //DELETE /clients/{id_usuario}
    public function destroy($id){
        //Borrar los datos de un usuario
        echo "Función para borrar los datos del cliente $id";
    }

}