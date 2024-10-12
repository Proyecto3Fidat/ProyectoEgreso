<?php

namespace App\Models;

class SeAgendaModel
{
    private $nroDocumento;
    private $tipoDocumento;
    private $fecha;
    private $asistencia;

    public function __construct($nroDocumento, $tipoDocumento, $fecha, $asistencia)
    {
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

}