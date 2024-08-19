<?php
namespace App\Controllers;
use App\Services\CalificacionService;
use App\Models\CalificacionModel;
use App\Repositories\CalificacionRepository;
use App\Controllers\ObtieneController;
use App\Services\ObtieneService;
use App\Models\ObtieneModel;
use App\Repositories\ObtieneRepository;


use Monolog\Logger;
Class CalificacionController{
    private $calificacionService;
    private $logger;
    public function __construct(CalificacionService $calificacionService, Logger $logger){
        $this->calificacionService = $calificacionService;
        $this->logger = $logger;
    }
    public function asignarPuntuacion(){
        $calificacionRepository = new CalificacionRepository();
        $calificacionService = new CalificacionService($calificacionRepository);
        $calificacion = new CalificacionModel(
            null,
            $_POST['puntMaxima'],
            $_POST['fuerzaMusc'],
            $_POST['resMusc'],
            $_POST['resAnaerobica'],
            $_POST['resiliencia'],
            $_POST['flexibilidad'],
            $_POST['cumplAgenda'],
            $_POST['resMonotonia']
        );
        $id = $calificacionService->asignarPuntuacion($calificacion);
        $obtieneRepository = new ObtieneRepository();
        $obtieneService = new ObtieneService($obtieneRepository);
        $obtiene = new ObtieneController($obtieneService, $this->logger);
        $calificacionObtenida = $calificacionService->obtenerCalificacion($calificacion);
        $obtiene->asignarPuntuacion(new ObtieneModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            $id,
            date('Y-m-d H:i:s'),
            $_POST['puntuacionEsperado'],
            $calificacionObtenida
        ));
    }

    public function obtenerPuntuaciones($id){
      
        return $this->calificacionService->obtenerPuntuaciones($id);
    }


}