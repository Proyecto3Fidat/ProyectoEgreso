<?php
namespace App\Services;

use App\Repositories\ClienteRepository;
use App\Models\ClienteModel;
use App\Services\ObtieneService;
use App\Repositories\ObtieneRepository;
use App\Services\CalificacionService;
use App\Repositories\CalificacionRepository;
use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;
use TCPDF;
class ClienteService
{
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    public function crearCliente(ClienteModel $clienteModel)
    {
        $this->clienteRepository->guardar($clienteModel);
    }
    public function crearEntrenador(ClienteModel $clienteModel)
    {
        $this->clienteRepository->guardarEntrenador($clienteModel);
    }

    public function imprimirNota($id)
    {
        $usuarioRepository = new UsuarioRepository();
        $usuarioService = new UsuarioService($usuarioRepository);
        $obtenerRepository = new ObtieneRepository();
        $obtenerService = new ObtieneService($obtenerRepository);
        $calificacionRepository = new CalificacionRepository();
        $calificacionService = new CalificacionService($calificacionRepository);
        if (isset($_SESSION['documento']) && isset($_SESSION['token']) && $usuarioService->comprobarToken($_SESSION['documento'], $_SESSION['token'])) {
            if ($obtenerService->comprobarId($_SESSION['documento'])) {
                $calificacion = $obtenerService->obtenerCalificacionesXID($id);
                $puntuacion = $calificacionService->obtenerPuntuaciones($id);
                $pdf = new TCPDF();
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('SIGEN');
                $pdf->SetTitle('Calificación ' . $calificacion[0]['fecha']);
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

                $html .= '<tr>
                                <td>' . htmlspecialchars($calificacion[0]['fecha']) . '</td>
                                <td>' . htmlspecialchars($calificacion[0]['puntObtenido']) . '</td>
                                <td>' . htmlspecialchars($puntuacion[0]['fuerzaMusc']) . '</td>
                                <td>' . htmlspecialchars($puntuacion[0]['resMusc']) . '</td>
                                <td>' . htmlspecialchars($puntuacion[0]['resAnaerobica']) . '</td>
                                <td>' . htmlspecialchars($puntuacion[0]['resiliencia']) . '</td>
                                <td>' . htmlspecialchars($puntuacion[0]['flexibilidad']) . '</td>
                                <td>' . htmlspecialchars($puntuacion[0]['cumplAgenda']) . '</td>
                                <td>' . htmlspecialchars($puntuacion[0]['resMonotonia']) . '</td>
                              </tr>';

                $html .= '</tbody></table>';
                $pdf->writeHTML($html, true, false, true, false, '');
                $nombreArchivo = 'calificacion_' . $calificacion[0]['fecha'] . '.pdf';
                $pdf->Output($nombreArchivo, 'I'); // 'I' para visualizar en el navegador, 'D' para forzar descarga
            } else {echo "<script>
        alert('Accesso Denegado');
        window.location.href = '../../Public/inicio.html'; 
        </script>";
            }
        } else {
            $usuarioService->tokenInvalido();
        }
    }

    public function emailBienvenida($email)
    {
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

    public function modificarNombre($nroDocumento, ClienteModel $cliente)
    {
        $this->clienteRepository->modificarNombre($nroDocumento, $cliente);
    }

    public function modificarApellido($nroDocumento, ClienteModel $cliente)
    {
        $this->clienteRepository->modificarApellido($nroDocumento, $cliente);
    }
    public function comprobarCliente($documento)
    {

        return $this->clienteRepository->comprobarCliente($documento);

    }
    public function listarClientes()
    {
        return $this->clienteRepository->listarClientes();
    }
}