
# Sistema Informático de Gestión de Entrenamiento (SIGEN)

SIGEN es un sistema web diseñado para optimizar la gestión de planes de entrenamiento y fisioterapia en centros deportivos y de rehabilitación. El sistema permite a los entrenadores crear y asignar planes de entrenamiento personalizados, realizar un seguimiento del progreso de los deportistas y pacientes, y generar informes detallados sobre su evolución.
<p align="center">
  <img src="Imagenes/LogoFidat1080p.png" alt="LOGO DE FIDAT">
</p>

## Authors

- [@faquito22](https://www.github.com/faquito22)
- [@DiegoGar15](https://www.github.com/DiegoGar15)
- [@IsmaelBergaradev](https://www.github.com/IsmaelBergaradev)
- [@Thisguitoxddd](https://www.github.com/Thisguitoxddd)
## Sitios Web 
  [Fidat NET](http://fidat.net)
  [Fidat UY](http://fidat.uy)
  [S.I.G.E.N NET](http://sigen.fidat.net)
  [S.I.G.E.N UY](http://sigen.fidat.uy)



## Documentacion 
  [Programacion](https://docs.google.com/document/d/19vSB3dFqhOWqyqpYA8gIByVBd8gIq5lW/edit?usp=sharing&ouid=105375972641917367063&rtpof=true&sd=true)
  [Diseño Web](https://docs.google.com/document/d/1xj8YEZUi7dPlQrArb1ahrwRL2w7dPh7o/edit?usp=sharing&ouid=105375972641917367063&rtpof=true&sd=true)
  [Sistemas Operativos](https://docs.google.com/document/d/11E99Me8L000dhJ4NiVZWE_H5Ykiwzspv/edit?usp=sharing&ouid=105375972641917367063&rtpof=true&sd=true)
  [Formacion Empresarial](https://docs.google.com/document/d/1G3woINWYzDqqcI8hoEMY2kJwfiDHjGFG/edit?usp=sharing&ouid=105375972641917367063&rtpof=true&sd=true)
  [Analisis y Diseño de Aplicaciones](https://docs.google.com/document/d/1-rRJfJ6yZolVou6n9b0Ytq5x2lY6CoAX/edit?usp=sharing&ouid=105375972641917367063&rtpof=true&sd=true)

  


## Índice

- [Características Principales](#características-principales)
    - [Gestión de Planes de Entrenamiento](#gestión-de-planes-de-entrenamiento)
    - [Seguimiento del Progreso](#seguimiento-del-progreso)
    - [Informes y Análisis](#informes-y-análisis)
    - [Gestión Administrativa](#gestión-administrativa)
    - [Usuarios y Roles](#usuarios-y-roles)
    - [Alertas y Notificaciones](#alertas-y-notificaciones)
    - [Personalización y Flexibilidad](#personalización-y-flexibilidad)
- [Programacion](#programación)
    - [Requisitos del Sistema](#requisitos-del-sistema)
    - [Instalación](#instalación)
    - [Detalles](#detalles)
    - [Implicaciones](#implicaciones)


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
