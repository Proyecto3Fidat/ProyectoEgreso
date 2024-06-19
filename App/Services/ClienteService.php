<?php
namespace App\Services;

use App\Repositories\ClienteRepository;
use App\Models\ClienteModel;

class ClienteService {
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository) {
        $this->clienteRepository = $clienteRepository;
    }

    public function crearCliente(ClienteModel $clienteModel) {
        $this->clienteRepository->guardar($clienteModel);
    }
    public function autenticar($documento,$passwd) {
        if($this->clienteRepository->autenticar($documento,$passwd)){
            return true;
        }else
            return false;
    }

}