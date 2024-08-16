<?php
namespace App\Models;
Class DeportistaModel{
    private $nroDocumento;
    private $tipoDocumento;
    private $deporte;
    private $posicion;  
    private $estado;

    public function __construct($nroDocumento, $tipoDocumento, $deporte, $posicion, $estado) {
        $this->nroDocumento = $nroDocumento;    
        $this->tipoDocumento = $tipoDocumento;
        $this->deporte = $deporte;
        $this->posicion = $posicion;
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
    public function getDeporte() {
        return $this->deporte;
    }
    public function setDeporte($deporte) {
        $this->deporte = $deporte;
    }
    public function getPosicion() {
        return $this->posicion;
    }
    public function setPosicion($posicion) {
        $this->posicion = $posicion;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    
}