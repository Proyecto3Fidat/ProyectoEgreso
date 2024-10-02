<?php

namespace App\Models;

class EligeModel
{
    private $tipoDocumento;
    private $nroDocumento;


    public function __construct($nroDocumento, $tipoDocumento){
        $this->nroDocumento = $nroDocumento;
        $this->tipoDocumento = $tipoDocumento;
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


    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }


    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
        return $this;
    }

}