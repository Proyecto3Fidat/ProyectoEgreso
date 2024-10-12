<?php

namespace App\Repositories;

class RutinaRepository extends Database
{

    public function crearRutina($series, $repeticiones, $dia)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Rutina (series, repeticiones, dia) VALUES (?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('iis', $series, $repeticiones, $dia);
        $stmt->execute();
        $last_id = $stmt->insert_id;
        $stmt->close();
        $database->disconnect();
        return $last_id;
    }

    public function obtenerRutinas()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM Rutina";
        $result = $database->getConnection()->query($sql);
        $rutinas = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rutina = [
                    'idRutina' => $row['idRutina'],
                    'series' => $row['series'],
                    'repeticiones' => $row['repeticiones'],
                    'dia' => $row['dia']
                ];
                array_push($rutinas, $rutina);
            }
        }
        $database->disconnect();
        return $rutinas;
    }
}