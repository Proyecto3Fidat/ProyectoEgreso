<?php

namespace App\Repositories;

class ClubRepository extends Database
{

    public function guardar(\App\Models\ClubModel $param)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Club (nombreClub) VALUES (?)";
        $stmt = $database->getConnection()->prepare($sql);
        $nombreClub = $param->getNombreClub();
        $stmt->bind_param('s', $nombreClub);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function obtenerClubes()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM Club";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $clubes = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $database->disconnect();
        return $clubes;
    }

    public function asignarClub($deporte, $club, $documento, $tipoDocumento)
    {
        $database = Database::getInstance();
        $database->connect();

        $sql_check = "SELECT COUNT(*) FROM Relacionado WHERE nroDocumento = ?";
        $stmt_check = $database->getConnection()->prepare($sql_check);
        $stmt_check->bind_param('s', $documento);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count > 0) {
            $sql_update = "UPDATE relacionado SET idClub = ? WHERE nroDocumento = ?";
            $stmt_update = $database->getConnection()->prepare($sql_update);
            $stmt_update->bind_param('is', $club, $documento);
            $stmt_update->execute();
            $stmt_update->close();
        } else {
            $sql_insert = "INSERT INTO relacionado (idClub,nombre, nroDocumento, tipoDocumento) VALUES (?, ?, ?, ?)";
            $stmt_insert = $database->getConnection()->prepare($sql_insert);
            $stmt_insert->bind_param('isss', $club, $deporte, $documento, $tipoDocumento);
            $stmt_insert->execute();
            $stmt_insert->close();
        }

        $database->disconnect();
    }

    public function obtenerClub($idClub)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM Club WHERE idClub = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('i', $idClub);
        $stmt->execute();
        $result = $stmt->get_result();
        $club = $result->fetch_assoc();
        $stmt->close();
        $database->disconnect();
        return $club;
    }

    public function crearClub(mixed $nombreClub)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Club (nombreClub) VALUES (?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('s', $nombreClub);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

}