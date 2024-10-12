<?php

namespace App\Models;

class ConformaModel
{
    private $nombre;
    private $dia;
    private $horaInicio;
    private $horaFin;

    public function __construct($nombre, $dia, $horaInicio, $horaFin)
    {
        $this->nombre = $nombre;
        $this->dia = $dia;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
    }


    public function getNombre()
    {
        return $this->nombre;
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

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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