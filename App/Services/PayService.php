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
        if (!isset($pago['fechaVencimiento'])){
            return;
        }
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

    public function verificarCaducidad()
    {
        $loader = new FilesystemLoader('../App/Views');
        $twig = new Environment($loader);
        $usuarioRepository = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepository);

        $eligeService = new EligeService();
        $pago = $eligeService->obtenerPagosPorDocumento($_SESSION['documento']);
        if (!isset($pago['fechaVencimiento'])){
            return;
        }

        $fechaVencimiento = new \DateTime($pago['fechaVencimiento']);
        $fechaActual = new \DateTime();
        $rol = $usuarioService->obtenerRol($_SESSION['documento']);

        if (isset($_COOKIE['mensaje_mostrado']) && $_COOKIE['mensaje_mostrado'] == '1') {
            return;
        }
        if ($fechaVencimiento > $fechaActual) {
            $intervalo = $fechaActual->diff($fechaVencimiento);
            $diasRestantes = $intervalo->days;
            if ($diasRestantes <= 5) {
                $datos = [
                    'mensaje' =>'quedan '.$diasRestantes.' días para que caduque su pago',
                ];
                setcookie('mensaje_mostrado', '1', time() + 86400, "/");
                echo $twig->render('alerta.html.twig', $datos);
                exit();
            } else {
                return;
            }
        }else {
           echo $twig->render('pagoCaducado.html.twig');
           exit();
        }

    }


}