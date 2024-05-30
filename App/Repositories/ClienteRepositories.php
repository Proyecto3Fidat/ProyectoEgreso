<?php
require_once 'conexionBD.php';

class ClienteRepository {

    public function guardar(ClienteModel $clienteModel) {
        $conexion = new Database(); // Instanciar la clase Database
        $conexion->connect(); // Conectar a la base de datos
        
        $sql = "INSERT INTO Cliente (nroDocumento, tipDocumento, contrasena, altura, peso, calle, numero, esquina, email, telefono, patologias, edad, fechaNacimiento, primerNombre, segundoNombre, primerApellido, segundoApellido) 
                VALUES (:nroDocumento, :tipoDocumento, :contrasena, :altura, :peso, :calle, :numero, :esquina, :email, :telefono, :patologias, :edad, :fechaNacimiento, :primerNombre, :segundoNombre, :primerApellido, :segundoApellido)";
        
        echo "Consulta SQL: $sql"; // Imprimir la consulta SQL
        
        $stmt = $conexion->getConnection()->prepare($sql); // Preparar la consulta SQL
        $stmt->execute([
            ':nroDocumento' => $clienteModel->getnroDocumento(),
            ':tipoDocumento' => $clienteModel->gettipoDocumento(),
            ':contrasena' => $clienteModel->getcontraseña(),
            ':altura' => $clienteModel->getaltura(),
            ':peso' => $clienteModel->getpeso(),
            ':calle' => $clienteModel->getcalle(),
            ':numero' => $clienteModel->getnumero(),
            ':esquina' => $clienteModel->getesquina(),
            ':email' => $clienteModel->getemail(),
            ':telefono' => $clienteModel->gettelefono(),
            ':patologias' => $clienteModel->getpatologias(),
            ':edad' => $clienteModel->getedad(),
            ':fechaNacimiento' => $clienteModel->getfechaNacimiento(),
            ':primerNombre' => $clienteModel->getprimerNombre(),
            ':segundoNombre' => $clienteModel->getsegundosNombre(),
            ':primerApellido' => $clienteModel->getprimerApellido(),
            ':segundoApellido' => $clienteModel->getsegundoApellido(),
        ]);
        
        $conexion->disconnect(); // Desconectar de la base de datos
    }
}

