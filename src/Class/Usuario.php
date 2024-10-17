<?php

namespace Class;
use Class\Enum\TipoUsuario;
use DateTime;

class Usuario
{
    private string $username;
    private string $password;
    private string $dni;
    private string $correoelectronico;
    private DateTime $fechanac;
    private string $nombre;
    private string $apellidos;
    private string $direccion;
    private array $telefonos;
    private array $reservas;
    private float $calificacion;
    private string $tarjetaPago;
    private array $datosAdicionales;
    private TipoUsuario $tipo;

    //Métodos de la clase Usuario

    public function __construct()
    {
        $this->reservas=array();
        $this->telefonos=array();
        $this->datosAdicionales=array();
        $this->calificacion=3;
        $this->tipo=TipoUsuario::USER;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): Usuario
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password):Usuario
    {
        $this->password = $password;
        return $this;
    }

    public function getDni(): string
    {
        return $this->dni;
    }

    public function setDni(string $dni): Usuario
    {
        $this->dni = $dni;
        return $this;
    }

    public function getCorreoelectronico(): string
    {
        return $this->correoelectronico;
    }

    public function setCorreoelectronico(string $correoelectronico): Usuario
    {
        $this->correoelectronico = $correoelectronico;
        return $this;
    }

    public function getFechanac(): DateTime
    {
        return $this->fechanac;
    }

    public function setFechanac(DateTime $fechanac): Usuario
    {
        $this->fechanac = $fechanac;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Usuario
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): Usuario
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): Usuario
    {
        $this->direccion = $direccion;
        return $this;
    }

    public function getTelefonos(): array
    {
        return $this->telefonos;
    }

    public function setTelefonos(array $telefonos): Usuario
    {
        $this->telefonos = $telefonos;
        return $this;
    }

    public function getReservas(): array
    {
        return $this->reservas;
    }

    public function setReservas(array $reservas): Usuario
    {
        $this->reservas = $reservas;
        return $this;
    }

    public function getCalificacion(): float
    {
        return $this->calificacion;
    }

    public function setCalificacion(float $calificacion): Usuario
    {
        $this->calificacion = $calificacion;
        return $this;
    }

    public function getTarjetaPago(): string
    {
        return $this->tarjetaPago;
    }

    public function setTarjetaPago(string $tarjetaPago): Usuario
    {
        $this->tarjetaPago = $tarjetaPago;
        return $this;
    }

    public function getDatosAdicionales(): array
    {
        return $this->datosAdicionales;
    }

    public function setDatosAdicionales(array $datosAdicionales): Usuario
    {
        $this->datosAdicionales = $datosAdicionales;
        return $this;
    }

    public function getTipo(): TipoUsuario
    {
        return $this->tipo;
    }

    public function setTipo(TipoUsuario $tipo): Usuario
    {
        $this->tipo = $tipo;
        return $this;
    }


    //Espacio para funciones definidas por el programador

    public function calcularCalificacion():float{

        //TODO Pensar como calificar a una persona dentro de la app

        return 0.0;
    }




}