<?php

namespace App\Controllers;
use App\Controllers\TemplateController;

class HomeController
{

    public function index()
    {
        $template = new TemplateController();
        $existe = isset($_SESSION['rol']);
        if (!$existe) {
            $template->renderTemplate('inicio');
            exit();
        } else
        if ($_SESSION['rol'] == "cliente" && $_SESSION['rol'] != null) {
            $template->renderTemplate('inicio');
            exit();
        } else if ($_SESSION['rol'] == "entrenador" && $_SESSION['rol'] != null) {
            $template->renderTemplate('entrenador');
            exit();
        } else if ($_SESSION['rol'] == "deportista" || $_SESSION['rol'] == "paciente" && $_SESSION['rol'] != null) {
            $template->renderTemplate('calificaciones');
            exit();
        }else if ($_SESSION['rol'] == "administrativo" && $_SESSION['rol'] != null) {
            $template->renderTemplate("listaClientesAdmin");
            exit();
        } else {
            $template->renderTemplate('inicio');
            exit();
        }
    }
}
