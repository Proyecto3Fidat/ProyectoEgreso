<?php

class RutinaModel {
    private $series;
    private $repeticiones;
    private $dia;

    // Constructor
    public function __construct($series, $repeticiones, $dia) {
        $this->series = $series;
        $this->repeticiones = $repeticiones;
        $this->dia = $dia;
    }

    // Getters
    public function getSeries() {
        return $this->series;
    }

    public function getRepeticiones() {
        return $this->repeticiones;
    }

    public function getDia() {
        return $this->dia;
    }

    // Setters
    public function setSeries($series) {
        $this->series = $series;
    }

    public function setRepeticiones($repeticiones) {
        $this->repeticiones = $repeticiones;
    }

    public function setDia($dia) {
        $this->dia = $dia;
    }
}
?>