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
    public function comprobarUsuario($documento) {
        $this->database->connect();
        $sql = "SELECT nroDocumento FROM Usuario WHERE nroDocumento = ?";
        $nroDocumento = $documento;
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("i", $nroDocumento);
        $stmt->execute();
        $stmt->bind_result($nroDocumento);
        $stmt->fetch();
        $stmt->close();
        $this->database->disconnect();
        if (isset($nroDocumento)) {
            echo "<script>
                alert('El usuario ya existe');
                window.location.href = '../../Views/crearUsuario.html'; 
                </script>";
            exit();}

    }
    public function guardar(UsuarioModel $usuarioModel){
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
        if ($epasswd == $passwd || password_verify($passwd, $epasswd)){
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
