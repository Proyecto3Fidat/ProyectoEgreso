<?php
    require __DIR__ . '/../../vendor/autoload.php';
    use App\Controllers\ClienteController;   
    use App\Services\ClienteService;
    use App\Repositories\ClienteRepository;
    use App\Controllers\UsuarioController;
    use App\Services\UsuarioService;
    use App\Repositories\UsuarioRepository;

    $config = require __DIR__ . '/../../Config/monolog.php';
    $logger = $config['logger']();

    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $usuarioController = new UsuarioController(new UsuarioService(new UsuarioRepository()), $logger);

    if (
        $_SESSION['sesion'] == false ||
        $_SESSION['sesion'] == null ||
        $_SESSION['rol'] == null ||
        ($_SESSION['rol'] != "entrenador"&& $usuarioController->comprobarToken() == false)
    ){
        $redireccion = "loginusuario.html"; 
    
        echo "<script>
                alert('No tiene permisos para ver esta página');
                window.location.href = '$redireccion';
            </script>";
        exit(); 
    }else {
    $usuarios = $clienteController->listarClientes();
    $clientes = $usuarioController->comprobarDeportistaOPaciente($usuarios);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Public/css/styleentrenador.css">
    <link rel="stylesheet" href="../../Public/css/responsive.css">
    <script src="https://kit.fontawesome.com/58f9dcf30d.js" crossorigin="anonymous"></script>
    <title>Lista de Clientes</title>
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
                        <li><a href="/">Nosotros</a></li>
                    </ul>
                </div>
                <div class="menu2">
                    <ul class="listmenu2" id="welcome-message">
                    </ul>
                </div>
        </nav>
    </header>

    <section class="listaclientes">
        <table class="lista-clientes">
            <tr>
            <th>Nombre de Cliente</th>
                <th>Documento</th>
                <th>Rol</th>
                <!--<th><a href="#"><button class="btn-detalles">Detalles</button></a></th>-->
            </tr>
            <?php if (is_array($clientes) || is_object($clientes)) : ?>
                <?php foreach ($clientes as $cliente) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['nombre'])." ". htmlspecialchars($cliente['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['nroDocumento']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['rol']); ?></td>
                        <td>
                                <button class="btnfichatecnica">Ficha tecnica</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="2">No hay clientes disponibles.</td>
                </tr>
            <?php endif; ?>
        </table>
    </section>

<section class="fichatecn">
    <tr id="fichatec">
        <td>
        <h4>Ficha tecnica de *Nombre del cliente*</h4>
            <div class="divficha">
                <p>Documento:</p>
                <p>Edad:</p>
                <p>Email:</p>
                <p>Teléfono:</p>
                <p>Dirección:</p>
            </div>
            <div class="divficha2">
                <p>Patologias:</p>
                <p>Altura:</p>
                <p>Peso:</p>
            </div>
        </td>
    </tr>

<section>
    <div class="btnficha">
        <button class="adejerci">Añadir ejercicio</but>
        <button class="adrut">Añadir rutina</button>
    </div>
</section>
</section>
    <script src="../../Public/js/script.js"></script>
</body>
</html>
<?php } ?>       