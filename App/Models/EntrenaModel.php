<?php

namespace App\Models;

class EntrenaModel
{
    private $documento;
    private $tipoDocumento;
    private $nombre;
    public function __construct($documento, $tipoDocumento, $nombre)
    {
        $this->documento = $documento;
        $this->tipoDocumento = $tipoDocumento;
        $this->nombre = $nombre;
    }
    public function getDocumento()
    {
        return $this->documento;
    }
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setDocumento($documento)
    {
        $this->documento = $documento;
    }
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

}