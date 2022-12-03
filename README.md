<p align="center"><a href="https://ingesoftllc.com/" target="_blank"><img src="https://github.com/pablomadariaga/ingenuity/blob/d505efa8a6f875465a4b736cee0979426da7e2e0/resources/views/components/application-logo.svg" width="400" alt="Ingenuity Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## ES
# Configuración del proyecto

De acuerdo a los requerimientos de la prueba para desarrollo práctico en el proceso de selección, estos son los puntos a seguir para la configuración del proyecto.

-   Se asume como primer punto que Apache2, MySQL 8 y PHP 8.1> ya han sido instalados y configurados en el servidor.
-   Instalar composer de manera global para nuestro sistema operativo.
-   Crear la base de datos en nuestro MySQL.
-   Bajar el repositorio al servidor donde correremos nuestra aplicación.
-   Configurar el archivo con las variables de entorno para nuestra aplicación.
-   Bajar las dependencias del proyecto.
-   Realizar migraciones de las tablas a la base de datos y correr el proyecto.
-   Construir aplicación front

## Instalar composer

En el siguiente enlace podemos encontrar una guía completa sobre la instalación y configuración de Composer en nuestro S.O de manera global [composer](https://getcomposer.org/doc/00-intro.md).

## Crear base de datos

Creamos la base de datos para nuestra aplicación, a continuación podemos ver el comando para realizar esto en nuestro MySQL, `nombre_bd` puede ser cualquier denominación sin caracteres especiales ni espacios.

-   CREATE DATABASE `nombre_bd` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

### Clonar repositorio
Copiamos el repositorio al root de nuestro servidor apache, _ingenuity_ puede ser cualquier denominación sin caracteres especiales.

-   git clone https://github.com/pablomadariaga/ingenuity.git _ingenuity_
-   Ahora ingresamos a nuestra carpeta **ingenuity**, de aquí en adelante los pasos a seguir son dentro de esta ruta

## Configurar .env

Después de clonar nuestro repositorio, accedemos a nuestro proyecto desde la terminal, luego debemos duplicar el archivo **.env.example** con el nombre del nuevo archivo igual a **.env** y configurar las siguientes variables.

-   comando: cp .env.example .env
-   variables
    1. APP_NAME = 'El nombre que queramos para el proyecto'
    1. APP_URL = 'Url o IP designada para correr el proyecto'    
    1. DB_HOST = HOST para nuestro servidor MySQL
    1. DB_PORT = PUERTO para nuestro servidor MySQL
    1. DB_DATABASE = Nombre de la base de datos que creamos
    1. DB_USERNAME = Nombre de usuario de MySQL
    1. DB_PASSWORD = Si el usuario tiene contraseña

## Dependencias

Ejecute los siguientes comandos desde la consola dentro de nuestra carpeta raíz del proyecto para instalar todas las dependencias de PHP.

-   composer i
-   php artisan config:cache
-   php artisan key:generate

## Correr migraciones para la base de datos y correr la aplicación

Ejecute los siguientes comandos desde la consola dentro de nuestra carpeta raíz del proyecto.

-   php artisan migrate:fresh --seed
    **Para finalizar corremos el servidor**
-   _php artisan serve_ , este comando no es necesario si tenemos un servidor para descubrir nuestras aplicaciones automáticamente, simplemente accedemos a la url configurada en nuestro servidor para la aplicación

## Construir aplicación front

Ejecute el siguiente comando instalar para construir nuestros módulos de JavaScript y CSS

-   npm install && npm run build

Ahora puede acceder a la aplicación *ingenuity*, por medio de la ip o url designada.

Cualquier duda sobre la configuración del proyecto, puede comunicarse conmigo por medio de correo electrónico o celular. 
**+57 3113350596**
[juanpablomadariagacardona@gmail.com](mailto:mailjuanpablomadariagacardona@gmail.com)

## License

El Framework de Laravel es un software de código abierto con licencia bajo [MIT license](https://opensource.org/licenses/MIT).


## EN

# project configuration

According to the requirements of the test for practical development in the selection process, these are the points to follow for the configuration of the project.

- It is assumed as a first point that Apache2, MySQL 8 and PHP 8.1> have already been installed and configured on the server.
- Install composer globally for our operating system.
- Create the database in our MySQL.
- Download the repository to the server where we will run our application.
- Configure the file with the environment variables for our application.
- Download the dependencies of the project.
- Perform migrations of the tables to the database and run the project.
- Build front app

## Install composer

In the following link we can find a complete guide on the installation and configuration of Composer in our OS globally [composer](https://getcomposer.org/doc/00-intro.md).

## Create database

We create the database for our application, below we can see the command to do this in our MySQL, `db_name` can be any name without special characters or spaces.

- CREATE DATABASE `db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

### Clone repository
We copy the repository to the root of our apache server, _ingenuity_ can be any name without special characters.

- git clone https://github.com/pablomadariaga/ingenuity.git _ingenuity_
- Now we enter our folder **ingenuity**, from now on the steps to follow are within this path

## Configure .env

After cloning our repository, we access our project from the terminal, then we need to duplicate the **.env.example** file with the new file name equal to **.env** and set the following variables.

- command: cp .env.example .env
- variables
    1. APP_NAME = 'The name we want for the project'
    1. APP_URL = 'Url or IP designated to run the project'
    1. DB_HOST = HOST for our MySQL server
    1. DB_PORT = PORT for our MySQL server
    1. DB_DATABASE = Name of the database that we created
    1. DB_USERNAME = MySQL Username
    1. DB_PASSWORD = If the user has a password

## Dependencies

Run the following commands from the console inside our project root folder to install all the PHP dependencies.

- composer i
- php artisan config:cache
- php artisan key:generate

## Run migrations for the database and run the application

Run the following commands from the console inside our project root folder.

- php artisan migrate:fresh --seed
    **To finish we run the server**
- _php artisan serve_ , this command is not necessary if we have a server to discover our applications automatically, we simply access the url configured on our server for the application

## Build front application

Run the following install command to build our JavaScript and CSS modules

- npm install && npm run build

You can now access the *ingenuity* application, via the designated ip or url.

Any questions about the configuration of the project, you can contact me by email or cell phone.
**+57 3113350596**
[juanpablomadariagacardona@gmail.com](mailto:mailjuanpablomadariagacardona@gmail.com)

## License

The Laravel Framework is open source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
