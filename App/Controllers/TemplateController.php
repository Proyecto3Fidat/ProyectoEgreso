<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
class TemplateController
{
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader([
            '../App/Views',
            '../Public'
        ]);
        $this->twig = new Environment($loader, [
            'debug' => true,
            'cache' => false
        ]);

        $this->twig->addExtension(new DebugExtension());
    }


    public function renderTemplate(string $templateName, array $data = []): void
    {
        try {
            echo $this->twig->render($templateName . '.html.twig', $data);
            exit();
        } catch (\Twig\Error\LoaderError $e) {
            $currentFilePath = __FILE__;

            echo "La ruta actual del archivo es: " . $currentFilePath;
            echo "Error: Plantilla no encontrada.";
        } catch (\Twig\Error\RuntimeError $e) {
            echo "Error: Ocurrió un problema al renderizar la plantilla.";
        } catch (\Twig\Error\SyntaxError $e) {
            echo "Error: Problema de sintaxis en la plantilla.". $e;
        }
    }
    public function renderHtml(string $htmlFileName): void
    {
        try {
            echo $this->twig->render($htmlFileName . '.html');
            exit();
        } catch (\Twig\Error\LoaderError $e) {
            echo "Error: Plantilla no encontrada.";
        } catch (\Twig\Error\RuntimeError $e) {
            echo "Error: Ocurrió un problema al renderizar la plantilla.";
        } catch (\Twig\Error\SyntaxError $e) {
            echo "Error: Problema de sintaxis en la plantilla.";
        }
    }
}
