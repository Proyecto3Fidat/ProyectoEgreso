<?php
namespace App\Models;
class PacienteModel
{
    private $nroDocumento;
    private $tipoDocumento;
    private $fisioterapia;


    public function __construct($nroDocumento, $tipoDocumento, $fisioterapia)
    {
        $this->nroDocumento = $nroDocumento;
        $this->tipoDocumento = $tipoDocumento;
        $this->fisioterapia = $fisioterapia;
    }
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
    public function getFisioterapia()
    {
        return $this->fisioterapia;
    }
    public function setFisioterapia($fisioterapia)
    {
        $this->fisioterapia = $fisioterapia;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

}