<?php

class ClienteRepository {

    public function guardar(ClienteModel $clienteModel) {
        $sql = "INSERT INTO Cliente (nroDocumento, tipDocumento, contraseña, altura, peso, calle, numero, esquina, email, telefono, patologias, edad, fechaNacimiento, primerNombre, segundoNombre, primerApellido, segundoApellido) 
                VALUES (:nroDocumento, :tipoDocumento, :contraseña, :altura, :peso, :calle, :numero, :esquina, :email, :telefono, :patologias, :edad, fechaNacimiento, :primerNombre, :segundoNombre, :primerApellido, :segundoApellido)";
        $stmt = $this->clase->prepare($sql);
        $stmt->execute([
            ':nroDocumento' => $agenda->getnroDocumento(),
            ':tipoDocumento' => $agenda->gettipoDocumento(),
            ':contraseña' => $agenda->getcontraseña(),
            ':altura' => $agenda->getaltura(),
            ':peso' => $agenda->getpeso(),
            ':calle' => $agenda->getcalle(),
            ':numero' => $agenda->getnumero(),
            ':esquina' => $agenda->getesquina(),
            ':email' => $agenda->getemail(),
            ':telefono' => $agenda->gettelefono(),
            ':patologias' => $agenda->getpatologias(),
            ':edad' => $agenda->getedad(),
            ':fechaNacimiento' => $agenda->getfechaNacimiento(),
            ':primerNombre' => $agenda->getprimerNombre(),
            ':segundoNombre' => $agenda->getsegundosNombre(),
            ':primerApellido' => $agenda->getprimerApellido(),
            ':segundoApellido' => $agenda->getsegundoApellido(),
        ]);
    }
}