<?php

namespace App\Repositories;

class ComponeRepository extends Database
{

    public function crearRutina()
    {
        $database = Database::getInstance();
        $connection = $database->getConnection();
        $sql = "INSERT INTO rutina (nombre, descripcion) VALUES ('Rutina de prueba', 'Esta es una rutina de prueba')";
    }
}