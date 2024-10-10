<?php

namespace App\Models;

class RutinaModel
{
    private $idRutina;
    private $repeticiones;
    private $series;
    private $dia;


    public function __construct($idRutina, $repeticiones, $series, $dia)
    {
        $this->idRutina = $idRutina;
        $this->repeticiones = $repeticiones;
        $this->series = $series;
        $this->dia = $dia;
    }


    public function getIdRutina()
    {
        return $this->idRutina;
    }

    public function setIdRutina($idRutina)
    {
        $this->idRutina = $idRutina;
        return $this;
    }
    public function getRepeticiones()
    {
        return $this->repeticiones;
    }


    public function setRepeticiones($repeticiones)
    {
        $this->repeticiones = $repeticiones;
        return $this;
    }


    public function getSeries()
    {
        return $this->series;
    }

    public function setSeries($series)
    {
        $this->series = $series;
        return $this;
    }
    public function getDia()
    {
        return $this->dia;
    }

    public function setDia($dia)
    {
        $this->dia = $dia;
        return $this;
    }

}