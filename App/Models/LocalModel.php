<?php 
namespace App\Models;

class LocalModel {
    private $nombreLocal;
    private  $direccionLocal = [
        "calleLocal" => "" ,
        "numPuerta" => "" ,
        "nomEsquina" => ""
    ];

     public function __construct($nombreLocal, $calleLocal, $numPuerta, $nomEsquina)
     {
         $this->nombreLocal = $nombreLocal;
         $this->direccionLocal["calleLocal"] = $calleLocal;
         $this->direccionLocal["numPuerta"] = $numPuerta;
         $this->direccionLocal["nomEsquina"] = $nomEsquina;
     }

     public function setDireccionLocal($calleLocal, $numPuerta, $nomEsquina)
     {
         $this->direccionLocal["calleLocal"] = $calleLocal;
         $this->direccionLocal["numPuerta"] = $numPuerta;
         $this->direccionLocal["nomEsquina"] = $nomEsquina;
     }
     
     public function setNombreLocal($nombreLocal)
     {
         $this->nombreLocal = $nombreLocal;
     }

     public function getNombreLocal()
     {
         return $this->nombreLocal;
     }

     public function getDireccionLocal()
     {
         return $this->direccionLocal;
     }
 
    
 }
 

 

?>