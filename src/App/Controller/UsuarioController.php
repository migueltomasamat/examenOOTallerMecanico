<?php

namespace App\Controller;
use App\Class\Enum\TipoUsuario;
use App\Class\Telefono;
use App\Class\Usuario;
use App\Controller\InterfaceController;
use App\Excepcions\DeleteUserException;
use App\Excepcions\ReadUserException;
use App\Model\UsuarioModel;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;

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
        try {

            Validator::key('usernick', Validator::stringType()->notEmpty()->length(3, null))
                ->key('username', Validator::stringType())
                ->key('userdni', Validator::stringType()->length(9,9))
                ->key('usersurname', Validator::stringType())
                ->key('userpass', Validator::stringType()->length(8, null))
                ->key('useremail', Validator::email())
                ->key('userbirthdate', Validator::date('d/m/Y')->minAge(18, 'd/m/Y'))
                ->key('useradress', Validator::stringType())
                ->key('userphone', Validator::phone())
                ->key('useraltphone', Validator::optional(Validator::phone()),false)
                ->key('userdata', Validator::optional(Validator::json()),mandatory: false)
                ->assert($_POST);

        } catch (NestedValidationException $exception) {
            $errores=$exception->getMessages();
        }

        //Comprobamos si ha habido errores
        if (is_array($errores)){
            include_once __DIR__."/../View/Users/errorUser.php";
        }else{
            $usuario=Usuario::crearUsuarioAPartirDeUnArray($_POST);
        }

        //Guardamos el usuario
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
        parse_str(file_get_contents("php://input"),$datos_put_para_editar);

        //Filtraremos esos datos
        try {

            Validator::key('usernick', Validator::optional(Validator::stringType()->notEmpty()->length(3, null)),false)
                ->key('username', Validator::optional(Validator::stringType()),false)
                ->key('userdni', Validator::optional(Validator::stringType()->length(9,9)),false)
                ->key('usersurname', Validator::optional(Validator::stringType()),false)
                ->key('userpass', Validator::optional(Validator::stringType()->length(8, null)),false)
                ->key('useremail', Validator::optional(Validator::email()),false)
                ->key('userbirthdate', Validator::optional(Validator::date('d/m/Y')->minAge(18, 'd/m/Y')),false)
                ->key('useradress', Validator::optional(Validator::stringType()),false)
                ->key('userphone', Validator::optional(Validator::phone()),false)
                ->key('useraltphone', Validator::optional(Validator::phone()),false)
                ->key('userdata', Validator::optional(Validator::json()), false)
                ->assert($datos_put_para_editar);

        } catch (NestedValidationException $exception) {
            $errores=$exception->getMessages();
        }

        //Los datos no tienen errores

        $usuario->setUsername($datos_put_para_editar['usernick']??$usuario->getUsername());
        $usuario->setNombre($datos_put_para_editar['username']??$usuario->getNombre());
        $usuario->setApellidos($datos_put_para_editar['usersurname']??$usuario->getApellidos());
        $usuario->setCorreoelectronico($datos_put_para_editar['useremail']??$usuario->getCorreoelectronico());
        $usuario->setDireccion($datos_put_para_editar['useradress']??$usuario->getDireccion());
        $usuario->setDni($datos_put_para_editar['userdni']??$usuario->getDni());
        $usuario->setDatosAdicionales($datos_put_para_editar['userdata']??$usuario->getDatosAdicionales());
        $usuario->setCalificacion($datos_put_para_editar['usermark']??$usuario->getCalificacion());
        $usuario->setTarjetaPago($datos_put_para_editar['usercard']??$usuario->getTarjetaPago());

        //Comprobación para cifrar el nuevo password
        if (isset($datos_put_para_editar['userpass'])){
            $usuario->setPassword(password_hash($datos_put_para_editar['userpass'],PASSWORD_DEFAULT));
        }

        //Comprobación para transformar la fecha de string a DateTime
        if(isset($datos_put_para_editar['userbirthdate'])){
            $usuario->setFechanac(\DateTime::createFromFormat('d/m/Y',$datos_put_para_editar['userbirthdate']));
        }

        //Gestión de los teléfonos asociados al usuario
        $telefonos=$usuario->getTelefonos();
        if (isset($datos_put_para_editar['userphone'])){
            $telefonos[0]=Telefono::crearTelefonoDesdeString($datos_put_para_editar['userphone']);
        }
        if (isset($datos_put_para_editar['useraltphone'])){
            $telefonos[1]=Telefono::crearTelefonoDesdeString($datos_put_para_editar['userphone']);
        }

        $usuario->setTelefonos($telefonos);

        if (isset($datos_put_para_editar['usertype'])){
            $usuario->setTipo(TipoUsuario::convertirStringATipoUsuario($datos_put_para_editar['usertype']));
        }


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
        try{
            UsuarioModel::leerUsuario($id);
        }catch(ReadUserException $e){
            $errores[]=$e->getMessage();
            include_once DIRECTORIO_VISTAS."errores.php";
        }
    }


    //DELETE /users/{id_usuario}
    public function destroy($id){
        //Borrar los datos de un usuario
        try {
            UsuarioModel::borrarUsuario($id);
            echo "Borrado correcto";
        }catch (DeleteUserException $e){
            $errores[]=$e->getMessage();
            include_once DIRECTORIO_VISTAS."errores.php";

        }
    }

    public function verify(){
        //Tenemos que leer los datos del usuario que me han llegado por $_POST
        if (isset($_POST['username']) && isset($_POST['userpass'])){
            //Tenemos que verificar que el usuario exista y que la contrasña sea correcta
            $usuario= UsuarioModel::comprobarUsuario($_POST['username']);
            if (password_verify($_POST['userpass'],$usuario->getPassword())){
               //session_start();
               $_SESSION['username']=$usuario->getUsername();
               header('Location: /');
               exit();
            }else{
                $errores=['Login invalido'];
                //TODO modificar la vista Login para que se muestren los errores y se rellene el usuario
                echo "pass_incorrecto";
            }

            //Tenemos que guardar en la session $_SESSION algo
            // que nos permita identificar que el usuario está logeado
        }else{
            $errores=['Login invalido'];
            //TODO modificar la vista Login para que se muestren los errores y se rellene el usuario
            echo "usuario incorrecto";
        }


    }

}