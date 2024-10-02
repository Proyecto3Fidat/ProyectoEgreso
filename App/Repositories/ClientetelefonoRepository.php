<?php

namespace App\Repositories;

use App\Controllers\ClientetelefonoModel;

class ClientetelefonoRepository extends Database
{
    public function __construct()
    {
        parent::__construct();
    }
    public  function guardarTelefono($clientetelefonoModel){
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Cliente_Telefono (nroDocumento, tipoDocumento, telefono) 
                VALUES (?,?,?)";
        $nroDocumento = $clientetelefonoModel->getNroDocumento();
        $tipoDocumento = $clientetelefonoModel->getTipoDocumento();
        $telefono = (int) $clientetelefonoModel->getTelefono();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("sss", $nroDocumento, $tipoDocumento, $telefono);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    public function traerTelefono($nroDocumento){
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT telefono FROM Cliente_Telefono WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nroDocumento);
        $stmt->execute();
        $stmt->bind_result($telefono);
        $stmt->fetch();
        $stmt->close();
        $database->disconnect();
        return $telefono;
    }
}