<?php
namespace App\Models;

class AgendaModel {
    private $horaInicio;
    private $dias;
    private $fecha;
    private $horaFin;
    private $ciCliente;

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
    
    public function getCiCliente() {
        return $this->ciCliente;
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
    
    public function setciCliente($ciCliente) {
        $this->ciCliente = $ciCliente;
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
