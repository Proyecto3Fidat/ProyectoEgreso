<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        if($_SESSION['rol'] == "cliente"){
            header("Location: ../../Public/inicio.html");
            exit();
        }else if($_SESSION['rol'] == "entrenador"){
            header("Location: ../../App/Views/entrenador.html");
            exit();
        }
        exit();
    }
}
