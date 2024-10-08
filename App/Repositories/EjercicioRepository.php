<?php

namespace App\Repositories;

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
        $sql = "SELECT * FROM Ejercicio";
        $result = $database->getConnection()->query($sql);
        $ejercicios = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $ejercicio = new EjercicioModel($row['nombre'], $row['descripcion'], $row['grupoMuscular'], $row['tipoEjercicio']);
                $ejercicios[] = $ejercicio;
            }
        }
        $database->disconnect();
        return $ejercicios;
    }
}