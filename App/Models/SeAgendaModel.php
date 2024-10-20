<?php

namespace App\Models;

class SeAgendaModel
{
    private $nroDocumento;
    private $tipoDocumento;
    private $fecha;
    private $asistencia;

    public function __construct($nroDocumento, $tipoDocumento, $fecha, $asistencia, $dia, $horaInicio, $horaFin)
    {
        $this->dia = $dia;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        $this->nroDocumento = $nroDocumento;
        $this->tipoDocumento = $tipoDocumento;
        $this->fecha = $fecha;
        $this->asistencia = $asistencia;
    }

    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function getAsistencia()
    {
        return $this->asistencia;
    }

    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
    }

    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setAsistencia($asistencia)
    {
        $this->asistencia = $asistencia;
    }

    public function getDia()
    {
        return $this->dia;
    }

    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    public function getHoraFin()
    {
        return $this->horaFin;
    }

    public function setDia($dia)
    {
        $this->dia = $dia;
    }

    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;
    }

    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;
    }

    

}