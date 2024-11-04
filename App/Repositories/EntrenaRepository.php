<?php

namespace App\Repositories;

use App\Utilities\DataSeeder;

class EntrenaRepository extends Database
{


    public function guardar(\App\Models\EntrenaModel $param)
    {

        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Entrena (nroDocumento, tipoDocumento, nombre) VALUES (?,?,?)";
        $stmt = $database->getConnection()->prepare($sql);
        $documento = $param->getDocumento();
        $tipoDocumento = $param->getTipoDocumento();
        $nombre = $param->getNombre();
        $stmt->bind_param('sss', $documento, $tipoDocumento, $nombre);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function guardarEntrena(mixed $deportePost, mixed $documento, mixed $tipoDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Entrena (nombre, nroDocumento, tipoDocumento) VALUES (?,?,?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('sss', $deportePost, $documento, $tipoDocumento);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();

    }

    public function obtenerEntrena(mixed $nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM Entrena WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('s', $nroDocumento);
        $stmt->execute();
        $result = $stmt->get_result();
        $entrena = $result->fetch_assoc();
        $stmt->close();
        $database->disconnect();
        return $entrena;
    }
}