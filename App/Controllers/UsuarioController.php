<?php
namespace App\Controllers;

use App\Services\UsuarioService;
use App\Models\UsuarioModel;
use App\Repositories\UsuarioRepository;

class UsuarioController {
    private $usuarioService;

    public function __construct(UsuarioService $usuarioService) {
        $this->usuarioService = $usuarioService;
    }

    public function comprobarUsuario() {
        $usuarioRepository = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepository);
        if($usuarioService->comprobarUsuario($_POST['nroDocumento']) == true) {
            echo "El usuario ya existe";
            exit();
        }else {
            $this->crearUsuario();
            echo "Usuario creado";
            exit();
        }
    }
    public function crearUsuario() {
        $usuario = new UsuarioModel(
            $_POST['nroDocumento'],
            $_POST['rol'],
            $_POST['passwd']
        );
        $this->usuarioService->crearUsuario($usuario);
    }

    public function autenticar() {
        if ($this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']) == false) {
            header("Location: ../../App/Views/loginusuario.html?error=true");
            exit();
        } else {
            echo "<script>
                localStorage.setItem('documento', '" . $this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']). "');
                window.location.href = '../../Public/inicio.html'; 
                </script>";
            $_SESSION['logged'] = true;
            $_SESSION['nroDocumento'] = $_POST['documento'];
            echo "Sesion iniciada";
        }
    }

    public function logout() {
        session_destroy();
        echo "<script>
            localStorage.removeItem('documento');
            window.location.href = '../../Public/inicio.html'; // Redirigir a la página de inicio
            </script>";
    }
}
?>
