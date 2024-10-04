<?php

namespace App\Repositories;

class RealizaRepository extends Database
{

    public function actualizarPago($id, $realiza)
    {
        $idPago = $id;
        $fechaPago = $realiza->getFechaPago();
        $nombreplan = $realiza->getNombrePlan();
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Realiza (idPago, fechaPago, nombrePlan) VALUES (?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('iss', $idPago, $fechaPago, $nombreplan);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
}