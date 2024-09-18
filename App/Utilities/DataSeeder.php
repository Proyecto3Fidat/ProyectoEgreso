<?php

namespace App\Utilities;

use App\Repositories\CalificacionRepository;
use App\Models\CalificacionModel;
use App\Models\ClienteModel;
use App\Repositories\ClienteRepository;
use App\Models\UsuarioModel;
use App\Repositories\UsuarioRepository;
use App\Models\ObtieneModel;
use App\Repositories\ObtieneRepository;
use App\Models\DeportistaModel;
use App\Repositories\DeportistaRepository;
use App\Models\PacienteModel;
use App\Repositories\PacienteRepository;

class DataSeeder
{
    public function seedCliente($nroDocumento,$tipoDocumento,$altura, $peso, $calle, $numero,$esquina,$email,$patologias,$fechaNacimiento,$nombre,$apellido,$telefono,$sexo,$idUsuario)
    {
        $clienteRepository = new ClienteRepository();
        $clienteModel = new ClienteModel(
            $nroDocumento,
            $tipoDocumento,
            $altura,
            $peso,
            $calle,
            $numero,
            $esquina,
            $email,
            $patologias,
            $fechaNacimiento,
            $nombre,
            $apellido,
        );
        $clienteRepository->guardar($clienteModel);
    }
    public function seedUsuario($nroDocumento,$passwd,$rol)
    {
        $usuarioRepository = new UsuarioRepository();
        $usuarioModel = new UsuarioModel(
            $nroDocumento,
            $rol,
            $passwd,
            bin2hex(random_bytes(16))
        );
        $usuarioRepository->guardar($usuarioModel);
    }
    public function seedDeportista($nroDocumento,$tipoDocumento, $deporte, $posicion, $estado)
    {
        $deportistaRepository = new DeportistaRepository();
        $deportistaModel = new DeportistaModel(
            $nroDocumento,
            $tipoDocumento,
            $deporte,
            $posicion,
            $estado
        );
        $deportistaRepository->guardarDeportista($deportistaModel);
    }
    public function seedCalificaciones($puntMaxima, $fuerzaMusc, $resMusc, $resAnaerobica, $resiliencia, $flexibilidad, $cumplAgenda, $resMonotonia)
    {
        $calificacionRepository = new CalificacionRepository();

        $calificacionModel = new CalificacionModel(
            null,
            $puntMaxima,
            $fuerzaMusc,
            $resMusc,
            $resAnaerobica,
            $resiliencia,
            $flexibilidad,
            $cumplAgenda,
            $resMonotonia
        );
        return $calificacionRepository->asignarPuntuacion($calificacionModel);
    }

    public function seedObtiene($nroDocumento, $tipoDocumento,  $puntuacionEsperado, $puntMaxima, $fuerzaMusc, $resMusc, $resAnaerobica, $resiliencia, $flexibilidad, $cumplAgenda, $resMonotonia)
    {
        $obtieneRepository = new ObtieneRepository();
        $obtieneModel = new ObtieneModel(
            $nroDocumento,
            $tipoDocumento,
            $this->seedCalificaciones($puntMaxima, $fuerzaMusc, $resMusc, $resAnaerobica, $resiliencia, $flexibilidad, $cumplAgenda, $resMonotonia),
            date('Y-m-d H:i:s'),
            $puntuacionEsperado,
            $fuerzaMusc + $resMusc + $resAnaerobica + $resiliencia + $flexibilidad + $cumplAgenda + $resMonotonia
        );
        return $obtieneRepository->asignarPuntuacion($obtieneModel);
    }
}
