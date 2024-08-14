<?php
namespace App\Controllers;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Services\UsuarioService;
use App\Models\UsuarioModel;
use App\Repositories\UsuarioRepository;
use Monolog\Logger;

class UsuarioController {
    private $usuarioService;
    private $logger;

    public function __construct(UsuarioService $usuarioService,  Logger $logger) {
        $this->usuarioService = $usuarioService;
        $this->logger = $logger;
    }

    public function comprobarUsuario() {
        $usuarioRepository = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepository);
        return $usuarioService->comprobarUsuario($_POST['nroDocumento']);
    }
    public function crearUsuario() {
        $this->logger->info('Se intento crear el usuario: '. $_POST['nroDocumento']);
        $usuario = new UsuarioModel(
            $_POST['nroDocumento'],
            "cliente",
            $_POST['passwd'],
            $this->usuarioService->generarToken()
        );
        $this->usuarioService->crearUsuario($usuario);
    }

    public function autenticar(){
            $this->logger->info('Se intento autenticar el usuario: '. $_POST['documento']);
            $resultadoAutenticacion = $this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']);
            $resultado = $resultadoAutenticacion['resultado'];
            if ($resultado == false) {
                header("Location: ../../App/Views/loginusuario.html?error=true");
                $this->logger->info('El usuario: '. $_POST['documento']. " no se autentico correctamente");
            } else { 
                $this->logger->info('El usuario: '. $_POST['documento']. " se autentico correctamente");
                $rol = $resultadoAutenticacion['rol'];
                $nombre = $resultadoAutenticacion['nombre'];
                $token = $resultadoAutenticacion['token'];
                $documento = $resultadoAutenticacion['documento'];
                switch($rol){
                    case "entrenador": 
                        $_SESSION['token'] = $token;
                        $_SESSION['documento'] = $documento;
                        $_SESSION['nombre'] = $nombre;
                        $_SESSION['rol'] = $rol;
                        echo "<script>
                            localStorage.setItem('nombre', '" . $nombre . "');
                            window.location.href = '../../App/Views/entrenador.html'; 
                            </script>";
                    case "cliente":
                        $_SESSION['token'] = $token;
                        $_SESSION['documento'] = $documento;
                        $_SESSION['nombre'] = $nombre;
                        $_SESSION['rol'] = $rol;
                        echo "<script>
                            localStorage.setItem('nombre', '" . $nombre . "');
                            window.location.href = '../../Public/inicio.html'; 
                            </script>";
                        
                    }
            }
    }
    
    public function crearEntrenador(){
        $this->logger->info('Se intento crear el administrador: '. $_POST['nroDocumento']);
        $usuario = new UsuarioModel(
            $_POST['nroDocumento']."@"."entrenador",
            'entrenador',
            $_POST['passwd'],
            $this->usuarioService->generarToken()
        );
        $this->usuarioService->crearEntrenador($usuario);
    }

    
    public function logout() {
        $this->logger->info('Se deslogeo '. $_GET['nombre']); 
        session_unset();
        session_destroy();
        echo "<script>
            localStorage.removeItem('nombre');
            window.location.href = '../../Public/inicio.html';
            </script>";
        exit();
    }        
}    

?>