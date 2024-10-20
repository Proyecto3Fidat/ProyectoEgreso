<?php

namespace App\Utilities;

use App\Models\AgendaModel;
use App\Models\ConformaModel;
use App\Models\EjercicioModel;
use App\Models\SeAgendaModel;
use App\Repositories\AgendaRepository;
use App\Repositories\CalificacionRepository;
use App\Models\CalificacionModel;
use App\Models\ClienteModel;
use App\Repositories\ClienteRepository;
use App\Models\UsuarioModel;
use App\Repositories\ConformaRepository;
use App\Repositories\RealizaRepository;
use App\Repositories\SeAgendaRepository;
use App\Repositories\UsuarioRepository;
use App\Models\ObtieneModel;
use App\Repositories\ObtieneRepository;
use App\Models\DeportistaModel;
use App\Repositories\DeportistaRepository;
use App\Models\PacienteModel;
use App\Repositories\PacienteRepository;
use App\Models\LocalGymModel;
use App\Repositories\LocalGymRepository;
class DataSeeder
{
    public function seedCliente($nroDocumento,$tipoDocumento,$altura, $peso, $calle, $numero,$esquina,$email,$patologias,$fechaNacimiento,$nombre,$apellido)
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
    public function seedDeportista($nroDocumento,$tipoDocumento, $deporte, $posicion)
    {
        $deportistaRepository = new DeportistaRepository();
        $deportistaModel = new DeportistaModel(
            $nroDocumento,
            $tipoDocumento,
            $deporte,
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

    public function seedLocalGym(LocalGymModel $LocalGymModel)
    {
        $localGymRepository = new LocalGymRepository();
        $localGymRepository->guardar($LocalGymModel);
    }

    public function seedConforma(ConformaModel $conformaModel)
    {
        $conformaRepository = new ConformaRepository();
        $conformaRepository->guardar($conformaModel);
    }

    public function seedAgenda(AgendaModel $agendaModel)
    {
        $agendaRepository = new AgendaRepository();
        $agendaRepository->guardar($agendaModel);
    }

    public function seedSeAgenda(SeAgendaModel $seAgendaModel)
    {
        $agendaRepository = new SeAgendaRepository();
        $agendaRepository->guardarSeAgenda($seAgendaModel);
    }

    public function seedPlanPago(\App\Models\PlanPagoModel $param)
    {
        $planPagoRepository = new \App\Repositories\PlanPagoRepository();
        $planPagoRepository->guardar($param);
    }

    public function seedPago(\App\Models\PagoModel $param, \App\Models\RealizaModel $param1, \App\Models\EligeModel $param2)
    {
        $pagoRepository = new \App\Repositories\PagoRepository();
        $id = $pagoRepository->guardar($param);
        $realiza = new RealizaRepository();
        $realiza->guardar($param1, $id);
        $elige = new \App\Repositories\EligeRepository();
        $elige->guardar($param2, $id);
    }

    public function seedEjercicios(EjercicioModel $ejercicioModel)
    {

        $ejercicioRepository = new \App\Repositories\EjercicioRepository();
        $ejercicioRepository->guardar($ejercicioModel);

    }

}
