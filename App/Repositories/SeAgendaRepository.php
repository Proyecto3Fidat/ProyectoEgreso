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

    public function obtenerAgendas($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM SeAgenda WHERE nroDocumento = ?";
        $result = $database->getConnection()->prepare($sql);
        $result->bind_param("s", $nroDocumento);
        $result->execute();
        $result = $result->get_result();
        $agendas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $agenda = [
                    'nroDocumento' => $row['nroDocumento'],
                    'tipoDocumento' => $row['tipoDocumento'],
                    'dia' => $row['dia'],
                    'horaInicio' => $row['horaInicio'],
                    'horaFin' => $row['horaFin']
                ];
                array_push($agendas, $agenda);
            }
        }
        $result->close();
        $database->disconnect();
        return $agendas;
    }

    public function asistir($documento, $dia, $horaInicio, $horaFin, $asistencia)
    {
        // Verificamos que los tiempos estén en formato adecuado HH:MM:SS
        if (!preg_match('/^\d{2}:\d{2}:\d{2}$/', $horaInicio)) {
            throw new Exception('El formato de horaInicio es incorrecto: ' . $horaInicio);
        }
        if (!preg_match('/^\d{2}:\d{2}:\d{2}$/', $horaFin)) {
            throw new Exception('El formato de horaFin es incorrecto: ' . $horaFin);
        }

        $database = Database::getInstance();
        $database->connect();

        // Preparamos la consulta
        $sql = "UPDATE SeAgenda SET asistencia = ? WHERE nroDocumento = ? AND dia = ? AND horaInicio = ? AND horaFin = ?";
        $stmt = $database->getConnection()->prepare($sql);

        if ($stmt === false) {
            throw new Exception('Error preparando la consulta: ' . $database->getConnection()->error);
        }

        if (!$stmt->bind_param("sssss", $asistencia, $documento, $dia, $horaInicio, $horaFin)) {
            throw new Exception('Error al vincular los parámetros: ' . $stmt->error);
        }

        if (!$stmt->execute()) {
            throw new Exception('Error ejecutando la consulta: ' . $stmt->error);
        }

        if ($stmt->affected_rows === 0) {
            throw new Exception('No se actualizó ninguna fila. Verifica los parámetros.');
        }

        $stmt->close();

        $database->disconnect();
    }

    public function eliminarAgenda($dia, $horaInicio, $horaFin, $documento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "DELETE FROM SeAgenda WHERE dia = ? AND horaInicio = ? AND horaFin = ? AND nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("ssss", $dia, $horaInicio, $horaFin, $documento);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }


}