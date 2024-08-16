<?php
    require __DIR__ . '/../../vendor/autoload.php';
    use App\Controllers\ClienteController;   
    use App\Services\ClienteService;
    use App\Repositories\ClienteRepository;

    $config = require __DIR__ . '/../../Config/monolog.php';
    $logger = $config['logger']();

    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
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
    $clientes = $clienteController->listarClientes();
    
    
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
                <!--<th><a href="#"><button class="btn-detalles">Detalles</button></a></th>-->
            </tr>
            <?php if (is_array($clientes) || is_object($clientes)) : ?>
                <?php foreach ($clientes as $cliente) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['nombre'])." ". htmlspecialchars($cliente['apellido']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['nroDocumento']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="2">No hay clientes disponibles.</td>
                </tr>
            <?php endif; ?>
        </table>
    </section>



    <script src="../../Public/js/script.js"></script>
</body>
</html>
<?php } ?>