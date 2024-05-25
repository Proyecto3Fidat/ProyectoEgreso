<?php 

class Local {
    private $nombreLocal;
    private  $direccionLocal = [
        "calleLocal" => "" ,
        "numPuerta" => "" ,
        "nomEsquina" => ""
    ];
    //Setters
    public function setNombreLocal(string $nombreLocal): void
{
    $this->nombreLocal = $nombreLocal;
}
public function setCalleLocal(string $calleLocal): void
{
    $this->direccionLocal["calleLocal"] = $calleLocal;
}

public function setNumPuerta(string $numPuerta): void
{
    $this->direccionLocal["numPuerta"] = $numPuerta;
}

public function setNomEsquina(string $nomEsquina): void
{
    $this->direccionLocal["nomEsquina"] = $nomEsquina;
}
//Getters
public function getNombreLocal(): string
{
    return $this->nombreLocal;
}

public function getCalleLocal(): string
{
    return $this->direccionLocal["calleLocal"];
}

public function getNumPuerta(): string
{
    return $this->direccionLocal["numPuerta"];
}

public function getNomEsquina(): string
{
    return $this->direccionLocal["nomEsquina"];
}
//Constructor
public function __construct(string $nombreLocal, array $direccionLocal)
{
    $this->nombreLocal = $nombreLocal;
    $this->direccionLocal = $direccionLocal;
}
}

