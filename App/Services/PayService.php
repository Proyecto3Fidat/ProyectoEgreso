<?php

namespace App\Services;
use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
class PayService
{
    public function verificarPago()
    {
        $loader = new FilesystemLoader('../App/Views');
        $twig = new Environment($loader);
        $usuarioRepository = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepository);

        $eligeService = new EligeService();
        $pago = $eligeService->obtenerPagosPorDocumento($_SESSION['documento']);

        $fechaVencimiento = new \DateTime($pago['fechaVencimiento']);
        $fechaActual = new \DateTime();

        $rol = $usuarioService->obtenerRol($_SESSION['documento']);
        if ($fechaVencimiento > $fechaActual && $rol == 'cliente') {
            $intervalo = $fechaActual->diff($fechaVencimiento);
            $diasRestantes = $intervalo->days;
            $datos = [
                'documento' => $_SESSION['documento'],
            ];
            echo $twig->render('carga.html.twig', $datos);
            exit();
        } else {
        }

       // exit();
    }


}