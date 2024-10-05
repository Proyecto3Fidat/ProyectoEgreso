<?php

namespace App\Controllers;

use App\Repositories\ClienteRepository;
use App\Repositories\ClientetelefonoRepository;
use App\Services\ClienteService;
use App\Services\ClientetelefonoService;
use App\Services\EligeService;
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
        if(isset($_SESSION['sesion']) && $_SESSION['sesion'] === true) {
        if ($usuarioService->comprobarToken($_SESSION['documento'], $_SESSION['token'])) {

            $this->clienteService->imprimirNota($_GET['id']);
        }
        }else{
            $usuarioService->tokenInvalido();
            echo "<script>
                alert('No tiene permisos para ver esta página');
                window.location.href = '../../Public/inicio.html'; 
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
    public function obtenerListaClientesAdmin()
    {
        $clienteTelefonoRepository = new ClientetelefonoRepository();
        $clienteTelefonoService = new ClientetelefonoService($clienteTelefonoRepository);
        $usuarioRepo = new UsuarioRepository();
        $eligeService = new EligeService();
        $usuarioService = new UsuarioService($usuarioRepo);
        $lista = $this->clienteService->listarClientes();
        $clientes = $usuarioService->comprobarClientes($lista);
        $resultado = [];
        foreach ($clientes as $cliente) {
            $pago = $eligeService->obtenerPagosPorDocumento($cliente['nroDocumento']);
            $edad = $this->clienteService->calcularEdad($cliente['fechaNacimiento']);
            $direccion = "{$cliente['calle']} {$cliente['numero']} {$cliente['esquina']}";

            // Verificar si $pago es null
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
                    'fechaVencimiento' => $pago['fechaVencimiento']
                ];
            } else {
                // En caso de que $pago sea null
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
                    'fechaVencimiento' => null
                ];
            }
        }
        echo json_encode($resultado);
    }


}   
