Patrón de Arquitectura del Proyecto
Modelo Vista Controlador (MVC)
El Modelo-Vista-Controlador (MVC) es un patrón de arquitectura de software ampliamente utilizado en el desarrollo de aplicaciones, especialmente en el desarrollo web.

1. Separación de Preocupaciones
El MVC divide una aplicación en tres componentes principales: Modelo, Vista y Controlador. Cada componente se encarga de aspectos específicos de la funcionalidad:

Modelo: Maneja la lógica de datos y negocio. Se ocupa de acceder, almacenar y procesar los datos.
Vista: Responsable de la presentación de los datos. Define cómo se muestran los datos al usuario.
Controlador: Actúa como un intermediario que maneja la entrada del usuario, interactúa con el modelo y selecciona la vista apropiada para mostrar la salida.
Esta separación de responsabilidades facilita el mantenimiento y la escalabilidad de la aplicación, ya que cada componente puede desarrollarse, probarse y modificarse de manera independiente.

2. Facilita el Desarrollo Colaborativo
La división en componentes claros permite que diferentes equipos o desarrolladores trabajen en paralelo sin interferencias. Por ejemplo, los diseñadores pueden trabajar en la vista mientras los desarrolladores de backend se centran en la lógica del modelo.

3. Mejor Mantenimiento y Escalabilidad
La estructura modular de MVC facilita la localización de problemas y la implementación de mejoras. Si un cambio es necesario en la lógica de negocio, se puede modificar el modelo sin afectar las vistas y controladores, y viceversa. Esta modularidad también hace que la aplicación sea más fácil de escalar.

4. Reutilización de Código
El MVC promueve la reutilización de código. Por ejemplo, el modelo y el controlador pueden ser reutilizados con diferentes vistas para distintas interfaces de usuario (web, móvil, escritorio), lo cual ahorra tiempo y esfuerzo en el desarrollo de aplicaciones multiplataforma.

5. Facilita las Pruebas
El patrón MVC permite pruebas unitarias más efectivas y sencillas. Cada componente se puede probar de manera aislada. Los modelos se pueden probar sin necesidad de cargar vistas o manejar eventos de entrada, y los controladores pueden ser probados para verificar la lógica de flujo de la aplicación.

6. Mejora la Estructura del Código
El uso de MVC proporciona una estructura clara y organizada al código de la aplicación, lo que facilita su comprensión y gestión, especialmente en proyectos grandes y complejos. Esta claridad también ayuda a nuevos desarrolladores a integrarse en el proyecto más rápidamente.

Conclusión
El uso del patrón MVC en el desarrollo de software no solo mejora la organización y eficiencia del desarrollo, sino que también proporciona una estructura robusta y flexible que facilita el mantenimiento, escalabilidad y pruebas de la aplicación. Su adopción en proyectos de software contribuye significativamente a la calidad y sostenibilidad del producto final.

Principales Clases del Programa
Descripción de la Clase Database
La clase Database se encarga de gestionar la conexión a una base de datos MySQL y está diseñada para ser flexible y segura. A continuación, se describen sus principales características y propiedades:

$servername: El nombre del servidor donde se encuentra la base de datos.
$username: El nombre de usuario para acceder a la base de datos.
$password: La contraseña para acceder a la base de datos.
$dbname: El nombre de la base de datos a la que se va a acceder.
$conn: Un objeto de conexión a la base de datos, inicialmente nulo.
El método __construct() actúa como el constructor de la clase y se invoca automáticamente cuando se crea un objeto de la clase. Este constructor toma cuatro argumentos opcionales, que se utilizan para establecer las propiedades necesarias para la conexión a la base de datos. El método connect() es responsable de establecer la conexión utilizando las propiedades definidas anteriormente, garantizando que la conexión se gestione de manera eficiente y segura.

Descripción de la Clase UsuarioRepository
La clase UsuarioRepository se encuentra en el archivo UsuarioRepository.php y su principal responsabilidad es interactuar con la base de datos para realizar operaciones relacionadas con los usuarios. A continuación, se describen sus componentes y funcionalidades clave:





    private $database;
    public function __construct() {
        $this->database = new Database();
    }

    public function guardar(UsuarioModel $usuarioModel) {
        $this->database->connect();
        $sql = "INSERT INTO Usuario (nroDocumento, rol, passwd) VALUES (?,?, ?)";
        $nroDocumento = $usuarioModel->getNroDocumento();
        $rol = $usuarioModel->getRol();
        $passwd = $usuarioModel->getPasswd();
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("iis", $nroDocumento, $rol, $passwd);
        $stmt->execute();
        $stmt->close();
    }

