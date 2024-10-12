<?php
namespace App\Controllers;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Services\UsuarioService;
use App\Models\UsuarioModel;
use App\Repositories\UsuarioRepository;
use Monolog\Logger;

class UsuarioController
{
    private $usuarioService;
    private $logger;

    public function __construct(UsuarioService $usuarioService, Logger $logger)
    {
        $this->usuarioService = $usuarioService;
        $this->logger = $logger;
    }

    public function comprobarUsuario()
    {
        $usuarioRepository = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepository);
        return $usuarioService->comprobarUsuario($_POST['nroDocumento']);
    }
    public function crearUsuario()
    {
        $this->logger->info('Se intento crear el usuario: ' . $_POST['nroDocumento']);
        $usuario = new UsuarioModel(
            $_POST['nroDocumento'],
            "cliente",
            $_POST['passwd'],
            $this->usuarioService->generarToken()
        );
        $this->usuarioService->crearUsuario($usuario);
    }

   public function autenticar(){
        $this->logger->info('Se intento autenticar el usuario: ' . $_POST['documento']);
        $this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']);
   }

    public function crearEntrenador()
    {
        $this->logger->info('Se intento crear el administrador: ' . $_POST['nroDocumento']);
        $usuario = new UsuarioModel(
            $_POST['nroDocumento'] . "@" . "entrenador",
            'entrenador',
            $_POST['passwd'],
            $this->usuarioService->generarToken()
        );
        $this->usuarioService->crearEntrenador($usuario);
    }

    public function crearAdministrativo()
    {
        $this->logger->info('Se intento crear el administrativo: ' . $_POST['nroDocumento']);
        $usuario = new UsuarioModel(
            $_POST['nroDocumento'] . "@" . "administrativo",
            'administrativo',
            $_POST['passwd'],
            $this->usuarioService->generarToken()
        );
        $this->usuarioService->crearAdministrativo($usuario);
    }

    public function guardarDeportista()
    {
        $this->logger->info('Se intento guardar el entrenador: ' . $_POST['nroDocumento']);
        $this->usuarioService->guardarDeportista($_POST['nroDocumento']);
    }
    public function guardarPaciente()
    {
        $this->logger->info('Se intento guardar el entrenador: ' . $_POST['nroDocumento']);
        $this->usuarioService->guardarPaciente($_POST['nroDocumento']);
    }
   
    public function comprobarToken()
    {
        $this->logger->info('Se intento comprobar el token: ' . $_SESSION['documento']);
        return $this->usuarioService->comprobarToken($_SESSION['documento'], $_SESSION['token']);
    }

    public function comprobarDeportistaOPaciente($usuarios)
    {
         return $this->usuarioService->comprobarDeportistaOPaciente($usuarios);
    }
    public function logout()
    {
        $this->logger->info('Se intento cerrar sesion');
        $this->usuarioService->logout();
    }
    public function obtenerIipoDocumento($documento)
    {
        return $this->usuarioService->obtenerTipoDocumento($documento);
    }
}

?>