<?php

namespace App\Repositories;

class DeporteRepository extends Database
{

    public function guardar(\App\Models\DeporteModel $param)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO deporte (nombre) VALUES (?)";
        $stmt = $database->getConnection()->prepare($sql);
        $nombre = $param->getNombre();
        $stmt->bind_param('s', $nombre);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function obtenerDeportes()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM deporte";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $deportes = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $database->disconnect();
        return $deportes;
    }
}