<?php

namespace App\Repositories;

class ComboEjercicioRepository
{
    public function crearCombo($nombre)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO ComboEjercicio (nombreCombo) VALUES (?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('s', $nombre);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    public function comprobarCombo($nombre)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nombreCombo FROM ComboEjercicio WHERE nombreCombo = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('s', $nombre);
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