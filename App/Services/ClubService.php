<?php

namespace App\Services;
use App\Repositories\ClienteRepository;
use App\Repositories\ClubRepository;

class ClubService
{


    public function obtenerClubes()
    {
        $resultado = [];
        $repository = new ClubRepository();
        $clubes = $repository->obtenerClubes();

        return $clubes;
         }

    public function asignarClub($deporte, $club, $documento)
    {
        $cliente = new ClienteRepository();
        $clienteService = new ClienteService($cliente);
        $tipoDocumento = $clienteService->obtenerTipoDocumento($documento);
        $repository = new ClubRepository();
        $repository->asignarClub($deporte, $club , $documento, $tipoDocumento);
    }

    public function obtenerClub($idClub){
        $repository = new ClubRepository();
        $club = $repository->obtenerClub($idClub);
        return $club;
    }

    public function crearClub(mixed $nombreClub)
    {
        $repository = new ClubRepository();
        $repository->crearClub($nombreClub);
    }
}