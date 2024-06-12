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
            
        $sql = "INSERT INTO Cliente (nroDocumento, tipoDocumento,rol, passwd, altura, peso, calle, numero, esquina, email, patologias, puntMinima, puntMaxima, fechaNacimiento, primerNombre, segundoNombre, primerApellido, segundoApellido) 
                VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Asignar los valores de los métodos a variables
        $nroDocumento = $clienteModel->getNroDocumento();
        echo "numero documento: ", $nroDocumento;

        $tipoDocumento = $clienteModel->getTipoDocumento();
        echo "tipo documento: ", $tipoDocumento;

        $rol = $clienteModel->getRol(); // Asumiendo que 'getRol' es un método.
        echo "rol: ", $rol;

        $passwd = $clienteModel->getPasswd();
        echo "password: ", $passwd;

        $altura = $clienteModel->getAltura();
        echo "altura: ", $altura;

        $peso = $clienteModel->getPeso();
        echo "peso: ", $peso;

        $calle = $clienteModel->getCalle();
        echo "calle: ", $calle;

        $numero = $clienteModel->getNumero();
        echo "numero: ", $numero;

        $esquina = $clienteModel->getEsquina();
        echo "esquina: ", $esquina;

        $email = $clienteModel->getEmail();
        echo "email: ", $email;

        $patologias = $clienteModel->getPatologias();
        echo "patologias: ", $patologias;

        $puntMinima = $clienteModel->getPuntMinima();
        echo "puntuación mínima: ", $puntMinima;

        $puntMaxima = $clienteModel->getPuntMaxima();
        echo "puntuación máxima: ", $puntMaxima;

        $fechaNacimiento = $clienteModel->getFechaNacimiento();
        echo "fecha de nacimiento: ", $fechaNacimiento;

        $primerNombre = $clienteModel->getPrimerNombre();
        echo "primer nombre: ", $primerNombre;

        $segundoNombre = $clienteModel->getSegundoNombre();
        echo "segundo nombre: ", $segundoNombre;

        $primerApellido = $clienteModel->getPrimerApellido();
        echo "primer apellido: ", $primerApellido;

        $segundoApellido = $clienteModel->getSegundoApellido();
        echo "segundo apellido: ", $segundoApellido;

        
        $stmt = $this->database->getConnection()->prepare($sql); // Preparar la consulta SQL
        
        if (!$stmt) {
            // Manejar el error si la preparación de la consulta falla
            echo "Error al preparar la consulta: " . $this->database->getConnection()->error;
            return;
        }
        
        $stmt->bind_param(
            "isissisisssissssss",
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
        $this->database->disconnect(); // Desconectar de la base de datos
    }
    
}
