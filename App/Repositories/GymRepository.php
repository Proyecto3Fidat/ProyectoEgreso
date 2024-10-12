<?php

namespace App\Repositories;

class GymRepository extends Database
{

   public function ingresarGym($nombre, $calle, $numero, $esquina, $capXTurno)
   {
       $database = Database::getInstance();
       $database->connect();
         $sql = "INSERT INTO LocalGym (nombre, calle, nroPuerta, esquina, capXTurno) VALUES (?, ?, ?, ?, ?)";
            $stmt = $database->getConnection()->prepare($sql);
            $stmt->bind_param('sssss', $nombre, $calle, $numero, $esquina, $capXTurno);
            $stmt->execute();
            $stmt->close();
            $database->disconnect();

   }

    public function obtenerGym()
    {
        $database = Database::getInstance();
        $database->connect();
        $sql = "SELECT * FROM LocalGym";
        $stmt = $database->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $gym = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $local = [
                    'nombre' => $row['nombre'],
                    'calle' => $row['calle'],
                    'nroPuerta' => $row['nroPuerta'],
                    'esquina' => $row['esquina'],
                    'capXTurno' => $row['capXturno']
                ];
                $gym[] = $local; // Añadir el local al array $gym
            }
        }

        return $gym; // Devolver el array con todos los gimnasios
    }

}