<?php

namespace App\Repositories;

class ComponeRepository extends Database
{

    public function crearRutina($idRutina, $nombreCombo, $idEjercicio)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Compone (idRutina, nombreCombo, idEjercicio) VALUES (?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('isi', $idRutina, $nombreCombo, $idEjercicio);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function obtenerCombos($idRutina)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nombreCombo FROM Compone WHERE idRutina = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('i', $idRutina);
        $stmt->execute();
        $result = $stmt->get_result();
        $combos = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $combo = [
                    'nombreCombo' => $row['nombreCombo']
                ];
                array_push($combos, $combo);
            }
        }
        $stmt->close();
        $database->disconnect();
        return $combos;
    }

    public function eliminarRutina($id)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "DELETE FROM Practica WHERE idRutina = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

}