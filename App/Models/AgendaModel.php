<?php

namespace App\Models;

class AgendaModel
{
    private $dia;
    private $horaInicio;
    private $horaFin;
    private $agendados;

    public function __construct($dia, $horaInicio, $horaFin, $agendados)
    {
        $this->dia = $dia;
        $this->horaInicio = $horaInicio;
        $this->horaFin = $horaFin;
        $this->agendados = $agendados;
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

    public function getAgendados()
    {
        return $this->agendados;
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

    public function setAgendados($agendados)
    {
        $this->agendados = $agendados;
    }


}