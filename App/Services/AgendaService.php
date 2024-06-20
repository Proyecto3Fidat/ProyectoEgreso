<?php
require_once 'Repositories/AgendaRepositories.php';
class AgendaService {
    private $agendaRepository;

    public function __construct(AgendaRepository $agendaRepository) {
        $this->agendaRepository = $agendaRepository;
    }

    public function crearAgenda(Agenda $agenda) {
        $this->agendaRepository->guardar($agenda);
    }

}