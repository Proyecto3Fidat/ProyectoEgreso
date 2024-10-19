<?php

namespace App\Services;
use App\Repositories\UsuarioRepository;
use App\Controllers\TemplateController;
class AuthService
{
    private function handleForbiddenError(string $message): void {
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => $message]);
        exit();
    }

    public function comprobarSesion(): bool {
        if (!isset($_SESSION['sesion']) || $_SESSION['sesion'] === false) {
            $templateController = new TemplateController();
            $templateController->renderTemplate('sesion');
            $this->handleForbiddenError('No tienes permisos para ver esta pagina');
        }
        return true;
    }

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

    public function comprobarEntrenador(): bool {

        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'entrenador') {
            $templateController = new TemplateController();
            $templateController->renderTemplate('rol', ['rol' => 'entrenador']);
            $this->handleForbiddenError('Debes ser un Entrenador para realizar esta accion');
        }
        return true;
    }

    public function comprobarAdministrativo(): bool {

        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'administrativo') {
            $templateController = new TemplateController();
            $templateController->renderTemplate('rol', ['rol' => 'administrativo']);
            $this->handleForbiddenError('Debes ser un Entrenador para realizar esta accion');
        }
        return true;
    }

}
