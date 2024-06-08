<?php
namespace App\Models;

class EjercicioModel {
    private $nombreEjercicio;
    private $descripcionEjercicio;
    private $grupoMuscular;
    private $tipoEjercicio;
    private $idEjercicio;
    private $rutina = [
        "dia" =>"" ,
        "repeticiones" =>"" ,
        "series" =>"" 

    ];
    // Constructor
    public function __construct($nombreEjercicio, $descripcionEjercicio, $grupoMuscular, $tipoEjercicio, $idEjercicio, $dia, $repeticiones, $series)
    {
        $this->nombreEjercicio = $nombreEjercicio;
        $this->descripcionEjercicio = $descripcionEjercicio;
        $this->grupoMuscular = $grupoMuscular;
        $this->tipoEjercicio = $tipoEjercicio;
        $this->idEjercicio = $idEjercicio;
        $this->rutina["dia"] = $dia;
        $this->rutina["repeticiones"] = $repeticiones;
        $this->rutina["series"] = $series;
    }

    //Getters
    public function getNombreEjercicio()
    {
        return $this->nombreEjercicio;
    }
    public function getDescripcionEjercicio()
    {
        return $this->descripcionEjercicio;
    }
    public function getGrupoMuscular()
    {
        return $this->grupoMuscular;
    }
    public function getTipoEjercicio()
    {
        return $this->tipoEjercicio;
    }
    public function getIdEjercicio()
    {
        return $this->idEjercicio;
    }
    public function getRutina()
    {
        return $this->rutina;
    }

    //Setters
    public function setNombreEjercicio($nombreEjercicio)
    {
        $this->nombreEjercicio = $nombreEjercicio;
    }
    public function setDescripcionEjercicio($descripcionEjercicio)
    {
        $this->descripcionEjercicio = $descripcionEjercicio;
    }
    public function setGrupoMuscular($grupoMuscular)
    {
        $this->grupoMuscular = $grupoMuscular;
    }

    public function setTipoEjercicio($tipoEjercicio)
    {
        $this->tipoEjercicio = $tipoEjercicio;
    }

    public function setIdEjercicio($idEjercicio)
    {
        $this->idEjercicio = $idEjercicio;
    }

    public function setRutina($dia, $repeticiones, $series)
    {
        $this->rutina["dia"] = $dia;
        $this->rutina["repeticiones"] = $repeticiones;
        $this->rutina["series"] = $series;
    }
}






