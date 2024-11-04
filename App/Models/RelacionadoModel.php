<?php

namespace App\Models;

class RelacionadoModel
{
    private $idClub;
  private $nombre;
  private $nroDocumento;
    private $tipoDocumento;

    public function __construct($idClub,$nombre, $nroDocumento, $tipoDocumento)
    {
        $this->idClub = $idClub;

        $this->nombre = $nombre;
        $this->nroDocumento = $nroDocumento;
        $this->tipoDocumento = $tipoDocumento;
    }

    public function getIdClub()
    {
        return $this->idClub;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
    }
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }

    public function setIdClub($idClub)
    {
        $this->idClub = $idClub;
    }

}