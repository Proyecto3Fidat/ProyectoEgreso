<?php
namespace App\Services;
use App\Repositories\DeportistaRepository;

class DeportistaService {
    private $deportistaRepository;
    public function __construct(DeportistaRepository $deportistaRepository) {
        $this->deportistaRepository = $deportistaRepository;
    }
    public function guardarDeportista($deportista){
            $this->deportistaRepository->guardarDeportista($deportista);    
        }
}