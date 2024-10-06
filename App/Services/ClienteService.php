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
use DateTime;
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
                $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('SIGEN');
                $pdf->SetTitle('Calificación ' . $calificacion[0]['fecha']);
                $pdf->SetSubject('Calificación');
                $pdf->SetKeywords('TCPDF, PDF, calificación');
                $pdf->SetMargins(15, 15, 15);
                $pdf->AddPage(); // Asegúrate de añadir una nueva página

                // Agregar ícono
                /*$iconFile = __DIR__ . '/../../images/1344134.png'; // Ruta absoluta

                // Verificar si el archivo de ícono existe
                if (!file_exists($iconFile)) {
                    echo "El archivo de ícono no se encontró.";
                    die();
                }

                $pdf->Image($iconFile, 15, 15, 20, 20, 'PNG', '', '', false, 300, '', false, false, 0, false, false, false); // Ajusta las coordenadas y dimensiones
*/
                $pdf->SetFont('helvetica', 'B', 16);
                $pdf->Cell(0, 10, 'Calificación', 0, 1, 'C');
                $pdf->Ln(10); // Espacio adicional

                // Estilo de la tabla
                $html = '<table border="1" cellpadding="5" cellspacing="0" style="width: 100%; border-collapse: collapse;">';
                $html .= '<thead>
                <tr style="background-color: #007BFF; color: #ffffff;">
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Puntuacion Total</th>
                    <th style="text-align: center;">Fuerza Muscular</th>
                    <th style="text-align: center;">Resistencia Muscular</th>
                    <th style="text-align: center;">Resistencia Anaerobica</th>
                    <th style="text-align: center;">Resiliencia</th>
                    <th style="text-align: center;">Flexibilidad</th>
                    <th style="text-align: center;">Cumplimiento de Agenda</th>
                    <th style="text-align: center;">Resistencia a la Monotonia</th>
                </tr>
              </thead>
              <tbody>';

                // Añadir datos
                if (!empty($calificacion) && !empty($puntuacion)) {
                    $html .= '<tr style="background-color: #f2f2f2;">
                        <td style="text-align: center;">' . htmlspecialchars($calificacion[0]['fecha']) . '</td>
                        <td style="text-align: center;">' . htmlspecialchars($calificacion[0]['puntObtenido']) . '</td>
                        <td style="text-align: center;">' . htmlspecialchars($puntuacion[0]['fuerzaMusc']) . '</td>
                        <td style="text-align: center;">' . htmlspecialchars($puntuacion[0]['resMusc']) . '</td>
                        <td style="text-align: center;">' . htmlspecialchars($puntuacion[0]['resAnaerobica']) . '</td>
                        <td style="text-align: center;">' . htmlspecialchars($puntuacion[0]['resiliencia']) . '</td>
                        <td style="text-align: center;">' . htmlspecialchars($puntuacion[0]['flexibilidad']) . '</td>
                        <td style="text-align: center;">' . htmlspecialchars($puntuacion[0]['cumplAgenda']) . '</td>
                        <td style="text-align: center;">' . htmlspecialchars($puntuacion[0]['resMonotonia']) . '</td>
                      </tr>';
                } else {
                    $html .= '<tr>
                        <td colspan="9" style="text-align: center;">No hay datos disponibles</td>
                      </tr>';
                }

                $html .= '</tbody></table>';

                $pdf->writeHTML($html, true, false, true, false, '');
                $nombreArchivo = 'calificacion_' . $calificacion[0]['fecha'] . '.pdf';
                $pdf->Output($nombreArchivo, 'I'); // 'I' para visualizar en el navegador, 'D' para forzar descarga
            } else {
                echo "<script>
            alert('Acceso Denegado');
            window.location.href = '../../Public/inicio.html.twig'; 
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

    public function calcularEdad($fechaNacimiento)
    {
        $fechaNacimiento = new DateTime($fechaNacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fechaNacimiento);
        return $edad->y;
    }
}