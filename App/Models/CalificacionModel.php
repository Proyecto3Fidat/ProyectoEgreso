<?php
namespace App\Models;

CLass CalificacionModel{
   private $id;
   private $puntMaxima;
    private $fuerzaMusc;
    private $resMusc;
    private $resAnaerobica;
    private $resiliencia;
    private $flexibilidad;
    private $cumplAgenda;
    private $resMonotonia;
    
    public function __construct($id = null, $puntMaxima, $fuerzaMusc, $resMusc, $resAnaerobica, $resiliencia, $flexibilidad, $cumplAgenda, $resMonotonia){ 
        $this->id = $id;
        $this->puntMaxima = $puntMaxima;
        $this->fuerzaMusc = $fuerzaMusc;
        $this->resMusc = $resMusc;
        $this->resAnaerobica = $resAnaerobica;
        $this->resiliencia = $resiliencia;
        $this->flexibilidad = $flexibilidad;
        $this->cumplAgenda = $cumplAgenda;
        $this->resMonotonia = $resMonotonia;
    }
    public function getId(){
        return $this->id;
    }   
    public function getPuntMaxima(){
        return $this->puntMaxima;
    }
    public function getFuerzaMusc(){
        return $this->fuerzaMusc;
    }
    public function getResMusc(){
        return $this->resMusc;
    }
    public function getResAnaerobica(){
        return $this->resAnaerobica;
    }
    public function getResiliencia(){
        return $this->resiliencia;
    }
    public function getFlexibilidad(){
        return $this->flexibilidad;
    }
    public function getCumplAgenda(){
        return $this->cumplAgenda;
    }
    public function getResMonotonia(){
        return $this->resMonotonia;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setPuntMaxima($puntMaxima){
        $this->puntMaxima = $puntMaxima;
    }
    public function setFuerzaMusc($fuerzaMusc){
        $this->fuerzaMusc = $fuerzaMusc;
    }
    public function setResMusc($resMusc){
        $this->resMusc = $resMusc;
    }
    public function setResAnaerobica($resAnaerobica){
        $this->resAnaerobica = $resAnaerobica;
    }
    public function setResiliencia($resiliencia){
        $this->resiliencia = $resiliencia;
    }
    public function setFlexibilidad($flexibilidad){
        $this->flexibilidad = $flexibilidad;
    }
    public function setCumplAgenda($cumplAgenda){
        $this->cumplAgenda = $cumplAgenda;
    }
    public function setResMonotonia($resMonotonia){
        $this->resMonotonia = $resMonotonia;
    }
       
}