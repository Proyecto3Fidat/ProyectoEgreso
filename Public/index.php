<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../vendor/autoload.php';
use Pecee\SimpleRouter\SimpleRouter;



header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
require_once  '../Config/monolog.php';

$config = require '../Config/monolog.php';
$logger = $config['logger']();



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

require_once '../Routes/web.php';
SimpleRouter::start();
