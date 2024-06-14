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

    public function guardar(UsuarioModel $usuarioModel){
        $this->database->connect(); // Conectar a la base de datos
            
        $sql = "INSERT INTO Usuario (nroDocumento, rol, passwd) 
                VALUES (?,?, ?)";
        
        // Asignar los valores de los métodos a variables
        $nroDocumento = $usuarioModel->getNroDocumento();
        $rol = $usuarioModel->getRol();
        $passwd = $usuarioModel->getPasswd();       
        $stmt = $this->database->getConnection()->prepare($sql); // Preparar la consulta SQL
        $stmt->bind_param(
            "iis",
            $nroDocumento,
            $rol,
            $passwd,
        );
        $stmt->execute();
        $stmt->close();
        $this->database->disconnect(); // Desconectar de la base de datos
    }
    
    public function autenticar($nroDocumento, $passwd) {
        $this->database->connect(); // Conectar a la base de datos

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
        $this->database->disconnect(); // Desconectar de la base de datos
        if ($epasswd == $passwd || password_verify($passwd, $epasswd)){
            return true;
        }
        return false;
    }
}