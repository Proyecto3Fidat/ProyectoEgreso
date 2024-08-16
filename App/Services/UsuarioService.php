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
    public function generarToken() {
        return bin2hex(random_bytes(16));
    }
    public function comprobarToken($documento, $token) {
        return $this->usuarioRepository->comprobarToken($documento, $token);
    }
    public function guardarDeportista($documento){
        $this->usuarioRepository->guardarDeportista($documento);
    }
    public function guardarPaciente($documento){
        $this->usuarioRepository->guardarPaciente($documento);
    }
    public function comprobarDeportistaOPaciente($usuarios){
        $resultados = array(); 
        foreach($usuarios as $usuario){
            $rol = $this->usuarioRepository->comprobarRol($usuario['nroDocumento']);
            if($rol == "deportista" || $rol == "paciente"){
                $usuario['rol'] = $rol;
                $resultados[] = $usuario;
            }
        }
            return $resultados;
    }
}
