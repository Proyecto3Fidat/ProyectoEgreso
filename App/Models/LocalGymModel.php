<?php

namespace App\Models;

class LocalGymModel
{

    private $nombre;
    private $calle;
    private $nroPuerta;
    private $esquina;
    private $capXTurno;

    public function __construct($nombre, $calle, $nroPuerta, $esquina, $capXTurno)
    {
        $this->nombre = $nombre;
        $this->calle = $calle;
        $this->nroPuerta = $nroPuerta;
        $this->esquina = $esquina;
        $this->capXTurno = $capXTurno;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getCalle()
    {
        return $this->calle;
    }

    public function getNroPuerta()
    {
        return $this->nroPuerta;
    }

    public function getEsquina()
    {
        return $this->esquina;
    }

    public function getCapXTurno()
    {
        return $this->capXTurno;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    public function setNroPuerta($nroPuerta)
    {
        $this->nroPuerta = $nroPuerta;
    }

    public function setEsquina($esquina)
    {
        $this->esquina = $esquina;
    }

    public function setCapXTurno($capXTurno)
    {
        $this->capXTurno = $capXTurno;
    }


}