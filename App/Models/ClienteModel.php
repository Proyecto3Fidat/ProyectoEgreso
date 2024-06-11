<?php
namespace App\Model;

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
    private $puntMinima;
    private $puntMaxima;
    private $fechaNacimiento;
    private $primerNombre;
    private $segundoNombre;
    private $primerApellido;
    private $segundoApellido;

    // Constructor
    public function __construct($nroDocumento, $tipoDocumento, $rol, $passwd, $altura, $peso, $calle, $numero, $esquina, $email, $patologias, $puntMinima, $puntMaxima, $fechaNacimiento, $primerNombre, $segundoNombre = null, $primerApellido, $segundoApellido = null)
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
        $this->puntMinima = $puntMinima;
        $this->puntMaxima = $puntMaxima;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->primerNombre = $primerNombre;
        $this->segundoNombre = $segundoNombre;
        $this->primerApellido = $primerApellido;
        $this->segundoApellido = $segundoApellido;
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

    public function getPuntMinima()
    {
        return $this->puntMinima;
    }

    public function setPuntMinima($puntMinima)
    {
        $this->puntMinima = $puntMinima;
    }

    public function getPuntMaxima()
    {
        return $this->puntMaxima;
    }

    public function setPuntMaxima($puntMaxima)
    {
        $this->puntMaxima = $puntMaxima;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getPrimerNombre()
    {
        return $this->primerNombre;
    }

    public function setPrimerNombre($primerNombre)
    {
        $this->primerNombre = $primerNombre;
    }

    public function getSegundoNombre()
    {
        return $this->segundoNombre;
    }

    public function setSegundoNombre($segundoNombre)
    {
        $this->segundoNombre = $segundoNombre;
    }

    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;
    }

    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;
    }
}

?>