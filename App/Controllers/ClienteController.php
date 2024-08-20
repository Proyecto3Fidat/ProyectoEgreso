<?php
namespace App\Controllers;
use App\Services\ClienteService;
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

    public function crearEntrenador()
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
    public function imprimirNota(){
        $this->logger->info('Se intento imprimir la nota');
        $this->clienteService->imprimirNota($_GET['id']);
    }
}   
