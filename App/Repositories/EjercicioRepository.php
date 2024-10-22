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

    public function obtenerEjercicios($page = 1, $itemsPerPage = 7)
    {
        $database = Database::getInstance();
        $database->connect();

        $offset = ($page - 1) * $itemsPerPage;

        $sql = "SELECT idEjercicio, nombre, descripcion, grupoMuscular, tipoEjercicio 
            FROM Ejercicio 
            LIMIT ?, ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("ii", $offset, $itemsPerPage); // Pasar el offset y el número de resultados por página
        $stmt->execute();
        $result = $stmt->get_result();

        $ejercicios = [];
        while ($row = $result->fetch_assoc()) {
            $ejercicios[] = $row;
        }

        // Obtener el total de ejercicios para calcular el número de páginas
        $sqlTotal = "SELECT COUNT(*) AS total FROM Ejercicio";
        $totalResult = $database->getConnection()->query($sqlTotal);
        $totalRow = $totalResult->fetch_assoc();
        $totalItems = $totalRow['total'];
        $totalPages = ceil($totalItems / $itemsPerPage);

        $database->disconnect();

        return [
            'ejercicios' => $ejercicios,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ];
    }

    public function guardar(EjercicioModel $ejercicioModel)
    {

        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Ejercicio (nombre, descripcion, grupoMuscular, tipoEjercicio) VALUES (?, ?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $nombre = $ejercicioModel->getNombre();
        $descripcion = $ejercicioModel->getDescripcion();
        $grupoMuscular = $ejercicioModel->getGrupoMuscular();
        $tipoEjercicio = $ejercicioModel->getTipoEjercicio();
        $stmt->bind_param('ssss', $nombre, $descripcion, $grupoMuscular, $tipoEjercicio);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();

    }

}