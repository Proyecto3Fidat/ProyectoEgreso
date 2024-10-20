<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\LocalGymController;
use App\Controllers\ComboEjercicioController;
use App\Controllers\ContieneController;
use Pecee\SimpleRouter\SimpleRouter;
use App\Controllers\HomeController;
use App\Controllers\ClienteController;
use App\Controllers\UsuarioController;
use App\Controllers\DeportistaController;
use App\Controllers\PacienteController;
use App\Controllers\ObtieneController;
use App\Controllers\CalificacionController;
use App\Services\ClienteService;
use App\Services\UsuarioService;
use App\Services\DeportistaService;
use App\Services\PacienteService;
use App\Services\ObtieneService;
use App\Services\CalificacionService;
use App\Repositories\ClienteRepository;
use App\Repositories\UsuarioRepository;
use App\Repositories\DeportistaRepository;
use App\Repositories\PacienteRepository;
use App\Repositories\ObtieneRepository;
use App\Repositories\CalificacionRepository;
use App\Controllers\ClientelefonoController;
use App\Models\ClientelefonoModel;
use App\Services\ClientetelefonoService;
use App\Utilities\DataSeeder;
use App\Repositories\ClientetelefonoRepository;
use App\Utilities\DatabaseLoader;
use App\Controllers\AuthMiddleware;
use App\Controllers\EntrenadorMiddleware;
use App\Controllers\AdministrativoMiddleware;
use \App\Controllers\PagoMiddleware;
use App\Controllers\TemplateController;
use App\Controllers\EjercicioController;

$config = require __DIR__ . '/../Config/monolog.php';
$logger = $config['logger']();

$usuarioLog = require __DIR__ . '/../Config/usuarioLogger.php';
$loggerU = $usuarioLog['logger']();

