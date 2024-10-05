<?php

namespace App\Services;
use App\Repositories\UsuarioRepository;
class AuthService
{
    private function handleForbiddenError(string $message): void {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => $message]);
        exit();
    }

    public function comprobarSesion(): bool {
        if (!isset($_SESSION['sesion']) || $_SESSION['sesion'] === false) {
            $this->handleForbiddenError('No tienes permisos para ver esta pagina');
        }

        return true;
    }
    // Comprobar si el token es válido
    public function comprobarToken(): bool {
        if (!isset($_SESSION['token'], $_SESSION['documento'])) {
            $this->handleForbiddenError('Token Invalido');
        }

        $usuarioRepo = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepo);

        if (!$usuarioService->comprobarToken($_SESSION['documento'], $_SESSION['token'])) {
            session_unset();
            session_destroy();
            $this->handleForbiddenError('Token Invalido');
        }

        return true;
    }
}
