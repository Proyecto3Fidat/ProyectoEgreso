<?php

namespace App\Controllers;

class ErrorController {

    public function paginaInaccesible() {
        // Aquí puedes mostrar un mensaje de error o una página de error 404
        echo "Error 404: Página no encontrada";
        exit();
    }

}
