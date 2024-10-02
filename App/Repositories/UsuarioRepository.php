<?php
namespace App\Repositories;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Models\UsuarioModel;

class UsuarioRepository extends Database
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function comprobarUsuario($nroDocumento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nroDocumento FROM usuario WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nroDocumento);
        $stmt->execute();
        $stmt->store_result();
        $num_of_rows = $stmt->num_rows;
        $stmt->close();
        $database->disconnect();
        if ($num_of_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function comprobarToken($documento, $token)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT token FROM Usuario WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        if ($stmt->error) {
            echo "error";
        }
        $stmt->bind_result($etoken);
        $stmt->fetch();
        $stmt->close();
        $database->disconnect();
        if ($etoken == $token && $etoken != null) {
            return true;
        } else {
            return false;
        }
    }

    public function guardar(UsuarioModel $usuarioModel)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "INSERT INTO Usuario (nroDocumento, rol, passwd, token) 
                VALUES (?,?,?,?)";

        $nroDocumento = $usuarioModel->getNroDocumento();
        $rol = $usuarioModel->getRol();
        $passwd = $usuarioModel->getPasswd();
        $token = $usuarioModel->getToken();
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ssss",
            $nroDocumento,
            $rol,
            $passwd,
            $token
        );
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }



    public function guardarDeportista($cedula)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Usuario SET rol = ? WHERE nroDocumento = ?";
        $deportista = "deportista";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $deportista,
            $cedula
        );
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function guardarPaciente($cedula)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "UPDATE Usuario SET rol = ? WHERE nroDocumento = ?";
        $paciente = "paciente";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ss",
            $paciente,
            $cedula
        );
        $stmt->execute();
        $stmt->close();
        $database->disconnect();
    }

    public function autenticar($nroDocumento, $passwd): array
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT passwd , nroDocumento, rol FROM Usuario WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nroDocumento);
        $stmt->execute();
        if ($stmt->error) {
            echo "error";
        }
        $stmt->bind_result($epasswd, $edocumento, $rol);
        $stmt->fetch();
        $stmt->close();
        $database->disconnect();
        if (password_verify($passwd, $epasswd)) {
            return [
                'nombre' => $this->nombreCliente($edocumento),
                'documento' => $edocumento,
                'rol' => $rol,
                'resultado' => true,
                'token' => $this->devolverToken($edocumento)
            ];
        } else {
            return ['resultado' => false];
        }
    }

    public function nombreCliente($documento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT nombre  FROM Cliente WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("i", $documento);
        $stmt->execute();
        if ($stmt->error) {
            echo "error";
        }
        $stmt->bind_result($nombre);
        $stmt->fetch();
        $stmt->close();
        $database->disconnect();
        return $nombre;
    }

    public function devolverToken($documento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT token FROM Usuario WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        if ($stmt->error) {
            echo "error";
        }
        $stmt->bind_result($token);
        $stmt->fetch();
        $stmt->close();
        $database->disconnect();
        return $token;
    }

    public function comprobarRol($documento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT rol FROM Usuario WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        if ($stmt->error) {
            echo "error";
        }
        $stmt->bind_result($rol);
        $stmt->fetch();
        $stmt->close();
        $database->disconnect();
        return $rol;
    }
    public function obtenerTipoDocumento($documento)
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT tipoDocumento FROM Cliente WHERE nroDocumento = ?";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        if ($stmt->error) {
            echo "error";
        }
        $stmt->bind_result($tipoDocumento);
        $stmt->fetch();
        $stmt->close();
        $database->disconnect();
        return $tipoDocumento;
    }
}
