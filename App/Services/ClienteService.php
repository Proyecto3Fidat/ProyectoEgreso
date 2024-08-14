<?php
namespace App\Services;

use App\Repositories\ClienteRepository;
use App\Models\ClienteModel;

class ClienteService {
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository) {
        $this->clienteRepository = $clienteRepository;
    }

    public function crearCliente(ClienteModel $clienteModel) {
        $this->clienteRepository->guardar($clienteModel);
    }
    public function crearEntrenador(ClienteModel $clienteModel) {
        $this->clienteRepository->guardarEntrenador($clienteModel);
    }
    public function emailBienvenida($email) {
        $para = $email;
        $asunto = "Bienvenido a la plataforma de entrenamiento";
        $mensaje = "Bienvenido a la plataforma de entrenamiento";
        $from = "FIDAT <isbergara1@gmail.com>";
    
        // Comando para enviar correo usando mailx
         $comando = 'echo ' . escapeshellarg($mensaje) . ' | mailx -s ' . escapeshellarg($asunto) . ' -S from=' . escapeshellarg($from) . ' ' . $para;
        // Ejecutar el comando y capturar la salida
        // echo "Bienvenido a la plataforma de entrenamiento" | mailx -s "Bienvenido a la plataforma de entrenamiento" -S from="FIDAT <isbergara1@gmail.com>" {$email}
        exec($comando, $salida, $devolver);
    
        // Verificar si el correo se envió correctamente
        if ($devolver === 0) {
            echo 'Correo enviado correctamente.';
        } else {
            echo 'Error al enviar el correo.';
        }
    }
    
    public function modificarNombre($nroDocumento, ClienteModel $cliente){
        $this->clienteRepository->modificarNombre($nroDocumento, $cliente);
    }

    public function modificarApellido($nroDocumento, ClienteModel $cliente){
        $this->clienteRepository->modificarApellido($nroDocumento, $cliente);
    }
    public function comprobarCliente($documento) {

       return $this->clienteRepository->comprobarCliente($documento);
      
    }
}