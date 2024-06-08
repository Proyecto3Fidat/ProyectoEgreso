<?php

require_once '../vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
require_once '../Routes/web.php';

SimpleRouter::start();