<?php
namespace App\Controllers;
use App\Services\ClienteService;
use App\Models\ClienteModel;

class ClienteController {
    private $clienteService;

    public function __construct(ClienteService $clienteService) {
        $this->clienteService = $clienteService;
    }

    public function crearCliente() {
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
    public function crearAdministrador(){
        $cliente = new ClienteModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            null,
            null,
            null,
            null,
            null,
            $_POST['email'],
            null,
            null,
            $_POST['nombre'],
            $_POST['apellido'],
        );
    }

    public function emailBienvenida($email){
        $this->clienteService->emailBienvenida($email);
    }

}
