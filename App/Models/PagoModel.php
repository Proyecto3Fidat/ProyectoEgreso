<?php
namespace App\Models;

class PagoModel {
    private $ultimoMesAbonado;
    private $idPago;

    public function __construct($ultimoMesAbonado, $idPago) {
        $this->ultimoMesAbonado = $ultimoMesAbonado;
        $this->idPago = $idPago;
    }

    public function getUltimoMesAbonado() {
        return $this->ultimoMesAbonado;
    }

    public function getIdPago() {
        return $this->idPago;
    }

    public function setUltimoMesAbonado($ultimoMesAbonado) {
        $this->ultimoMesAbonado = $ultimoMesAbonado;
    }

    public function setIdPago($idPago) {
        $this->idPago = $idPago;
    }
}
?> 
 