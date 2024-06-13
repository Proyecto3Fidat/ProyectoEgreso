<?php
namespace App\Controllers;
use App\Services\UsuarioService;
use App\Models\UsuarioModel;

class UsuarioController {
    private $usuarioService;

    public function __construct(UsuarioService $usuarioService) {
        $this->usuarioService = $usuarioService;
    }

    public function crearUsuario() {
        // 1. Crear instancia del modelo
        $usuario = new UsuarioModel(
            $_POST['nroDocumento'],
            $_POST['rol'],
            $_POST['passwd'],
            );
        // 4. Llamar al servicio para crear el cliente
        $this->usuarioService->crearUsuario($usuario);
    }
    public function autenticar(){
        if($this->usuarioService->autenticar($_POST['documento'], $_POST['passwd'])){
            $_SESSION['loged'] = true;
            $_SESSION['nroDocumento'] = $_POST['documento'];
            echo "Sesion iniciada";
        }else 
            echo "algo anduvo mal";
    }
}
