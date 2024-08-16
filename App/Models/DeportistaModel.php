<?php
namespace App\Models;
Class DeportistaModel{
    private $nroDocumento;
    private $tipoDocumento;
    private $deporte;
    private $posicion;  
    private $estado;

    public function __construct($nroDocumento, $tipoDocumento, $deporte, $posicion, $estado) {
        $this->var = $var;
    }
}