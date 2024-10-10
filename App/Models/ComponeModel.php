<?php

namespace App\Models;

class ComponeModel
{
    private $idEjercicio;
    private $nombreCombo;

    public function __construct($idEjercicio, $nombreCombo)
    {
        $this->idEjercicio = $idEjercicio;
        $this->nombreCombo = $nombreCombo;
    }

    /**
     * @return mixed
     */
    public function getIdEjercicio()
    {
        return $this->idEjercicio;
    }

    /**
     * @param mixed $idEjercicio
     * @return ComponeModel
     */
    public function setIdEjercicio($idEjercicio)
    {
        $this->idEjercicio = $idEjercicio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombreCombo()
    {
        return $this->nombreCombo;
    }

    /**
     * @param mixed $nombreCombo
     * @return ComponeModel
     */
    public function setNombreCombo($nombreCombo)
    {
        $this->nombreCombo = $nombreCombo;
        return $this;
    }

}