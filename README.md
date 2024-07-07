
# Sistema Informático de Gestión de Entrenamiento (SIGEN)

SIGEN es un sistema web diseñado para optimizar la gestión de planes de entrenamiento y fisioterapia en centros deportivos y de rehabilitación. El sistema permite a los entrenadores crear y asignar planes de entrenamiento personalizados, realizar un seguimiento del progreso de los deportistas y pacientes, y generar informes detallados sobre su evolución.

## Índice

1. [Características Principales](#características-principales)
2. [Programación](#programación)
   - [Requisitos del Sistema](#requisitos-del-sistema)
   - [Instalación](#instalación)
     1. [Clonar el repositorio](#clonar-el-repositorio)
     2. [Instalación de Composer](#instalación-de-composer)
     3. [Configurar el VirtualHost en Apache](#configurar-el-virtualhost-en-apache)
     4. [Reiniciar Apache](#reiniciar-apache)
     5. [Uso de Composer](#uso-de-composer)
3. [Detalles](#detalles)
4. [Implicaciones](#implicaciones)


## Características Principales
### Gestión de Planes de Entrenamiento
- Creación, modificación y eliminación de planes de entrenamiento personalizados para deportistas y pacientes.
### Seguimiento del Progreso
- Registro y seguimiento del progreso de los deportistas y pacientes, incluyendo el cumplimiento de la planificación y la evolución en diferentes áreas.
### Informes y Análisis
- Generación de informes detallados sobre el rendimiento y la evolución de los deportistas y pacientes, incluyendo tablas y gráficos.
### Gestión Administrativa
- Funcionalidades para gestionar la agenda de los clientes, el cobro de cuotas y el registro de datos de los usuarios.
### Usuarios y Roles
- Diferentes tipos de usuarios con permisos específicos, incluyendo clientes, entrenadores, administradores y seleccionadores.
### Alertas y Notificaciones
- Generación de alertas automáticas en caso de incumplimiento de metas, cuotas impagas, inasistencias y cupos máximos en la agenda.
### Personalización y Flexibilidad
- Posibilidad de parametrizar ejercicios, clubes, períodos, calificaciones y otros datos relevantes.

## Programación
### Requisitos del Sistema
- Servidor web (Apache, Nginx, etc.)
- PHP 7.x o superior
- MySQL 5.x o superior
- Navegador web compatible (Chrome, Firefox, Edge, etc.)

### Instalación
1. Clonar el repositorio:
 ```sh
   git clone https://github.com/Proyecto3Fidat/     
   ProyectoEgreso.git
```
2. Instalación de Composer
2.1 Descarga Composer desde el sitio oficial de Composer:
```sh
   https://getcomposer.org
```
2.2 Sigue las instrucciones de instalación proporcionadas en el sitio.

3. Configurar el VirtualHost en Apache
 3.1 Abre el archivo de configuración de Apache para VirtualHosts. Este archivo suele encontrarse en:
 ```sh
  C:\xampp\apache\conf\extra\httpd-vhosts.conf
```
 3.2 Añade la siguiente configuración al archivo httpd-vhosts.conf. Asegúrate de cambiar las rutas en DocumentRoot y <Directory> por la ruta donde se encuentra tu programa.
  ```sh
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
```
4. Reiniciar Apache
5. Uso de Composer
 5.1 Abre una consola de comandos (cmd).
 5.2 Navega al directorio del proyecto
 5.3 Ejecuta Composer para instalar las dependencias del proyecto:
  ```sh
  composer install
  ```
⚠️ **Nota:** _Mientras se tenga configurado el VirtualHost como se ha descrito anteriormente, todas las comunicaciones dirigidas al puerto 80 en tu equipo serán redirigidas a proyecto.localhost._

### Detalles
- Con la configuración de VirtualHost establecida en Apache, cualquier solicitud HTTP que llegue a tu máquina a través del puerto 80 se manejará según las reglas definidas para proyecto.localhost.
- Las directivas ServerName proyecto.localhost y ServerAlias proyecto.localhost aseguran que el dominio proyecto.localhost se resuelva y sea atendido por el servidor Apache configurado.
- Como resultado, cualquier navegador web o aplicación que intente acceder a http://proyecto.localhost se conectará al DocumentRoot especificado.


### Implicaciones 
- Esta configuración es ideal para un entorno de desarrollo local, permitiendo probar y desarrollar la aplicación web sin conflictos de dominio.

- Si en algún momento deseas desactivar esta configuración, puedes comentar o eliminar la sección correspondiente en httpd-vhosts.conf y reiniciar Apache para que los cambios surtan efecto.

_Recuerda que estos ajustes afectan únicamente el entorno local de tu máquina y no impactan en servidores de producción u otros dispositivos en la red a menos que se configure específicamente para ello._
