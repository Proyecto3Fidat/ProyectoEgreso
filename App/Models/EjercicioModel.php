<?php

namespace App\Models;

class EjercicioModel
{
    private $tipoEjercicio;
    private $nombre;
    private $descripcion;
    private $grupoMuscular;
    private $tipoEjericio;

    public function __construct($nombre, $descripcion, $grupoMuscular, $tipoEjercicio)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->grupoMuscular = $grupoMuscular;
        $this->tipoEjercicio = $tipoEjercicio;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }
    public function getTipoEjercicio()
    {
        return $this->tipoEjercicio;
    }


    public function setTipoEjercicio($tipoEjercicio)
    {
        $this->tipoEjercicio = $tipoEjercicio;
        return $this;
    }


    public function getDescripcion()
    {
        return $this->descripcion;
    }


    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
        return $this;
    }


    public function getTipoEjericio()
    {
        return $this->tipoEjericio;
    }


    public function setTipoEjericio($tipoEjericio)
    {
        $this->tipoEjericio = $tipoEjericio;
        return $this;
    }


    public function getGrupoMuscular()
    {
        return $this->grupoMuscular;
    }


    public function setGrupoMuscular($grupoMuscular)
    {
        $this->grupoMuscular = $grupoMuscular;
        return $this;
    }


}