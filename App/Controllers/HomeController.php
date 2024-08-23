<?php

namespace App\Controllers;

class HomeController {
    public function index() {
        if($_SESSION['rol'] == "cliente" && $_SESSION['rol'] != null){
            header("Location: ../../Public/inicio.html");
            exit();
        }else if($_SESSION['rol'] == "entrenador" && $_SESSION['rol'] != null){
            header("Location: ../../App/Views/entrenador.php");
            exit();
        }else if($_SESSION['rol'] == "deportista" || $_SESSION['rol'] == "paciente" && $_SESSION['rol'] != null)
        {
            header("Location: ../../App/Views/Calificaciones.html");
            exit();
        }else {
            header("Location: ../../Public/inicio.html");
            exit();
        }
    }
}
