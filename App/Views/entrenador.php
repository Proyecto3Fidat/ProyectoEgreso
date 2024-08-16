<?php
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

if($_SESSION['sesion'] == false || $_SESSION['sesion'] == null && $_SESSION['rol'] == null || $_SESSION['rol'] != "entrenador" && $usuarioController->comprobarToken()){
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
    <link rel="stylesheet" href="../../Public/css/styleentrenador.css">
    <link rel="stylesheet" href="../../Public/css/responsive.css">
    <script src="https://kit.fontawesome.com/58f9dcf30d.js" crossorigin="anonymous"></script>
    <title>Entrenador</title>
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
                        <li><a href="/" class="inicioa">Inicio</a></li>
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
        <section>
            <div>
                <a class="tituloent" href="#">Bienvenido, <?php echo $_SESSION['nombre'] ?></a>
            </div>
        </section>
        
        <section>
            <div class="btnent">
               <a href="../Views/listaclientes.php"><button class="clienteslist">Lista de clientes</button></a> 
                <a href="#"><button class="ejerciciolist">Lista de ejercicios</button></a>
                <a href="#"><button class="rutinaslist">Lista de rutinas</button></a>
            </div>
        </section>
        <section class="agenda">
            <h1>HORARIOS</h1>
            <table class="horarios">
                <tr id="diasagenda">
                    <th data-label="Hora">Hora</th>
                    <th data-label="Lunes">Lunes</th>
                    <th data-label="Martes">Martes</th>
                    <th data-label="Miércoles">Miércoles</th>
                    <th data-label="Jueves">Jueves</th>
                    <th data-label="Viernes">Viernes</th>
                </tr>
                <tr>
                    <th data-label="Hora">7:00 a 8:00</th>
                    <td data-label="Lunes">Pilates</td>
                    <td data-label="Martes">Gimnasio Libre</td>
                    <td data-label="Miércoles">Estiramiento</td>
                    <td data-label="Jueves">Pilates</td>
                    <td data-label="Viernes" id="td-final">Boxeo</td>
                </tr>
                <tr>
                    <th data-label="Hora">8:30 a 9:45</th>
                    <td data-label="Lunes">Gimnasio Libre</td>
                    <td data-label="Martes">Pilates</td>
                    <td data-label="Miércoles">Recuperación Muscular</td>
                    <td data-label="Jueves">Cardio</td>
                    <td data-label="Viernes" id="td-final">Gimnasio Libre</td>
                </tr>
                <tr>
                    <th data-label="Hora">9:45 a 10:30</th>
                    <td data-label="Lunes">Caminadora</td>
                    <td data-label="Martes">Boxeo</td>
                    <td data-label="Miércoles">Masajes</td>
                    <td data-label="Jueves">Boxeo</td>
                    <td data-label="Viernes" id="td-final">Cardio</td>
                </tr>
                <tr>
                    <th data-label="Hora">9:45 a 10:30</th>
                    <td data-label="Lunes">Boxeo</td>
                    <td data-label="Martes">Cardio</td>
                    <td data-label="Miércoles">Fortalecimiento de tendones</td>
                    <td data-label="Jueves">Tren Inferior</td>
                    <td data-label="Viernes" id="td-final">Tren Superior</td>
                </tr>
                <tr>
                    <th data-label="Hora">11:00 a 12:00</th>
                    <td data-label="Lunes">Tren Superior</td>
                    <td data-label="Martes">Tren Inferior</td>
                    <td data-label="Miércoles">Libre</td>
                    <td data-label="Jueves">Tren Superior</td>
                    <td data-label="Viernes" id="td-final">Recuperación Muscular</td>
                </tr>
                <tr>
                    <th data-label="Hora">12:15 a 13:45</th>
                    <td data-label="Lunes">Cardio</td>
                    <td data-label="Martes">Caminadora</td>
                    <td data-label="Miércoles">Tren Superior</td>
                    <td data-label="Jueves">Fortalecimiento de tendones</td>
                    <td data-label="Viernes" id="td-final">Caminadora</td>
                </tr>
                <tr>
                    <th data-label="Hora">14:00 a 15:00</th>
                    <td data-label="Lunes">Tren Inferior</td>
                    <td data-label="Martes">Tren Superior</td>
                    <td data-label="Miércoles">Cardio</td>
                    <td data-label="Jueves">Estiramiento</td>
                    <td data-label="Viernes" id="td-final">Masajes</td>
                </tr>
              </table> 
        </section>
        
<script src="../../Public/js/script.js"></script>
</body>
</html>
<?php } ?>