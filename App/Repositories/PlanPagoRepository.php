<?php

namespace App\Repositories;

class PlanPagoRepository extends Database
{
    public function verificarPlan($planPago)
    {
        $nombre = $planPago->getNombrePlan();
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nombrePlan, descripcion, tipoPlan FROM PlanPago WHERE nombrePlan = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('s', $nombre);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($nombrePlan, $descripcion, $tipoPlan);
        $stmt->fetch();
        $clientes = array();
        if ($stmt->num_rows > 0) {
           $clientes = array(
                "existe" => true,
                "nombrePlan" => $nombrePlan,
                "descripcion" => $descripcion,
                "tipoPlan" => $tipoPlan
            );
           return $clientes;
        }else {
             $clientes = array(
                "existe" => false
            );

            return $clientes;
        }
    }
    public function insertarPlan($nombre, $descripcion, $tipo)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO PlanPago (nombrePlan, descripcion, tipoPlan) VALUES (?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param('sss', $nombre, $descripcion, $tipo);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    public function obtenerPlanes()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nombrePlan, descripcion, tipoPlan FROM PlanPago";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($nombrePlan, $descripcion, $tipoPlan);
        $planes = array();
        while ($stmt->fetch()) {
            $planes[] = array(
                "nombrePlan" => $nombrePlan,
                "descripcion" => $descripcion,
                "tipoPlan" => $tipoPlan
            );
        }
        $stmt->close();
        $database->disconnect();
        return $planes;
    }

    public function guardar(\App\Models\PlanPagoModel $param)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO PlanPago (nombrePlan, descripcion, tipoPlan) VALUES (?, ?, ?)";
        $stmt = $database->getConnection()->prepare($sql);
        $nombrePlan = $param->getNombrePlan();
        $descripcion = $param->getDescripcion();
        $tipoPlan = $param->getTipoPlan();

        $stmt->bind_param('sss',$nombrePlan, $descripcion, $tipoPlan);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
}