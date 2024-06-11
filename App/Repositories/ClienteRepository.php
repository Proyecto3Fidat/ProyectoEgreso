<?php

namespace App\Repositories;

use App\Models\ClienteModel;

class ClienteRepository {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function guardar(ClienteModel $clienteModel)
    {
        $this->database->connect(); // Conectar a la base de datos
            
        $sql = "INSERT INTO Cliente (nroDocumento, tipoDocumento, passwd, altura, peso, calle, numero, esquina, email, patologias, puntMinima, puntMaxima, fechaNacimiento, primerNombre, segundoNombre, primerApellido, segundoApellido) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Asignar los valores de los métodos a variables
        $nroDocumento = $clienteModel->getNroDocumento();
        $tipoDocumento = $clienteModel->getTipoDocumento();
        $contrasena = $clienteModel->getPasswd();
        $altura = $clienteModel->getAltura();
        $peso = $clienteModel->getPeso();
        $calle = $clienteModel->getCalle();
        $numero = $clienteModel->getNumero();
        $esquina = $clienteModel->getEsquina();
        $email = $clienteModel->getEmail();
        $patologias = $clienteModel->getPatologias();
        $puntMinima = $clienteModel->getPuntMinima();
        $puntMaxima = $clienteModel->getPuntMaxima();
        $fechaNacimiento = $clienteModel->getFechaNacimiento();
        $primerNombre = $clienteModel->getPrimerNombre();
        $segundoNombre = $clienteModel->getSegundoNombre();
        $primerApellido = $clienteModel->getPrimerApellido();
        $segundoApellido = $clienteModel->getSegundoApellido();
        
        $stmt = $this->database->getConnection()->prepare($sql); // Preparar la consulta SQL
        $stmt->bind_param(
            "isssiiisssississs",
            $nroDocumento,
            $tipoDocumento,
            $contrasena,
            $altura,
            $peso,
            $calle,
            $numero,
            $esquina,
            $email,
            $patologias,
            $puntMinima,
            $puntMaxima,
            $fechaNacimiento,
            $primerNombre,
            $segundoNombre,
            $primerApellido,
            $segundoApellido
        );
        
        $stmt->execute();
        $stmt->close();
        $rowsAffected = $stmt->affected_rows;

        if ($rowsAffected > 0) {
            echo "Se insertaron $rowsAffected filas en la tabla.";
        } else {
            echo "No se insertaron filas en la tabla.";
        }
        $this->database->disconnect(); // Desconectar de la base de datos
    }
    
}
