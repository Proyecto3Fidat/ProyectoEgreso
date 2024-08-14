<?php
namespace App\Services;

use App\Repositories\UsuarioRepository;
use App\Models\UsuarioModel;

class UsuarioService {
    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository) {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function comprobarUsuario($documento) {
        return $this->usuarioRepository->comprobarUsuario($documento);
    }
    public function crearUsuario(UsuarioModel $usuarioModel) {
        $this->usuarioRepository->guardar($usuarioModel);
    }
    public function autenticar($documento,$passwd) {
        return $this->usuarioRepository->autenticar($documento,$passwd);
    }
    public function crearEntrenador(UsuarioModel $usuarioModel) {
        $this->usuarioRepository->guardarEntrenador($usuarioModel);
    }
}