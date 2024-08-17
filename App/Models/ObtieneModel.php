<?php
namespace App\Models;

Class ObtieneModel{
    private $nroDocumento;
    private $tipoDocumento;
    private $id;

    private $fecha;
    private $puntuacionEsperado;
    private $puntuacionObtenido;

    public function __construct($nroDocumento, $tipoDocumento, $id, $fecha, $puntuacionEsperado, $puntuacionObtenido){
        $this->nroDocumento = $nroDocumento;
        $this->tipoDocumento = $tipoDocumento;
        $this->id = $id;
        $this->fecha = $fecha;
        $this->puntuacionEsperado = $puntuacionEsperado;
        $this->puntuacionObtenido = $puntuacionObtenido;
    }
    public function getNroDocumento(){
        return $this->nroDocumento;
    }
    public function getTipoDocumento(){
        return $this->tipoDocumento;
    }
    public function getId(){
        return $this->id;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getPuntuacionEsperado(){
        return $this->puntuacionEsperado;
    }
    public function getPuntuacionObtenido(){
        return $this->puntuacionObtenido;
    }
    public function setNroDocumento($nroDocumento){
        $this->nroDocumento = $nroDocumento;
    }
    public function setTipoDocumento($tipoDocumento){
        $this->tipoDocumento = $tipoDocumento;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }
    public function setPuntuacionEsperado($puntuacionEsperado){
        $this->puntuacionEsperado = $puntuacionEsperado;
    }
    public function setPuntuacionObtenido($puntuacionObtenido){
        $this->puntuacionObtenido = $puntuacionObtenido;
    }
    
}