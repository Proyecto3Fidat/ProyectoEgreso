<?php

namespace App\Repositories;

Class CalificacionRepository extends Database{
    public function asignarPuntuacion($calificacionModel){
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Calificacion (puntMaxima, fuerzaMusc, resMusc, resAnaerobica, resilicencia, flexibilidad, cumpAgenda, resMonotonia) 
                VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $database->getConnection()->prepare($sql);
        $puntMaxima = $calificacionModel->getPuntMaxima();
        $fuerzaMusc = $calificacionModel->getFuerzaMusc();
        $resMusc = $calificacionModel->getResMusc();
        $resAnaerobica = $calificacionModel->getResAnaerobica();
        $resiliencia = $calificacionModel->getResiliencia();
        $flexibilidad = $calificacionModel->getFlexibilidad();
        $cumplAgenda = $calificacionModel->getCumplAgenda();
        $resMonotonia = $calificacionModel->getResMonotonia();
        $stmt->bind_param("iiiiiiii", $puntMaxima, $fuerzaMusc, $resMusc, $resAnaerobica, $resiliencia, $flexibilidad, $cumplAgenda, $resMonotonia);  
        $stmt->execute();
        $last_id = $stmt->insert_id;
        $stmt->close();
        $database->disconnect();
        return $last_id;
    }
    public function obtenerPuntuaciones($id){
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT id , puntMaxima , fuerzaMusc , resMusc , resAnaerobica , resilicencia , flexibilidad , cumpAgenda , resMonotonia  FROM Calificacion where id = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $calificaciones = [];
        $stmt->bind_result($id, $puntMaxima, $fuerzaMusc, $resMusc, $resAnaerobica, $resiliencia, $flexibilidad, $cumplAgenda, $resMonotonia);
        $calificaciones = array();
        while ($stmt->fetch()) {
            $calificaciones [] = array(
                'id' => $id,
                'puntMaxima' => $puntMaxima,
                'fuerzaMusc' => $fuerzaMusc,
                'resMusc' => $resMusc,
                'resAnaerobica' => $resAnaerobica,
                'resiliencia' => $resiliencia,
                'flexibilidad' => $flexibilidad,
                'cumplAgenda' => $cumplAgenda,
                'resMonotonia' => $resMonotonia
            );
        }
        $stmt->close();
        $database->disconnect();
        return $calificaciones;
    }

    public function editarCalificacion(\App\Models\CalificacionModel $calificacionModel, $id)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Calificacion SET puntMaxima = ?, fuerzaMusc = ?, resMusc = ?, resAnaerobica = ?, resilicencia = ?, flexibilidad = ?, cumpAgenda = ?, resMonotonia = ? WHERE id = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $puntMaxima = $calificacionModel->getPuntMaxima();
        $fuerzaMusc = $calificacionModel->getFuerzaMusc();
        $resMusc = $calificacionModel->getResMusc();
        $resAnaerobica = $calificacionModel->getResAnaerobica();
        $resiliencia = $calificacionModel->getResiliencia();
        $flexibilidad = $calificacionModel->getFlexibilidad();
        $cumplAgenda = $calificacionModel->getCumplAgenda();
        $resMonotonia = $calificacionModel->getResMonotonia();
        $stmt->bind_param("iiiiiiiii", $puntMaxima, $fuerzaMusc, $resMusc, $resAnaerobica, $resiliencia, $flexibilidad, $cumplAgenda, $resMonotonia, $id);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
}