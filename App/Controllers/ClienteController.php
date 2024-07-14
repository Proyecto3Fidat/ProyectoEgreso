<?php
namespace App\Controllers;
use App\Services\ClienteService;
use App\Models\ClienteModel;
use Monolog\Logger;

class ClienteController {
    private $clienteService;
    private $logger;
    public function __construct(ClienteService $clienteService, Logger $logger) {
        $this->clienteService = $clienteService;
        $this->logger = $logger;
    }

    public function crearCliente() {
        $this->logger->info('Se intento crear el cliente: '. $_POST['nroDocumento']);
        $cliente = new ClienteModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            $_POST['altura'],
            $_POST['peso'],
            $_POST['calle'],
            $_POST['numero'],
            $_POST['esquina'],
            $_POST['email'],
            $_POST['patologias'],
            $_POST['fechaNacimiento'],
            $_POST['nombre'],
            $_POST['apellido']
            );
        $this->clienteService->crearCliente($cliente);
    }

    public function emailBienvenida($email){
        $this->logger->info('Se envio el email de bienvenida a: '. $email);
        $this->clienteService->emailBienvenida($email);
    }

}
