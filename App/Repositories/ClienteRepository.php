<?php
namespace App\Repositories;

use App\Models\ClienteModel;
use App\Repositories\Database;
use App\Repositories\Logger;

class ClienteRepository {
    private $database;
    private $logger;

    public function __construct() {
        $this->database = new Database();
        $this->logger = new Logger(); // Inicializar el logger
    }

    public function guardar(ClienteModel $clienteModel){
        try {
            $this->database->connect();
                
            $sql = "INSERT INTO Cliente (nroDocumento, tipoDocumento, altura, peso, calle, numero, esquina, email, patologias, fechaNacimiento, nombre, apellido) 
                    VALUES (?,?, ?, ?, ?, ?, ?,  ?, ?, ?, ?, ?)";
            
            $nroDocumento = $clienteModel->getNroDocumento();
            $tipoDocumento = $clienteModel->getTipoDocumento();
            $altura = $clienteModel->getAltura();
            $peso = $clienteModel->getPeso();
            $calle = $clienteModel->getCalle();
            $numero = $clienteModel->getNumero();
            $esquina = $clienteModel->getEsquina();
            $email = $clienteModel->getEmail();
            $patologias = $clienteModel->getPatologias();
            $fechaNacimiento = $clienteModel->getFechaNacimiento();
            $nombre = $clienteModel->getNombre();
            $apellido = $clienteModel->getApellido();

            
            $stmt = $this->database->getConnection()->prepare($sql);
            $stmt->bind_param(
                "isiisissssss",
                $nroDocumento,
                $tipoDocumento,
                $altura,
                $peso,
                $calle,
                $numero,
                $esquina,
                $email,
                $patologias,
                $fechaNacimiento,
                $nombre,
                $apellido,
            );
            $stmt->execute();
            $stmt->close();
            $this->database->disconnect(); 
        } catch (\Exception $e) {
            // Registrar el error utilizando el logger
            $this->logger->logError("Error en ClienteRepository::guardar(): " . $e->getMessage());
            die("Error al guardar cliente. Revisa el registro de errores.");
        }
    }
}
?>
