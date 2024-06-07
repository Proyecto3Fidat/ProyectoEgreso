<?php

use Pecee\SimpleRouter\SimpleRouter;
use ProyectoEgreso\Controllers\HomeController;
use ProyectoEgreso\Controllers\ClienteController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/clientes', [ClienteController::class, 'index']);
