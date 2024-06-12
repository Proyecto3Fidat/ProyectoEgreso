<?php

namespace App\Repositories;

use App\Models\ClienteModel;

class ClienteRepository {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function guardar(ClienteModel $clienteModel){
        $this->database->connect(); // Conectar a la base de datos
            
        $sql = "INSERT INTO Cliente (nroDocumento, tipoDocumento,rol, passwd, altura, peso, calle, numero, esquina, email, patologias, puntuacion, fechaNacimiento, nombre, apellido) 
                VALUES (?,?, ?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Asignar los valores de los métodos a variables
        $nroDocumento = $clienteModel->getNroDocumento();
        $tipoDocumento = $clienteModel->getTipoDocumento();
        $rol = $clienteModel->getRol(); // Asumiendo que 'getRol' es un método.
        $passwd = $clienteModel->getPasswd();
        $altura = $clienteModel->getAltura();
        $peso = $clienteModel->getPeso();
        $calle = $clienteModel->getCalle();
        $numero = $clienteModel->getNumero();
        $esquina = $clienteModel->getEsquina();
        $email = $clienteModel->getEmail();
        $patologias = $clienteModel->getPatologias();
        $puntuacion = $clienteModel->getPuntuacion();
        $fechaNacimiento = $clienteModel->getFechaNacimiento();
        $nombre = $clienteModel->getNombre();
        $apellido = $clienteModel->getApellido();

        
        $stmt = $this->database->getConnection()->prepare($sql); // Preparar la consulta SQL
        $stmt->bind_param(
            "isissisisssisss",
            $nroDocumento,
            $tipoDocumento,
            $rol,
            $passwd,
            $altura,
            $peso,
            $calle,
            $numero,
            $esquina,
            $email,
            $patologias,
            $puntuacion,
            $fechaNacimiento,
            $nombre,
            $apellido,
        );
        $stmt->execute();
        $stmt->close();
        $this->database->disconnect(); // Desconectar de la base de datos
    }
    public function autenticar($nroDocumento, $passwd) {
        $this->database->connect(); // Conectar a la base de datos

        $sql = "SELECT passwd FROM Cliente WHERE nroDocumento = ?";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("i", $nroDocumento);
        $stmt->execute();
        if($stmt->error){
            echo "error";
        }
        $stmt->bind_result($epasswd);
        $stmt->fetch();
        $stmt->close();
        $this->database->disconnect(); // Desconectar de la base de datos
        if ($epasswd == $passwd){
            return true;
        }
        return false;
    }
}
