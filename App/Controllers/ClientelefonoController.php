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
        // Leer el contenido crudo de la solicitud
        $json = file_get_contents('php://input');

        // Decodificar el JSON a un array asociativo
        $data = json_decode($json, true);
        // Verificar si la decodificación fue exitosa y los campos están presentes
        if (is_array($data) && isset($data['telefono'], $data['nroDocumento'], $data['tipoDocumento'])) {
            // Acceder a los datos del JSON decodificado
            $telefono = $data['telefono'];
            $nroDocumento = $data['nroDocumento'];
            $tipoDocumento = $data['tipoDocumento'];

            // Guardar los datos en el log
            $this->logger->info('Se intento guardar el telefono: ' . $telefono);

            // Crear el modelo con los datos obtenidos
            $clienteTelefono = new ClientelefonoModel(
                $nroDocumento,
                $telefono,
                $tipoDocumento
            );

            // Llamar al servicio para guardar los datos
            $this->clienteTelefonoService->guardarClienteTelefono($clienteTelefono);
        } else {
            // Registrar un mensaje de error si los datos no son válidos
            $this->logger->error('Datos inválidos en la solicitud POST.');
        }
    }
    public function traerTelefono()
    {
        $this->clienteTelefonoService->traerClienteTelefono();

    }

}