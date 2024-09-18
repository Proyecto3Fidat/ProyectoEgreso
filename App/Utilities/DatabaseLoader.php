<?php

namespace App\Utilities;

class DatabaseLoader {
    private $pdo;
    private $host;
    private $username;
    private $password;

    public function __construct($host = null, $username = null, $password = null) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
    }

    private function connectToServer() {
        $dsn = "mysql:host=$this->host;charset=utf8mb4";
        try {
            // Usamos \PDO para referenciar la clase PDO del espacio de nombres global
            $this->pdo = new \PDO($dsn, $this->username, $this->password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]);
        } catch (\PDOException $e) {
            die("Error connecting to the server: " . $e->getMessage());
        }
    }

    public function createDatabaseIfNotExists($dbname) {
        $this->connectToServer();
        $sql = "CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
        try {
            $this->pdo->exec($sql);
            echo "La base de datos `$dbname` fue creada o ya existe.\n";
        } catch (\PDOException $e) {
            die("Error creando la base de datos: " . $e->getMessage());
        }
    }

    public function connectToDatabase($dbname) {
        $dsn = "mysql:host=$this->host;dbname=$dbname;charset=utf8mb4";
        try {
            $this->pdo = new \PDO($dsn, $this->username, $this->password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]);
        } catch (\PDOException $e) {
            die("Error conectando a la base de datos: " . $e->getMessage());
        }
    }

    public function loadSQLFile($sqlFilePath) {
        $fullPath = realpath($sqlFilePath);
        if (!$fullPath || !file_exists($fullPath)) {
            die("Archivo no encontrado en la ruta: $fullPath.\n");
        }

        $sql = file_get_contents($fullPath);
        try {
            $this->pdo->exec($sql);
            echo "Archivo SQL cargado exitosamente.\n";
        } catch (\PDOException $e) {
            die("Error ejecutando el archivo SQL: " . $e->getMessage());
        }
    }

    public function crearBD() {
        $dbLoader = new DatabaseLoader('127.0.0.1', 'admin', 'admin');
        $dbLoader->createDatabaseIfNotExists('FidatBD');
        $dbLoader->connectToDatabase('FidatBD');
        $sqlFilePath = __DIR__ . '/../../Config/BaseDeDatos.sql';
        $dbLoader->loadSQLFile($sqlFilePath);
    }
}
