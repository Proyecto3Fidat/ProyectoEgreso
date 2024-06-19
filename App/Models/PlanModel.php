<?php

namespace App\Models;

class PlanModel {
    private $nombre;
    private $descripcion;
    private $tipoPlan;

    public function __construct($nombre, $descripcion, $tipoPlan) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->tipoPlan = $tipoPlan;
    }


    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getTipoPlan() {
        return $this->tipoPlan;
    }
 
 
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setTipoPlan($tipoPlan) {
        $this->tipoPlan = $tipoPlan;
    }
}
?>
 