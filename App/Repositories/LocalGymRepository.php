<?php

namespace App\Repositories;

use App\Models\LocalGymModel;

class LocalGymRepository extends Database
{

    public function obtenerNombres()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nombre FROM LocalGym";
        $result = $database->getConnection()->query($sql);
        $nombres = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombres[] = $row;
            }
        }
        $database->disconnect();
        return $nombres;
    }

    public function guardar(LocalGymModel $localGymModel)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO LocalGym (nombre, calle, nroPuerta, esquina,capXturno) VALUES ( ?, ?, ?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $nombre = $localGymModel->getNombre();
        $calle = $localGymModel->getCalle();
        $nroPuerta = $localGymModel->getNroPuerta();
        $esquina = $localGymModel->getEsquina();
        $capXturno = $localGymModel->getCapXturno();
        echo $nombre;
        $stmt->bind_param('sssss', $nombre, $calle, $nroPuerta, $esquina, $capXturno);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
}