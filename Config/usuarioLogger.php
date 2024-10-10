<?php
require __DIR__ . '/../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;

return [
    'logger' => function() {
        $logger = new Logger('app');

        // Log general
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/app.log', Logger::DEBUG));

        // Log específico para el usuario
        $usuarioHandler = new StreamHandler(__DIR__ . '/logs/usuario.log', Logger::INFO);
        $logger->pushHandler($usuarioHandler);

        ErrorHandler::register($logger);

        return $logger;
    }
];