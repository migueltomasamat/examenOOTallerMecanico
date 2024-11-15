<?php
namespace App\Class;

include_once "Enum/TipoUsuario.php";
use App\Class\Enum\TipoUsuario;
use App\Model\UsuarioModel;
use DateTime;
use Ramsey\Uuid\Uuid;
use Respect\Validation\Validator;
use Respect\Validation\Exceptions\NestedValidationException;

/**
 *
 */
class Usuario
{
    /**
     * @var string
     */
    private string $uuid;
    /**
     * @var string
     */
    private string $username;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var string
     */
    private string $dni;
    /**
     * @var string
     */
    private string $correoelectronico;
    /**
     * @var DateTime
     */
    private DateTime $fechanac;
    /**
     * @var string
     */
    private string $nombre;
    /**
     * @var string
     */
    private string $apellidos;
    /**
     * @var string
     */
    private string $direccion;
    /**
     * @var array
     */
    public ?array $telefonos;
    /**
     * @var array
     */
    public ?array $reservas;
    /**
     * @var float|int
     */
    private float $calificacion;
    /**
     * @var string
     */
    private ?string $tarjetaPago;
    /**
     * @var array
     */
    public ?array $datosAdicionales;
    /**
     * @var TipoUsuario
     */
    private TipoUsuario $tipo;

    //Métodos de la clase Usuario

    /**
     *
     */
    public function __construct()
    {
        $this->reservas=null;
        $this->telefonos=null;
        $this->datosAdicionales=null;
        $this->tarjetaPago=null;
        $this->calificacion=3;
        $this->tipo=TipoUsuario::USER;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername(string $username): Usuario
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password):Usuario
    {
        $this->password = password_hash($password,PASSWORD_DEFAULT);
        return $this;
    }

    /**
     * @return string
     */
    public function getDni(): string
    {
        return $this->dni;
    }

    /**
     * @param string $dni
     * @return $this
     */
    public function setDni(string $dni): Usuario
    {
        $this->dni = $dni;
        return $this;
    }

    /**
     * @return string
     */
    public function getCorreoelectronico(): string
    {
        return $this->correoelectronico;
    }

    /**
     * @param string $correoelectronico
     * @return $this
     */
    public function setCorreoelectronico(string $correoelectronico): Usuario
    {
        $this->correoelectronico = $correoelectronico;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getFechanac(): DateTime
    {
        return $this->fechanac;
    }

    /**
     * @param DateTime $fechanac
     * @return $this
     */
    public function setFechanac(DateTime $fechanac): Usuario
    {
        $this->fechanac = $fechanac;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return $this
     */
    public function setNombre(string $nombre): Usuario
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     * @return $this
     */
    public function setApellidos(string $apellidos): Usuario
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    /**
     * @return string
     */
    public function getDireccion(): string
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     * @return $this
     */
    public function setDireccion(string $direccion): Usuario
    {
        $this->direccion = $direccion;
        return $this;
    }

    /**
     * @return array
     */
    public function getTelefonos(): ?array
    {
        return $this->telefonos;
    }

    /**
     * @param array $telefonos
     * @return $this
     */
    public function setTelefonos(array $telefonos): Usuario
    {
        $this->telefonos = $telefonos;
        return $this;
    }

    /**
     * @return array
     */
    public function getReservas(): ?array
    {
        return $this->reservas;
    }

    /**
     * @param array $reservas
     * @return $this
     */
    public function setReservas(array $reservas): Usuario
    {
        $this->reservas = $reservas;
        return $this;
    }

    /**
     * @return float
     */
    public function getCalificacion(): float
    {
        return $this->calificacion;
    }

    /**
     * @param float $calificacion
     * @return $this
     */
    public function setCalificacion(float $calificacion): Usuario
    {
        $this->calificacion = $calificacion;
        return $this;
    }

    /**
     * @return string
     */
    public function getTarjetaPago(): ?string
    {
        return $this->tarjetaPago;
    }

    /**
     * @param string $tarjetaPago
     * @return $this
     */
    public function setTarjetaPago(string $tarjetaPago): Usuario
    {
        $this->tarjetaPago = $tarjetaPago;
        return $this;
    }

    /**
     * @return array
     */
    public function getDatosAdicionales(): ?array
    {
        return $this->datosAdicionales;
    }

    /**
     * @param array $datosAdicionales
     * @return $this
     */
    public function setDatosAdicionales(array $datosAdicionales): Usuario
    {
        $this->datosAdicionales = $datosAdicionales;
        return $this;
    }

    /**
     * @return TipoUsuario
     */
    public function getTipo(): TipoUsuario
    {
        return $this->tipo;
    }

    /**
     * @param TipoUsuario $tipo
     * @return $this
     */
    public function setTipo(TipoUsuario $tipo): Usuario
    {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     * @return $this
     */
    public function setUuid(string $uuid): Usuario
    {
        $this->uuid = $uuid;
        return $this;
    }


    //Espacio para funciones definidas por el programador

    /**
     * @return float
     */
    public function calcularCalificacion():float{

        //TODO Pensar como calificar a una persona dentro de la app

        return 0.0;
    }

    /**
     * @param array $datosUsuario
     * @return false|array
     */
    public static function filtrarDatosUsuario(array $datosUsuario):false|array
    {
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
                ->assert($datosUsuario);

        } catch (NestedValidationException $exception) {
            return $exception->getMessages();
        }

        return false;
    }

    /**
     * @param array $datosUsuario
     * @return Usuario
     */
    public static function crearUsuarioAPartirDeUnArray(array $datosUsuario):Usuario{

        $usuario = new Usuario();
        $usuario->setUuid(Uuid::uuid4());
        $usuario->setUsername($datosUsuario['usernick']??"Sin nick");
        $usuario->setNombre($datosUsuario['username']??"Sin nombre");
        $usuario->setApellidos($datosUsuario['usersurname']??"Sin apellidos");
        $usuario->setCorreoelectronico($datosUsuario['useremail']??"Sin nombre");

        //Además de almacenar el password lo encriptamos
        $usuario->setPassword(password_hash($datosUsuario['userpass'],PASSWORD_DEFAULT)??"Sin password");
        $usuario->setDireccion($datosUsuario['useradress']??"Sin direccion");
        $usuario->setDni($datosUsuario['userdni']??"00000000A");
        $usuario->setFechanac(DateTime::createFromFormat('d/m/Y',$datosUsuario['userbirthdate']));
        $telefonos=[];

        if (isset($datosUsuario['userphone'])){
            $telefono=Telefono::crearTelefonoDesdeString($datosUsuario['userphone']);
            $telefonos[]=$telefono;
        }
        if (isset($datosUsuario['useraltphone'])){
            $telefono=Telefono::crearTelefonoDesdeString($datosUsuario['useraltphone']);
            $telefonos[]=$telefono;
        }

        $usuario->setTelefonos($telefonos);


        return $usuario;
    }

    /**
     * @return void
     */
    public function save(){
        UsuarioModel::guardarUsuario($this);
    }


}