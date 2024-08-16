<?php
namespace App\Models;
Class PacienteModel{
    private $nroDocumento;
    private $tipoDocumento;
    private $fisioterapia;
    private $estado;

    public function __construct($nroDocumento, $tipoDocumento, $fisioterapia, $estado) {
        $this->nroDocumento = $nroDocumento;    
        $this->tipoDocumento = $tipoDocumento;
        $this->fisioterapia = $fisioterapia;
        $this->estado = $estado;
    }
    public function getNroDocumento() {
        return $this->nroDocumento;
    }
    public function setNroDocumento($nroDocumento) {
        $this->nroDocumento = $nroDocumento;
    }
    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }
    public function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }
    public function getFisioterapia() {
        return $this->fisioterapia;
    }
    public function setFisioterapia($fisioterapia) {
        $this->fisioterapia = $fisioterapia;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    
}