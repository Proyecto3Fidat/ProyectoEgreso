<?php
namespace App\Repositories;

class AgendaRepository {

    public function guardar(Agenda $agenda) {
        $sql = "INSERT INTO agenda (horaInicio, dias, fecha, horaFin, ciCliente) 
                VALUES (:horaInicio, :dias, :fecha, :horaFin, :ciCliente)";
        $stmt = $this->clase->prepare($sql);
        $stmt->execute([
            ':horaInicio' => $agenda->getHoraInicio(),
            ':dias' => $agenda->getDias(),
            ':fecha' => $agenda->getFecha(),
            ':horaFin' => $agenda->getHoraFin(),
            ':ciCliente' => $agenda->getCiCliente(),
        ]);
    }
}