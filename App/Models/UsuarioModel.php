<?php
namespace App\Models;

class UsuarioModel{
    private $nroDocumento;
    private $rol;
    private $passwd;

    public function __construct($nroDocumento, $passwd, $rol){
        $this->nroDocumento = $nroDocumento;
        $this->rol = $rol;
        $passwdHASH = password_hash($passwd, PASSWORD_DEFAULT);
        $this->passwd = $passwdHASH;
        }

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
