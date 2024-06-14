<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../vendor/autoload.php';
use Pecee\SimpleRouter\SimpleRouter;
require_once '../Routes/web.php';

SimpleRouter::start();
