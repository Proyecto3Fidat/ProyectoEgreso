<?php

class Agenda {
    private $horaInicio;
    private $dias;
    private $fecha;
    private $horaFin;

    public function __construct($horaInicio, $dias, $fecha, $horaFin) {
        $this->horaInicio = $horaInicio;
        $this->dias = $dias;
        $this->fecha = $fecha;
        $this->horaFin = $horaFin;
    }

    // Getters
    public function getHoraInicio() {
        return $this->horaInicio;
    }

    public function getDias() {
        return $this->dias;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getHoraFin() {
        return $this->horaFin;
    }

    // Setters
    public function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;
    }

    public function setDias($dias) {
        $this->dias = $dias;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setHoraFin($horaFin) {
        $this->horaFin = $horaFin;
    }
}
?> 
