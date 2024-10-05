<?php
namespace App\Repositories;
use App\Models\PacienteModel;


Class PacienteRepository extends Database{
    public function guardarPaciente(PacienteModel $pacienteModel){
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Paciente (nroDocumento, tipoDocumento, fisioterapia) 
                VALUES (?,?,?)";
        
        $nroDocumento = $pacienteModel->getNroDocumento();
        $tipoDocumento = $pacienteModel->getTipoDocumento();
        $fisioterapia = $pacienteModel->getFisioterapia();
        
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("ssss", $nroDocumento, $tipoDocumento, $fisioterapia);
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    public function comprobarPaciente($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nroDocumento FROM Paciente WHERE nroDocumento = ?";
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
    
}