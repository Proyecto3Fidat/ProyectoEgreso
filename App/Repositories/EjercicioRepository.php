<?php

namespace App\Repositories;

use App\Models\EjercicioModel;
use App\Repositories\Database;

class EjercicioRepository extends Database
{
    public function crearEjercicio($ejercicio)
    {
        $nombre = $ejercicio->getNombre();
        $descripcion = $ejercicio->getDescripcion();
        $grupoMuscular = $ejercicio->getGrupoMuscular();
        $tipoEjercicio = $ejercicio->getTipoEjercicio();

        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Ejercicio (nombre, descripcion, grupoMuscular, tipoEjercicio) VALUES (?, ?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('ssss', $nombre, $descripcion, $grupoMuscular, $tipoEjercicio);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function obtenerEjercicios()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT idEjercicio, nombre, descripcion, grupoMuscular, tipoEjercicio FROM Ejercicio";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $ejercicios = [];
        while ($row = $result->fetch_assoc()) {
            $ejercicios[] = $row;
        }

        $database->disconnect();
        return $ejercicios;
    }

}