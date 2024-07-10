<?php
namespace App\Repositories;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Models\UsuarioModel;

class UsuarioRepository {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }
    public function comprobarUsuario($nroDocumento) {
        $this->database->connect();
        $sql = "SELECT nroDocumento FROM Usuario WHERE nroDocumento = ?";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nroDocumento); // Cambié "i" a "s" si nroDocumento es un string
        $stmt->execute();
        $stmt->store_result();
        $num_of_rows = $stmt->num_rows;
        $stmt->close();
        $this->database->disconnect();
    
        if ($num_of_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function guardar(UsuarioModel $usuarioModel){
        $this->database->connect();
        $sql = "INSERT INTO Usuario (nroDocumento, rol, passwd) 
                VALUES (?,?, ?)";
        
        $nroDocumento = $usuarioModel->getNroDocumento();
        $rol = $usuarioModel->getRol();
        $passwd = $usuarioModel->getPasswd();    
        echo $usuarioModel->getPasswd();   
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "sis",
            $nroDocumento,
            $rol,
            $passwd
        );
        $stmt->execute();
        $stmt->close();
        $this->database->disconnect();
    }
    public function guardarAdministrador(UsuarioModel $usuarioModel){
        $this->database->connect();
        $sql = "INSERT INTO Usuario (nroDocumento, rol, passwd) 
                VALUES (?,?, ?)";
        
        $nroDocumento = $usuarioModel->getNroDocumento();
        $rol = $usuarioModel->getRol();
        $passwd = $usuarioModel->getPasswd();    
        echo $usuarioModel->getPasswd();   
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "sis",
            $nroDocumento,
            $rol,
            $passwd
        );
        $stmt->execute();
        $stmt->close();
        $this->database->disconnect();
    }
    
    public function autenticar($nroDocumento, $passwd) {
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
        if (password_verify($passwd, $epasswd)){
            return $this->nombreCliente($edocumento);
        }
        return false;
    }

    public function nombreCliente($documento){
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
    }
}
?>
