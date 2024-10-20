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
        $json = file_get_contents('php://input');

        $data = json_decode($json, true);

        if (is_array($data) && isset($data['telefono'], $data['nroDocumento'], $data['tipoDocumento'])) {
            
            $telefono = $data['telefono'];
            $nroDocumento = $data['nroDocumento'];
            $tipoDocumento = $data['tipoDocumento'];

            $this->logger->info('Se intento guardar el telefono: ' . $telefono);

            $clienteTelefono = new ClientelefonoModel(
                $nroDocumento,
                $telefono,
                $tipoDocumento
            );
s
            $this->clienteTelefonoService->guardarClienteTelefono($clienteTelefono);
        } else {
            $this->logger->error('Datos inválidos en la solicitud POST.');
        }
    }
    public function traerTelefono()
    {
        $this->clienteTelefonoService->traerClienteTelefono();

    }

}