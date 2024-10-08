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
}