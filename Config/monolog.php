<?php
require __DIR__ . '/../vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;

return [
    'logger' => function() {
        $logger = new Logger('app');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/app.log', Logger::DEBUG));
        ErrorHandler::register($logger);
        return $logger;
    }
];
