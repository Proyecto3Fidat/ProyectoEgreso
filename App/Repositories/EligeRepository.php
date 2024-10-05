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

    public function obtenerPagosPorDocumento($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();

        $sql = "SELECT pp.nombrePlan, pp.descripcion, pp.tipoPlan, r.fechaPago, r.idPago, p.fechaVencimiento, e.fechaPago AS fechaPagoElige, e.idPago AS idPagoElige
            FROM PlanPago pp
            JOIN Realiza r ON pp.nombrePlan = r.nombrePlan
            JOIN Pago p ON r.idPago = p.idPago
            JOIN Elige e ON r.fechaPago = e.fechaPago AND r.idPago = e.idPago
            WHERE e.nroDocumento = ?";

        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('s', $nroDocumento);
        $stmt->execute();
        $result = $stmt->get_result();

        $pagos = [];
        while ($row = $result->fetch_assoc()) {
            $pagos[] = $row;
        }

        $stmt->close();
        $database->disconnect();

        return $pagos;
    }
    public function eliminarPagosPorDocumento($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();

        $sqlElige = "DELETE FROM Elige WHERE nroDocumento = ?";
        $stmtElige = $database->getConnection()->prepare($sqlElige);
        $stmtElige->bind_param('s', $nroDocumento);
        $stmtElige->execute();
        $stmtElige->close();

        $sqlRealiza = "DELETE r FROM Realiza r
                   JOIN Elige e ON r.fechaPago = e.fechaPago AND r.idPago = e.idPago
                   WHERE e.nroDocumento = ?";
        $stmtRealiza = $database->getConnection()->prepare($sqlRealiza);
        $stmtRealiza->bind_param('s', $nroDocumento);
        $stmtRealiza->execute();
        $stmtRealiza->close();

        $sqlPago = "DELETE p FROM Pago p
                JOIN Realiza r ON p.idPago = r.idPago
                JOIN Elige e ON r.fechaPago = e.fechaPago AND r.idPago = e.idPago
                WHERE e.nroDocumento = ?";
        $stmtPago = $database->getConnection()->prepare($sqlPago);
        $stmtPago->bind_param('s', $nroDocumento);
        $stmtPago->execute();
        $stmtPago->close();

        $database->disconnect();

        return true;
    }

    public function eliminarPagosPorId($idPago)
    {
        $database = Database::getInstance();
        $database->connect();

        $sqlElige = "DELETE FROM Elige WHERE idPago = ?";
        $stmtElige = $database->getConnection()->prepare($sqlElige);
        $stmtElige->bind_param('i', $idPago);
        $stmtElige->execute();
        $stmtElige->close();

        $sqlRealiza = "DELETE FROM Realiza WHERE idPago = ?";
        $stmtRealiza = $database->getConnection()->prepare($sqlRealiza);
        $stmtRealiza->bind_param('i', $idPago);
        $stmtRealiza->execute();
        $stmtRealiza->close();

        $sqlPago = "DELETE FROM Pago WHERE idPago = ?";
        $stmtPago = $database->getConnection()->prepare($sqlPago);
        $stmtPago->bind_param('i', $idPago);
        $stmtPago->execute();
        $stmtPago->close();

        $database->disconnect();

        return true;
    }
}