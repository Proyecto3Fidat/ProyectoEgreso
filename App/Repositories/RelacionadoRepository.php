<?php

namespace App\Repositories;

class RelacionadoRepository extends Database
{

    public function guardar(\App\Models\RelacionadoModel $param)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Relacionado (idClub, nombre, nroDocumento, tipoDocumento) VALUES (?,?,?,?)";
        $stmt = $database->getConnection()->prepare($sql);
        $idClub = $param->getIdClub();
        $nombre = $param->getNombre();
        $nroDocumento = $param->getNroDocumento();
        $tipoDocumento = $param->getTipoDocumento();
        $stmt->bind_param('ssss', $idClub, $nombre, $nroDocumento, $tipoDocumento);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function obtenerRelacionado(mixed $nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM Relacionado WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('s', $nroDocumento);
        $stmt->execute();
        $result = $stmt->get_result();
        $relacionado = $result->fetch_assoc();
        $stmt->close();
        $database->disconnect();
        return $relacionado;
    }
}