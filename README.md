Sistema Informático de Gestión de Entrenamiento (SIGEN)
Descripción del Proyecto
SIGEN es un sistema web diseñado para optimizar la gestión de planes de entrenamiento y fisioterapia en centros deportivos y de rehabilitación. El sistema permite a los entrenadores crear y asignar planes de entrenamiento personalizados, realizar un seguimiento del progreso de los deportistas y pacientes, y generar informes detallados sobre su evolución.
Características Principales
Gestión de Planes de Entrenamiento: Creación, modificación y eliminación de planes de entrenamiento personalizados para deportistas y pacientes.
Seguimiento del Progreso: Registro y seguimiento del progreso de los deportistas y pacientes, incluyendo el cumplimiento de la planificación y la evolución en diferentes áreas.
Informes y Análisis: Generación de informes detallados sobre el rendimiento y la evolución de los deportistas y pacientes, incluyendo tablas y gráficos.
Gestión Administrativa: Funcionalidades para gestionar la agenda de los clientes, el cobro de cuotas y el registro de datos de los usuarios.
Usuarios y Roles: Diferentes tipos de usuarios con permisos específicos, incluyendo clientes, entrenadores, administradores y seleccionadores.
Alertas y Notificaciones: Generación de alertas automáticas en caso de incumplimiento de metas, cuotas impagas, inasistencias y cupos máximos en la agenda.
Personalización y Flexibilidad: Posibilidad de parametrizar ejercicios, clubes, períodos, calificaciones y otros datos relevantes.















