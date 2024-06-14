<?php
require_once __DIR__ . '/../Services/ClienteService.php';
require_once __DIR__ . '/../Models/ClienteModel.php';

class ClienteController {
    private $clienteService;

    public function __construct(ClienteService $clienteService) {
        $this->clienteService = $clienteService;
    }

    public function crearCliente() {
        $cliente = new ClienteModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            $_POST['contraseña'],
            $_POST['altura'],
            $_POST['peso'],
            $_POST['calle'],
            $_POST['numero'],
            $_POST['esquina'],
            $_POST['email'],
            $_POST['telefono'],
            $_POST['patologias'],
            $_POST['edad'],
            $_POST['fechaNacimiento'],
            $_POST['primerNombre'],
            $_POST['segundoNombre'],
            $_POST['primerApellido'],
            $_POST['segundoApellido'],
            );
        $this->clienteService->crearCliente($cliente);
    }
    public function autenticar($documento, $passwd){
        if($this->cllienteService->autenticar()){
            echo "Sesion iniciada";
        }else 
            echo "algo anduvo mal";
    }
}
