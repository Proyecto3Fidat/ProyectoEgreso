<?php

class Tercera_EdadModel {
    private $altura;
    private $peso;
    private $edad;

    // Constructor
    public function __construct($altura, $peso, $edad) {
        $this->altura = $altura;
        $this->peso = $peso;
        $this->edad = $edad;
    }

    // Getters
    public function getAltura() {
        return $this->altura;
    }

    public function getPeso() {
        return $this->peso;
    }

    public function getEdad() {
        return $this->edad;
    }

    // Setters
    public function setAltura($altura) {
        $this->altura = $altura;
    }

    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }
}
?>