<?php

namespace App\Repositories;

use App\Models\ClienteModel;

class ClienteRepository {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function guardar(ClienteModel $clienteModel){
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
            "ssiisissssss",
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
    }
    
}
