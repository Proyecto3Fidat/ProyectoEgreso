<?php
namespace App\Views;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
use App\Controllers\UsuarioController;
use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;
use App\Controllers\ObtieneController;
use App\Services\ObtieneService;
use App\Repositories\ObtieneRepository;
use App\Controllers\CalificacionController;
use App\Services\CalificacionService;
use App\Repositories\CalificacionRepository;

$config = require __DIR__ . '/../../Config/monolog.php';
$logger = $config['logger']();
$usuarioRepository = new UsuarioRepository();
$usuarioService = new UsuarioService($usuarioRepository);
$usuarioController = new UsuarioController($usuarioService, $logger);
$obtieneRepository = new ObtieneRepository();
$obtieneService = new ObtieneService($obtieneRepository);
$obtieneController = new ObtieneController($obtieneService, $logger);
$calificacionRepository = new CalificacionRepository();
$calificacionService = new CalificacionService($calificacionRepository);
$calificacionController = new CalificacionController($calificacionService, $logger);
$token = $usuarioController->comprobarToken();

if (
    $_SESSION['sesion'] == false ||
    $_SESSION['sesion'] == null ||
    $_SESSION['rol'] == null ||
    ($_SESSION['rol'] != "deportista" && $_SESSION['rol'] != "paciente" && $usuarioController->comprobarToken() == false)
) {
    $redireccion = "loginusuario.html";

    echo "<script>
            alert('No tiene permisos para ver esta página');
            window.location.href = '$redireccion';
        </script>";
    exit();
} else {
    $resultado = $obtieneController->obtenerCalificaciones();
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
                <button class="cerrarmenu" id="cerrar"><i class="fa-solid fa-right-from-bracket fa-xl"
                        style="color: #ffffff;"></i></button>
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
            <th>Fecha</th>
            <th>Puntuacion Total</th>
            <th>Fuerza Muscular</th>
            <th>Resistencia Muscular</th>
            <th>Resistencia Anaerobica</th>
            <th>Resiliencia</th>
            <th>Flexibilidad</th>
            <th>Cumplimiento de Agenda</th>
            <th>Resistencia a la Monotonia</th>
            <th>Imprimir</th>
        </tr>
        <?php foreach ($resultado as $resultados): ?>
            <?php
            // Obtener calificaciones
            $calificacion = $calificacionController->obtenerPuntuaciones($resultados['id']);
            
            // Asegúrate de que $calificacion no esté vacío y sea un array
            if (is_array($calificacion) && !empty($calificacion)) {
                $calificacion = $calificacion[0]; // Accede al primer elemento del array
            } else {
                $calificacion = []; // Definir $calificacion como un array vacío si no hay datos
            }
            ?>

            <tr>
                <td><?php echo htmlspecialchars($resultados['fecha']); ?></td>
                <td><?php echo htmlspecialchars($resultados['puntObtenido']); ?></td>
                <td><?php echo htmlspecialchars(isset($calificacion['fuerzaMusc']) ? $calificacion['fuerzaMusc'] : ''); ?></td>
                <td><?php echo htmlspecialchars(isset($calificacion['resMusc']) ? $calificacion['resMusc'] : ''); ?></td>
                <td><?php echo htmlspecialchars(isset($calificacion['resAnaerobica']) ? $calificacion['resAnaerobica'] : ''); ?></td>
                <td><?php echo htmlspecialchars(isset($calificacion['resiliencia']) ? $calificacion['resiliencia'] : ''); ?></td>
                <td><?php echo htmlspecialchars(isset($calificacion['flexibilidad']) ? $calificacion['flexibilidad'] : ''); ?></td>
                <td><?php echo htmlspecialchars(isset($calificacion['cumplAgenda']) ? $calificacion['cumplAgenda'] : ''); ?></td>
                <td><?php echo htmlspecialchars(isset($calificacion['resMonotonia']) ? $calificacion['resMonotonia'] : ''); ?></td>
                <td><button id="printButton" class="btn-detalles" onclick="window.location.href='/imprimirNota?ID=<?php echo $calificacion['id'] ?>';">Imprimir</button></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
        

        <script src="../../Public/js/script.js"></script>
    </body>

    </html>
    <?php
}