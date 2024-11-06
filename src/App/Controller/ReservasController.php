<?php

namespace App\Controller;

use App\Controller\InterfaceController;

class ReservasController implements InterfaceController
{
    //GET /bookings
    public function index(){
        //include_once "../View/Users/indexUser.php";
    }

    //GET /bookings/create
    public function create(){
        //Aquí mostraríamos el formulario de registro
        echo "Formulario de registro de una reserva";

    }

    //POST /bookings
    public function store(){
        //Guardaría en la base de datos el usuario
        echo "Función para guardar una reserva";
    }

    //GET /bookings/{id_reserva}/edit
    public function edit($id){
        //Mostraría un formulario con los datos del usuario
        echo "Formulario para editar los datos de la reserva $id";

    }


    //PUT /bookings/{id_reserva}
    public function update($id){
        //Guardaría los datos modificados del usuario
        echo "Función para actualizar los datos en la BD de la reserva $id";

    }


    //GET /bookings/{id_reserva}
    public function show($id){
        echo "Mostar los datos de la reserva $id";
    }


    //DELETE /bookings/{id_reserva}
    public function destroy($id){
        echo "Función para borrar los datos de la reserva $id";
    }
}