<?php
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    // Constructor para inicializar las credenciales de la base de datos
    public function __construct($servername = "localhost", $username = "admin", $password = "admin", $dbname = "fidatbd") {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->conn = null;
    }

    // Método para conectar a la base de datos
    public function connect() {
        // Crear conexión
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verificar conexión
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        echo "Conexión exitosa";
    }

    // Método para desconectar de la base de datos
    public function disconnect() {
        if ($this->conn !== null) {
            $this->conn->close();
            $this->conn = null;
            echo "Conexión cerrada";
        }
    }

    // Método para obtener la conexión activa
    public function getConnection() {
        return $this->conn;
    }
}
