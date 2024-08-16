<?php
namespace App\Controllers;
use App\Services\ClienteService;
use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;
use App\Models\ClienteModel;
use Monolog\Logger;
use TCPDF;

class ClienteController
{
    private $clienteService;
    private $logger;
    public function __construct(ClienteService $clienteService, Logger $logger)
    {
        $this->clienteService = $clienteService;
        $this->logger = $logger;
    }

    public function crearCliente()
    {
        $this->logger->info('Se intento crear el cliente: ' . $_POST['nroDocumento']);
        $cliente = new ClienteModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            $_POST['altura'],
            $_POST['peso'],
            $_POST['calle'],
            $_POST['numero'],
            $_POST['esquina'],
            $_POST['email'],
            $_POST['patologias'],
            $_POST['fechaNacimiento'],
            $_POST['nombre'],
            $_POST['apellido']
        );
        $this->clienteService->crearCliente($cliente);
    }

    public function emailBienvenida($email)
    {
        $this->logger->info('Se envio el email de bienvenida a: ' . $email);
        $this->clienteService->emailBienvenida($email);
    }

    public function crearEntrenador()
    {
        $cliente = new ClienteModel(
            $_POST['nroDocumento'],
            $_POST['tipoDocumento'],
            null,
            null,
            null,
            null,
            null,
            $_POST['email'],
            null,
            null,
            $_POST['nombre'],
            $_POST['apellido'],
        );
        $this->clienteService->crearEntrenador($cliente);
    }

    public function modificarNombre($nroDocumento, $nombre)
    {
        $cliente = new ClienteModel(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            $nombre,
            null,
        );
        $this->clienteService->modificarNombre($nroDocumento, $cliente);
    }
    public function modificarApellido($nroDocumento, $apellido)
    {
        $cliente = new ClienteModel(
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            $apellido,
        );
        $this->clienteService->modificarApellido($nroDocumento, $cliente);
    }
    public function comprobarCliente()
    {
        return $this->clienteService->comprobarCliente($_POST['nroDocumento']);
    }
    public function listarClientes()
    {
        $usuarioRepo = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepo);
        if ($usuarioService->comprobarToken($_SESSION['documento'], $_SESSION['token']) == false) {
            echo "<script>
            alert('Alerta de seguridad: Token invalido');
            window.location.href = '../../Public/inicio.html'; 
          </script>";
        } else {
            return $this->clienteService->listarClientes();
        }
    }
    public function imprimirNota()
    {
        $datos = [
            [
                'fecha' => '12/10/2021',
                'puntuacionTotal' => 100,
                'fuerzaMuscular' => 50,
                'resistenciaMuscular' => 54,
                'resistenciaAnaerobica' => 23,
                'resiliencia' => 22,
                'flexibilidad' => 10,
                'cumplimientoAgenda' => 10,
                'resistenciaMonotonia' => 10,
            ],
        ];

        $pdf = new TCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('SIGEN');
        $pdf->SetTitle('Calificación');
        $pdf->SetSubject('Calificación');
        $pdf->SetKeywords('TCPDF, PDF, calificación');

        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);

        $html = '<h1>Calificación</h1>';
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Puntuacion Total</th>
                            <th>Fuerza Muscular</th>
                            <th>Resistencia Muscular</th>
                            <th>Resistencia Anaerobica</th>
                            <th>Resiliencia</th>
                            <th>Flexibilidad</th>
                            <th>Cumplimiento de Agenda</th>
                            <th>Resistencia a la Monotonia</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($datos as $dato) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($dato['fecha']) . '</td>
                        <td>' . htmlspecialchars($dato['puntuacionTotal']) . '</td>
                        <td>' . htmlspecialchars($dato['fuerzaMuscular']) . '</td>
                        <td>' . htmlspecialchars($dato['resistenciaMuscular']) . '</td>
                        <td>' . htmlspecialchars($dato['resistenciaAnaerobica']) . '</td>
                        <td>' . htmlspecialchars($dato['resiliencia']) . '</td>
                        <td>' . htmlspecialchars($dato['flexibilidad']) . '</td>
                        <td>' . htmlspecialchars($dato['cumplimientoAgenda']) . '</td>
                        <td>' . htmlspecialchars($dato['resistenciaMonotonia']) . '</td>
                      </tr>';
        }

        $html .= '</tbody></table>';

        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('calificacion.pdf', 'I'); // 'I' para visualizar en el navegador, 'D' para forzar descarga
    }
}
