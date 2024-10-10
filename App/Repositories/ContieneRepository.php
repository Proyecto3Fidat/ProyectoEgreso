<?php

namespace App\Repositories;

class ContieneRepository extends Database
{
    public function crearContiene($nombreCombo, $idEjercicio)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Contiene (nombreCombo, idEjercicio) VALUES (?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('si', $nombreCombo, $idEjercicio);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    public function comprobarContiene($nombreCombo, $idEjercicio)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nombreCombo, idEjercicio FROM Contiene WHERE nombreCombo = ? AND idEjercicio = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('si', $nombreCombo, $idEjercicio);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $database->disconnect();
        if ($result->num_rows > 0){
            return true;
        } else {
            return false;
        }
    }

    public function obtenerEjercicios()
    {
        $database = Database::getInstance();
        $database->connect();

        // Consulta con JOIN para obtener la información de los ejercicios y sus combos
        $sql = "
        SELECT Contiene.nombreCombo, Ejercicio.idEjercicio, Ejercicio.nombre, Ejercicio.descripcion, Ejercicio.tipoEjercicio, Ejercicio.grupoMuscular
        FROM Contiene
        INNER JOIN Ejercicio ON Contiene.idEjercicio = Ejercicio.idEjercicio
    ";

        $result = $database->getConnection()->query($sql);
        $ejercicios = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ejercicios[] = $row;
            }
        }

        $database->disconnect();
        return $ejercicios;
    }
}