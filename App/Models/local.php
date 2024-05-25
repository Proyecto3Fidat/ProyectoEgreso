<?php 

class Local {
    private $nombreLocal;
    private  $direccionLocal = [
        "calleLocal" => "" ,
        "numPuerta" => "" ,
        "nomEsquina" => ""
    ];
     // Constructor
     public function __construct($nombreLocal, $calleLocal, $numPuerta, $nomEsquina)
     {
         $this->nombreLocal = $nombreLocal;
         $this->direccionLocal["calleLocal"] = $calleLocal;
         $this->direccionLocal["numPuerta"] = $numPuerta;
         $this->direccionLocal["nomEsquina"] = $nomEsquina;
     }
 
     // Getter y Setter para nombreLocal
     public function getNombreLocal()
     {
         return $this->nombreLocal;
     }
 
     public function setNombreLocal($nombreLocal)
     {
         $this->nombreLocal = $nombreLocal;
     }
 
     // Getter y Setter para direccionLocal
     public function getDireccionLocal()
     {
         return $this->direccionLocal;
     }
 
     public function setDireccionLocal($calleLocal, $numPuerta, $nomEsquina)
     {
         $this->direccionLocal["calleLocal"] = $calleLocal;
         $this->direccionLocal["numPuerta"] = $numPuerta;
         $this->direccionLocal["nomEsquina"] = $nomEsquina;
     }
 }

?>