Razones para Utilizar la Clase UsuarioRepository
Encapsulación de la Lógica de Acceso a Datos: Mejora la organización y mantenibilidad del código.
Reutilización de Código: Centraliza las operaciones de base de datos, evitando la duplicación de código.
Seguridad y Prevención de Inyecciones SQL: Utiliza consultas preparadas para mejorar la seguridad.
Facilidad de Mantenimiento y Evolución: Permite realizar cambios en un solo lugar.
Separación de Preocupaciones: Facilita el desarrollo colaborativo y mejora la claridad del código.
Descripción de la Clase UsuarioService
La clase UsuarioService encapsula la lógica de negocio relacionada con los usuarios y utiliza una instancia de UsuarioRepository para interactuar con la base de datos. A continuación, se describen sus componentes y funcionalidades clave:


    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository) {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function crearUsuario(UsuarioModel $usuarioModel) {
        $this->usuarioRepository->guardar($usuarioModel);
    }

    public function autenticar($documento, $passwd) {
        return $this->usuarioRepository->autenticar($documento, $passwd);
    }


Razones para Utilizar la Clase UsuarioService
Separación de Preocupaciones: Facilita la gestión del código y mejora la organización del proyecto.
Facilidad de Mantenimiento y Evolución: Simplifica el mantenimiento y la evolución del código.
Reutilización de Código: Promueve la reutilización y evita la duplicación de código.
Mejora de la Seguridad: Implementa validaciones y reglas de negocio antes de interactuar con la base de datos.
Descripción de la Clase UsuarioModel
La clase UsuarioModel se encuentra en el archivo UsuarioModel.php bajo el espacio de nombres App\Models. Está diseñada para encapsular los datos de un usuario y proporcionar métodos para acceder y modificar estos datos de manera segura. A continuación, se describen sus componentes y funcionalidades clave:




    public function __construct($nroDocumento, $rol, $passwd) {
        $this->nroDocumento = $nroDocumento;
        $this->rol = $rol;
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
    }

    public function getNroDocumento() {
        return $this->nroDocumento;
    }

    public function setNroDocumento($nroDocumento) {
        $this->nroDocumento = $nroDocumento;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function getPasswd() {
        return $this->passwd;
    }

    public function setPasswd($passwd) {
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
    }

Razones para Utilizar la Clase UsuarioModel
Encapsulación de Datos: Proporciona una estructura clara y organizada para el almacenamiento y manipulación de datos.
Seguridad en el Almacenamiento de Contraseñas: Utiliza password_hash para cifrar las contraseñas, asegurando su almacenamiento seguro.
Acceso y Modificación Controlados: Asegura que cualquier cambio en los datos del usuario se realice de manera consistente y controlada.
Mantenibilidad y Claridad del Código: Mejora la claridad y mantenibilidad del código.
Reutilización de Código: Promueve la reutilización de código y evita la duplicación.
Flexibilidad y Escalabilidad: Proporciona una base flexible para la gestión de datos de usuarios.
Descripción de la Clase UsuarioController
La clase UsuarioController se encarga de recibir las solicitudes del usuario, procesarlas y devolver la respuesta adecuada. Está diseñada para interactuar con UsuarioService y manejar las operaciones relacionadas con los usuarios. A continuación, se describen sus componentes y funcionalidades clave:

    public function __construct(UsuarioService $usuarioService) {
        $this->usuarioService = $usuarioService;
    }

    public function crearUsuario() {
        $usuario = new UsuarioModel(
            $_POST['nroDocumento'],
            $_POST['rol'],
            $_POST['passwd']
        );
        $this->usuarioService->crearUsuario($usuario);
    }

    public function autenticar() {
        if ($this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']) == false) {
            echo "Algo anduvo mal";
        } else {
            echo "<script>
                localStorage.setItem('documento', '" . $this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']). "');
                window.location.href = '../../Public/inicio.html'; 
                </script>";
            $_SESSION['logged'] = true;
            $_SESSION['nroDocumento'] = $_POST['documento'];
            echo "Sesión iniciada";
        }
    }

    public function logout() {
        session_destroy();
        echo "<script>
            localStorage.removeItem('documento');
            window.location.href = '../../Public/inicio.html';
            </script>";
    }

Razones para Utilizar MySQLi
La extensión MySQLi (MySQL Improved) es una versión mejorada de la extensión original MySQL de PHP, proporcionando una interfaz orientada a objetos para interactuar con bases de datos MySQL. A continuación, se detallan las razones clave para utilizar MySQLi:

Interfaz Orientada a Objetos: Facilita una programación más estructurada y modular.
Consultas Preparadas: Ayudan a prevenir ataques de inyección SQL, mejorando la seguridad.
Compatibilidad con Características Recientes de MySQL: Permite aprovechar las mejoras de rendimiento y las nuevas funcionalidades de MySQL.
Mejora en el Rendimiento: Está optimizado para mejorar el rendimiento en comparación con la extensión original de MySQL.
Conclusión
El uso de MVC junto con las clases Database, UsuarioRepository, UsuarioService, UsuarioModel y UsuarioController, y la extensión MySQLi, proporciona una estructura sólida y bien organizada para el desarrollo de aplicaciones web. Esta arquitectura mejora la mantenibilidad, seguridad, y escalabilidad del proyecto, contribuyendo a la creación de software de alta calidad y fácil de mantener.






