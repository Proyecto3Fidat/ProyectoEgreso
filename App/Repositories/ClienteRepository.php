<?php

namespace App\Repositories;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Models\ClienteModel;

class ClienteRepository extends Database
{
    private $database;

    public function __construct()
    {
        parent::__construct();
    }

    public function guardar(ClienteModel $clienteModel)
    {
        $database = Database::getInstance();
        $database->connect();
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


        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ssdisissssss",
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
        $database->disconnect();
    }
    public function guardarEntrenador(ClienteModel $clienteModel)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Cliente (nroDocumento, tipoDocumento, email, nombre, apellido) 
                VALUES (?,?, ?, ?, ?)";

        $nroDocumento = $clienteModel->getNroDocumento();
        $tipoDocumento = $clienteModel->getTipoDocumento();
        $email = $clienteModel->getEmail();
        $nombre = $clienteModel->getNombre();
        $apellido = $clienteModel->getApellido();


        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "sssss",
            $nroDocumento,
            $tipoDocumento,
            $email,
            $nombre,
            $apellido,
        );
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function modificarNombre($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET nombre = ? WHERE nroDocumento = ?";

        $nombre = $cliente->getNombre();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $nombre,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();

        $database->disconnect();
    }

    public function modificarApellido($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET apellido = ? WHERE nroDocumento = ?";

        $apellido = $cliente->getApellido();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $apellido,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();

        $database->disconnect();
    }

    public function modificarFecha($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET fechaNacimiento = ? WHERE nroDocumento = ?";

        $fecha = $cliente->getFechaNacimiento();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $fecha,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();

        $database->disconnect();
    }

    public function modificarPatologia($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET patologias = ? WHERE nroDocumento = ?";

        $patologias = $cliente->getPatologias();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $patologias,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();

        $database->disconnect();
    }

    public function modificarEmail($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET email = ? WHERE nroDocumento = ?";

        $email = $cliente->getEmail();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $email,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();

        $database->disconnect();
    }

    public function modificarEsquina($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET esquina = ? WHERE nroDocumento = ?";

        $esquina = $cliente->getEsquina();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $esquina,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();

        $database->disconnect();
    }

    public function modificarNumero($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET numero = ? WHERE nroDocumento = ?";

        $numero = $cliente->getNumero();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $numero,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();

        $database->disconnect();
    }

    public function modificarCalle($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET calle = ? WHERE nroDocumento = ?";

        $calle = $cliente->getCalle();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $calle,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    public function modificarPeso($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET peso = ? WHERE nroDocumento = ?";

        $peso = $cliente->getPeso();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $peso,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    public function modificarAltura($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Cliente SET altura = ? WHERE nroDocumento = ?";

        $altura = $cliente->getAltura();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $altura,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }
    public function modificarPasswd($nroDocumento, $cliente)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Usuario SET passwd = ? WHERE nroDocumento = ?";

        $passwd = $cliente->getPasswd();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $altura,
            $nroDocumento
        );
        $stmt->execute();
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function comprobarCliente($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nroDocumento FROM Cliente WHERE nroDocumento = ?";
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
    public function listarClientes()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nombre, nroDocumento, tipoDocumento, apellido , altura , peso , patologias , email , fechaNacimiento , calle , numero , esquina FROM Cliente";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($nombre, $nroDocumento, $tipoDocumento, $apellido, $altura, $peso, $patologia, $email, $fechaNacimiento, $calle, $numero, $esquina);
        $clientes = array();
        while ($stmt->fetch()) {
            $clientes[] = array(
                'nombre' => $nombre,
                'nroDocumento' => $nroDocumento,
                'tipoDocumento' => $tipoDocumento,
                'apellido' => $apellido,
                'altura' => $altura,
                'peso' => $peso,
                'patologia' => $patologia,
                'email' => $email,
                'fechaNacimiento' => $fechaNacimiento,
                'calle' => $calle,
                'numero' => $numero,
                'esquina' => $esquina
            );
        }
        $stmt->close();
        $database->disconnect();
        return $clientes;
    }

    public function obtenerInfoCliente($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nombre, apellido, fechaNacimiento, patologias, email, calle, numero, esquina, peso, altura FROM Cliente WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nroDocumento);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($nombre, $apellido, $fechaNacimiento, $patologias, $email, $calle, $numero, $esquina, $peso, $altura);
        $clientes = array();
        while ($stmt->fetch()) {
            $clientes[] = array(
                'nombre' => $nombre,
                'apellido' => $apellido,
                'fechaNacimiento' => $fechaNacimiento,
                'patologias' => $patologias,
                'email' => $email,
                'calle' => $calle,
                'numero' => $numero,
                'esquina' => $esquina,
                'peso' => $peso,
                'altura' => $altura
            );
        }
        $stmt->close();
        $database->disconnect();
        return $clientes;

    }

    public function obtenerTipoDocumento($documento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT tipoDocumento FROM Cliente WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($tipoDocumento);
        $stmt->fetch();
        $stmt->close();
        $database->disconnect();
        return $tipoDocumento;
    }

}
