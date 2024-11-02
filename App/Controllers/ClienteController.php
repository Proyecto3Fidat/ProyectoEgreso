<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Repositories\ClienteRepository;
use App\Repositories\ClientetelefonoRepository;
use App\Services\ClienteService;
use App\Services\ClientetelefonoService;
use App\Services\EligeService;
use App\Services\SeAgendaService;
use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;
use App\Models\ClienteModel;
use Monolog\Logger;
use TCPDF;

class ClienteController
{
    private $clienteService;
    private $logger;

    public function __construct(ClienteService $clienteService, Logger $logger)
    {
        $this->clienteService = $clienteService;
        $this->logger = $logger;
    }

    public function crearCliente()
    {
        $this->logger->info('Se intento crear el cliente: ' . $_POST['nroDocumento']);
        $cliente = new ClienteModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            $_POST['altura'],
            $_POST['peso'],
            $_POST['calle'],
            $_POST['numero'],
            $_POST['esquina'],
            $_POST['email'],
            $_POST['patologias'],
            $_POST['fechaNacimiento'],
            $_POST['nombre'],
            $_POST['apellido']
        );
        $this->clienteService->crearCliente($cliente);
    }

    public function emailBienvenida($email)
    {
        $this->logger->info('Se envio el email de bienvenida a: ' . $email);
        $this->clienteService->emailBienvenida($email);
    }

    public function crearConPrivilegios()
    {
        $cliente = new ClienteModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            null,
            null,
            null,
            null,
            null,
            $_POST['email'],
            null,
            null,
            $_POST['nombre'],
            $_POST['apellido'],
        );
        $this->clienteService->crearEntrenador($cliente);
    }

    public function modificarNombre($nroDocumento, $nombre)
    {
        $cliente = new ClienteModel(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            $nombre,
            null,
        );
        $this->clienteService->modificarNombre($nroDocumento, $cliente);
    }

    public function modificarApellido($nroDocumento, $apellido)
    {
        $cliente = new ClienteModel(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            $apellido,
        );
        $this->clienteService->modificarApellido($nroDocumento, $cliente);
    }

    public function comprobarCliente()
    {

        return $this->clienteService->comprobarCliente($_POST['nroDocumento']);
    }

    public function listarClientes()
    {
        $usuarioRepo = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepo);
        if ($usuarioService->comprobarToken($_SESSION['documento'], $_SESSION['token']) == false) {
            $usuarioService->tokenInvalido();
        } else {
            return $this->clienteService->listarClientes();
        }
    }

    public function imprimirNota()
    {
        $usuarioRepo = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepo);
        $this->logger->info('Se intento imprimir la nota');
        if (isset($_SESSION['sesion']) && $_SESSION['sesion'] === true) {
            if ($usuarioService->comprobarToken($_SESSION['documento'], $_SESSION['token'])) {

                $this->clienteService->imprimirNota($_GET['id']);
            }
        } else {
            $usuarioService->tokenInvalido();
            echo "<script>
                alert('No tiene permisos para ver esta página');
                window.location.href = '../../Public/inicio.html.twig'; 
              </script>";
        }
    }

    public function obtenerListaClientesAjax()
    {

        $clienteTelefonoRepository = new ClientetelefonoRepository();
        $clienteTelefonoService = new ClientetelefonoService($clienteTelefonoRepository);
        $usuarioRepo = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepo);


        $lista = $this->clienteService->listarClientes();
        $clientes = $usuarioService->comprobarDeportistaOPaciente($lista);
        $resultado = [];
        foreach ($clientes as $cliente) {
            $edad = $this->clienteService->calcularEdad($cliente['fechaNacimiento']);
            $direccion = "{$cliente['calle']} {$cliente['numero']} {$cliente['esquina']}";
            $resultado[] = [
                'nombre' => $cliente['nombre'],
                'nroDocumento' => $cliente['nroDocumento'],
                'rol' => $cliente['rol'],
                'altura' => $cliente['altura'],
                'peso' => $cliente['peso'],
                'patologias' => $cliente['patologia'],
                'email' => $cliente['email'],
                'edad' => $edad,
                'direccion' => $direccion,
                'telefono' => $clienteTelefonoService->traerClienteTelefono($cliente['nroDocumento'])
            ];
        }
        echo json_encode($resultado);

    }

    public function obtenerInfoCliente($nroDocumento)
    {


        $clienteTelefonoRepository = new ClientetelefonoRepository();
        $clienteTelefonoService = new ClientetelefonoService($clienteTelefonoRepository);
        $cliente = $this->clienteService->obtenerInfoCliente($nroDocumento);

        if (is_array($cliente) && count($cliente) === 1) {
            $cliente[0]['documento'] = $nroDocumento;
            $cliente[0]['edad'] = $this->clienteService->calcularEdad($cliente[0]['fechaNacimiento']);

            return $cliente[0];
        }

        return $cliente;
    }

    public function obtenerListaClientesAdmin()
    {
        $seAgenda = new SeAgendaService();
        $clienteTelefonoRepository = new ClientetelefonoRepository();
        $clienteTelefonoService = new ClientetelefonoService($clienteTelefonoRepository);
        $usuarioRepo = new UsuarioRepository();
        $eligeService = new EligeService();
        $usuarioService = new UsuarioService($usuarioRepo);
        $lista = $this->clienteService->listarClientes();
        $clientes = $usuarioService->comprobarClientes($lista);
        $resultado = [];

        foreach ($clientes as $cliente) {
            $agenda = $seAgenda->obtenerAgendas($cliente['nroDocumento']);

            if ($agenda !== null && !empty($agenda)) {
                $horaInicioSinSegundos = substr($agenda['horaInicio'], 0, 5);
                $horaFinSinSegundos = substr($agenda['horaFin'], 0, 5);
                $dia = $agenda['dia'];
            } else {
                $horaInicioSinSegundos = null;
                $horaFinSinSegundos = null;
                $dia = null;
            }

            $pago = $eligeService->obtenerPagosPorDocumento($cliente['nroDocumento']);
            $edad = $this->clienteService->calcularEdad($cliente['fechaNacimiento']);
            $direccion = "{$cliente['calle']} {$cliente['numero']} {$cliente['esquina']}";

            if ($pago !== null) {
                $resultado[] = [
                    'nombre' => $cliente['nombre'],
                    'nroDocumento' => $cliente['nroDocumento'],
                    'tipoDocumento' => $cliente['tipoDocumento'],
                    'altura' => $cliente['altura'],
                    'peso' => $cliente['peso'],
                    'rol' => $cliente['rol'],
                    'patologias' => $cliente['patologia'],
                    'email' => $cliente['email'],
                    'edad' => $edad,
                    'direccion' => $direccion,
                    'telefono' => $clienteTelefonoService->traerClienteTelefono($cliente['nroDocumento']),
                    'nombrePlan' => $pago['nombrePlan'],
                    'tipoPlan' => $pago['tipoPlan'],
                    'fechaVencimiento' => $pago['fechaVencimiento'],
                    'horaInicio' => $horaInicioSinSegundos,
                    'horaFin' => $horaFinSinSegundos,
                    'dia' => $dia
                ];
            } else {
                $resultado[] = [
                    'nombre' => $cliente['nombre'],
                    'nroDocumento' => $cliente['nroDocumento'],
                    'tipoDocumento' => $cliente['tipoDocumento'],
                    'altura' => $cliente['altura'],
                    'peso' => $cliente['peso'],
                    'rol' => $cliente['rol'],
                    'patologias' => $cliente['patologia'],
                    'email' => $cliente['email'],
                    'edad' => $edad,
                    'direccion' => $direccion,
                    'telefono' => $clienteTelefonoService->traerClienteTelefono($cliente['nroDocumento']),
                    'nombrePlan' => null,
                    'tipoPlan' => null,
                    'fechaVencimiento' => null,
                    'horaInicio' => null,
                    'horaFin' => null,
                    'dia' => null
                ];
            }
        }
        echo json_encode($resultado);
    }

    public function obtenerListaClientesAdmintrativo()
    {
        $clienteTelefonoRepository = new ClientetelefonoRepository();
        $clienteTelefonoService = new ClientetelefonoService($clienteTelefonoRepository);
        $usuarioRepo = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepo);
        $lista = $this->clienteService->listarClientes();
        $clientes = $usuarioService->comprobarRol($lista);
        $resultado = [];

        foreach ($clientes as $cliente) {
            $edad = $this->clienteService->calcularEdad($cliente['fechaNacimiento']);
            $direccion = "{$cliente['calle']} {$cliente['numero']} {$cliente['esquina']}";
            $resultado[] = [
                'nombre' => $cliente['nombre'],
                'apellido' => $cliente['apellido'],
                'nroDocumento' => $cliente['nroDocumento'],
                'tipoDocumento' => $cliente['tipoDocumento'],
                'altura' => $cliente['altura'],
                'peso' => $cliente['peso'],
                'rol' => $cliente['rol'],
                'patologias' => $cliente['patologia'],
                'email' => $cliente['email'],
                'edad' => $edad,
                'direccion' => $direccion,
                'telefono' => $clienteTelefonoService->traerClienteTelefono($cliente['nroDocumento'])
            ];
        }
        return $resultado;
    }

    public function crearUsuarioAdmin()
    {
        $usuarioRepo = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepo);

        var_dump($_POST);
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_SPECIAL_CHARS);
        $nroDocumento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_SPECIAL_CHARS);
        $tipoDocumento = filter_input(INPUT_POST, 'tipoDocumento', FILTER_SANITIZE_SPECIAL_CHARS);
        $fechaNacimiento = filter_input(INPUT_POST, 'fechaNacimiento', FILTER_SANITIZE_SPECIAL_CHARS);
        $correo = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
        $passwd = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
        $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_SPECIAL_CHARS);

        $altura = filter_input(INPUT_POST, 'altura', FILTER_SANITIZE_SPECIAL_CHARS);
        $peso = filter_input(INPUT_POST, 'peso', FILTER_SANITIZE_SPECIAL_CHARS);
        $calle = filter_input(INPUT_POST, 'calle', FILTER_SANITIZE_SPECIAL_CHARS);
        $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);
        $esquina = filter_input(INPUT_POST, 'esquina', FILTER_SANITIZE_SPECIAL_CHARS);
        $patologias = filter_input(INPUT_POST, 'patologias', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($nombre === null || $apellido === null || $nroDocumento === null || $tipoDocumento === null || $fechaNacimiento === null || $correo === null || $passwd === null || $rol === null) {
            echo json_encode(['error' => 'Faltan datos']);
            exit();
        }

        switch ($rol) {
            case 'entrenador':
                if ($this->clienteService->comprobarCliente($nroDocumento) !== null) {
                    if ($usuarioService->comprobarDocumentoRol($nroDocumento."@entrenador") === 'true') {
                        echo json_encode(['error' => 'El entrenador ya existe']);
                        exit();
                    }
                    $usuarioService->crearEntrenador(
                        new UsuarioModel(
                            $nroDocumento . "@" . "entrenador",
                            'entrenador',
                            $passwd,
                            $usuarioService->generarToken()
                        )
                    );
                    exit();
                }
                $this->clienteService->crearSinInfo(
                    new ClienteModel(
                        $nroDocumento,
                        $tipoDocumento,
                        null,
                        null,
                        null,
                        null,
                        null,
                        $correo,
                        null,
                        $fechaNacimiento,
                        $nombre,
                        $apellido,
                        $rol
                    )
                );
                $usuarioService->crearEntrenador(
                         new UsuarioModel(
                            $nroDocumento . "@" . "entrenador",
                            'entrenador',
                            $passwd,
                            $usuarioService->generarToken()
                    )
                    );
                exit();
            case 'administrativo':
                if ($this->clienteService->comprobarCliente($nroDocumento) !== null) {
                    if ($usuarioService->comprobarDocumentoRol($nroDocumento."@administrativo") === 'true') {
                        echo json_encode(['error' => 'El administrativo ya existe']);
                        exit();
                    }
                    $usuarioService->crearAdministrativo(
                        new UsuarioModel(
                            $nroDocumento . "@" . "administrativo",
                            'administrativo',
                            $passwd,
                            $usuarioService->generarToken()
                        )
                    );
                    exit();
                }
                $this->clienteService->crearSinInfo(
                    new ClienteModel(
                        $nroDocumento,
                        $tipoDocumento,
                        $altura,
                        $peso,
                        $calle,
                        $numero,
                        $esquina,
                        $correo,
                        null,
                        $fechaNacimiento,
                        $nombre,
                        $apellido,
                        $rol
                    )
                );
                $usuarioService->crearAdministrativo(
                    new UsuarioModel(
                        $nroDocumento . "@" . "administrativo",
                        'administrativo',
                        $passwd,
                        $usuarioService->generarToken()
                    )
                );
                exit();
                break;
                case('deportista'):
                if ($this->clienteService->comprobarCliente($nroDocumento) !== null) {
                    $this->clienteService->crearCliente(
                        new ClienteModel(
                            $nroDocumento,
                            $tipoDocumento,
                            $altura,
                            null,
                            null,
                            null,
                            null,
                            $correo,
                            null,
                            $fechaNacimiento,
                            $nombre,
                            $apellido,
                            $rol
                        )
                    );
                    if ($usuarioService->comprobarRolAdministrativo($nroDocumento) === 'deportista') {
                        echo json_encode(['error' => 'El deportista ya existe']);
                        exit();
                    }
                    $usuarioService->crearDeportista(
                        new UsuarioModel(
                            $nroDocumento . "@" . "deportista",
                            'deportista',
                            $passwd,
                            $usuarioService->generarToken()
                        )
                    );
                    exit();
                }
            default:
                echo json_encode(['error' => 'Rol incorrecto']);
                exit();
        }
    }


}
