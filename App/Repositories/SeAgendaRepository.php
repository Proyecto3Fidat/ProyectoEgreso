<?php

namespace App\Repositories;

class SeAgendaRepository extends Database
{

    public function agendar($documento, $tipoDocumento, $dia, $horaInicio, $horaFin)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO SeAgenda (nroDocumento, tipoDocumento, dia, horaInicio, horaFin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("sssss", $documento, $tipoDocumento, $dia, $horaInicio, $horaFin);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
}