<?php

namespace App\Services;
use App\Models\ObtieneModel; 
use App\Repositories\ObtieneRepository;


Class ObtieneService{
    private $obtieneRepository;

    public function __construct(ObtieneRepository $obtieneRepository){
        $this->obtieneRepository = $obtieneRepository;
    }
    public function asignarPuntuacion(ObtieneModel $obtieneModel){
        $this->obtieneRepository->asignarPuntuacion($obtieneModel);
    }
    public function obtenerCalificaciones($nroDocumento){
        return $this->obtieneRepository->obtenerCalificaciones($nroDocumento);
    }
    public function obtenerCalificacionesXId($id){
        return $this->obtieneRepository->obtenerCalificacionesXId($id);
    }
}