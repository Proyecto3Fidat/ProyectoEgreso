<?php
namespace App\Services;
use App\Models\CalificacionModel;
use App\Repositories\CalificacionRepository;

Class CalificacionService{
    private $calificacionRepository;
    public function __construct(CalificacionRepository $calificacionRepository){
        $this->calificacionRepository = $calificacionRepository;
    }
    public function asignarPuntuacion(CalificacionModel $calificacionModel){
        return $this->calificacionRepository->asignarPuntuacion($calificacionModel);
    }
    public function obtenerCalificacion(CalificacionModel $calificacionModel){
        $puntMaxima = $calificacionModel->getPuntMaxima();
        $fuerzaMusc = $calificacionModel->getFuerzaMusc();
        $resMusc = $calificacionModel->getResMusc();
        $resAnaerobica = $calificacionModel->getResAnaerobica();
        $resiliencia = $calificacionModel->getResiliencia();
        $flexibilidad = $calificacionModel->getFlexibilidad();
        $cumplAgenda = $calificacionModel->getCumplAgenda();
        $resMonotonia = $calificacionModel->getResMonotonia();
        $maxPorItem = $puntMaxima / 7;
        if( $fuerzaMusc <= $maxPorItem && $resMusc <= $maxPorItem && $resAnaerobica <= $maxPorItem && $resiliencia <= $maxPorItem && $flexibilidad <= $maxPorItem && $cumplAgenda <= $maxPorItem && $resMonotonia <= $maxPorItem){
           $puntuacion = $fuerzaMusc + $resMusc + $resAnaerobica + $resiliencia + $flexibilidad + $cumplAgenda + $resMonotonia;
            return $puntuacion;
        }else{
            echo "<script>
            alert('Los valores ingresados no son validos');
            </script>";
            exit();
        }
    }
    public function obtenerPuntuaciones($id){
        return $this->calificacionRepository->obtenerPuntuaciones($id);
    }

    public function editarCalificacion(CalificacionModel $calificacionModel, $id)
    {
        return $this->calificacionRepository->editarCalificacion($calificacionModel, $id);
    }
}