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
) {
    $redireccion = "loginusuario.html";

    echo "<script>
            alert('No tiene permisos para ver esta página');
            window.location.href = '$redireccion';
        </script>";
    exit();
} else {
    $datos = [
        [
            'fecha' => '12/10/2021',
            'puntuacionTotal' => 100,
            'fuerzaMuscular' => 50,
            'resistenciaMuscular' => 54,
            'resistenciaAnaerobica' => 23,
            'resiliencia' => 22,
            'flexibilidad' => 10,
            'cumplimientoAgenda' => 10,
            'resistenciaMonotonia' => 10,
        ],
    ];
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
            <?php foreach ($datos as $dato): ?>
            <tr>
                <td><?php echo htmlspecialchars($dato['fecha']); ?></td>
                <td><?php echo htmlspecialchars($dato['puntuacionTotal']); ?></td>
                <td><?php echo htmlspecialchars($dato['fuerzaMuscular']); ?></td>
                <td><?php echo htmlspecialchars($dato['resistenciaMuscular']); ?></td>
                <td><?php echo htmlspecialchars($dato['resistenciaAnaerobica']); ?></td>
                <td><?php echo htmlspecialchars($dato['resiliencia']); ?></td>
                <td><?php echo htmlspecialchars($dato['flexibilidad']); ?></td>
                <td><?php echo htmlspecialchars($dato['cumplimientoAgenda']); ?></td>
                <td><?php echo htmlspecialchars($dato['resistenciaMonotonia']); ?></td>
                <td><button id="printButton" class="btn-detalles" onclick="window.location.href='/imprimirNota';">Imprimir</button></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>

        <script>
    document.getElementById('printButton').addEventListener('click', function() {
        console.log('Botón presionado'); // Verifica en la consola del navegador

        const table = document.getElementById('calificacionTable');
        const rows = table.querySelectorAll('tr');
        const data = [];

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length) {
                const rowData = Array.from(cells).map(cell => cell.textContent);
                data.push(rowData);
            }
        });

        console.log(data); // Verifica en la consola del navegador

        fetch('/imprimirNota', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({
                fecha: data[1][0], // Primera fila de datos, primera columna
                puntuacionTotal: data[1][1],
                fuerzaMuscular: data[1][2],
                resistenciaMuscular: data[1][3],
                resistenciaAnaerobica: data[1][4],
                resiliencia: data[1][5],
                flexibilidad: data[1][6],
                cumplimientoAgenda: data[1][7],
                resistenciaMonotonia: data[1][8],
            }),
        })
        .then(response => response.blob()) // Convertir la respuesta a blob
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'calificacion.pdf';
            document.body.appendChild(a);
            a.click();
            a.remove();
        })
        .catch(error => console.error('Error:', error));
    });
</script>


        <script src="../../Public/js/script.js"></script>
    </body>

    </html>
    <?php
}