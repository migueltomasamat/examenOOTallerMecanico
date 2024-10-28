<?php

namespace Controller;

class UsuarioController
{

    //GET /users
    public function index(){
        include_once "../View/Users/indexUser.php";
    }

    //GET /users/create
    public function create(){
        //Aquí mostraríamos el formulario de registro
    }

    //POST /users
    public function store(){
        //Guardaría en la base de datos el usuario
    }

    //GET /users/{id_usuario}/edit
    public function edit(){
        //Mostraría un formulario con los datos del usuario
    }


    //PUT /users/{id_usuario}
    public function update(){
        //Guardaría los datos modificados del usuario
    }


    //GET /users/{id_usuario}
    public function show(){
        //Mostraría los datos de un solo usuario
    }


    //DELETE /users/{id_usuario}
    public function destroy(){
        //Borrar los datos de un usuario
    }

}