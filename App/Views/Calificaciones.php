<?php
namespace App\Views;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use App\Controllers\UsuarioController;
use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;
$config = require __DIR__ . '/../../Config/monolog.php';
$logger = $config['logger']();
$usuarioRepository = new UsuarioRepository();
$usuarioService = new UsuarioService($usuarioRepository);
$usuarioController = new UsuarioController($usuarioService, $logger);
$token = $usuarioController->comprobarToken();
if (
    $_SESSION['sesion'] == false ||
    $_SESSION['sesion'] == null ||
    $_SESSION['rol'] == null ||
    ($_SESSION['rol'] != "deportista" && $_SESSION['rol'] != "paciente" && $usuarioController->comprobarToken() == false)
){
    $redireccion = "loginusuario.html"; 

    echo "<script>
            alert('No tiene permisos para ver esta página');
            window.location.href = '$redireccion';
        </script>";
    exit(); 
}else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/css/stylesExtra.css">
    <link rel="stylesheet" href="../../Public/css/styleCliente.css">
    <link rel="stylesheet" href="../../Public/css/responsive.css">
    <script src="https://kit.fontawesome.com/58f9dcf30d.js" crossorigin="anonymous"></script>
    <title>Calificación</title>
</head>
<body>
    <header>
        <section class="navhead">
            <button class="abrirmenu" id="abrir"><i class="fa-solid fa-bars fa-xl" style="color: #ffffff;"></i></button>
        </section>
        <nav class="navbar" id="nav">
            <button class="cerrarmenu" id="cerrar"><i class="fa-solid fa-right-from-bracket fa-xl" style="color: #ffffff;"></i></button>
                <div class="menu1">
                    <ul class="listmenu1">
                        <li><a href="/inicio" class="inicioa">Gym</a></li>
                        <li><a href="/horarios" class="inicioa">Horarios</a></li>
                        <li><a href="/planes" class="inicioa">Planes</a></li>
                    </ul>
                </div>
                <div class="menu2">
                    <ul class="listmenu2" id="welcome-message">
                    </ul>
                </div>
        </nav>
    </header>
<section class="agendaCliente">
    <h1>Calificación</h1>
    <table class="horariosCliente">
        <tr>
          <th>Nombre</th>
          <th>Cédula</th>
          <th>Ejercicio</th>
          <th>Nota</th>
          <th>Juicio</th>
        </tr>
        <tr>
          <td>Juan Pérez</td>
          <td>12345678-9</td>
          <td>Fútbol</td>
          <td>9.5</td>
          <td>Muy buena técnica, sabe flotar en el agua perfectamente, está muy avanzado con respecto a sus compañeros.</td>
        </tr>
        </table>
</section>
    
    <script src="../../Public/js/script.js"></script>
</body>
</html>
<?php
}