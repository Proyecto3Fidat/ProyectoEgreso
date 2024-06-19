<?php

namespace App\Controllers;

class Error404 {
    
    public function notFound() {
        exit();
    }

}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso denegado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        h1 {
            color: #FF0000;
        }
    </style>
</head>
<body>
    <h1>Pagina no encontrada</h1>
    <p>No se ha encontrado la pagina solicitada</p>
</body>
</html>