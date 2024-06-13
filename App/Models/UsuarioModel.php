<?php
namespace App\Models;

class UsuarioModel{
    private $nroDocumento;
    private $rol;
    private $passwd;

    // Constructor
    public function __construct($nroDocumento, $rol, $passwd)
    {
        $this->nroDocumento = $nroDocumento;
        $this->rol = $rol;
        $passwdHASH = password_hash($passwd, PASSWORD_DEFAULT);
        $this->passwd = $passwdHASH;
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

    public function setPasswd($passwd){
        $passwdHASH = password_hash($passwd, PASSWORD_DEFAULT);
        $this->passwd = $passwdHASH;
    }

}

?>