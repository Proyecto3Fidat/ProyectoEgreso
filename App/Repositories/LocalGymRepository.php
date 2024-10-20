<?php

namespace App\Repositories;

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
}