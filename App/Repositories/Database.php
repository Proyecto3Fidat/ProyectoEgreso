<?php
namespace App\Repositories;

use App\Repositories\Logger;

class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private $logger;

    public function __construct($servername = "localhost", $username = "admina", $password = "admin", $dbname = "fidatbd") {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->conn = null;
        $this->logger = new Logger(); // Inicializar el logger
    }

    public function connect() {
        try {
            $this->conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);

            if ($this->conn->connect_error) {
                throw new \Exception("Conexión fallida: " . $this->conn->connect_error);
            }
            
            echo "Conexión exitosa";
        } catch (\Exception $e) {
            // Registrar el error utilizando el logger
            $this->logger->logError("Error en Database::connect(): " . $e->getMessage());
            die("Error en la conexión a la base de datos. Revisa el registro de errores.");
        }
    }

    public function disconnect() {
        if ($this->conn !== null) {
            $this->conn->close();
            $this->conn = null;
            echo "Conexión cerrada";
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
