<?php
namespace App\Repositories;
use App\Models\DeportistaModel;
class DeportistaRepository extends Database{
    private $database;
    public function __construct() {
        $this->database = new Database();
    }
    public function comprobarDeportista($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nroDocumento FROM Deportista WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nroDocumento);
        $stmt->execute();
        $stmt->store_result();
        $num_of_rows = $stmt->num_rows;
        $stmt->close();
        $database->disconnect();
        if ($num_of_rows > 0) {
            return "true";
        } else {
            return "false";
        }
    }
    public function guardarDeportista(DeportistaModel $deportistaModel){
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Deportista (nroDocumento, tipoDocumento, posicion) 
                VALUES (?,?,?)";
        
        $nroDocumento = $deportistaModel->getNroDocumento();
        $tipoDocumento = $deportistaModel->getTipoDocumento();
        $posicion = $deportistaModel->getPosicion();
        
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("sss", $nroDocumento, $tipoDocumento, $posicion);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    
}