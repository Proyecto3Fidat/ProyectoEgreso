<?php

namespace App\Repositories;

use App\Models\ObtieneModel;

class ObtieneRepository extends Database
{
    private $obtieneModel;

    public function asignarPuntuacion(ObtieneModel $obtieneModel)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Obtiene (nroDocumento, tipoDocumento, id, fecha, puntEsperado, puntObtenido) 
                VALUES (?,?,?,?,?,?)";
        $stmt = $database->getConnection()->prepare($sql);
        $nroDocumento = $obtieneModel->getNroDocumento();
        $tipoDocumento = $obtieneModel->getTipoDocumento();
        $id = $obtieneModel->getId();
        $fecha = $obtieneModel->getFecha();
        $puntuacionEsperado = $obtieneModel->getPuntuacionEsperado();
        $puntuacionObtenido = $obtieneModel->getPuntuacionObtenido();
        $stmt->bind_param("ssisii", $nroDocumento, $tipoDocumento, $id, $fecha, $puntuacionEsperado, $puntuacionObtenido);  
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    public function obtenerCalificaciones($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT id , puntObtenido, fecha FROM Obtiene WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nroDocumento);
        $stmt->execute();
        $calificaciones = [];
        $stmt->bind_result($id, $puntObtenido, $fecha);
        $calificaciones = array();
        while ($stmt->fetch()) {
            $calificaciones [] = array(
                'id' => $id,
                'puntObtenido' => $puntObtenido,
                'fecha' => $fecha
            );
        }
        $stmt->close();
        $database->disconnect();
        return $calificaciones;
    }
    public function obtenerCalificacionesXId($id)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT puntObtenido, fecha FROM Obtiene WHERE id = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $calificaciones = [];
        $stmt->bind_result( $puntObtenido, $fecha);
        $calificaciones = array();
        while ($stmt->fetch()) {
            $calificaciones [] = array(
                'puntObtenido' => $puntObtenido,
                'fecha' => $fecha
            );
        }
        $stmt->close();
        $database->disconnect();
        return $calificaciones;
    }
}