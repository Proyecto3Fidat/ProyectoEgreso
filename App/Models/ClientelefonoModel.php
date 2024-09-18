<?php

namespace App\Models;

class ClientelefonoModel
{
    private $nroDocumento;
    private $telefono;
    private $tipoDocumento;

    public function __construct($nroDocumento, $telefono, $tipoDocumento)
    {
        $this->nroDocumento = $nroDocumento;
        $this->telefono = $telefono;
        $this->tipoDocumento = $tipoDocumento;
    }

    public function getNroDocumento()
    {
        return $this->nroDocumento;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    public function setNroDocumento($nroDocumento)
    {
        $this->nroDocumento = $nroDocumento;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }


}