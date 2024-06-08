<?php

namespace App\Repositories;

use App\Models\ClienteModel;

class ClienteRepository {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function guardar(ClienteModel $clienteModel) {
        $this->database->connect(); // Conectar a la base de datos
            
        $sql = "INSERT INTO Cliente (nroDocumento, tipoDocumento, contrasena, altura, peso, calle, numero, esquina, email, telefono, patologias, edad, fechaNacimiento, primerNombre, segundoNombre, primerApellido, segundoApellido) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Asignar los valores de los métodos a variables
        $nroDocumento = $clienteModel->getNumeroDocumento();
        $tipoDocumento = $clienteModel->gettipoDocumento();
        $contrasena = $clienteModel->getPassword();
        $altura = $clienteModel->getaltura();
        $peso = $clienteModel->getpeso();
        $calle = $clienteModel->getcalle();
        $numero = $clienteModel->getnumero();
        $esquina = $clienteModel->getesquina();
        $email = $clienteModel->getemail();
        $telefono = $clienteModel->getTelefono1();
        $patologias = $clienteModel->getpatologias();
        $edad = $clienteModel->getedad();
        $fechaNacimiento = $clienteModel->getfechaNacimiento();
        $primerNombre = $clienteModel->getprimerNombre();
        $segundoNombre = $clienteModel->getsegundoNombre();
        $primerApellido = $clienteModel->getprimerApellido();
        $segundoApellido = $clienteModel->getsegundoApellido();
        
        $stmt = $this->database->getConnection()->prepare($sql); // Preparar la consulta SQL
        $stmt->bind_param(
            "sssssssssssssssss",
            $nroDocumento,
            $tipoDocumento,
            $contrasena,
            $altura,
            $peso,
            $calle,
            $numero,
            $esquina,
            $email,
            $telefono,
            $patologias,
            $edad,
            $fechaNacimiento,
            $primerNombre,
            $segundoNombre,
            $primerApellido,
            $segundoApellido
        );
        
        $stmt->execute();
        $stmt->close();
        $this->database->disconnect(); // Desconectar de la base de datos
    }
    
}
