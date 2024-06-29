<?php
namespace App\Repositories;

use App\Models\UsuarioModel;
use App\Repositories\Database;
use App\Repositories\Logger;

class UsuarioRepository {
    private $database;
    private $logger;

    public function __construct() {
        $this->database = new Database();
        $this->logger = new Logger(); // Inicializar el logger
    }

    public function comprobarUsuario($nroDocumento) {
        try {
            $this->database->connect();
            $sql = "SELECT nroDocumento FROM Usuario WHERE nroDocumento = ?";
            $stmt = $this->database->getConnection()->prepare($sql);
            $stmt->bind_param("i", $nroDocumento);
            $stmt->execute();
            $stmt->store_result();
            $num_of_rows = $stmt->num_rows;
            $stmt->close();
            $this->database->disconnect();
            return $num_of_rows > 0;
        } catch (\Exception $e) {
            // Registrar el error utilizando el logger
            $this->logger->logError("Error en UsuarioRepository::comprobarUsuario(): " . $e->getMessage());
            die("Error al comprobar usuario. Revisa el registro de errores.");
        }
    }

    public function guardar(UsuarioModel $usuarioModel){
        try {
            $this->database->connect();
            $sql = "INSERT INTO Usuario (nroDocumento, rol, passwd) 
                    VALUES (?,?, ?)";
            
            $nroDocumento = $usuarioModel->getNroDocumento();
            $rol = $usuarioModel->getRol();
            $passwd = $usuarioModel->getPasswd();       
            $stmt = $this->database->getConnection()->prepare($sql);
            $stmt->bind_param(
                "iis",
                $nroDocumento,
                $rol,
                $passwd
            );
            $stmt->execute();
            $stmt->close();
            $this->database->disconnect();
        } catch (\Exception $e) {
            // Registrar el error utilizando el logger
            $this->logger->logError("Error en UsuarioRepository::guardar(): " . $e->getMessage());
            die("Error al guardar usuario. Revisa el registro de errores.");
        }
    }
    
    public function autenticar($nroDocumento, $passwd) {
        try {
            $this->database->connect();
            $sql = "SELECT passwd , nroDocumento FROM Usuario WHERE nroDocumento = ?";
            $stmt = $this->database->getConnection()->prepare($sql);
            $stmt->bind_param("i", $nroDocumento);
            $stmt->execute();
            if($stmt->error){
                echo "error";
            }
            $stmt->bind_result($epasswd, $edocumento);
            $stmt->fetch();
            $stmt->close();
            $this->database->disconnect();
            if ($epasswd == $passwd || password_verify($passwd, $epasswd)){
                return $this->nombreCliente($edocumento);
            }
            return false;
        } catch (\Exception $e) {
            // Registrar el error utilizando el logger
            $this->logger->logError("Error en UsuarioRepository::autenticar(): " . $e->getMessage());
            die("Error al autenticar usuario. Revisa el registro de errores.");
        }
    }

    public function nombreCliente($documento){
        try {
            $this->database->connect();
            $sql = "SELECT nombre  FROM Cliente WHERE nroDocumento = ?";
            $stmt = $this->database->getConnection()->prepare($sql);
            $stmt->bind_param("i", $documento);
            $stmt->execute();
            if($stmt->error){
                echo "error";
            }
            $stmt->bind_result($nombre);
            $stmt->fetch();
            $stmt->close();
            $this->database->disconnect();
            return $nombre;
        } catch (\Exception $e) {
            // Registrar el error utilizando el logger
            $this->logger->logError("Error en UsuarioRepository::nombreCliente(): " . $e->getMessage());
            die("Error al obtener nombre del cliente. Revisa el registro de errores.");
        }
    }
}
?>
