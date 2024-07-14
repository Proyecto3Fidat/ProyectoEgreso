<?php
namespace App\Controllers;

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
            1,
            $_POST['passwd']
        );
        $this->usuarioService->crearUsuario($usuario);
    }

    public function autenticar(){
            $this->logger->info('Se intento autenticar el usuario: '. $_POST['documento']);
            if ($this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']) == false) {
                header("Location: ../../App/Views/loginusuario.html?error=true");
                $this->logger->info('El usuario: '. $_POST['documento']. "no se autentico correctamente");
            } else { 
                $this->logger->info('El usuario: '. $_POST['documento']. "se autentico correctamente");
                echo "<script>
                    localStorage.setItem('nombre', '" . $this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']) . "');
                    window.location.href = '../../Public/inicio.html'; 
                    </script>";
            }
    }
    
    public function logout() {
        $this->logger->info('Se deslogeo '. $_GET['documento']); 
        echo "<script>
            localStorage.removeItem('nombre');
            window.location.href = '../../Public/inicio.html';
            </script>";
    }
}
?>
