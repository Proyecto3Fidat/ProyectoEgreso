<?php
namespace App\Services;
use  App\Repositories\ClienteTelefonoRepository;
Class ClientetelefonoService{
    private $clienteTelefonoRepository;
    public function __construct(ClienteTelefonoRepository $clienteTelefonoRepository){
         $this->clienteTelefonoRepository = $clienteTelefonoRepository;
    }

    public function guardarClienteTelefono($clienteTelefono){
        $this->clienteTelefonoRepository->guardarTelefono($clienteTelefono);
    }
    public function traerClienteTelefono($nroDocumento){
        return $this->clienteTelefonoRepository->traerTelefono($nroDocumento);
    }
    public function comprobarClienteTelefono($nroDocumento){
        return $this->clienteTelefonoRepository->comprobarClienteTelefono($nroDocumento);
    }
}