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
    public function crearAdministrador(ClienteModel $clienteModel) {
        $this->clienteRepository->guardarAdministrador($clienteModel);
    }
    public function emailBienvenida($email){
        $para = $email;
        $asunto = "Bienvenido a la plataforma de entrenamiento";
        $mensaje = "Bienvenido a la plataforma de entrenamiento";

        $comando = 'echo "' . addslashes($mensaje) . '" | mailx -s "' . addslashes($asunto) . '" ' . $para;
        exec($comando, $salida, $devolver);

        if ($devolver === 0) {
            echo 'Correo enviado correctamente.';
        } else {
        echo 'Error al enviar el correo.';
        }   
    }
}