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
}