SimpleRouter::get('cargarDatos', function (){
    $seeder = new DataSeeder();
    /* Locales    */
    $seeder->seedLocalGym( new \App\Models\LocalGymModel('Gym1', 'Calle 1', '1', 'Esquina 1', '10'));
    $seeder->seedLocalGym( new \App\Models\LocalGymModel('Gym2', 'Calle 2', '2', 'Esquina 2', '20'));
    $seeder->seedLocalGym( new \App\Models\LocalGymModel('Gym3', 'Calle 3', '3', 'Esquina 3', '30'));
    $seeder->seedLocalGym( new \App\Models\LocalGymModel('Gym4', 'Calle 4', '4', 'Esquina 4', '40'));
    $seeder->seedLocalGym( new \App\Models\LocalGymModel('Gym5', 'Calle 5', '5', 'Esquina 5', '50'));
    $seeder->seedLocalGym( new \App\Models\LocalGymModel('Gym6', 'Calle 6', '6', 'Esquina 6', '60'));


    /* Agendas   */
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '08:00', '09:00', '2'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '09:00', '10:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '10:00', '11:00', '1'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '11:00', '12:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '12:00', '13:00', '3'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '13:00', '14:00', '4'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '14:00', '15:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '15:00', '16:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '16:00', '17:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '17:00', '18:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '18:00', '19:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '19:00', '20:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '20:00', '21:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Lunes', '21:00', '22:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '08:00', '09:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '09:00', '10:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '10:00', '11:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '11:00', '12:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '12:00', '13:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '13:00', '14:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '14:00', '15:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '15:00', '16:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '16:00', '17:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '17:00', '18:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '18:00', '19:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '19:00', '20:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '20:00', '21:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Martes', '21:00', '22:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '08:00', '09:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '09:00', '10:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '10:00', '11:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '11:00', '12:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '12:00', '13:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '13:00', '14:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '14:00', '15:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '15:00', '16:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '16:00', '17:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '17:00', '18:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '18:00', '19:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '19:00', '20:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Miercoles', '20:00', '21:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '08:00', '09:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '09:00', '10:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '10:00', '11:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '11:00', '12:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '12:00', '13:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '13:00', '14:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '14:00', '15:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '15:00', '16:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '16:00', '17:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '17:00', '18:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '18:00', '19:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '19:00', '20:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Jueves', '20:00', '21:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '08:00', '09:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '09:00', '10:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '10:00', '11:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '11:00', '12:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '12:00', '13:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '13:00', '14:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '14:00', '15:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '15:00', '16:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '16:00', '17:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '17:00', '18:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '18:00', '19:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '19:00', '20:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Viernes', '20:00', '21:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '08:00', '09:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '09:00', '10:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '10:00', '11:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '11:00', '12:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '12:00', '13:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '13:00', '14:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '14:00', '15:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '15:00', '16:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '16:00', '17:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '17:00', '18:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '18:00', '19:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '19:00', '20:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Sabado', '20:00', '21:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '08:00', '09:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '09:00', '10:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '10:00', '11:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '11:00', '12:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '12:00', '13:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '13:00', '14:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '14:00', '15:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '15:00', '16:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '16:00', '17:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '17:00', '18:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '18:00', '19:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '19:00', '20:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '20:00', '21:00', '0'));
    $seeder->seedAgenda(new \App\Models\AgendaModel('Domingo', '21:00', '22:00', '0'));

    /* Conformas  */
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '11:00', '12:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '12:00', '13:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '13:00', '14:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '14:00', '15:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '15:00', '16:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '16:00', '17:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '17:00', '18:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '18:00', '19:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '19:00', '20:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '20:00', '21:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Lunes', '21:00', '22:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '11:00', '12:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '12:00', '13:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '13:00', '14:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '14:00', '15:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '15:00', '16:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '16:00', '17:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '17:00', '18:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '18:00', '19:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym1', 'Martes', '19:00', '20:00'));

    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '11:00', '12:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '12:00', '13:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '13:00', '14:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '14:00', '15:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '15:00', '16:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '16:00', '17:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '17:00', '18:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '18:00', '19:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '19:00', '20:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '20:00', '21:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Lunes', '21:00', '22:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '11:00', '12:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '12:00', '13:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '13:00', '14:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '14:00', '15:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '15:00', '16:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '16:00', '17:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '17:00', '18:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym2', 'Martes', '18:00', '19:00'));

    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '08:00', '09:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '11:00', '12:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '12:00', '13:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '13:00', '14:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '14:00', '15:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '15:00', '16:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '16:00', '17:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '17:00', '18:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '18:00', '19:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '19:00', '20:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '20:00', '21:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Lunes', '21:00', '22:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Martes', '08:00', '09:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Martes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Martes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym3', 'Martes', '11:00', '12:00'));

    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '08:00', '09:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '11:00', '12:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '12:00', '13:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '13:00', '14:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '14:00', '15:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '15:00', '16:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '16:00', '17:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '17:00', '18:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '18:00', '19:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '19:00', '20:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '20:00', '21:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Lunes', '21:00', '22:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Martes', '08:00', '09:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Martes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Martes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Martes', '11:00', '12:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym4', 'Martes', '12:00', '13:00'));

    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '08:00', '09:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '11:00', '12:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '12:00', '13:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '13:00', '14:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '14:00', '15:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '15:00', '16:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '16:00', '17:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '17:00', '18:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '18:00', '19:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '19:00', '20:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '20:00', '21:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Lunes', '21:00', '22:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Martes', '08:00', '09:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym5', 'Martes', '09:00', '10:00'));

    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '08:00', '09:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '09:00', '10:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '10:00', '11:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '11:00', '12:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '12:00', '13:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '13:00', '14:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '14:00', '15:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '15:00', '16:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '16:00', '17:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '17:00', '18:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '18:00', '19:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '19:00', '20:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '20:00', '21:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Lunes', '21:00', '22:00'));
    $seeder->seedConforma(new \App\Models\ConformaModel('Gym6', 'Martes', '08:00', '09:00'));

    /* Usuarios */
    $seeder->seedCliente('12326789', 'ci', '1.71', '40', 'montemayor', 8080, 'leal de ibarra', 'juanperez@gmail.com', 'nada', '2006-06-13', 'Juan', 'Perez', '+59893653471');
    $seeder->seedCliente('97121013', 'ci', '1.64', '43', 'reconquista', 545, 'rincon', 'matiasrezo@gmail.com', 'nada', '2001-06-02', 'Matias', 'Rezo', '+59893653471');
    $seeder->seedCliente('2455963147', 'ci', '1.85', '32', 'sarandi', 1234, 'brava', 'luisgomez@gmail.com', 'nada', '1990-04-15', 'Luis', 'Gomez', '+59893654321');
    $seeder->seedCliente('85463701', 'ci', '1.77', '29', 'libertad', 9123, 'martinez', 'mariarodriguez@gmail.com', 'nada', '1995-11-23', 'Maria', 'Rodriguez', '+59892678943');
    $seeder->seedCliente('745258963', 'ci', '1.60', '25', 'salto', 1234, 'oribe', 'carlosalvarez@gmail.com', 'nada', '1998-07-19', 'Carlos', 'Alvarez', '+59893456982');
    $seeder->seedCliente('945852741', 'ci', '1.72', '37', 'ciudadela', 5678, 'tacuarembo', 'sofiafernandez@gmail.com', 'nada', '1987-09-11', 'Sofia', 'Fernandez', '+59894567389');
    $seeder->seedCliente('789456123', 'ci', '1.65', '22', 'mercedes', 3456, 'agraciada', 'pabloferrari@gmail.com', 'nada', '2000-05-27', 'Pablo', 'Ferrari', '+59892347890');
    $seeder->seedCliente('145852369', 'ci', '1.90', '30', 'artigas', 9876, 'solis', 'anagonzalez@gmail.com', 'nada', '1993-02-17', 'Ana', 'Gonzalez', '+59895673482');
    $seeder->seedCliente('34562147', 'ci', '1.73', '28', 'colon', 4321, 'rivera', 'rodrigosanchez@gmail.com', 'nada', '1996-12-08', 'Rodrigo', 'Sanchez', '+59896451234');
    $seeder->seedCliente('145753486', 'ci', '1.55', '31', 'flores', 8765, 'santana', 'veronicadiaz@gmail.com', 'nada', '1992-10-02', 'Veronica', 'Diaz', '+59898674521');
    $seeder->seedCliente('951753852', 'ci', '1.82', '45', 'florida', 1478, 'colon', 'gabrielmartinez@gmail.com', 'nada', '1978-06-14', 'Gabriel', 'Martinez', '+59892345678');
    $seeder->seedCliente('65587321', 'ci', '1.66', '26', 'durazno', 9632, 'las flores', 'isabelcorrea@gmail.com', 'nada', '1997-03-11', 'Isabel', 'Correa', '+59896543217');
    $seeder->seedCliente('745963258', 'ci', '1.58', '33', 'cerro largo', 5623, 'ramirez', 'cristianrios@gmail.com', 'nada', '1990-01-22', 'Cristian', 'Rios', '+59898765431');
    $seeder->seedCliente('984323654', 'ci', '1.72', '38', 'maldonado', 2345, 'rivero', 'clararuiz@gmail.com', 'nada', '1985-09-30', 'Clara', 'Ruiz', '+59894567892');
    $seeder->seedCliente('25876369', 'ci', '1.67', '41', 'treinta y tres', 8901, 'lavalleja', 'emilianolopez@gmail.com', 'nada', '1982-08-05', 'Emiliano', 'Lopez', '+59895346782');
    $seeder->seedCliente('456122789', 'ci', '1.74', '35', 'tacuarembo', 6789, 'suarez', 'andreamartinez@gmail.com', 'nada', '1988-04-21', 'Andrea', 'Martinez', '+59898451234');
    $seeder->seedCliente('789654523', 'ci', '1.68', '42', 'rivera', 3452, 'paez', 'camilagutierrez@gmail.com', 'nada', '1981-12-13', 'Camila', 'Gutierrez', '+59891234567');
    $seeder->seedCliente('963258741', 'ci', '1.75', '27', 'rocha', 9012, 'fuentes', 'jorgemunoz@gmail.com', 'nada', '1996-07-29', 'Jorge', 'Munoz', '+59893247890');
    $seeder->seedCliente('123987654', 'ci', '1.80', '24', 'artigas', 6541, 'pinto', 'victoriaalvarez@gmail.com', 'nada', '1999-11-07', 'Victoria', 'Alvarez', '+59892347856');
    $seeder->seedCliente('74258963', 'ci', '1.69', '44', 'cerro', 8761, 'gonzalez', 'ricardotorres@gmail.com', 'nada', '1980-10-26', 'Ricardo', 'Torres', '+59894782356');
    $seeder->seedCliente('852741963', 'ci', '1.61', '36', 'salto', 1432, 'torres', 'beatrizgomez@gmail.com', 'nada', '1987-05-17', 'Beatriz', 'Gomez', '+59895781234');
    $seeder->seedCliente('258963741', 'ci', '1.61', '23', 'tacuarembo', 7123, 'serrato', 'andresalvarez@gmail.com', 'nada', '2000-07-04', 'Andres', 'Alvarez', '+59893657892');
    $seeder->seedCliente('369852741', 'ci', '1.83', '39', 'treinta y tres', 9421, 'juarez', 'alejandragonzalez@gmail.com', 'nada', '1985-03-18', 'Alejandra', 'Gonzalez', '+59894562347');
    $seeder->seedCliente('654987123', 'ci', '1.65', '34', 'artigas', 8723, 'morales', 'felipegarcia@gmail.com', 'nada', '1989-01-09', 'Felipe', 'Garcia', '+59896783452');
    $seeder->seedCliente('123654987', 'ci', '1.71', '28', 'paysandu', 3124, 'ramos', 'paulagomez@gmail.com', 'nada', '1996-06-19', 'Paula', 'Gomez', '+59897823412');
    $seeder->seedCliente('852369741', 'ci', '1.62', '46', 'rocha', 5213, 'gomez', 'guillermolopez@gmail.com', 'nada', '1978-11-15', 'Guillermo', 'Lopez', '+59897654283');
    $seeder->seedCliente('147852963', 'ci', '1.55', '40', 'rivera', 1098, 'rios', 'gabrielasanchez@gmail.com', 'nada', '1983-07-02', 'Gabriela', 'Sanchez', '+59892367458');
    $seeder->seedCliente('258741963', 'ci', '1.73', '29', 'montevideo', 4500, 'lavalleja', 'juaniglesias@gmail.com', 'nada', '1994-04-25', 'Juan', 'Iglesias', '+59895472681');
    $seeder->seedCliente('753951426', 'ci', '1.76', '22', 'cerro largo', 7623, 'oribe', 'claudiaperez@gmail.com', 'nada', '2001-02-13', 'Claudia', 'Perez', '+59896534219');
    $seeder->seedCliente('159357486', 'ci', '1.80', '33', 'salto', 1094, 'lopez', 'santiagomartinez@gmail.com', 'nada', '1990-11-09', 'Santiago', 'Martinez', '+59894562834');
    $seeder->seedCliente('123456741', 'ci', '1.66', '47', 'florida', 2098, 'fernandez', 'mariariquelme@gmail.com', 'nada', '1976-10-18', 'Maria', 'Riquelme', '+59895487312');
    $seeder->seedCliente('250963147', 'ci', '1.82', '35', 'durazno', 6714, 'ramirez', 'lucianoduran@gmail.com', 'nada', '1988-03-25', 'Luciano', 'Duran', '+59897865412');
    $seeder->seedCliente('75159486', 'ci', '1.74', '27', 'flores', 8956, 'carballo', 'catalinavazquez@gmail.com', 'nada', '1996-08-29', 'Catalina', 'Vazquez', '+59893674812');
    $seeder->seedCliente('321254987', 'ci', '1.59', '21', 'cerro largo', 4375, 'martinez', 'julioarrieta@gmail.com', 'nada', '2002-12-12', 'Julio', 'Arrieta', '+59892657893');
    $seeder->seedCliente('963741258', 'ci', '1.77', '42', 'sarandi', 5003, 'gonzalez', 'fatimaruiz@gmail.com', 'nada', '1981-04-06', 'Fatima', 'Ruiz', '+59891452345');
    $seeder->seedCliente('654789123', 'ci', '1.81', '38', 'durazno', 3985, 'correa', 'fernandolopez@gmail.com', 'nada', '1985-06-26', 'Fernando', 'Lopez', '+59894652318');
    $seeder->seedCliente('852963741', 'ci', '1.63', '26', 'ciudadela', 7123, 'saavedra', 'aliciarodriguez@gmail.com', 'nada', '1997-10-04', 'Alicia', 'Rodriguez', '+59898451234');
    $seeder->seedCliente('753159624', 'ci', '1.78', '31', 'treinta y tres', 4231, 'pinto', 'sebastianmolina@gmail.com', 'nada', '1992-03-30', 'Sebastian', 'Molina', '+59897834612');
    $seeder->seedCliente('987654123', 'ci', '1.68', '45', 'rivera', 3124, 'torres', 'danielcardoso@gmail.com', 'nada', '1979-07-11', 'Daniel', 'Cardoso', '+59894582347');
    $seeder->seedCliente('951753486', 'ci', '1.62', '33', 'sarandi', 2453, 'viera', 'mariaruiz@gmail.com', 'nada', '1990-09-08', 'Maria', 'Ruiz', '+59891247892');
    $seeder->seedCliente('163852741', 'ci', '1.79', '41', 'paysandu', 7392, 'gimenez', 'albertososa@gmail.com', 'nada', '1983-01-15', 'Alberto', 'Sosa', '+59898712345');
    $seeder->seedCliente('25896147', 'ci', '1.70', '34', 'maldonado', 7123, 'beltran', 'guadalupefernandez@gmail.com', 'nada', '1989-08-19', 'Guadalupe', 'Fernandez', '+59893651234');
    $seeder->seedCliente('752159486', 'ci', '1.75', '26', 'florida', 3456, 'torres', 'ignaciofernandez@gmail.com', 'nada', '1997-05-23', 'Ignacio', 'Fernandez', '+59898765123');
    $seeder->seedCliente('321654789', 'ci', '1.61', '39', 'pando', 5673, 'hernandez', 'martinarodriguez@gmail.com', 'nada', '1984-11-04', 'Martina', 'Rodriguez', '+59891234598');
    $seeder->seedCliente('963152741', 'ci', '1.73', '43', 'artigas', 1234, 'vazquez', 'marceloalvarez@gmail.com', 'nada', '1981-01-21', 'Marcelo', 'Alvarez', '+59894567891');
    $seeder->seedCliente('654967123', 'ci', '1.66', '29', 'salto', 8765, 'ramirez', 'lorenaperez@gmail.com', 'nada', '1994-02-10', 'Lorena', 'Perez', '+59895678234');
    $seeder->seedCliente('85293147', 'ci', '1.69', '47', 'treinta y tres', 6789, 'gimenez', 'emilianofernandez@gmail.com', 'nada', '1976-03-15', 'Emiliano', 'Fernandez', '+59896543218');
    $seeder->seedCliente('258324193', 'ci', '1.72', '36', 'montevideo', 3451, 'gonzalez', 'cristinafernandez@gmail.com', 'nada', '1987-06-14', 'Cristina', 'Fernandez', '+59892345671');
    $seeder->seedCliente('7533146', 'ci', '1.75', '33', 'durazno', 9873, 'sosa', 'ramiroalvarez@gmail.com', 'nada', '1990-05-28', 'Ramiro', 'Alvarez', '+59897432156');
    $seeder->seedCliente('1593457486', 'ci', '1.60', '25', 'cerro largo', 5432, 'martinez', 'mariatapia@gmail.com', 'nada', '1998-08-08', 'Maria', 'Tapia', '+59898654712');
    $seeder->seedCliente('82387474', 'ci', '1.70', '22', 'paysandu', 7654, 'gutierrez', 'leandrolopez@gmail.com', 'nada', '2000-07-19', 'Leandro', 'Lopez', '+59893456712');
    $seeder->seedCliente('2589347', 'ci', '1.78', '31', 'artigas', 1234, 'rios', 'valentinperez@gmail.com', 'nada', '1993-09-22', 'Valentin', 'Perez', '+59894567834');
    $seeder->seedCliente('751152486', 'ci', '1.65', '27', 'rivera', 8765, 'gomez', 'noeliadiaz@gmail.com', 'nada', '1996-11-18', 'Noelia', 'Diaz', '+59895673124');
    $seeder->seedCliente('3265387', 'ci', '1.79', '40', 'cerro largo', 9874, 'ferrari', 'fernandofernandez@gmail.com', 'nada', '1983-10-12', 'Fernando', 'Fernandez', '+59896547832');
    $seeder->seedCliente('96384741', 'ci', '1.68', '38', 'sarandi', 4321, 'perez', 'gabrielalopez@gmail.com', 'nada', '1985-06-17', 'Gabriela', 'Lopez', '+59892347812');
    $seeder->seedCliente('65497123', 'ci', '1.62', '44', 'florida', 7653, 'gimenez', 'sergioperez@gmail.com', 'nada', '1979-02-26', 'Sergio', 'Perez', '+59891234573');
    $seeder->seedCliente('855243147', 'ci', '1.81', '35', 'treinta y tres', 6543, 'garcia', 'luciamorales@gmail.com', 'nada', '1988-03-11', 'Lucia', 'Morales', '+59893456789');
    $seeder->seedCliente('258121961', 'ci', '1.69', '41', 'durazno', 9873, 'suarez', 'diegoalvarez@gmail.com', 'nada', '1982-09-05', 'Diego', 'Alvarez', '+59892347823');
    $seeder->seedCliente('753951186', 'ci', '1.75', '29', 'rocha', 5432, 'lopez', 'juliadiaz@gmail.com', 'nada', '1994-12-03', 'Julia', 'Diaz', '+59895432167');
    $seeder->seedCliente('151257486', 'ci', '1.70', '37', 'artigas', 6543, 'gomez', 'marianalopez@gmail.com', 'nada', '1986-01-07', 'Mariana', 'Lopez', '+59896547892');
    $seeder->seedCliente('121223741', 'ci', '1.64', '24', 'rivera', 9874, 'perez', 'franciscolopez@gmail.com', 'nada', '1999-05-12', 'Francisco', 'Lopez', '+59897654321');


    /*Usuarios y Calificaciones */
    $seeder->seedUsuario('121223741', '1234', 'entrenador');
    $seeder->seedUsuario('151257486', '1234', 'entrenador');
    $seeder->seedUsuario('753951186', '1234', 'entrenador');
    $seeder->seedUsuario('163852741', '1234', 'entrenador');
    $seeder->seedUsuario('258121961', '1234', 'entrenador');
    $seeder->seedUsuario('855243147', '1234', 'administrativo');
    $seeder->seedUsuario('65497123', '1234', 'administrativo');
    $seeder->seedUsuario('96384741', '1234', 'administrativo');
    $seeder->seedUsuario('3265387', '1234', 'administrativo');
    $seeder->seedUsuario('751152486', '1234', 'administrativo');
    $seeder->seedUsuario('12326789', '1234', 'deportista');
    $seeder->seedUsuario('97121013', '1234', 'deportista');
    $seeder->seedUsuario('2455963147', '1234', 'deportista');
    $seeder->seedUsuario('85463701', '1234', 'deportista');
    $seeder->seedDeportista('12326789','ci','futbol','golero');
    $seeder->seedDeportista('97121013','ci','futbol','golero');
    $seeder->seedDeportista('2455963147','ci','futbol','golero');
    $seeder->seedDeportista('85463701','ci','futbol','golero');
    $seeder->seedObtiene('12326789','ci','90','200','8','2','16','17','9','26','1');
    $seeder->seedObtiene('12326789','ci','99','200','18','12','19','17','9','2','8');
    $seeder->seedObtiene('97121013','ci','90','200','8','2','16','17','9','26','1');
    $seeder->seedObtiene('97121013','ci','99','200','18','12','19','17','9','2','8');
    $seeder->seedObtiene('2455963147','ci','90','200','8','2','16','17','9','26','1');
    $seeder->seedObtiene('2455963147','ci','99','200','18','12','19','17','9','2','8');
    $seeder->seedObtiene('85463701','ci','90','200','8','2','16','17','9','26','1');
    $seeder->seedObtiene('85463701','ci','99','200','18','12','19','17','9','2','8');


     $clientesSinUsuario = [
         '745258963', '945852741', '789456123', '145852369', '34562147',
        '145753486', '951753852', '65587321', '745963258', '984323654', '25876369', '456122789',
        '789654523', '963258741', '123987654', '74258963', '852741963', '258963741', '369852741',
        '654987123', '123654987', '852369741', '147852963', '258741963', '753951426', '159357486',
        '123456741', '250963147', '75159486', '321254987', '963741258', '654789123', '852963741',
        '753159624', '987654123', '951753486', '25896147', '752159486', '321654789',
        '963152741', '654967123', '85293147', '258324193', '7533146', '1593457486', '82387474',
        '2589347'
    ];
    foreach ($clientesSinUsuario as $clienteId) {
        $seeder->seedUsuario($clienteId, '1234', 'cliente');
    }

    /* Se Agenda*/
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('12326789', 'ci', '2021-06-13', '0', 'Lunes', '08:00', '09:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('12326789', 'ci', '2021-06-13', '0', 'Martes', '09:00', '10:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('12326789', 'ci', '2021-06-13', '0', 'Miercoles', '09:00', '10:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('12326789', 'ci', '2021-06-13', '0', 'Jueves', '09:00', '10:00'));


    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('97121013', 'ci', '2021-06-13', '0', 'Lunes', '08:00', '09:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('97121013', 'ci', '2021-06-13', '0', 'Martes', '09:00', '10:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('97121013', 'ci', '2021-06-13', '0', 'Miercoles', '09:00', '10:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('97121013', 'ci', '2021-06-13', '0', 'Jueves', '09:00', '10:00'));


    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('2455963147', 'ci', '2021-06-13', '0', 'Lunes', '08:00', '09:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('2455963147', 'ci', '2021-06-13', '0', 'Martes', '09:00', '10:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('2455963147', 'ci', '2021-06-13', '0', 'Miercoles', '09:00', '10:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('2455963147', 'ci', '2021-06-13', '0', 'Jueves', '09:00', '10:00'));


    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('85463701', 'ci', '2021-06-13', '0', 'Lunes', '08:00', '09:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('85463701', 'ci', '2021-06-13', '0', 'Martes', '09:00', '10:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('85463701', 'ci', '2021-06-13', '0', 'Miercoles', '09:00', '10:00'));
    $seeder->seedSeAgenda( new \App\Models\SeAgendaModel('85463701', 'ci', '2021-06-13', '0', 'Jueves', '09:00', '10:00'));

    $seeder->seedPlanPago( new \App\Models\PlanPagoModel('trimestral', 'Pago de 3 meses', '3 meses'));
    $seeder->seedPlanPago( new \App\Models\PlanPagoModel('semestral', 'Pago de un semestre', '6 meses'));
    $seeder->seedPlanPago( new \App\Models\PlanPagoModel('anual', 'Pago de un año', '12 meses'));


    $seeder->seedPago(new \App\Models\PagoModel('2024/09/13'), new \App\Models\RealizaModel('2024/06/13','trimestral'), new \App\Models\EligeModel('2455963147','ci','2024/06/13','trimestral'));
    $seeder->seedPago(new \App\Models\PagoModel('2024/09/13'), new \App\Models\RealizaModel('2024/06/13','trimestral'), new \App\Models\EligeModel('97121013','ci','2024/06/13','trimestral'));
    $seeder->seedPago(new \App\Models\PagoModel('2024/09/13'), new \App\Models\RealizaModel('2024/06/13','trimestral'), new \App\Models\EligeModel('12326789','ci','2024/06/13','trimestral'));

    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Press banca plano','El press de banca activa los músculos del pecho, sobre todo el músculo pectoral mayor (los pectorales)','pectoral, hombro y tríceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Press banca inclinado',' Los principales músculos que participan son el pectoral mayor (con énfasis en la porción superior), el deltoides (porción anterior) y el tríceps. ','pectoral, hombro y tríceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Aperturas con mancuerna y banco plano','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','pectoral, hombro y tríceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Aperturas con mancuerna y banco inclinado','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','pectoral, hombro y tríceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Hombro.  Elevaciones laterales','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','pectoral, hombro y tríceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Extensión de tríceps en polea','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','pectoral, hombro y tríceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Press francés en banco y barra Z','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','pectoral, hombro y tríceps','Fuerza o Resistencia'));

    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Empujes en polea alta','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Espalda, hombro (pres) y bíceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Empujes en polea baja','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Espalda, hombro (pres) y bíceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Hiperextensiones','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Espalda, hombro (pres) y bíceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Press en multipower','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Espalda, hombro (pres) y bíceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Elevaciones frontales','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Wspalda, hombro (pres) y bíceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Curl en barra','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Espalda, hombro (pres) y bíceps','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Curl de martillo con mancuerna.','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Espalda, hombro (pres) y bíceps','Fuerza o Resistencia'));

    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Sentadilla.','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Pierna','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Extensiones.','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Pierna','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Curl de femoral en banco.','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Pierna','Fuerza o Resistencia'));
    $seeder->seedEjercicios(new \App\Models\EjercicioModel('Elevaciones de pie.','el press de banca plano con mancuernas trabaja predominantemente el hombro mediante la aducción horizontal, fortaleciendo las fibras centrales del pectoral mayor','Pierna','Fuerza o Resistencia'));

    exit();
});
SimpleRouter::post('/pagos', function () use ($logger) {
    $elige = new App\Controllers\EligeController();
    $elige->obtenerPagosPorDocumento();
    exit();
});

SimpleRouter::get('/inicio', function () {
    $template = new TemplateController();
    $template->renderTemplate('inicio', ['calificacion' => '<li><a href="/">Calificación</a></li>']);
});

SimpleRouter::get('/main', function () {
    $template = new TemplateController();
    $template->renderTemplate('inicio');
});



SimpleRouter::post('planes', function () use ($logger) {
    $planes = new App\Controllers\EligeController();
    $planes->obtenerPagosPorDocumento();
    exit();
});

SimpleRouter::group(['middleware' => PagoMiddleware::class], function () use ($logger, $loggerU) {
    SimpleRouter::get('/', [HomeController::class, 'index']);

SimpleRouter::group(['middleware' => AuthMiddleware::class], function () use ($logger, $loggerU) {

    Simplerouter::get('/usuario/obtenerCalificacionesAjax', function () use ($logger) {
        $calificacionRepository = new CalificacionRepository();
        $calificacionService = new CalificacionService($calificacionRepository);
        $calificacionController = new CalificacionController($calificacionService, $logger);
        $calificacionController->obtenerPuntuacionesAjax();
        exit();
    });

    SimpleRouter::post('/asistencia', function () use ($logger) {
        $asistencia = filter_input(INPUT_POST, 'asistencia', FILTER_SANITIZE_SPECIAL_CHARS);
        $documento = filter_input(INPUT_POST, 'documento', FILTER_SANITIZE_SPECIAL_CHARS);
        $dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaInicio = filter_input(INPUT_POST, 'horaInicio', FILTER_SANITIZE_SPECIAL_CHARS);
        $horaFin = filter_input(INPUT_POST, 'horaFin', FILTER_SANITIZE_SPECIAL_CHARS);
        $seAgenda = new App\Services\SeAgendaService();
        $seAgenda->asistir($documento, $dia, $horaInicio, $horaFin, $asistencia);
        exit();
    });

    SimpleRouter::get('/dashboardUsuario', function () use ($loggerU) {
        $seAgenda = new App\Services\SeAgendaService();
        $grafico = [];
        $compone = new App\Controllers\ComponeController();
        $rutina = new \App\Controllers\RutinaController();
        $practica = new \App\Controllers\PracticaController();
        $graficos = new App\Controllers\GraficosController();
        $template = new TemplateController();
        $calificacionRepository = new CalificacionRepository();
        $calificacionService = new CalificacionService($calificacionRepository);
        $calificacionController = new CalificacionController($calificacionService, $loggerU);
        $clienteRepository = new ClienteRepository();
        $clienteService = new ClienteService($clienteRepository);
        $clienteController = new ClienteController($clienteService, $loggerU);

        $agenda = $seAgenda->obtenerAgendasUsuario($_SESSION['documento']);

        $usuario = $clienteController->obtenerInfoCliente($_SESSION['documento']);
        $calificaciones = $calificacionController->obtenerPuntuacionesCliente($_SESSION['documento']);
        try {
            $grafico = $graficos->crearGrafico($_SESSION['documento'], $calificaciones, $loggerU);

        } catch (Exception $e) {
            $loggerU->error('Error al crear el gráfico: ' . $e->getMessage());
        }
        $practicar = $practica->obtenerPracticas($_SESSION['documento']);
        $resultado = []; // Inicializar el resultado
        foreach ($practicar as $practica) {
            $rutinaInfo = $rutina->obtenerRutina($practica['idRutina']);


            if (!empty($rutinaInfo) && isset($rutinaInfo[0])) {
                $rutinaData = $rutinaInfo[0];
                $combos = $compone->obtenerCombos($practica['idRutina']);

                $resultado[] = [
                    'idRutina' => $rutinaData['idRutina'],
                    'series' => $rutinaData['series'],
                    'repeticiones' => $rutinaData['repeticiones'],
                    'dia' => $rutinaData['dia'],
                    'combo' => $combos
                ];
            }
        }

        $template->renderTemplate(
            'dashboardCliente',
            array_merge(
                ['usuario' => $usuario],
                ['calificaciones' => $calificaciones],
                ['grafico' => $grafico],
                ['practicas' => $resultado],
                ['agenda' => $agenda]
            )
        );
        exit();
    });

    SimpleRouter::group(['middleware' => EntrenadorMiddleware::class], function () use ($logger) {
        SimpleRouter::post('/eliminarRutina', function () {
            $compone = new App\Controllers\ComponeController();
            $solicitud = json_decode(file_get_contents('php://input'), true);
            $id = $solicitud['idRutina'];
            try {
                $compone->eliminarRutina($id);
                echo json_encode([
                    'status' => 'ok',
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Error al eliminar la rutina: ',
                ]);
            }

            exit();

        });
        SimpleRouter::get('/ejercicios', function () {
            $ejer = new EjercicioController();
            $ejer->obtenerEjercicios();
            exit();
        });

        SimpleRouter::post('asignarRutina', function () {
            $template = new TemplateController();
            $practica = new App\Controllers\PracticaController();

            try {
                $practica->asignarRutina();

                echo json_encode([
                    'status' => 'ok',
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ]);
            }

            exit();
        });

        SimpleRouter::get('/obtenerComboEjercicios', function () {
            $template = new TemplateController();
            $ejer = new ContieneController();
            $calificaciones = $ejer->obtenerEjercicios();
            $template->renderTemplate('combo', ['combos' => $calificaciones]);
        });

        SimpleRouter::get('/asignarRutina', function () {
            $resultados = [];
            $rutina = new App\Controllers\RutinaController();
            $compone = new App\Controllers\ComponeController();
            $template = new TemplateController();
            $rutinas = $rutina->obtenerRutinas();
            foreach ($rutinas as $rutina) {
                $r = [
                    'combos' => $compone->obtenerCombos($rutina['idRutina']),
                    'idRutina' => $rutina['idRutina'],
                    'series' => $rutina['series'],
                    'repeticiones' => $rutina['repeticiones'],
                    'dia' => $rutina['dia']
                ];
                $resultado [] = $r;
            }
            $data = [
                'rutinas' => $resultado,
                'documento' => $_GET['documento']
            ];

            $template->renderTemplate('asignarRutina', $data);

        });

        SimpleRouter::post('/crearRutina', function () {
            $contiene = new App\Controllers\ContieneController();
            $compone = new App\Controllers\ComponeController();
            $rutina = new App\Controllers\RutinaController();
            $combosSeleccionadosJson = $_POST['combosSeleccionados'];
            $combosSeleccionados = json_decode($combosSeleccionadosJson, true);

            if($combosSeleccionados == null){
                http_response_code(400);
                $data = [
                    'mensaje' => 'Debe seleccionar al menos un combo',
                    'ruta' => 'obtenerComboEjercicios'
                ];
                $template = new TemplateController();
                $template->renderTemplate('alerta', $data);
                exit();
            }
            if (is_array($combosSeleccionados)) {
                $nombresCombos = [];
                foreach ($combosSeleccionados as $combo) {
                    $nombreCombo = $combo['nombreCombo'];
                    $idEjercicio = $combo['idEjercicio'];
                    $nombreEjercicio = $combo['nombre'];
                    $descripcion = $combo['descripcion'];
                    $tipoEjercicio = $combo['tipoEjercicio'];
                    $grupoMuscular = $combo['grupoMuscular'];
                    $nombresCombos[] = $nombreCombo;
                }

                foreach ($nombresCombos as $nombreCombo) {
                    $ejercicioId = $contiene->obtenerEjerciciosNombre($nombreCombo);
                    $combos [] = [
                        'nombreCombo' => $nombreCombo,
                        'ejercicios' => $ejercicioId
                    ];
                }
                $id = $rutina->crearRutina();
                $compone->crearRutina($combos, $id);
            }

            $datos = [
                'mensaje' => 'Rutina creada con éxito',
                'ruta' => 'obtenerComboEjercicios'
            ];

            $template = new TemplateController();
            $template->renderTemplate('alerta', $datos);
            exit();

        });

        global $loggerU;
        Simplerouter::get('/entrenador/obtenerCalificacionesAjax', function () use ($logger) {

            $calificacionRepository = new CalificacionRepository();
            $calificacionService = new CalificacionService($calificacionRepository);
            $calificacionController = new CalificacionController($calificacionService, $logger);
            $calificacionController->obtenerPuntuacionesAjax();
            exit();
        });

        SimpleRouter::post('/dashboard', function () use ($loggerU) {

            $grafico = [];
            $compone = new App\Controllers\ComponeController();
            $rutina = new \App\Controllers\RutinaController();
            $practica = new \App\Controllers\PracticaController();
            $graficos = new App\Controllers\GraficosController();
            $template = new TemplateController();
            $calificacionRepository = new CalificacionRepository();
            $calificacionService = new CalificacionService($calificacionRepository);
            $calificacionController = new CalificacionController($calificacionService, $loggerU);
            $clienteRepository = new ClienteRepository();
            $clienteService = new ClienteService($clienteRepository);
            $clienteController = new ClienteController($clienteService, $loggerU);

            $usuario = $clienteController->obtenerInfoCliente($_POST['documento']);
            $calificaciones = $calificacionController->obtenerPuntuacionesCliente($_POST['documento']);
            try {
                $grafico = $graficos->crearGrafico($_POST['documento'], $calificaciones, $loggerU);

            } catch (Exception $e) {
                $loggerU->error('Error al crear el gráfico: ' . $e->getMessage());
            }
            $practicar = $practica->obtenerPracticas($_POST['documento']);
            $resultado = []; // Inicializar el resultado

            foreach ($practicar as $practica) {

                $rutinaInfo = $rutina->obtenerRutina($practica['idRutina']);

                if (!empty($rutinaInfo) && isset($rutinaInfo[0])) {
                    $rutinaData = $rutinaInfo[0];
                    $combos = $compone->obtenerCombos($practica['idRutina']);

                    $resultado[] = [
                        'idRutina' => $rutinaData['idRutina'],
                        'series' => $rutinaData['series'],
                        'repeticiones' => $rutinaData['repeticiones'],
                        'dia' => $rutinaData['dia'],
                        'combo' => $combos
                    ];
                }
            }

            $template->renderTemplate(
                'dashboardEntrenador',
                array_merge(
                    ['usuario' => $usuario],
                    ['calificaciones' => $calificaciones],
                    ['grafico' => $grafico],
                    ['practicas' => $resultado]
                )
            );
            exit();
        });

        SimpleRouter::post('editarCalificacion', function () use ($loggerU) {
            $calificacionRepository = new CalificacionRepository();
            $calificacionService = new CalificacionService($calificacionRepository);
            $calificacionController = new CalificacionController($calificacionService, $loggerU);
            try {
                $calificacionController->editarCalificacion();
                echo json_encode([
                    'status' => 'ok',
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Error al editar la calificación: '
                ]);
            }

            exit();
        });

        SimpleRouter::get('editarCalificacion', function () use ($logger) {
            $template = new TemplateController();
            $template->renderTemplate('editarCalificacion', ['id' => $_GET['id']]);
        });

        SimpleRouter::get('/dashboard', function () {
            $template = new TemplateController();
            $template->renderTemplate('dashboardEntrenador');
        });


        SimpleRouter::post('/crearEjercicio', function () {
            $template = new TemplateController();
            $ejercicio = new EjercicioController();
            $ejercicio->crearEjercicio();
            $datos = [
                'mensaje' => 'Ejercicio creado con éxito',
                'ruta' => 'crearEjercicio'
            ];
            $template->renderTemplate('alerta', $datos);
            exit();
        });

        SimpleRouter::get('/crearEjercicio', function () {
            $template = new TemplateController();
            $template->renderTemplate('crearEjercicio');
        });

        SimpleRouter::get('/crearComboEjercicio', function () {
            $template = new TemplateController();
            $template->renderTemplate('crearComboEjercicio');
        });
        SimpleRouter::post('/crearComboEjercicio', function () {
            $template = new TemplateController();
            $combo = new ComboEjercicioController();
            $combo->crearCombo();
            $datos = [
                'mensaje' => 'Combo creado con éxito',
                'ruta' => 'crearComboEjercicio'
            ];
            $template->renderTemplate('alerta', $datos);
            exit();
        });

        SimpleRouter::get('/calificacion', function () {
            $template = new TemplateController();
            $template->renderTemplate('calificacion');
            exit();
        });

        SimpleRouter::get('/listaclientes', function () {
            $template = new TemplateController();
            $template->renderTemplate('listaclientes');
        });

        SimpleRouter::get('/listaejercicios', function () {
            $ejercicios = new EjercicioController();
            $lista  = $ejercicios->obtenerListaEjercicios();
            $template = new TemplateController();
            $data = [
                'ejercicios' => $lista
            ];
            $template->renderTemplate('listaejercicios', $data);
        });

        SimpleRouter::get('/usuario/obtenerListaClientesAjax', function () use ($logger) {
            $clienteRepository = new ClienteRepository();
            $clienteService = new ClienteService($clienteRepository);
            $clienteController = new ClienteController($clienteService, $logger);
            $clienteController->obtenerListaClientesAjax();
            exit();
        });

        SimpleRouter::post('/calificacion', function () use ($loggerU) {
            $calificacionRepository = new CalificacionRepository();
            $calificacionService = new CalificacionService($calificacionRepository);
            $calificacionController = new CalificacionController($calificacionService, $loggerU);
            try {
                $calificacionController->asignarPuntuacion();
                echo json_encode([
                    'success' => true,
                    'message' => 'Calificación creada con éxito'
                ]);
            } catch (Exception $e) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Error al crear la calificación: ' . $e->getMessage()
                ]);
            }
            exit();
        });

    });
    SimpleRouter::group(['middleware' => AdministrativoMiddleware::class], function () use ($logger, $loggerU) {

        SimpleRouter::post('/usuario/eliminarAgenda', function () use ($logger) {


            $template = new TemplateController();
            $seAgenda = new App\Services\SeAgendaService();

            $documento = filter_input(INPUT_POST, 'nroDocumento', FILTER_SANITIZE_SPECIAL_CHARS);
            $horaInicio = filter_input(INPUT_POST, 'horaInicio', FILTER_SANITIZE_SPECIAL_CHARS);
            $horaFin = filter_input(INPUT_POST, 'horaFin', FILTER_SANITIZE_SPECIAL_CHARS);
            $dia = filter_input(INPUT_POST, 'dia', FILTER_SANITIZE_SPECIAL_CHARS);
            echo $dia;
            echo $horaInicio;
            echo $horaFin;
            $seAgenda->eliminarAgenda($dia, $horaInicio, $horaFin, $documento);
            $datos = [
                'mensaje' => 'Agenda eliminada con éxito',
                'ruta' => 'agendar?documento=' . $documento
            ];
            $template->renderTemplate('alerta', $datos);
            exit();
        });

        SimpleRouter::get('/agendar', function () {
            $resultado = [];
            $nombre = filter_input(INPUT_GET, 'documento', FILTER_SANITIZE_SPECIAL_CHARS);
            $template = new TemplateController();
            $localGym = new App\Controllers\GymController();
            $agenda = new App\Controllers\AgendaController();
            $locales = $localGym->obtenerGym();
            $agendas = $agenda->obtenerAgendas();
            $agendasYaAsignadas = $agenda->obtenerAgendasYaAsignadas($nombre);

          foreach ($agendas as $comparacion1) {
                $coincide = false;
                foreach ($agendasYaAsignadas as $comparacion2) {
                    if ($comparacion1['horaInicio'] === $comparacion2['horaInicio'] && $comparacion1['horaFin'] === $comparacion2['horaFin'] && $comparacion1['dia'] === $comparacion2['dia']) {
                        $coincide = true;
                        break;
                    }

                }
              if (!$coincide) {
                  $coincide = true;
                  $resultado[] = $comparacion1;
              }
            }
            $data = [
                'locales' => $locales,
                'agendas' => $resultado ,
                'nombre' => $nombre,
                'agendasYaAsignadas' => $agendasYaAsignadas
            ];
            $template->renderTemplate('agendar', $data);
            exit();
        });
        SimpleRouter::post('/agendar', function ()use ($logger) {
            $template = new TemplateController();
            $seAgenda = new App\Controllers\SeAgendaController();
            $usuarioRepository = new UsuarioRepository();
            $usuarioService = new UsuarioService($usuarioRepository);
            $usuario = new UsuarioController($usuarioService, $logger);
            $local = $_POST['local'];
            $documento = $_POST['documento'];
            $calle = $_POST['calle'];
            $esquina = $_POST['esquina'];
            $nroPuerta = $_POST['nroPuerta'];
            $capXTurno = $_POST['capXTurno'];
            $nombreLocal = $_POST['nombreLocal'];
            $resultado = [];

            $tipoDocumento = $usuario->obtenerIipoDocumento($documento);
            $agendas = isset($_POST['agendas']) ? $_POST['agendas'] : [];

            foreach ($agendas as $agendaJson) {
                $agenda = json_decode($agendaJson, true);
                if (is_array($agenda)) {
                    $dia = $agenda['dia'];
                    $horaInicio = $agenda['horaInicio'];
                    $horaFin = $agenda['horaFin'];
                    $agendados = $agenda['agendados'];

                    $seAgenda->agendar($documento,$tipoDocumento, $dia, $horaInicio, $horaFin);
                }
            }
            $data = [
                'mensaje' => 'Agenda creada con éxito',
                'ruta' => 'agendar?documento=' . $documento
            ];
            $template->renderTemplate('alerta', $data);
            exit();
        });

        SimpleRouter::get('/dashAgenda', function () {
            $local = new LocalGymController();
            $conforma = new App\Controllers\ConformaController();
            $template = new TemplateController();
            $agendas = $conforma->obtenerAgendas();
            $nombres = $local->obtenerNombres();

            $data = [
                'agenda' => $agendas,
                'nombres' => $nombres
            ];

            $template->renderTemplate('dashAgenda', $data);
            exit();

        });


        SimpleRouter::get('/ingresarGym', function () {
            $template = new TemplateController();
            $template->renderTemplate('ingresarGym');
        });

        SimpleRouter::post('/ingresarGym', function () {

            $controller = new App\Controllers\GymController();
            $controller->ingresarGym();
            exit();
        });

        SimpleRouter::get('/usuario/obtenerListaClientesAdmin', function () use ($logger) {
            $clienteRepository = new ClienteRepository();
            $clienteService = new ClienteService($clienteRepository);
            $clienteController = new ClienteController($clienteService, $logger);
            $clienteController->obtenerListaClientesAdmin();
            exit();
        });


        SimpleRouter::post('/logo', function () use ($logger) {
            $template = new TemplateController();
            if (isset($_FILES['logo'])) {
                $file = $_FILES['logo'];

                if ($file['error'] !== 0) {
                    $logger->error('Error al subir el archivo.');
                    echo "Error al subir el archivo.";
                    return;
                }

                $validImageTypes = ['image/png', 'image/jpeg', 'image/jpg'];
                if (!in_array($file['type'], $validImageTypes)) {
                    $logger->error('Formato de archivo no soportado. Suba un PNG o JPEG.');
                    echo "Formato de archivo no soportado. Suba un PNG o JPEG.";
                    return;
                }

                $tempFile = $file['tmp_name'];

                $image = null;
                switch ($file['type']) {
                    case 'image/png':
                        $image = imagecreatefrompng($tempFile);
                        break;
                    case 'image/jpeg':
                    case 'image/jpg':
                        $image = imagecreatefromjpeg($tempFile);
                        break;
                }

                if ($image === null) {
                    $logger->error('Error al procesar la imagen.');
                    echo "Error al procesar la imagen.";
                    return;
                }

                $faviconSize = 64;
                $faviconImage = imagecreatetruecolor($faviconSize, $faviconSize);
                imagecopyresampled($faviconImage, $image, 0, 0, 0, 0, $faviconSize, $faviconSize, imagesx($image), imagesy($image));

                $targetFile = $_SERVER['DOCUMENT_ROOT'] . '/favicon.ico';

                if (file_exists($targetFile)) {
                    unlink($targetFile);
                }

                if (imagepng($faviconImage, $targetFile)) {
                    $logger->info('Favicon generado correctamente.');
                    $template->renderTemplate('inicio');
                } else {
                    $logger->error('Error al guardar el favicon.');
                    echo "Error al guardar el favicon.";
                }

                imagedestroy($image);
                imagedestroy($faviconImage);
            } else {
                echo "No se recibió ningún archivo.";
            }
        });

        SimpleRouter::post('/cargarImagen', function () use ($logger) {
            $repository = new UsuarioRepository();
            $service = new UsuarioService($repository);
            $controller = new App\Controllers\UsuarioController($service, $logger);
            $controller->cargarImagen();
            exit();
        });

        SimpleRouter::post('/actualizarPago', function () use ($logger) {
            $pago = new \App\Controllers\EligeController();
            $pago->actualizarPago();
            exit();
        });

        SimpleRouter::get('/pago', function () use ($logger) {
            $template = new TemplateController();
            $template->renderTemplate('pago');
        });


        SimpleRouter::post('/crearPlan', function () use ($logger) {
            $planes = new App\Controllers\PlanPagoController();
            $planes->crearPlan();
            exit();
        });
        SimpleRouter::get('/tiposDePlan', function () use ($logger) {
            $planes = new App\Controllers\PlanPagoController();
            $planes->obtenerPlanes();
            exit();
        });

        SimpleRouter::get('/nuevaAgenda', function () {
            $local = new LocalGymController();
            $agenda = new \App\Controllers\AgendaController();
            $template = new TemplateController();
            $nombres = $local->obtenerNombres();
            $agendas = $agenda->obtenerAgendas();
            $data = [
                'nombres' => $nombres,
                'agendas' => $agendas
            ];
            $template->renderTemplate('nuevaAgenda', $data);
            exit();
        });

        SimpleRouter::get('/cargarImagen', function () {
            $documento = filter_input(INPUT_GET, 'documento', FILTER_SANITIZE_SPECIAL_CHARS);
            $template = new TemplateController();
            $template->renderTemplate('cargarImagen', ['documento' => $documento]);
            die();
        });



        SimpleRouter::delete('/eliminarAgenda', function (){
            $conforma = new App\Controllers\ConformaController();
            $conforma->eliminarAgenda();
            exit();
        });

        SimpleRouter::get('/guardarAgenda', function () {
            $nombre = filter_input(INPUT_GET, 'local', FILTER_SANITIZE_SPECIAL_CHARS);
            $template = new TemplateController();
            $agenda = new \App\Controllers\AgendaController();
            $conforma = new \App\Controllers\ConformaController();
            $locales = $agenda->obtenerAgendas();
            $asignados = $conforma->obtenerAsignados($nombre);
            $localesFiltrados = [];
            if (empty($asignados)) {
                $localesFiltrados = $locales;
            } else {
                // Filtrar los locales que coinciden con los elementos en $asignados
                $localesFiltrados = array_filter($locales, function ($local) use ($asignados) {
                    foreach ($asignados as $asignado) {
                        if ($local['horaInicio'] === $asignado['horaInicio'] && $local['horaFin'] === $asignado['horaFin']) {
                            return true;
                        }
                    }
                    return false;
                });
            }
            $data = [
                'agendas' => $localesFiltrados,
                'nombre' => $nombre
            ];
            $template->renderTemplate('guardarAgenda', $data);
            exit();
        });

        SimpleRouter::post('/guardarAgenda', function () {
            $conforma = new App\Controllers\ConformaController();
            $conforma->guardarAgenda();
            exit();
        });
        SimpleRouter::post('/crearAgenda', function () {
            $agenda = new App\Controllers\AgendaController();
            $agenda->crearAgenda();
            exit();
        });

        SimpleRouter::post('/eliminar', function () use ($logger) {
            $planes = new App\Controllers\EligeController();
            $planes->eliminarPorDocumento();
            exit();
        });
    });

    SimpleRouter::get('/verificarsesion', function () use ($logger) {
        echo json_encode([
            'authenticated' => $_SESSION['sesion']
        ]);
        exit();
    });


});

SimpleRouter::get('/login', function () {
    $template = new TemplateController();
    $template->renderTemplate('loginUsuario');
});

SimpleRouter::get('/calificaciones', function () {
    $template = new TemplateController();
    $template->renderTemplate(calificaciones);
});


SimpleRouter::get('/registrarcliente', function () {
    $template = new TemplateController();
    $template->renderTemplate('crearUsuario');
});


SimpleRouter::get('/horarios', function () {
    $template = new TemplateController();
    $template->renderTemplate('agenda');
});

SimpleRouter::get('/planes', function () {
    $template = new TemplateController();
    $template->renderTemplate('planes');
});

SimpleRouter::get('/imprimirNota', function () use ($logger) {
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $clienteController->imprimirNota();
});
SimpleRouter::get('/listaUsuarios', function () {
    $template = new TemplateController();
    $template->renderTemplate('listaclientes');
});

SimpleRouter::post('/guardarDeportista', function () use ($logger) {
    $deportistaRepository = new DeportistaRepository();
    $deportistaService = new DeportistaService($deportistaRepository);
    $deportistaController = new DeportistaController($deportistaService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    if ($clienteController->comprobarCliente() == "false") {
        echo "<script>
                alert('El Usuario No Esta registrado en la Pagina');
                window.location.href = '/'; 
              </script>";
    } else {
        if ($deportistaController->comprobarDeportista() == "false") {
            $usuarioController->guardarDeportista();
            $deportistaController->guardarDeportista();
            exit();
        } else {
            echo "<script>
                    alert('El Deportista ya esta registrado');
                    window.location.href = '/'; 
                  </script>";
        }
    }
});


SimpleRouter::post('/guardarPaciente', function () use ($logger) {
    $pacienteRepository = new PacienteRepository();
    $pacienteService = new PacienteService($pacienteRepository);
    $pacienteController = new PacienteController($pacienteService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    if ($clienteController->comprobarCliente() == "false") {
        echo "<script>
                alert('El Usuario No Esta registrado en la Pagina');
                window.location.href = '../Public/inicio.html.twig'; 
              </script>";
    } else {
        if ($pacienteController->comprobarPaciente() == "false") {
            $usuarioController->guardarPaciente();
            $pacienteController->guardarPaciente();
            exit();
        } else {
            echo "<script>
                    alert('El Paciente ya esta registrado');
                    window.location.href = '../Public/inicio.html.twig'; 
                  </script>";
        }
    }
});

SimpleRouter::post('/twig/guardarDeportista', function () use ($logger) {
    $deportistaRepository = new DeportistaRepository();
    $deportistaService = new DeportistaService($deportistaRepository);
    $deportistaController = new DeportistaController($deportistaService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    if ($clienteController->comprobarCliente() == "false") {
        echo "<script>
                alert('El Usuario No Esta registrado en la Pagina');
                window.location.href = '/'; 
              </script>";
    } else {
        if ($deportistaController->comprobarDeportista() == "false") {
            $usuarioController->guardarDeportista();
            $deportistaController->guardarDeportista();
            $_SESSION['rol'] = 'deportista';
            $home = new HomeController();
            $home->index();
            exit();
        } else {
            echo "<script>
                    alert('El Deportista ya esta registrado');
                    window.location.href = '/'; 
                  </script>";
        }
    }
});


SimpleRouter::post('/twig/guardarPaciente', function () use ($logger) {
    $pacienteRepository = new PacienteRepository();
    $pacienteService = new PacienteService($pacienteRepository);
    $pacienteController = new PacienteController($pacienteService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    if ($clienteController->comprobarCliente() == "false") {
        echo "<script>
                alert('El Usuario No Esta registrado en la Pagina');
                window.location.href = '../Public/inicio.html.twig'; 
              </script>";
    } else {
        if ($pacienteController->comprobarPaciente() == "false") {
            $usuarioController->guardarPaciente();
            $pacienteController->guardarPaciente();
            $_SESSION['rol'] = 'paciente';
            $home = new HomeController();
            $home->index();
            exit();
        } else {
            echo "<script>
                    alert('El Paciente ya esta registrado');
                    window.location.href = '../Public/inicio.html.twig'; 
                  </script>";
        }
    }
});

SimpleRouter::post('/guardarTelefono', function () use ($logger) {
    $clientetelefonoRepository = new ClientetelefonoRepository();
    $clientetelefonoService = new ClientetelefonoService($clientetelefonoRepository);
    $clientetelefonoController = new ClientelefonoController($clientetelefonoService, $logger);
    $clientetelefonoController->guardarTelefono();
    exit();
});

// Ruta para registrar clientes (POST)
SimpleRouter::post('/registrarcliente', function () use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    if (!$usuarioController->comprobarUsuario()) {
        $clienteRepository = new ClienteRepository();
        $clienteService = new ClienteService($clienteRepository);
        $clienteController = new ClienteController($clienteService, $logger);
        $clienteController->crearCliente();
        $usuarioController->crearUsuario();
        $clienteController->emailBienvenida($_POST['email']);
        $telefono = $_POST['telefono'];
        $nroDocumento = $_POST['nroDocumento'];
        $tipoDocumento = $_POST['tipoDocumento'];
        echo "
    <script>
        const telefono = '$telefono';
        const nroDocumento = '$nroDocumento';
        const tipoDocumento = '$tipoDocumento';    
        const data = {
            telefono: telefono,
            nroDocumento: nroDocumento,
            tipoDocumento: tipoDocumento
        };
        fetch('/guardarTelefono', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' 
            },
            body: JSON.stringify(data) 
        })
        .then(response => response.json())
        .then(data => {
            console.log('Respuesta del servidor:', data);    
        })
        .catch(error => {
            console.error('Error durante la solicitud:', error);
        });
    </script>
";


        echo "<script>
                alert('Usuario creado con éxito');
                window.location.href = '../Public/inicio.html.twig'; 
              </script>";
        exit();
    } else {
        echo "<script>
                alert('El usuario ya existe');
                window.location.href = '../../App/Views/crearUsuario.html.twig'; 
              </script>";
        exit();
    }
});

// Ruta para el login de clientes (POST)
SimpleRouter::post('/login', function () use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $usuarioController->autenticar();
});

// Ruta para el logout
SimpleRouter::get('/logout', function () use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $usuarioController->logout();
});

SimpleRouter::post('/registrarEntrenador', function () use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);

    if ($clienteController->comprobarCliente() == "false") {
        $clienteController->crearConPrivilegios();
        $usuarioController->crearEntrenador();
        exit();
    } else {
        $usuarioController->crearEntrenador();
        exit();
    }
});

SimpleRouter::post('/registrarAdministrativo', function () use ($logger) {
    $usuarioRepository = new UsuarioRepository();
    $usuarioService = new UsuarioService($usuarioRepository);
    $usuarioController = new UsuarioController($usuarioService, $logger);
    $clienteRepository = new ClienteRepository();
    $clienteService = new ClienteService($clienteRepository);
    $clienteController = new ClienteController($clienteService, $logger);
    if ($clienteController->comprobarCliente() == "false") {
        $clienteController->crearConPrivilegios();
        $usuarioController->crearAdministrativo();
        exit();
    } else {
        $usuarioController->crearAdministrativo();
        exit();
    }
});

});

// Iniciar el enrutador
SimpleRouter::start();
