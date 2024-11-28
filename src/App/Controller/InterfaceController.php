<?php

namespace App\Controller;

interface InterfaceController
{

    //GET /users
    public function index($api);

    //GET /users/create
    public function create($api);

    //POST /users
    public function store($api);


    //GET /users/{id_usuario}/edit
    public function edit($id,$api);


    //PUT /users/{id_usuario}
    public function update($id,$api);


    //GET /users/{id_usuario}
    public function show($id,$api);


    //DELETE /users/{id_usuario}
    public function destroy($id,$api);

}