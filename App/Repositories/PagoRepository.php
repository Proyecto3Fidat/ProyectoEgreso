<?php

namespace App\Repositories;

class PagoRepository extends Database
{
    public function actualizarPago($pago)
    {

        $ultimoMesAbonado = $pago->getUltimoMesAbonado();
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Pago (fechaVencimiento) VALUES (?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('s', $ultimoMesAbonado);
        $stmt->execute();
        $last__id = $stmt->insert_id;
        $stmt->close();
        $database->disconnect();
        return $last__id;
    }

    public function guardar(\App\Models\PagoModel $param)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Pago (fechaVencimiento) VALUES (?)";
        $stmt = $database->getConnection()->prepare($sql);
        $fechaVencimiento = $param->getUltimoMesAbonado();
        $stmt->bind_param('s', $fechaVencimiento);
        $stmt->execute();
        $last__id = $stmt->insert_id;
        $stmt->close();
        $database->disconnect();
        return $last__id;
    }
}