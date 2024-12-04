<?php

namespace App\Controller;
use App\Class\Cliente;
use App\Class\Usuario;
use App\Class\Telefono;
use App\Excepcions\DeleteClientException;
use App\Excepcions\ReadClientException;
use App\Model\clienteModel;
use App\Controller\InterfaceController;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

include_once "InterfaceController.php";

class ClienteController implements InterfaceController
{
    //GET /clients
    public function index($api){
        //include_once __DIR__."../View/Users/indexClient.php";
    }

    //GET /clients/create
    public function create($api){
        //Aquí mostraríamos el formulario de registro
        echo "Formulario de registro de un cliente";
        //include_once __DIR__."/../View/Users/createClient.php";
    }

    //POST /clients
    public function store($api)
    {
        $errores = '';

        try {
            // Validación de los datos del cliente usando Respect\Validation
            Validator::key('clientname', Validator::stringType()->notEmpty()->length(1, 100))
                ->key('clientaddress', Validator::optional(Validator::stringType()->length(1, 255)))
                ->key('clientisopen', Validator::boolType())
                ->key('clientcost', Validator::numeric()->positive())
                ->key('useruuid', Validator::stringType()->notEmpty()->length(36, 36))
                ->assert($_POST);
        } catch (NestedValidationException $exception) {
            $errores = $exception->getMessages();
        }

        // Comprobamos si hubo errores en la validación
        if (is_array($errores) && !empty($errores)) {
            if ($api) {
                http_response_code(400);
                header('Content-Type: application/json');
                echo json_encode(['errores' => $errores]);
            } else {
                include_once __DIR__ . "/../View/Clients/errorClient.php";
            }
            return;
        }

        // Crear un cliente y verificar disponibilidad
        try {
            $cliente = new ConcreteCliente(uniqid());
            $cliente->setNombre($_POST['clientname'])
                ->setDireccion($_POST['clientaddress'] ?? '')
                ->setAbierto((bool)$_POST['clientisopen'])
                ->setCoste((float)$_POST['clientcost']);

            // Usuario asociado
            $usuario = UsuarioModel::leerUsuario($_POST['useruuid']);
            $cliente->setUsuario($usuario);

            // Verificar disponibilidad específica (implementado en la clase concreta)
            if (!$cliente->comprobarDisponibilidad()) {
                throw new Exception('El cliente no está disponible.');
            }

            // Guardar cliente y teléfonos
            ClienteModel::guardarCliente($cliente);

            if ($api) {
                http_response_code(201);
                header('Content-Type: application/json');
                echo json_encode($cliente);
            } else {
                $informacion = ['Se ha creado el cliente correctamente'];
                include_once __DIR__ . "/../View/Info/info.php";
            }
        } catch (Exception $e) {
            if ($api) {
                http_response_code(500);
                header('Content-Type: application/json');
                echo json_encode(['error' => $e->getMessage()]);
            } else {
                $errores = [$e->getMessage()];
                include_once __DIR__ . "/../View/Clients/errorClient.php";
            }
        }
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