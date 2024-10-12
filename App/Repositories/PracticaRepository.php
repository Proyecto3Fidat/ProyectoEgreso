<?php

namespace App\Repositories;

class PracticaRepository extends Database
{

    public function asignarRutina($idRutina, $nroDocumento, $tipoDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Practica (idRutina, nroDocumento, tipoDocumento) VALUES (?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("iss", $idRutina, $nroDocumento, $tipoDocumento);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function obtenerPracticas($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT idRutina FROM Practica WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nroDocumento);
        $stmt->execute();
        $result = $stmt->get_result();
        $practicas = [];
        while ($row = $result->fetch_assoc()) {
            $practicas[] = $row;
        }
        $database->disconnect();
        return $practicas;
    }
}