<?php
class ComboEjercicios {
    private $cantidadEjercicios;
    private $idCombo;

// Constructor
public function __construct($cantidadEjercicios, $idCombo)
{
    $this->cantidadEjercicios = $cantidadEjercicios;
    $this->idCombo = $idCombo;
}

//Getters
public function getCantidadEjercicios()
{
    return $this->cantidadEjercicios;
}
public function getIdCombo()
    {
        return $this->idCombo;
    }
    
//Setters
public function setCantidadEjercicios($cantidadEjercicios)
    {
        $this->cantidadEjercicios = $cantidadEjercicios;
    }
public function setIdCombo($idCombo)
    {
        $this->idCombo = $idCombo;
    }
}

