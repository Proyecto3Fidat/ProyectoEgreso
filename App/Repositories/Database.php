<?php

namespace App\Repositories;

class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct($servername = "localhost", $username = "admin", $password = "admin", $dbname = "fidatbd") {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->conn = null;
    }

    public function connect() {
        $this->conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        // echo "Conexión exitosa";
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
