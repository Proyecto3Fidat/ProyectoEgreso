<?php

namespace App\Models;

class ComboEjercicio
{
    private $nombreCombo;

    public function __construct($nombreCombo)

    {
        $this->nombreCombo = $nombreCombo;
    }

    public function getNombreCombo()
    {
        return $this->nombreCombo;
    }

    public function setNombreCombo($nombreCombo)
    {
        $this->nombreCombo = $nombreCombo;
    }

}