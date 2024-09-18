<?php
namespace App\Controllers;

use App\Repositories\ClientetelefonoRepository;
use App\Services\ClientetelefonoService;
use App\Models\ClientelefonoModel;
use Monolog\Logger;

Class ClientelefonoController{
    private $clienteTelefonoService;
    private $logger;

    public function __construct(ClienteTelefonoService $clienteTelefonoService, Logger $logger){
        $this->clienteTelefonoService = $clienteTelefonoService;
        $this->logger = $logger;
    }

    public function guardarTelefono()
    {
        $this->logger->info('Se intento guardar el telefono: ' . $_POST['telefono']);
        $clienteTelefono = new ClientelefonoModel(
            $_POST['nroDocumento'],
            $_POST['telefono'],
            $_POST['tipoDocumento']
        );
        $this->clienteTelefonoService->guardarClienteTelefono($clienteTelefono);
    }

}