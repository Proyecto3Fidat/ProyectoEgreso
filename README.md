

Patrón de arquitectura del proyecto
Modelo vista controlador(MVC)
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
Principales clases del programa
Descripción de la Clase Database
La clase Database se encarga de gestionar la conexión a una base de datos MySQL y está diseñada para ser flexible y segura. A continuación, se describen sus principales características y propiedades:
$servername: El nombre del servidor donde se encuentra la base de datos.
$username: El nombre de usuario para acceder a la base de datos.
$password: La contraseña para acceder a la base de datos.
$dbname: El nombre de la base de datos a la que se va a acceder.
$conn: Un objeto de conexión a la base de datos, inicialmente nulo.
El método __construct() actúa como el constructor de la clase y se invoca automáticamente cuando se crea un objeto de la clase. Este constructor toma cuatro argumentos opcionales, que se utilizan para establecer las propiedades necesarias para la conexión a la base de datos.
El método connect() es responsable de establecer la conexión utilizando las propiedades definidas anteriormente. Este método garantiza que la conexión se gestione de manera eficiente y segura.


Descripción de la Clase UsuarioRepository
La clase UsuarioRepository se encuentra en el archivo UsuarioRepository.php y su principal responsabilidad es interactuar con la base de datos para realizar operaciones relacionadas con los usuarios. A continuación, se describen sus componentes y funcionalidades clave:
use App\Models\UsuarioModel;
Esto importa la clase UsuarioModel desde el directorio App\Models, la cual define la estructura de datos de un usuario.
public function __construct() {
    $this->database = new Database();
}
Este es el constructor de la clase. Al crear una nueva instancia de UsuarioRepository, se crea una nueva instancia de la clase Database y se asigna a la variable $database.
public function guardar(UsuarioModel $usuarioModel) {
Esta es una función pública llamada guardar que toma un objeto UsuarioModel como argumento. Su propósito es guardar un usuario en la base de datos.
$sql = "INSERT INTO Usuario (nroDocumento, rol, passwd) VALUES (?,?, ?)";
Esta es una consulta SQL que inserta un nuevo usuario en la tabla Usuario.
$nroDocumento = $usuarioModel->getNroDocumento();
$rol = $usuarioModel->getRol();
$passwd = $usuarioModel->getPasswd();
Estas líneas obtienen los datos del usuario desde el objeto UsuarioModel.
$stmt = $this->database->getConnection()->prepare($sql);
Esto prepara la consulta SQL para su ejecución.
$stmt->bind_param("iis", $nroDocumento, $rol, $passwd);
Esto vincula los parámetros a la consulta SQL preparada. Los parámetros son los datos del usuario que se obtuvieron del objeto UsuarioModel.
Razones para Utilizar la Clase UsuarioRepository
El uso de la clase UsuarioRepository proporciona varios beneficios clave para la gestión de datos de usuarios en la aplicación:
Encapsulación de la Lógica de Acceso a Datos: La clase UsuarioRepository encapsula toda la lógica de acceso a datos en un solo lugar, lo que mejora la organización y mantenibilidad del código. Esto permite que otros componentes de la aplicación interactúen con la base de datos a través de una interfaz clara y consistente.
Reutilización de Código: Al centralizar las operaciones de base de datos en la clase UsuarioRepository, se evita la duplicación de código y se facilita la reutilización de estas operaciones en diferentes partes de la aplicación.
Seguridad y Prevención de Inyecciones SQL: El uso de consultas preparadas y la vinculación de parámetros en MySQLi ayudan a prevenir ataques de inyección SQL, mejorando así la seguridad de la aplicación.
Facilidad de Mantenimiento y Evolución: Cualquier cambio en la lógica de acceso a datos, como modificaciones en la estructura de la base de datos o mejoras en la consulta, se puede realizar en un solo lugar. Esto simplifica el mantenimiento y evolución del código.
Separación de Preocupaciones: Separar la lógica de acceso a datos de la lógica de negocio y de presentación facilita el desarrollo colaborativo y mejora la claridad del código. Los desarrolladores pueden trabajar en distintas capas de la aplicación de manera más eficiente.

Descripción de la Clase UsuarioService
La clase UsuarioService encapsula la lógica de negocio relacionada con los usuarios y utiliza una instancia de UsuarioRepository para interactuar con la base de datos. A continuación, se describen sus componentes y funcionalidades clave:





class UsuarioService {
    private $usuarioRepository;
}
Se define la clase UsuarioService y se declara una propiedad privada $usuarioRepository, que será una instancia de la clase UsuarioRepository. Esta propiedad maneja todas las operaciones de base de datos relacionadas con los usuarios.
public function crearUsuario(UsuarioModel $usuarioModel) {
    $this->usuarioRepository->guardar($usuarioModel);
}
Este es un método público llamado crearUsuario que toma una instancia de UsuarioModel como argumento. Luego, llama al método guardar en $usuarioRepository, pasando el UsuarioModel. Este método crea un nuevo usuario en la base de datos.
public function autenticar($documento, $passwd) {
    return $this->usuarioRepository->autenticar($documento, $passwd);
}
Este es otro método público llamado autenticar que toma dos argumentos, $documento y $passwd. Luego, llama al método autenticar en $usuarioRepository, pasando estos dos argumentos. Este método verifica si el usuario con el documento y la contraseña proporcionados existe en la base de datos.
Razones para Utilizar la Clase UsuarioService
La implementación de la clase UsuarioService aporta múltiples beneficios clave en la gestión de la lógica de negocio relacionada con los usuarios:
Separación de Preocupaciones: La clase UsuarioService separa claramente la lógica de negocio de la lógica de acceso a datos. Esto facilita la gestión del código y mejora la organización del proyecto. 
Facilidad de Mantenimiento y Evolución: Al encapsular la lógica de negocio en una clase dedicada, cualquier cambio en las reglas de negocio se puede implementar de manera centralizada y sin afectar al resto de la aplicación. Esto simplifica el mantenimiento y la evolución del código.
Reutilización de Código: La clase UsuarioService permite la reutilización de la lógica de negocio en diferentes partes de la aplicación. Cualquier componente que necesite realizar operaciones relacionadas con los usuarios puede utilizar UsuarioService, promoviendo la reutilización y evitando la duplicación de código.
Mejora de la Seguridad: La clase UsuarioService puede implementar validaciones y otras reglas de negocio antes de interactuar con la base de datos. Esto proporciona una capa adicional de seguridad, asegurando que solo los datos válidos se persistan en la base de datos.

Descripción de la Clase UsuarioModel
La clase UsuarioModel se encuentra en el archivo UsuarioModel.php bajo el espacio de nombres App\Models. Está diseñada para encapsular los datos de un usuario y proporcionar métodos para acceder y modificar estos datos de manera segura. A continuación, se describen sus componentes y funcionalidades clave:
public function __construct($nroDocumento, $rol, $passwd) {
$this->nroDocumento = $nroDocumento;
$this->rol = $rol;
$passwdHASH = password_hash($passwd, PASSWORD_DEFAULT);
 $this->passwd = $passwdHASH;
}
El constructor de la clase toma tres argumentos: $nroDocumento, $rol y $passwd. Al crear una nueva instancia de UsuarioModel, se asignan los valores proporcionados a las propiedades correspondientes. La contraseña se cifra utilizando la función password_hash con el algoritmo PASSWORD_DEFAULT para asegurar su almacenamiento seguro.
Razones para Utilizar la Clase UsuarioModel
La implementación de la clase UsuarioModel proporciona varios beneficios clave en la gestión de datos de usuarios:
Encapsulación de Datos: La clase UsuarioModel encapsula los datos del usuario, proporcionando una estructura clara y organizada para su almacenamiento y manipulación. Esto facilita la gestión de los datos en diferentes partes de la aplicación.
Seguridad en el Almacenamiento de Contraseñas: Al utilizar la función password_hash para cifrar las contraseñas, se asegura que las contraseñas se almacenen de manera segura. Esto protege los datos sensibles de los usuarios contra accesos no autorizados y ataques de fuerza bruta.
Acceso y Modificación Controlados: Los métodos getter y setter permiten el acceso controlado y la modificación de las propiedades del usuario. Esto asegura que cualquier cambio en los datos del usuario se realice de manera consistente y controlada.
Mantenibilidad y Claridad del Código: Al centralizar la lógica relacionada con los datos del usuario en una sola clase, se mejora la claridad y mantenibilidad del código. Cualquier cambio en la estructura de datos del usuario se puede realizar en un solo lugar, simplificando el mantenimiento y evolución de la aplicación.
Reutilización de Código: La clase UsuarioModel puede ser reutilizada en diferentes partes de la aplicación, promoviendo la reutilización de código y evitando la duplicación. Esto mejora la eficiencia del desarrollo y facilita la consistencia en la gestión de datos de usuarios.
Flexibilidad y Escalabilidad: La clase UsuarioModel proporciona una base flexible para la gestión de datos de usuarios. Si se necesitan agregar nuevas propiedades o cambiar la manera en que se gestionan los datos, estos cambios se pueden realizar de manera sencilla y sin afectar otras partes de la aplicación.


Descripción de la Clase UsuarioController
La clase UsuarioController se encarga de recibir las solicitudes del usuario, procesarlas y devolver la respuesta adecuada. Está diseñada para interactuar con UsuarioService y manejar las operaciones relacionadas con los usuarios. A continuación, se describen sus componentes y funcionalidades clave:
public function crearUsuario() {
    $usuario = new UsuarioModel(
        $_POST['nroDocumento'],
        $_POST['rol'],
        $_POST['passwd']
    );
    $this->usuarioService->crearUsuario($usuario);
}
Este método maneja la creación de un nuevo usuario. Toma los datos del formulario POST, crea una instancia de UsuarioModel y luego llama al método crearUsuario en UsuarioService para persistir el nuevo usuario en la base de datos.



public function autenticar() {
    if ($this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']) == false) {
        echo "algo anduvo mal";
    } else {
        echo "<script>
            localStorage.setItem('documento', '" . $this->usuarioService->autenticar($_POST['documento'], $_POST['passwd']). "');
            window.location.href = '../../Public/inicio.html'; 
            </script>";
        $_SESSION['logged'] = true;
        $_SESSION['nroDocumento'] = $_POST['documento'];
        echo "Sesion iniciada";
    }
}
Este método maneja la autenticación del usuario. Toma los datos de inicio de sesión del formulario POST y llama al método autenticar en UsuarioService. Si la autenticación falla, muestra un mensaje de error. Si tiene éxito, guarda el documento del usuario en localStorage, inicia la sesión y redirige al usuario a la página de inicio.
public function logout() {
    session_destroy();
    echo "<script>
        localStorage.removeItem('documento');
        window.location.href = '../../Public/inicio.html'; // Redirigir a la página de inicio
        </script>";
}
Este método maneja el cierre de sesión del usuario. Destruye la sesión actual y elimina el documento del usuario de localStorage, luego redirige al usuario a la página de inicio.

Razones para Utilizar MySQLi
La extensión MySQLi (MySQL Improved) es una versión mejorada de la extensión original MySQL de PHP, proporcionando una interfaz orientada a objetos para interactuar con bases de datos MySQL. A continuación, se detallan las razones clave para utilizar MySQLi:
Interfaz Orientada a Objetos: MySQLi proporciona una interfaz orientada a objetos, lo que facilita una programación más estructurada y modular. Esto es especialmente útil en aplicaciones grandes y complejas, donde la reutilización y el mantenimiento del código son esenciales.
Consultas Preparadas: Una de las características más importantes de MySQLi es el soporte para consultas preparadas. Las consultas preparadas ayudan a prevenir ataques de inyección SQL, ya que separan la lógica de la consulta de los datos que se envían a la base de datos. Esto mejora significativamente la seguridad de la aplicación.
Compatibilidad con Características Recientes de MySQL: MySQLi es compatible con las características más recientes de MySQL, lo que permite aprovechar las mejoras de rendimiento y las nuevas funcionalidades que ofrece MySQL. Esto es especialmente relevante si se utiliza una versión reciente de MySQL.
Mejora en el Rendimiento: MySQLi está optimizado para mejorar el rendimiento en comparación con la extensión original de MySQL. Esto se traduce en una mayor eficiencia en la gestión de conexiones y en la ejecución de consultas, lo cual es crucial para aplicaciones que requieren alta disponibilidad y rapidez en el acceso a los datos.
