<?php

namespace App\Repositories;

class EligeRepository
{

    public function actualizarPago($eligeModel)
    {
        $nroDocumento = $eligeModel->getNroDocumento();
        $tipoDocumento = $eligeModel->getTipoDocumento();
        $fechaPago = $eligeModel->getFechaPago();
        $nombrePlan = $eligeModel->getNombrePlan();
        $idPago = $eligeModel->getIdPago();
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Elige (nroDocumento, tipoDocumento, fechaPago, nombrePlan, idPago) VALUES (?, ?, ?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('ssssi', $nroDocumento, $tipoDocumento, $fechaPago, $nombrePlan, $idPago);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
}