<?php
namespace App\Controllers;
session_start();
use App\Services\ClienteService;
use App\Models\ClienteModel;

class ClienteController {
    private $clienteService;

    public function __construct(ClienteService $clienteService) {
        $this->clienteService = $clienteService;
    }

    public function crearCliente() {
        // 1. Crear instancia del modelo
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
        // 4. Llamar al servicio para crear el cliente
        $this->clienteService->crearCliente($cliente);
    }
}
