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
        $stmt->bind_param("s", $nroDocumento);  
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
    public function comprobarToken($documento, $token){
        $this->database->connect();
        $sql = "SELECT token FROM Usuario WHERE nroDocumento = ?";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        if($stmt->error){
            echo "error";
        }   
        $stmt->bind_result($etoken);
        $stmt->fetch();
        $stmt->close();
        $this->database->disconnect();
        if ($etoken == $token && $etoken != null){
            return true;
        }else{
            return false;
        }
    }
    public function guardar(UsuarioModel $usuarioModel){
        $this->database->connect();
        $sql = "INSERT INTO Usuario (nroDocumento, rol, passwd, token) 
                VALUES (?,?, ?)";
        
        $nroDocumento = $usuarioModel->getNroDocumento();
        $rol = $usuarioModel->getRol();
        $passwd = $usuarioModel->getPasswd();    
        $token = $usuarioModel->getToken();
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ssss",
            $nroDocumento,
            $rol,
            $passwd,
            $token
        );
        $stmt->execute();
        $stmt->close();
        $this->database->disconnect();
    }
    public function guardarEntrenador(UsuarioModel $usuarioModel){
        $this->database->connect();
        $sql = "INSERT INTO Usuario (nroDocumento, rol, passwd, token) 
                VALUES (?,?, ?, ?)";
        
        $nroDocumento = $usuarioModel->getNroDocumento();
        $rol = $usuarioModel->getRol();
        $passwd = $usuarioModel->getPasswd();    
        $token = $usuarioModel->getToken();
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param(
            "ssss",
            $nroDocumento,
            $rol,
            $passwd,
            $token
        );
        $stmt->execute();
        $stmt->close();
        $this->database->disconnect();
    }
    
    public function autenticar($nroDocumento, $passwd): array{
        $this->database->connect();
        $sql = "SELECT passwd , nroDocumento, rol FROM Usuario WHERE nroDocumento = ?";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $nroDocumento);
        $stmt->execute();
        if($stmt->error){
            echo "error";
        }
        $stmt->bind_result($epasswd, $edocumento, $rol);
        $stmt->fetch();
        $stmt->close();
        $this->database->disconnect();
        if (password_verify($passwd, $epasswd)){
            return [
                'nombre' => $this->nombreCliente($edocumento),
                'documento' => $edocumento, 
                'rol' => $rol,
                'resultado' => true,
                'token' => $this->devolverToken($edocumento)
            ];
        }else{
            return ['resultado' => false];
        }
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

    public function devolverToken($documento){
        $this->database->connect();
        $sql = "SELECT token FROM Usuario WHERE nroDocumento = ?";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("s", $documento);
        $stmt->execute();
        if($stmt->error){
            echo "error";
        }
        $stmt->bind_result($token);
        $stmt->fetch();
        $stmt->close();
        $this->database->disconnect();
        return $token;
    }
}
?>
