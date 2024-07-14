<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;

// Configuración de Monolog
//este metodo se encarga de guardar los logs en un archivo utilizando la libreria monolog
return [
    'logger' => function() {
        $logger = new Logger('app');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/app.log', Logger::DEBUG));
        ErrorHandler::register($logger);
        return $logger;
    }
];
