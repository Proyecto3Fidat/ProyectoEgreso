<?php

class PagoModel {
    private $ultimoMesAbonado;
    private $idPago;

    public function __construct($ultimoMesAbonado, $idPago) {
        $this->ultimoMesAbonado = $ultimoMesAbonado;
        $this->idPago = $idPago;
    }

    // Getters
    public function getUltimoMesAbonado() {
        return $this->ultimoMesAbonado;
    }

    public function getIdPago() {
        return $this->idPago;
    }
 
    // Setters
    public function setUltimoMesAbonado($ultimoMesAbonado) {
        $this->ultimoMesAbonado = $ultimoMesAbonado;
    }

    public function setIdPago($idPago) {
        $this->idPago = $idPago;
    }
}
?> 
 