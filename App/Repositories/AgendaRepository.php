<?php

namespace App\Repositories;

class AgendaRepository
{

    public function crearAgenda($dia, $horaInicio, $horaFin, $agendados)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Agenda (dia, horaInicio, horaFin, agendados) VALUES (?, ?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('ssss', $dia, $horaInicio, $horaFin, $agendados);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function obtenerAgendas()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM Agenda";
        $result = $database->getConnection()->query($sql);
        $agendas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $agendas[] = $row;
            }
        }
        $database->disconnect();
        return $agendas;
    }
}