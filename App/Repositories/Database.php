<?php
namespace App\Repositories;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;
    private static $instance = null;

    public function __construct($servername = "192.168.88.235", $username = "root", $password = "uvYyFaR.KSdt6ZAe", $dbname = "FidatBD") {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->conn = null;
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function connect() {
        $this->conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        //echo "Conexión exitosa";
    }

    public function disconnect() {
        if ($this->conn !== null) {
            $this->conn->close();
            $this->conn = null;
           // echo "Conexión cerrada";
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>
