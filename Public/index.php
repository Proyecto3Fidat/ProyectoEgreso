<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Pecee\SimpleRouter\SimpleRouter as Router;

require_once __DIR__ . '/../routes/web.php';

Router::start();
