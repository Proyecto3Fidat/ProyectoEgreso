<?php

namespace App\Controllers;

use App\Services\ComboEjercicioServices;
use App\Services\ContieneService;

class ComboEjercicioController
{
    public function crearCombo()
    {

        $contiene = new ContieneService();
        $ejerciciosJson = $_POST['ejercicios'];

        $ejercicios = json_decode($ejerciciosJson, true);
        $nombre = filter_input(INPUT_POST, 'nombreCombo', FILTER_SANITIZE_SPECIAL_CHARS);



        if (json_last_error() !== JSON_ERROR_NONE) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'JSON inválido en el campo ejercicios']);
            return;
        }

        if (is_array($ejercicios)) {
            $comboEjercicioServices = new ComboEjercicioServices();
            $contiene = new ContieneService();
            $comboEjercicioServices->crearCombo($nombre);

            foreach ($ejercicios as $ejercicio) {
                $id = $ejercicio['idEjercicio'];
                $contiene->crearContiene($nombre, $id);
            }

        }
    }



}