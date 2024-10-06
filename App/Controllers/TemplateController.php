<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TemplateController
{
    protected $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader([
            '../App/Views',
            '../Public'
        ]);
        $this->twig = new Environment($loader);
    }


    public function renderTemplate(string $templateName, array $data = []): void
    {
        try {
            echo $this->twig->render($templateName . '.html.twig', $data);
            exit();
        } catch (\Twig\Error\LoaderError $e) {
            echo "Error: Plantilla no encontrada.";
        } catch (\Twig\Error\RuntimeError $e) {
            echo "Error: Ocurrió un problema al renderizar la plantilla.";
        } catch (\Twig\Error\SyntaxError $e) {
            echo "Error: Problema de sintaxis en la plantilla.";
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