Sistema Informático de Gestión de Entrenamiento (SIGEN)	1
Descripción del Proyecto	1
Características Principales	1
Programación	5
Introducción	5
Objetivos	5
Objetivo General	5
Objetivos Específicos	5
Alcance	6
Patrón de arquitectura del proyecto	6
Modelo vista controlador(MVC)	6
Separación de Preocupaciones	6
Facilita el Desarrollo Colaborativo	7
Mejor Mantenimiento y Escalabilidad	7
Reutilización de Código	7
Facilita las Pruebas	7
Mejora la Estructura del Código	7
Conclusión	7
Principales clases del programa	8
Descripción de la Clase Database	8
Descripción de la Clase UsuarioRepository	8
Razones para Utilizar la Clase UsuarioRepository	9
Descripción de la Clase UsuarioService	10
Razones para Utilizar la Clase UsuarioService	11
Descripción de la Clase UsuarioModel	11
Razones para Utilizar la Clase UsuarioModel	12
Descripción de la Clase UsuarioController	13
Razones para Utilizar MySQLi	14
Importancia de Usar GitHub para el Desarrollo en Equipo	15
Repositorio del Proyecto	16
Instructivo de Ejecución	16
Prerrequisitos	16
Paso 1: Instalación de Composer	16
Paso 2: Configurar el VirtualHost en Apache	16
Paso 3: Reiniciar Apache	17
Paso 4: Uso de Composer	17
Detalles	17
Implicaciones	18
Bibliografía	18
Diseño Web	20
Introducción	20
Objetivo	21
Alcance	22
Logo Empresa	23
Argumentación del logo	24
Paleta de Colores	25
Argumentación paleta de colores	25
Negro (#000000)	25
Índigo (#4B0082)	26
Blanco (#FFFFFF)	26
Wireframe	27
INICIO	27
AGENDA	28
PLANES	29
LOGIN	30
REGISTER	30
Análisis FODA	31
Fortalezas	31
Diseño Atractivo y Moderno	31
Compatibilidad Móvil	31
Carrusel de Imágenes	31
Sección de Planes Claramente Definida	31
Enlaces a Redes Sociales	31
Oportunidades	32
Optimización SEO	32
Marketing Digital	32
E-commerce	32
Capacitación Continua	32
Debilidades	33
Contenido Limitado	33
Interactividad Restringida	33
Dependencia en Enlaces Externos	33
Actualización y Mantenimiento	33
Amenazas	34
Competencia en Línea	34
Cambios en Tecnología	34
Problemas de Seguridad	34
Cambios en el Comportamiento del Consumidor	34
Webgrafía	35


















































Programación
Introducción
El presente documento detalla la arquitectura, diseño e implementación del Sistema Informático de Gestión de Entrenamiento (SIGEN). Este sistema tiene como objetivo principal optimizar la gestión de planes de entrenamiento, fisioterapia y administración en centros deportivos y de rehabilitación.
El desarrollo de SIGEN se basa en un enfoque modular y escalable, utilizando tecnologías web modernas y una arquitectura Modelo-Vista-Controlador (MVC) para garantizar un sistema eficiente, seguro y fácil de mantener. A través de una implementación cuidadosa y pruebas rigurosas, se busca entregar un producto de alta calidad que cumpla con los requisitos y expectativas de los usuarios.
Objetivos
Objetivo General
Desarrollar un sistema informático de gestión de entrenamiento (SIGEN) que permita gestionar, organizar y monitorear el desempeño y recuperación de deportistas, así como medir su evolución a lo largo del tiempo.
Objetivos Específicos
Implementar una arquitectura MVC eficiente y escalable: Utilizar el patrón Modelo-Vista-Controlador para separar las responsabilidades del sistema y facilitar el desarrollo, mantenimiento y evolución del código.
Desarrollar un sistema seguro y confiable: Implementar medidas de seguridad para proteger los datos de los usuarios y garantizar la disponibilidad y confiabilidad del sistema.
Crear una interfaz de usuario intuitiva y fácil de usar: Diseñar una interfaz que permita a los usuarios interactuar con el sistema de manera eficiente y sin dificultades.
Integrar el sistema con una base de datos: Utilizar una base de datos para almacenar y gestionar los datos de usuarios, planes de entrenamiento, ejercicios y registros de evolución.
Realizar pruebas exhaustivas: Someter el sistema a pruebas rigurosas para identificar y corregir errores, asegurando un producto final de alta calidad.

Alcance
El alcance del desarrollo del sistema SIGEN abarca las siguientes actividades:
Implementación del modelo de datos: Diseño y creación de las tablas y relaciones en la base de datos para almacenar la información del sistema.
Desarrollo de la lógica de negocio: Implementación de las clases y funciones necesarias para procesar los datos y realizar las operaciones del sistema.
Creación de la interfaz de usuario: Diseño y desarrollo de las páginas web y componentes visuales para la interacción con el usuario.
Integración con la base de datos: Conexión del sistema con la base de datos para almacenar y recuperar información.
Pruebas y depuración: Realización de pruebas unitarias, de integración y de sistema para asegurar el correcto funcionamiento del sistema.
Patrón de arquitectura del proyecto
Modelo vista controlador(MVC)
El Modelo-Vista-Controlador (MVC) es un patrón de arquitectura de software ampliamente utilizado en el desarrollo de aplicaciones, especialmente en el desarrollo web.
Separación de Preocupaciones
El MVC divide una aplicación en tres componentes principales: Modelo, Vista y Controlador. Cada componente se encarga de aspectos específicos de la funcionalidad:
Modelo: Maneja la lógica de datos y negocio. Se ocupa de acceder, almacenar y procesar los datos.
Vista: Responsable de la presentación de los datos. Define cómo se muestran los datos al usuario.
Controlador: Actúa como un intermediario que maneja la entrada del usuario, interactúa con el modelo y selecciona la vista apropiada para mostrar la salida.

Esta separación de responsabilidades facilita el mantenimiento y la escalabilidad de la aplicación, ya que cada componente puede desarrollarse, probarse y modificarse de manera independiente.
Facilita el Desarrollo Colaborativo
La división en componentes claros permite que diferentes equipos o desarrolladores trabajen en paralelo sin interferencias. Por ejemplo, los diseñadores pueden trabajar en la vista mientras los desarrolladores de backend se centran en la lógica del modelo.
Mejor Mantenimiento y Escalabilidad
La estructura modular de MVC facilita la localización de problemas y la implementación de mejoras. Si un cambio es necesario en la lógica de negocio, se puede modificar el modelo sin afectar las vistas y controladores, y viceversa. Esta modularidad también hace que la aplicación sea más fácil de escalar.
Reutilización de Código
El MVC promueve la reutilización de código. Por ejemplo, el modelo y el controlador pueden ser reutilizados con diferentes vistas para distintas interfaces de usuario (web, móvil, escritorio), lo cual ahorra tiempo y esfuerzo en el desarrollo de aplicaciones multiplataforma.
Facilita las Pruebas
El patrón MVC permite pruebas unitarias más efectivas y sencillas. Cada componente se puede probar de manera aislada. Los modelos se pueden probar sin necesidad de cargar vistas o manejar eventos de entrada, y los controladores pueden ser probados para verificar la lógica de flujo de la aplicación.
Mejora la Estructura del Código
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
public function guardar(UsuarioModel $usuarioModel) 
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
Reutilización de Código: Al centralizar las operaciones de base de datos con la tabla usuario en la clase UsuarioRepository, se evita la duplicación de código y se facilita la reutilización de estas operaciones en diferentes partes de la aplicación.
Seguridad y Prevención de Inyecciones SQL: El uso de consultas preparadas y la vinculación de parámetros en MySQLi ayudan a prevenir ataques de inyección SQL, mejorando así la seguridad de la aplicación.
Facilidad de Mantenimiento y Evolución: Cualquier cambio en la lógica de acceso a datos, como modificaciones en la estructura de la base de datos o mejoras en la consulta, se puede realizar en un solo lugar. Esto simplifica el mantenimiento y evolución del código.
Separación de Preocupaciones: Separar la lógica de acceso a datos de la lógica de negocio y de presentación facilita el desarrollo colaborativo y mejora la claridad del código. Los desarrolladores pueden trabajar en distintas capas de la aplicación de manera más eficiente.
Descripción de la Clase UsuarioService
La clase UsuarioService encapsula la lógica de negocio relacionada con los usuarios y utiliza una instancia de UsuarioRepository para interactuar con la base de datos. A continuación, se describen sus componentes y funcionalidades clave:
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
Reutilización de Código: La clase UsuarioModel puede ser reutilizada en diferentes partes de la aplicación, promoviendo la reutilización de código y 

evitando la duplicación. Esto mejora la eficiencia del desarrollo y facilita la consistencia en la gestión de datos de usuarios.
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






Importancia de Usar GitHub para el Desarrollo en Equipo
GitHub es esencial para el desarrollo en equipo por varias razones clave:
Control de Versiones: Permite a los desarrolladores rastrear y revertir cambios en el código, facilitando el trabajo en paralelo y la integración de nuevas funcionalidades mediante ramas (branches) y fusiones (merges).
Colaboración: Pull requests y revisiones de código permiten la revisión, discusión y mejora del código antes de su integración, fomentando una cultura de colaboración y aprendizaje.
Seguridad y Control de Acceso: Controles de acceso detallados y análisis de seguridad protegen el código y los datos del proyecto.
Documentación y Comunicación: Facilita la creación de documentación y proporciona herramientas para una comunicación clara y eficiente entre los miembros del equipo.
Transparencia y Trazabilidad: Almacena todo el historial de cambios y discusiones, proporcionando trazabilidad completa y facilitando auditorías y la resolución de problemas.
GitHub mejora la eficiencia, la calidad del código y la colaboración en equipo, siendo fundamental para el éxito de los proyectos de software.
Repositorio del Proyecto
Para centralizar todos los aspectos del desarrollo, hemos creado un repositorio en GitHub donde todo el equipo puede colaborar. El repositorio del proyecto se encuentra en la siguiente dirección:
Repositorio del Proyecto

Instructivo de Ejecución
Prerrequisitos
Apache instalado y funcionando en tu equipo.
Composer instalado en tu equipo.
Paso 1: Instalación de Composer
Instalación de Composer
Descarga Composer desde el sitio oficial de Composer.
Sigue las instrucciones de instalación proporcionadas en el sitio.
Paso 2: Configurar el VirtualHost en Apache
Abre el archivo de configuración de Apache para VirtualHosts. Este archivo suele encontrarse en: C:\xampp\apache\conf\extra\httpd-vhosts.conf
Añade la siguiente configuración al archivo httpd-vhosts.conf. Asegúrate de cambiar las rutas en DocumentRoot y <Directory> por la ruta donde se encuentra tu programa.
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host.example.com
    DocumentRoot "ruta del proyecto"
    ServerName proyecto.localhost
    ServerAlias proyecto.localhost
    ErrorLog "logs/proyecto.localhost-error.log"
    CustomLog "logs/proyecto.localhost-access.log" common
    <Directory "ruta del proyecto">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
Paso 3: Reiniciar Apache
Paso 4: Uso de Composer
Abre una consola de comandos (cmd).
Navega al directorio del proyecto
Ejecuta Composer para instalar las dependencias del proyecto: composer install
Nota Importante sobre la Configuración del VirtualHost
Mientras se tenga configurado el VirtualHost como se ha descrito anteriormente, todas las comunicaciones dirigidas al puerto 80 en tu equipo serán redirigidas a proyecto.localhost.
Detalles
VirtualHost Configurado: Con la configuración de VirtualHost establecida en Apache, cualquier solicitud HTTP que llegue a tu máquina a través del puerto 80 se manejará según las reglas definidas para proyecto.localhost.
ServerName y ServerAlias: Las directivas ServerName proyecto.localhost y ServerAlias proyecto.localhost aseguran que el dominio proyecto.localhost se resuelva y sea atendido por el servidor Apache configurado.
Redirección de Comunicaciones: Como resultado, cualquier navegador web o aplicación que intente acceder a http://proyecto.localhost se conectará al DocumentRoot especificado.
Implicaciones
Desarrollo Local: Esta configuración es ideal para un entorno de desarrollo local, permitiendo probar y desarrollar la aplicación web sin conflictos de dominio.
Desactivación Temporal: Si en algún momento deseas desactivar esta configuración, puedes comentar o eliminar la sección correspondiente en httpd-vhosts.conf y reiniciar Apache para que los cambios surtan efecto.
Recuerda que estos ajustes afectan únicamente el entorno local de tu máquina y no impactan en servidores de producción u otros dispositivos en la red a menos que se configure específicamente para ello.
Bibliografía
Modelo Vista Controlador (MVC):
MDN Web Docs - Glosario de MDN MVC	https://developer.mozilla.org/es/docs/Glossary/MVC
TutorialsPoint. (s.f.). MVC Framework Introduction. https://www.tutorialspoint.com/mvc_framework/mvc_framework_introduction.htm
Microsoft MVC de ASP.NET Core					https://learn.microsoft.com/es-es/aspnet/mvc/overview/older-versions-1/overview/asp-net-mvc-overview	
MySQLi:
PHP.net. (s.f.). MySQLi Introduction. https://www.php.net/manual/en/mysqli.intro.php
W3Schools. (s.f.). PHP MySQLi. https://www.w3schools.com/php/php_mysql_intro.asp
Introduccion a MySQLi	https://www.ionos.mx/digitalguide/hosting/cuestiones-tecnicas/introduccion-a-mysqli/#:~:text=Continuar-,%C2%BFQu%C3%A9%20es%20MySQLi%20de%20PHP%3F,m%C3%A1s%20populares%20a%20nivel%20mundial
GitHub:
GitHub Guides. (s.f.). Hello World. https://guides.github.com/activities/hello-world/
GitHub Docs. (s.f.). Understanding the GitHub flow. https://docs.github.com/en/get-started/quickstart/github-flow
Apache:
Apache HTTP Server Documentation. (s.f.). Virtual Hosts. https://httpd.apache.org/docs/2.4/vhosts/
DigitalOcean. (s.f.). How To Set Up Apache Virtual Hosts on Ubuntu 20.04. https://www.digitalocean.com/community/tutorials/how-to-set-up-apache-virtual-hosts-on-ubuntu-20-04
Composer:
Composer Documentation. (s.f.). Getting Started. https://getcomposer.org/doc/00-intro.md
Packagist. (s.f.). The PHP Package Repository. https://packagist.org/
DesarrolloWeb - Composer guia tutorial				https://desarrolloweb.com/manuales/tutorial-composer.html	

































Diseño Web
Introducción
Este documento detalla el funcionamiento total de la página web en el marco del proyecto del Sistema Informático de Gestión de Entrenamiento (SIGEN). Este sistema tiene como objetivo principal optimizar la gestión de planes de entrenamiento, fisioterapia y administración en centros deportivos y de rehabilitación.
El diseño de una página web es crucial para el desarrollo de este proyecto, ya que será el método principal de interacción entre el usuario y los servicios que la empresa ofrece. La página web no solo actúa como una interfaz de usuario, sino que también es la plataforma a través de la cual se realizan todas las operaciones críticas del sistema. Un diseño intuitivo y atractivo es esencial para asegurar que los usuarios puedan navegar y utilizar todas las funcionalidades del sistema de manera eficiente.
Mediante un análisis exhaustivo de paletas de colores y diseño de ventanas, se busca garantizar que el sistema cumpla con las necesidades del usuario, así como con los objetivos del proyecto. La elección de colores no es solo una cuestión estética, sino también funcional, ya que influye en la percepción y usabilidad del sitio web. Del mismo modo, el diseño de ventanas y la estructura de la navegación se han pensado para ofrecer una experiencia de usuario fluida y sin complicaciones.
Podremos hallar distintos métodos, argumentos y elecciones, los cuales están meticulosamente pensados para el desarrollo de este proyecto. Cada decisión en el diseño y desarrollo del sistema se basa en una investigación cuidadosa y en la mejor práctica, buscando no solo cumplir con los estándares actuales de la industria, sino también innovar y proporcionar una solución superior. Este enfoque busca aclarar y evacuar dudas sobre el desarrollo de la página web, asegurando una argumentación y exposición clara y coherente para el espectador.

Objetivo

El objetivo de nuestra empresa es lograr satisfacer las necesidades del cliente para promover un servicio correcto según sus criterios. Buscamos el mayor compromiso empresa/cliente al ofrecer nuestros servicios para poder cumplir con los objetivos planteados y promover la mejor reputación para nosotros como empresa.

Para lograr esto, utilizamos un código basado en HTML y CSS que nos permite agregar estilos únicos a la página para hacerla más entendible y más fácil de navegar para el usuario. El CSS también nos permite agregar una parte “responsive” a la página, que la hace mucho más accesible a clientes en dispositivos móviles. De esta manera, se garantiza que los usuarios puedan acceder y utilizar la página web de manera eficiente y efectiva, sin importar el tipo de dispositivo que estén utilizando, ya sea un ordenador de escritorio, una tableta o un teléfono móvil.

Además de la accesibilidad, otro aspecto clave es la interactividad. La página web está diseñada para facilitar la interacción del usuario con el gimnasio, permitiéndole acceder a información relevante, realizar reservas, inscribirse en clases y consultar horarios, entre otras funcionalidades. Todo esto se logra a través de una interfaz amigable y sencilla de usar, que minimiza el tiempo que el usuario necesita para encontrar la información que busca o completar una tarea.

En conclusión, la idea principal de la página web es crear un producto que sea el método de interacción principal entre los usuarios y el gimnasio, además de que facilite el control del usuario sobre las actividades que realiza con la empresa. Esto incluye no sólo la interacción diaria, sino también la posibilidad de gestionar su cuenta, realizar pagos y recibir notificaciones sobre eventos o cambios en el horario del gimnasio. La combinación de una interfaz intuitiva, accesibilidad en múltiples dispositivos y una funcionalidad completa asegura que la página web sea una herramienta indispensable para los usuarios del gimnasio.
Alcance
El alcance de la página web abarca las siguientes actividades:
Relevar información: Se realizan entrevistas, encuestas, análisis de documentos y análisis de resultados para determinar con certeza las necesidades del usuario y los requisitos del sistema. Esta etapa es crucial para comprender qué esperan los usuarios del gimnasio y cómo puede la página web satisfacer esas expectativas.
Establecer los objetivos del proyecto: Utilizando las necesidades del usuario y los requisitos del sistema, se realiza un análisis detallado para definir los objetivos del sistema. Esto nos ayuda a saber exactamente qué características y funcionalidades debe tener nuestra página web para cumplir con las expectativas y necesidades de los usuarios.
Elaborar un plan de acción: Con los objetivos del proyecto claros, se desarrolla un plan detallado sobre cómo va a funcionar la página. Esto incluye la arquitectura de la información, el diseño de la interfaz de usuario, y la organización de las diferentes secciones de la página. Este plan es esencial para asegurar que el desarrollo de la página sea coherente y eficiente.
Elaborar un estudio de calidad: Se lleva a cabo un estudio exhaustivo para garantizar la eficiencia de la página web. Esto incluye pruebas de usabilidad, pruebas de rendimiento, y la verificación de que todas las funcionalidades cumplen con los objetivos y necesidades del usuario. Además, se implementan mecanismos de retroalimentación continua para identificar y corregir posibles problemas, asegurando así una mejora constante de la página web.
Este enfoque sistemático y detallado asegura que la página web no solo cumpla con los estándares de calidad esperados, sino que también proporcione una experiencia de usuario excepcional, contribuyendo significativamente a la satisfacción del cliente y al éxito del gimnasio.


Logo Empresa








Argumentación del logo
El uso del color azul en el logo de nuestra empresa ha sido cuidadosamente seleccionado con el objetivo de presentar una imagen de empresa sólida y confiable, ya que el color azul representa profesionalidad, confianza y comunicación clara. Estas son cualidades clave en el ámbito tecnológico, donde la percepción de seguridad y eficiencia es fundamental para ganar la confianza de los clientes y socios.
La elección de un logotipo, en lugar de un isotipo, responde a nuestra estrategia de marca. Creemos que un logotipo tiene un impacto mucho más grande en la audiencia, ya que el nombre de la empresa se presenta de manera clara y directa. Al centrarnos en un logotipo, enfatizamos la simplicidad y la claridad, lo cual facilita el reconocimiento y la recordación de la marca. El color azul potencia el logotipo, añadiendo una capa adicional de autoridad y credibilidad. Esta elección asegura que el mensaje de nuestra marca sea inequívoco y fuerte, reforzando nuestra identidad corporativa en cada interacción con el público.
En definitiva, el azul en nuestro logo es mucho más que un simple detalle, es parte fundamental de lo que somos. Demuestra nuestros valores y la forma en que queremos trabajar. En un mundo lleno de tecnología, donde la competencia es dura, el azul nos ayuda a destacarnos como una empresa profesional, confiable y con la que puedes contar para comunicarte con claridad. 
El azul es un color versátil que se combina bien con una variedad de otros colores, lo que nos permite tener flexibilidad en nuestras campañas de marketing y en la creación de materiales promocionales. Además, el azul evoca sentimientos de calma y estabilidad, lo cual es especialmente beneficioso en la industria tecnológica, donde los clientes buscan soluciones fiables y duraderas.
En conclusión, elegimos el color azul por sus ventajas en el ámbito tecnológico, tales como la capacidad de transmitir profesionalismo y confianza. Asimismo, optamos por un logotipo porque creemos que tiene más impacto en nuestra audiencia y deja una huella significativa al ser leído. Esta decisión estratégica está orientada a fortalecer nuestra presencia en el mercado y a crear una conexión duradera con nuestros clientes, asegurando que nuestra marca sea fácilmente reconocible y asociada con valores positivos.
Paleta de Colores

 
#000000 

#4B0082 

#FFFFFF


Argumentación paleta de colores
Negro (#000000)
Elegancia y Profesionalismo: El negro es un color asociado con la elegancia, la sofisticación y el profesionalismo. Utilizar negro en la página web del gimnasio transmitirá una imagen de seriedad y compromiso con la calidad, atributos que son esenciales para atraer a clientes que buscan un lugar confiable y profesional para sus entrenamientos.

Contraste y Claridad: El negro proporciona un excelente fondo para resaltar otros colores y elementos visuales. Al utilizarlo en la página web, podemos garantizar que los textos y las imágenes se destaquen de manera clara y nítida, mejorando así la legibilidad y la usabilidad del sitio.

Versatilidad: El negro es un color neutro que combina bien con casi cualquier otro color. En la página web, esto permite una flexibilidad en el diseño y la posibilidad de resaltar otros colores secundarios o de acento, como el índigo y el blanco.

Minimalismo y Enfoque: En un diseño minimalista, el negro se utiliza frecuentemente para crear un aspecto limpio y sin distracciones, lo que permite que los usuarios se concentren en el contenido esencial, como los servicios y planes del gimnasio.
Índigo (#4B0082)
Estabilidad y Poder: El índigo es un color que simboliza la estabilidad y el poder. En el contexto de un gimnasio, estos atributos son esenciales para transmitir la idea de que el espacio es un lugar donde los usuarios pueden construir fuerza y resistencia. Además, el índigo añade un toque de distinción y singularidad a la identidad visual del gimnasio, diferenciándolo de otros competidores.

Creatividad e Inspiración: El índigo también está asociado con la creatividad y la inspiración. En un entorno donde la motivación es clave para el éxito de los usuarios, este color puede contribuir a crear una atmósfera que inspira a los clientes a alcanzar sus metas y explorar nuevas formas de entrenamiento.

Estética Visual: Este color es perfecto para destacar elementos clave en el sitio web, como botones de llamada a la acción y encabezados importantes, sin desentonar con el resto de la paleta de colores.

Versatilidad: El índigo funciona bien tanto en esquemas de colores oscuros como claros, proporcionando flexibilidad en la creación de temas y estilos visuales en la página web.

Blanco (#FFFFFF)
Pureza y Limpieza: El blanco simboliza pureza y limpieza, dos cualidades fundamentales en un gimnasio. Una página web con elementos blancos transmite una sensación de frescura, asegurando a los potenciales clientes que el gimnasio es un lugar higiénico y bien mantenido.

Espacio y Libertad: El uso del blanco también ayuda a crear una sensación de espacio y amplitud. Esto es importante para evitar que la página web se sienta abrumada o congestionada. Un diseño con suficiente espacio en blanco puede hacer que la navegación sea más agradable y menos estresante para los usuarios.

Legibilidad y Contraste: El uso del blanco como fondo mejora la legibilidad del texto y otros elementos gráficos, especialmente cuando se utiliza en combinación con colores oscuros como el negro y el índigo. Esto asegura que la información sea accesible y fácil de leer para todos los usuarios.

Neutralidad: Como color neutro, el blanco actúa como un lienzo en blanco que permite una amplia creatividad en la selección de colores adicionales. Esto facilita la combinación con el negro y el índigo para crear un diseño armonioso y equilibrado.



Wireframe
Wireframe de Escritorio: 
INICIO





































AGENDA


















PLANES


















LOGIN






REGISTER








Análisis FODA
Fortalezas
Diseño Atractivo y Moderno
 El sitio web presenta un diseño contemporáneo con una estructura bien definida y colores atractivos que facilitan la navegación. Esta apariencia moderna no solo mejora la experiencia del usuario, sino que también refuerza la percepción de profesionalismo y calidad del gimnasio.
Compatibilidad Móvil
 La compatibilidad con dispositivos móviles es una característica clave, garantizada por un menú adaptable que optimiza la visualización y la navegación en smartphones y tabletas. Esto amplía significativamente el alcance del gimnasio, permitiendo a una audiencia más amplia acceder a la información de manera cómoda y eficiente.
Carrusel de Imágenes
 El uso de un carrusel de imágenes en la página de inicio es una estrategia efectiva para captar la atención del visitante de inmediato. Este elemento dinámico permite mostrar diversos aspectos y servicios del gimnasio de manera visualmente atractiva, incentivando a los visitantes a explorar más.
Sección de Planes Claramente Definida
 Los planes de suscripción están presentados de manera clara y accesible, permitiendo a los usuarios entender rápidamente las opciones disponibles y sus beneficios. Esto facilita la toma de decisiones y mejora la experiencia del usuario, incrementando las posibilidades de conversión.
Enlaces a Redes Sociales
 La inclusión de enlaces a redes sociales facilita la interacción y conexión con los clientes. Esto potencia la comunicación y el marketing del gimnasio a través de diferentes plataformas, aumentando la visibilidad y la participación de la comunidad.


Oportunidades
Optimización SEO
 	Mejorar las prácticas de SEO (Optimización para Motores de Búsqueda) puede incrementar significativamente la visibilidad del sitio en los resultados de búsqueda. Al atraer más visitantes orgánicos, se aumenta el tráfico al sitio web y, potencialmente, el número de nuevos clientes para el gimnasio.
Marketing Digital
 Implementar campañas de marketing digital a través de Google Ads, redes sociales y correo electrónico puede aumentar la visibilidad y atraer a nuevos miembros. Estas estrategias permiten alcanzar a un público más amplio y segmentado, optimizando los recursos de marketing y generando un mayor retorno de inversión.
E-commerce
 Desarrollar y optimizar una plataforma de e-commerce para la venta de productos y servicios en línea puede capturar el creciente mercado digital. Esto incluye la venta de membresías, mercadería del gimnasio y otros productos relacionados con el fitness, ampliando las fuentes de ingresos.
Capacitación Continua
Invertir en la formación continua del personal puede mejorar sus habilidades y productividad. Un equipo bien capacitado es esencial para mantener la calidad del servicio, adaptarse a nuevas tecnologías y satisfacer mejor las necesidades de los clientes.






Debilidades
Contenido Limitado
 El sitio web actualmente tiene contenido limitado, lo que puede hacer que los visitantes no obtengan toda la información que necesitan sobre el gimnasio y sus servicios. Esto puede afectar negativamente la percepción del gimnasio y la decisión de los potenciales clientes de unirse.
Interactividad Restringida
 La falta de funcionalidades interactivas como foros de discusión, chat en vivo y formularios de feedback puede limitar la interacción del usuario con el sitio web y el gimnasio. La interacción directa y el feedback instantáneo son aspectos importantes para mejorar la experiencia del usuario y fomentar la comunidad.
Dependencia en Enlaces Externos
 La dependencia en enlaces a páginas externas para funcionalidades adicionales, como la página de planes, puede desviar el tráfico del sitio principal y afectar la retención de usuarios. Es esencial integrar estas funcionalidades dentro del sitio principal para mantener a los usuarios comprometidos.
Actualización y Mantenimiento
Si no se realiza un mantenimiento y actualización periódica del contenido y diseño, la página puede volverse obsoleta y menos atractiva para los usuarios. Es crucial mantener el sitio web actualizado con las últimas tendencias y tecnologías para seguir siendo competitivo.






Amenazas
Competencia en Línea
Otros gimnasios con sitios web más interactivos y con mejores estrategias de marketing digital pueden atraer a los potenciales clientes, disminuyendo la cuota de mercado del gimnasio. Es importante monitorear a la competencia y adaptar las estrategias para mantenerse relevante.
Cambios en Tecnología
 La rápida evolución de las tecnologías web y las expectativas de los usuarios pueden hacer que el sitio actual se vuelva obsoleto si no se adapta rápidamente a las nuevas tendencias. La actualización continua y la innovación son esenciales para mantener la competitividad.
Problemas de Seguridad
Las amenazas de ciberseguridad, como ataques de hackers y malware, pueden comprometer la seguridad del sitio web y la confianza de los usuarios. Implementar medidas de seguridad robustas es fundamental para proteger la información y la integridad del sitio.
Cambios en el Comportamiento del Consumidor
 Cambios en las preferencias de los consumidores hacia la búsqueda de experiencias de fitness más personalizadas y digitales pueden requerir una rápida adaptación del sitio web y los servicios ofrecidos. Es importante estar atento a estas tendencias y ajustar las estrategias en consecuencia para satisfacer las nuevas demandas del mercado.





					
                                 
Webgrafía
		
https://www.canva.com/es_mx/aprende/psicologia-del-color/
https://www.lucidchart.com/pages/es/que-es-un-wireframe-para-un-sitio-web
https://imborrable.com/blog/crear-paleta-de-colores/
https://www.hn.cl/blog/evalua-la-efectividad-de-tu-sitio-web-mediante-un-analisis-foda/
https://togrowagencia.com/consejos-para-elegir-el-logo-adecuado/





















