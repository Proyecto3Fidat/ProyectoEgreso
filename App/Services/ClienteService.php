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
    public function crearSinInfo(ClienteModel $clienteModel)
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

                // Configuración del PDF
                $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('SIGEN');
                $pdf->SetTitle('Calificación ' . $calificacion[0]['fecha']);
                $pdf->SetSubject('Calificación');
                $pdf->SetKeywords('TCPDF, PDF, calificación');
                $pdf->SetMargins(15, 15, 15);
                $pdf->SetAutoPageBreak(TRUE, 15);
                $pdf->AddPage();

                // Encabezado de Documento
                $pdf->SetFont('helvetica', 'B', 18);
                $pdf->SetTextColor(0, 51, 102); // Azul oscuro
                $pdf->Cell(0, 10, 'Reporte de Calificación de Desempeño', 0, 1, 'C');
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetTextColor(0, 0, 0);
                $pdf->Cell(0, 10, 'Generado el: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
                $pdf->Ln(5);

                // Encabezado de la Tabla
                $pdf->SetFont('helvetica', 'B', 11);
                $pdf->SetFillColor(230, 230, 230); // Gris claro
                $pdf->SetTextColor(0, 0, 0); // Negro
                $pdf->Cell(30, 10, 'Fecha', 1, 0, 'C', 1);
                $pdf->Cell(30, 10, 'Total', 1, 0, 'C', 1);
                $pdf->Cell(35, 10, 'Fuerza Muscular', 1, 0, 'C', 1);
                $pdf->Cell(35, 10, 'Resistencia Muscular', 1, 0, 'C', 1);
                $pdf->Cell(35, 10, 'Resist. Anaeróbica', 1, 0, 'C', 1);
                $pdf->Cell(30, 10, 'Resiliencia', 1, 0, 'C', 1);
                $pdf->Cell(30, 10, 'Flexibilidad', 1, 0, 'C', 1);
                $pdf->Cell(35, 10, 'Agenda', 1, 0, 'C', 1);
                $pdf->Cell(35, 10, 'Resist. Monotonía', 1, 1, 'C', 1);

                // Datos de la Tabla
                $pdf->SetFont('helvetica', '', 10);
                $pdf->SetFillColor(245, 245, 245); // Fondo gris muy claro
                $pdf->SetTextColor(0, 0, 0); // Negro para texto

                if (!empty($calificacion) && !empty($puntuacion)) {
                    $pdf->Cell(30, 10, htmlspecialchars($calificacion[0]['fecha']), 1, 0, 'C', 1);
                    $pdf->Cell(30, 10, htmlspecialchars($calificacion[0]['puntObtenido']), 1, 0, 'C', 1);
                    $pdf->Cell(35, 10, htmlspecialchars($puntuacion[0]['fuerzaMusc']), 1, 0, 'C', 1);
                    $pdf->Cell(35, 10, htmlspecialchars($puntuacion[0]['resMusc']), 1, 0, 'C', 1);
                    $pdf->Cell(35, 10, htmlspecialchars($puntuacion[0]['resAnaerobica']), 1, 0, 'C', 1);
                    $pdf->Cell(30, 10, htmlspecialchars($puntuacion[0]['resiliencia']), 1, 0, 'C', 1);
                    $pdf->Cell(30, 10, htmlspecialchars($puntuacion[0]['flexibilidad']), 1, 0, 'C', 1);
                    $pdf->Cell(35, 10, htmlspecialchars($puntuacion[0]['cumplAgenda']), 1, 0, 'C', 1);
                    $pdf->Cell(35, 10, htmlspecialchars($puntuacion[0]['resMonotonia']), 1, 1, 'C', 1);
                } else {
                    $pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C', 1);
                }

                // Pie de página
                $pdf->SetY(-15);
                $pdf->SetFont('helvetica', 'I', 8);
                $pdf->Cell(0, 10, 'Página ' . $pdf->getAliasNumPage() . '/' . $pdf->getAliasNbPages(), 0, 0, 'C');

                $nombreArchivo = 'calificacion_' . $calificacion[0]['fecha'] . '.pdf';
                $pdf->Output($nombreArchivo, 'I');
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

        $comando = 'echo ' . escapeshellarg($mensaje) . ' | mailx -s ' . escapeshellarg($asunto) . ' -S from=' . escapeshellarg($from) . ' ' . $para;
        
        exec($comando, $salida, $devolver);

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

    public function obtenerinfoCliente($documento)
    {
        return $this->clienteRepository->obtenerInfoCliente($documento);
    }

    public function obtenerTipoDocumento($documento)
    {
        return $this->clienteRepository->obtenerTipoDocumento($documento);
    }

    public function eliminarUsuarioAdmin(mixed $nroDocumento)
    {
        $this->clienteRepository->eliminarUsuarioAdmin($nroDocumento);
    }

    public function desactivarUsuarioAdmin(mixed $documento)
    {
        $this->clienteRepository->desactivarUsuarioAdmin($documento);
    }

    public function activarUsuario(mixed $documento)
    {
        $this->clienteRepository->activarUsuario($documento);
    }
}