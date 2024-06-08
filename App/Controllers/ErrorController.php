<?php

namespace App\Controllers;

class ErrorController {

    public function notFound() {
        // Aquí puedes mostrar un mensaje de error o una página de error 404
        echo "Error 404: Página no encontrada";
        exit();
    }

}
