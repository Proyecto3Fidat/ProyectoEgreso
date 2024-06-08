<?php
namespace App\Models;

    class ClienteModel{
        private $peso; 
        private $altura;
        private $contraseña;
        private $nroDocumento;
        private $nombre;
        private $fechaNacimiento;
        private $edad;
        private $patologias;
        private $telefono;
        private $email;
        private $direccion;
    
        public function __construct($numeroDocumento, $tipoDocumento, $contraseña, $altura, $peso, $calle, $numero, $esquina, $email, $telefono, $patologias, $edad, $fechaNacimiento, $primerNombre, $segundoNombre, $primerApellido, $segundoApellido){
            $this->peso = $peso;
            $this->altura = $altura;
            $this->contraseña = $contraseña;
            $this->nroDocumento = [
                "numeroDocumento" => $numeroDocumento,
                "tipoDocumento" => $tipoDocumento,
            ];
            $this->nombre = [
                "primerNombre" => $primerNombre,
                "segundoNombre" => $segundoNombre,
                "primerApellido" => $primerApellido,
                "segundoApellido" => $segundoApellido,
            ];
            $this->fechaNacimiento = $fechaNacimiento;
            $this->edad = $edad;
            $this->patologias = $patologias;
            $this->telefono = $telefono;
            $this->email = $email;
            $this->direccion = [
                "calle" => $calle,
                "numero" => $numero,
                "esquina" => $esquina,
            ];
        }
    
    

    // Getters
    public function getPeso() {
        return $this->peso;
    }

    public function getAltura() {
        return $this->altura;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getNumeroDocumento() {
        return $this->nroDocumento["numeroDocumento"];
    }

    public function getTipoDocumento() {
        return $this->nroDocumento["tipoDocumento"];
    }

    public function getPrimerNombre() {
        return $this->nombre["primerNombre"];
    }

    public function getSegundoNombre() {
        return $this->nombre["segundoNombre"];
    }

    public function getPrimerApellido() {
        return $this->nombre["primerApellido"];
    }

    public function getSegundoApellido() {
        return $this->nombre["segundoApellido"];
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getPatologias() {
        return $this->patologias;
    }

    public function getTelefono1() {
        return $this->telefono["telefono1"];
    }

    public function getTelefono2() {
        return $this->telefono["telefono2"];
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCalle() {
        return $this->direccion["calle"];
    }

    public function getNumero() {
        return $this->direccion["numero"];
    }

    public function getEsquina() {
        return $this->direccion["esquina"];
    }

    // Setters
    public function setPeso($peso) {
        $this->peso = $peso;
    }

    public function setAltura($altura) {
        $this->altura = $altura;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setNumeroDocumento($numeroDocumento) {
        $this->nroDocumento["numeroDocumento"] = $numeroDocumento;
    }

    public function setTipoDocumento($tipoDocumento) {
        $this->nroDocumento["tipoDocumento"] = $tipoDocumento;
    }

    public function setPrimerNombre($primerNombre) {
        $this->nombre["primerNombre"] = $primerNombre;
    }

    public function setSegundoNombre($segundoNombre) {
        $this->nombre["segundoNombre"] = $segundoNombre;
    }

    public function setPrimerApellido($primerApellido) {
        $this->nombre["primerApellido"] = $primerApellido;
    }

    public function setSegundoApellido($segundoApellido) {
        $this->nombre["segundoApellido"] = $segundoApellido;
    }

    public function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function setPatologias($patologias) {
        $this->patologias = $patologias;
    }

    public function setTelefono1($telefono1) {
        $this->telefono["telefono1"] = $telefono1;
    }

    public function setTelefono2($telefono2) {
        $this->telefono["telefono2"] = $telefono2;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCalle($calle) {
        $this->direccion["calle"] = $calle;
    }

    public function setNumero($numero) {
        $this->direccion["numero"] = $numero;
    }

    public function setEsquina($esquina) {
        $this->direccion["esquina"] = $esquina;
    }
}
?>