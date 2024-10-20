<?php

namespace App\Repositories;

class ConformaRepository extends Database
{

    public function crearAgenda($dia, $horaInicio, $horaFin, $nombre)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Conforma (dia, horaInicio, horaFin, nombre) VALUES (?, ?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("ssss", $dia, $horaInicio, $horaFin, $nombre);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();

    }

    public function obtenerAgendas()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM Conforma";
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

    public function obtenerAsignados($nombre)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM Conforma WHERE nombre = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $result = $stmt->get_result();
        $asignados = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $asignados[] = $row;
            }
        }
        $stmt->close();
        $database->disconnect();
        return $asignados;
    }

    public function eliminarAgenda($dia, $horaInicio, $horaFin, $nombre)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "DELETE FROM Conforma WHERE dia = ? AND horaInicio = ? AND horaFin = ? AND nombre = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("ssss", $dia, $horaInicio, $horaFin, $nombre);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
}