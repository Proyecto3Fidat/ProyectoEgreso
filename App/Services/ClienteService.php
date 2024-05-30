<?php
require_once 'Repositories/ClienteRepositories.php';
class ClienteService {
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository) {
        $this->clienteRepository = $clienteRepository;
    }

    public function crearCliente(ClienteModel $clienteModel) {
        $this->clienteRepository->guardar($clienteModel);
    }

}