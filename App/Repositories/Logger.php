<?php
namespace App\Repositories;

class Logger {
    private $logFile;

    public function __construct($logFile = 'error_log.txt') {
        $this->logFile = $logFile;
    }

    public function logError($message, $level = 'ERROR', $context = []) {
        $timestamp = date('Y-m-d H:i:s');
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2); // Obtener información de la pila de llamadas
        $callingFile = $backtrace[0]['file'] ?? 'Desconocido';
        $callingLine = $backtrace[0]['line'] ?? 'Desconocida';

        $logMessage = "$timestamp [$level] $message (Archivo: $callingFile, Línea: $callingLine)";

        if (!empty($context)) {
            $logMessage .= "\nContexto:\n" . print_r($context, true); // Agregar contexto si está disponible
        }

        $logMessage .= "\n"; // Nueva línea para separar los mensajes

        $fileHandle = fopen($this->logFile, 'a');
        if ($fileHandle) {
            fwrite($fileHandle, $logMessage);
            fclose($fileHandle);
        } else {
            error_log("Error al escribir en el archivo de registro: " . $this->logFile);
        }
    }
}
?>