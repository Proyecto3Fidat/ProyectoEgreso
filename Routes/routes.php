<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', 'Ismael\ProyectoEgreso\Controllers\HomeController@index');
Router::get('/clientes', 'Ismael\ProyectoEgreso\Controllers\ClienteController@index');
