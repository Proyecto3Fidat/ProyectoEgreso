<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../vendor/autoload.php';
use Pecee\SimpleRouter\SimpleRouter;
require_once  '../Config/monolog.php';
$config = require '../Config/monolog.php';
$logger = $config['logger']();
// Establecer manejadores de errores y excepciones globales
set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($logger) {
    $message = "Error [$errno]: $errstr at $errfile line $errline";
    $logger->error($message);
    header ("Location: /App/Views/error.html");
});

set_exception_handler(function ($exception) use ($logger) {
    $message = "Uncaught Exception " . get_class($exception) . ": " . $exception->getMessage();
    $logger->error($message, ['exception' => (string) $exception]);
    if ($exception instanceof Pecee\SimpleRouter\Exceptions\NotFoundHttpException) {
        header ("Location: /App/Views/404.html");    
    }else 
    header ("Location: /App/Views/error.html");
});

require_once  '../Routes/web.php';
SimpleRouter::start();
