<?php

namespace App\Models;

class RealizaModel
{
    private $fechaPago;
    private $nombre;
    private $idPago;

    public function __construct($fechaPago, $nombre, $idPago){
        $this->fechaPago = $fechaPago;
        $this->nombre = $nombre;
        $this->idPago = $idPago;
    }


    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }


    public function getIdPago()
    {
        return $this->idPago;
    }


    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;
        return $this;
    }

}