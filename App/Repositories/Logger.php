<?php
namespace App\Repositories;

class Logger {
    private $logFile;

    public function __construct($logFile = 'error_log.txt') {
        $this->logFile = $logFile;
    }

    public function logError($message) {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "$timestamp - $message\n";

        // Abrir el archivo en modo append (a) para agregar al final
        $fileHandle = fopen($this->logFile, 'a');
        if ($fileHandle) {
            fwrite($fileHandle, $logMessage);
            fclose($fileHandle);
        } else {
            // Manejar el error si no se puede abrir el archivo (por ejemplo, registrar en otro lugar)
            error_log("Error al escribir en el archivo de registro: " . $this->logFile);
        }
    }
}
?>