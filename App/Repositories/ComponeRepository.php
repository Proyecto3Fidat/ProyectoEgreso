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

}