<?php

namespace App\Controller;

interface InterfaceController
{

    //GET /users
    public function index();

    //GET /users/create
    public function create();

    //POST /users
    public function store();


    //GET /users/{id_usuario}/edit
    public function edit($id);


    //PUT /users/{id_usuario}
    public function update($id);


    //GET /users/{id_usuario}
    public function show($id);


    //DELETE /users/{id_usuario}
    public function destroy($id);

}