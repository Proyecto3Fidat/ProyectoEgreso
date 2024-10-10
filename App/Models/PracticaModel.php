<?php

namespace App\Models;

class PracticaModel
{
    private $idRutina;
    private $nroDocumento;
    private $tipoDocumento;

    public function __construct($idRutina, $nroDocumento, $tipoDocumento)
    {
        $this->idRutina = $idRutina;
        $this->nroDocumento = $nroDocumento;
        $this->tipoDocumento = $tipoDocumento;
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

    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
        return $this;
    }

    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
        return $this;
    }


}