<?php
namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\YamlFileLoader;

class TemplateController
{
    protected $twig;
    protected $translator;

    public function __construct()
    {
        // Configuración de Twig
        $loader = new FilesystemLoader([
            '../App/Views',
            '../Public'
        ]);
        $this->twig = new Environment($loader, [
            'debug' => true,
            'cache' => false
        ]);

        $this->twig->addExtension(new DebugExtension());

        // Configuración del Traductor
        $this->translator = new Translator('es'); // Idioma por defecto
        $this->translator->addLoader('yaml', new YamlFileLoader());

        // Carga de archivos de traducción
        $this->translator->addResource('yaml', __DIR__ . '/../../translations/messages.en.yaml', 'en');
        $this->translator->addResource('yaml', __DIR__ . '/../../translations/messages.es.yaml', 'es');

        // Configuración del idioma según la cookie o variable de sesión
        $selectedLanguage = $_COOKIE['lang'] ?? 'es';
        $this->translator->setLocale($selectedLanguage);

        // Hacer el traductor global para Twig
        $this->twig->addGlobal('translator', $this->translator);
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
            echo $e;
        } catch (\Twig\Error\SyntaxError $e) {
            echo "Error: Problema de sintaxis en la plantilla.";
            echo $e;
        }
    }
}
