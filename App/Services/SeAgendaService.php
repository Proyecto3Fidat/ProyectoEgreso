<?php

namespace App\Services;

use App\Repositories\SeAgendaRepository;

class SeAgendaService
{

    public function agendar($documento, $tipoDocumento, $dia, $horaInicio, $horaFin)
    {
        $seAgenda = new SeAgendaRepository();
        $seAgenda->agendar($documento, $tipoDocumento, $dia, $horaInicio, $horaFin);
    }

    public function obtenerAgendas($nroDocumento)
    {
        $seAgenda = new SeAgendaRepository();
        $agenda = $seAgenda->obtenerAgendas($nroDocumento);
        $agendaMasProxima = $this->obtenerAgendaDiaActualOProximo($agenda);
        return $agendaMasProxima;
    }

    public function obtenerAgendaDiaActualOProximo($agendas)
    {

        $diaActualIngles = strtolower(date('l'));


        $diasTraducidos = [
            'monday'    => 'lunes',
            'tuesday'   => 'martes',
            'wednesday' => 'miércoles',
            'thursday'  => 'jueves',
            'friday'    => 'viernes',
            'saturday'  => 'sábado',
            'sunday'    => 'domingo',
        ];


        $diaActual = $diasTraducidos[$diaActualIngles];


        $agendaDiaActual = null;
        $agendaMasProxima = null;


        $diasSemana = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];


        $indiceDiaActual = array_search($diaActual, $diasSemana);

        foreach ($agendas as $agenda) {
            $diaAgenda = strtolower($agenda['dia']);

            $indiceDiaAgenda = array_search($diaAgenda, $diasSemana);

            if ($indiceDiaAgenda === $indiceDiaActual) {
                $agendaDiaActual = $agenda;
                break;
            }

            if ($indiceDiaAgenda > $indiceDiaActual) {
                if (is_null($agendaMasProxima) || $indiceDiaAgenda < array_search($agendaMasProxima['dia'], $diasSemana)) {
                    $agendaMasProxima = $agenda;
                }
            }
        }

        if ($agendaDiaActual) {
            return $agendaDiaActual;
        }

        return $agendaMasProxima;
    }

    public function obtenerAgendasUsuario($nroDocumento)
    {
        $seAgenda = new SeAgendaRepository();
        $agenda = $seAgenda->obtenerAgendas($nroDocumento);
        return $agenda;
    }

    public function asistir($documento, $dia, $horaInicio, $horaFin, $asistencia)
    {
        $seAgenda = new SeAgendaRepository();
        $seAgenda->asistir($documento, $dia, $horaInicio, $horaFin, $asistencia);
    }
}