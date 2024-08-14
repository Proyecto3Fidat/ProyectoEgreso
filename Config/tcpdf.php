<?php

class PdfGenerator{
    private $pdf;
    
    public function __construct(){
        $this->pdf = new \TCPDF();
        
        // Configurar el documento
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('Tu Nombre o Empresa');
        $this->pdf->SetTitle('Lista de Usuarios');
        $this->pdf->SetSubject('Lista de Usuarios');
        $this->pdf->SetKeywords('TCPDF, PDF, lista de usuarios');
        
        // Configurar el tamaño de la página
        $this->pdf->AddPage();
        
        // Configurar el estilo de texto
        $this->pdf->SetFont('helvetica', '', 12);
    }

    public function addUserTable(array $usuarios)
    {
        // Crear el contenido del PDF
        $html = '<h1>Lista de Usuarios</h1>';
        $html .= '<table border="1" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>';
        
        // Agregar los datos de los usuarios a la tabla
        foreach ($usuarios as $usuario) {
            $html .= '<tr>
                        <td>' . htmlspecialchars($usuario['nombre']) . '</td>
                        <td>' . htmlspecialchars($usuario['email']) . '</td>
                      </tr>';
        }
        
        $html .= '</tbody></table>';

        // Escribir el contenido HTML en el PDF
        $this->pdf->writeHTML($html, true, false, true, false, '');
    }

    public function outputPdf($filename = 'lista_usuarios.pdf')
    {
        // Cerrar y generar el PDF
        $this->pdf->Output($filename, 'I');
    }
}

// Ejemplo de uso
$usuarios = [
    ['nombre' => 'Juan Pérez', 'email' => 'juan@example.com'],
    ['nombre' => 'Ana Gómez', 'email' => 'ana@example.com'],
    ['nombre' => 'Luis Martínez', 'email' => 'luis@example.com']
];

$pdfGenerator = new PdfGenerator();
$pdfGenerator->addUserTable($usuarios);
$pdfGenerator->outputPdf();
