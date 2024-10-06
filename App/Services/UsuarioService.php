<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;
use App\Models\UsuarioModel;
use App\Controllers\TemplateController;
class UsuarioService
{
    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function tokenInvalido()
    {
        session_unset();
        session_destroy();
        echo "<script>
        localStorage.removeItem('nombre');
        alert('Alerta de seguridad: Token invalido');
        window.location.href = '../../Public/inicio.html.twig'; 
        </script>";
        exit();
    }

    public function comprobarUsuario($documento)
    {
        return $this->usuarioRepository->comprobarUsuario($documento);
    }

    public function crearUsuario(UsuarioModel $usuarioModel)
    {
        $this->usuarioRepository->guardar($usuarioModel);
    }

    public function crearEntrenador(UsuarioModel $usuarioModel)
    {
        $this->usuarioRepository->guardar($usuarioModel);
    }
    public function crearAdministrativo(UsuarioModel $usuarioModel)
    {
        $this->usuarioRepository->guardar($usuarioModel);
    }
    public function generarToken()
    {
        return bin2hex(random_bytes(16));
    }

    public function comprobarToken($documento, $token)
    {
        return $this->usuarioRepository->comprobarToken($documento, $token);
    }

    public function guardarDeportista($documento)
    {
        $this->usuarioRepository->guardarDeportista($documento);
    }

    public function guardarPaciente($documento)
    {
        $this->usuarioRepository->guardarPaciente($documento);
    }

    public function comprobarDeportistaOPaciente($usuarios)
    {
        $resultados = array();
        foreach ($usuarios as $usuario) {
            $rol = $this->usuarioRepository->comprobarRol($usuario['nroDocumento']);
            if ($rol == "deportista" || $rol == "paciente") {
                $usuario['rol'] = $rol;
                $resultados[] = $usuario;
            }
        }
        return $resultados;
    }
    public function comprobarClientes($usuarios)
    {
        $resultados = array();
        foreach ($usuarios as $usuario) {
            $rol = $this->usuarioRepository->comprobarRol($usuario['nroDocumento']);
            if ($rol == "deportista" || $rol == "paciente" || $rol == "cliente") {
                $usuario['rol'] = $rol;
                $resultados[] = $usuario;
            }
        }
        return $resultados;
    }
    public function logout()
    {
        $templateController = new TemplateController();
        session_unset();
        session_destroy();
        echo "<script>
            localStorage.removeItem('nombre');
            </script>";
        $templateController->renderTemplate('inicio');
        exit();
    }

    public function autenticar($documento, $passwd)
    {
        $resultadoAutenticacion = $this->usuarioRepository->autenticar($documento, $passwd);
        $resultado = $resultadoAutenticacion['resultado'];
        if ($resultado == false) {
            header("Location: /login?error=true");
        } else {
            $rol = $resultadoAutenticacion['rol'];
            $nombre = $resultadoAutenticacion['nombre'];
            $token = $resultadoAutenticacion['token'];
            $documento = $resultadoAutenticacion['documento'];
            switch ($rol) {
                case "entrenador":
                    $_SESSION['token'] = $token;
                    $_SESSION['documento'] = $documento;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['sesion'] = true;
                    echo "<script>
                            localStorage.setItem('nombre', '" . $nombre . "');
                            window.location.href = '/'; 
                            </script>";
                    exit();
                case "cliente":
                    $_SESSION['token'] = $token;
                    $_SESSION['documento'] = $documento;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['sesion'] = true;
                    echo "<script>
                            localStorage.setItem('nombre', '" . $nombre . "');
                            window.location.href = '/'; 
                            </script>";
                    exit();
                case "deportista":
                    $_SESSION['token'] = $token;
                    $_SESSION['documento'] = $documento;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['sesion'] = true;
                    echo "<script>
                            localStorage.setItem('nombre', '" . $nombre . "');
                            window.location.href = '/'; 
                            </script>";
                    exit();
                case "paciente":
                    $_SESSION['token'] = $token;
                    $_SESSION['documento'] = $documento;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['sesion'] = true;
                    echo "<script>
                        localStorage.setItem('nombre', '" . $nombre . "');
                        window.location.href = '/'; 
                        </script>";
                    exit();
                case "administrativo":
                    $_SESSION['token'] = $token;
                    $_SESSION['documento'] = $documento;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['sesion'] = true;
                    echo "<script>
                        localStorage.setItem('nombre', '" . $nombre . "');
                        window.location.href = '/'; 
                        </script>";
                    exit();
            }
        }
    }

    public function obtenerRol($nroDocumento){
        return $this->usuarioRepository->obtenerRol($nroDocumento);
    }
    public  function obtenerTipoDocumento($documento)
    {
        return $this->usuarioRepository->obtenerTipoDocumento($documento);
    }
}

