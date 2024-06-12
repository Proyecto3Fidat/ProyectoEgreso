<?php
namespace App\Models;

class ClienteModel{
    private $nroDocumento;
    private $tipoDocumento;
    private $rol;
    private $passwd;
    private $altura;
    private $peso;
    private $calle;
    private $numero;
    private $esquina;
    private $email;
    private $patologias;
    private $puntuacion;
    private $fechaNacimiento;
    private $nombre;
    private $apellido;

    // Constructor
    public function __construct($nroDocumento, $tipoDocumento, $rol, $passwd, $altura, $peso, $calle, $numero, $esquina, $email, $patologias, $puntuacion, $fechaNacimiento, $nombre, $apellido)
    {
        $this->nroDocumento = $nroDocumento;
        $this->tipoDocumento = $tipoDocumento;
        $this->rol = $rol;
        $this->passwd = $passwd;
        $this->altura = $altura;
        $this->peso = $peso;
        $this->calle = $calle;
        $this->numero = $numero;
        $this->esquina = $esquina;
        $this->email = $email;
        $this->patologias = $patologias;
        $this->puntuacion = $puntuacion;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    // Getters and Setters
    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
    }

    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getPasswd()
    {
        return $this->passwd;
    }

    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

    public function getAltura()
    {
        return $this->altura;
    }

    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    public function getPeso()
    {
        return $this->peso;
    }

    public function setPeso($peso)
    {
        $this->peso = $peso;
    }

    public function getCalle()
    {
        return $this->calle;
    }

    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getEsquina()
    {
        return $this->esquina;
    }

    public function setEsquina($esquina)
    {
        $this->esquina = $esquina;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPatologias()
    {
        return $this->patologias;
    }

    public function setPatologias($patologias)
    {
        $this->patologias = $patologias;
    }

    public function getPuntuacion()
    {
        return $this->puntuacion;
    }

    public function setPuntuacion($puntuacion)
    {
        $this->puntuacion = $puntuacion;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

}

?>