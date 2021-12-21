# Gestión Del Historial De Reservas De un Restaurante

_En este proyecto nos pidieron hacer una aplicación web donde poder registrar usuarios a un evento en concreto sin hacer loggin obligatoriamente. Los responsable pueden ser capaces de crear/modificar/eliminar evento y ver toda la información asociados a ellos._

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

Mira **Deployment** (Despliegue) para conocer como desplegar el proyecto.


### Pre-requisitos 📋

_Para poder tener nuestro proyecto en local necesitaremos lo siguiente:_

```
    1. Tener instalado el XAMPP.
        1.1. Para instalar XAMPP ejecuta el .exe y guardalo en una unidad (Ej. C:\xampp).
    2. Tener instalado un editor de texto (Ej: Visual Studio Code).
        2.2. Instala el editor de texto como si fuera un programa cualquiera.
```

### Instalación 🔧

_Aqui te explicaremos como instalar/hacer todo lo necesario para que la aplicación web funcione correctamente:_

_Importar la Base De Datos_

```
    1. Comprobar que el servicio de MySQL de tu ordenador no esta activado. Para comprobarlo escribe en la lupa "Servicios" busca "MySQL80" y si esta activo desactivalo.
    2. Una vez instalado XAMPP activa el servicio MySQL y Apache.
    3. Dale Administrar MySQL (botón a la derecha del de iniciar servicio).
    4. Cuando se abra la página arriba en el centro con una flecha de color rojo tenemos el botón "Importar", le damos click.
    5. Cuando se nos abra la nueva ventano tendremos otro botón que dice "Selecionar Archivo", le damos click y buscamos nuestro archivo .sql que se encuentra dentro de la carpeta "db".
```

_Crear el fichero "config.php" (En caso de que no este)_

```
    1. Si este fichero no esta creado lo creamos siguiendo esta estructura:
        · <?php 
        · define("SERVIDOR","SERVER_NAME");
        · define("USUARIO","USER_NAME");
        · define("PASSWORD","PASSWORD");
        · define("BD","DATABASE_NAME");
        · ?>
    2. Sustituimos todo lo que hay dentras de "," y ponermos la información correcta.
    3. En caso de que este fichero este creado, realizamos el paso número 2.
```

_Ejemplo: Para poder hacer loggin en nuestro proyecto_

```
    1. *IMPORTANTE:* Tener la base de datos bien linkada
    2. user= isaac@fje.edu pass=1234   (es admin)
    3. user= blumal@fje.edu pass=1234 (es CAMARERO)
```

## Despliegue 📦

_Hemos alojado nuestro proyecto en una web de hosting gratuito. Para poder testear la web, hacer click en el enlace (iomproject.epizy.com) y podreis testear la web._
_Pasos para desplegar el proyecto en la pagina de hosting._
```
    1. Crear la base de datos. Tendremos que añadir un nombre de la db, nombre de usuario y password.
    2. Importar el create, insert y foreign keys del archivo .sql a la base de datos del hosting.
    3. En el fichero .config.php cambiar los datos del nombre de la base de datos, nombre de usuario y password con los nuevos nombres.
    4. Subir en la carpeta de public_html todas nuestras carpetas con sus ficheros
    5. IMPORTANTE: no borrar la carpeta htaccess y tmp
    6. Si salen warning/errores arreglarlos
```


## Construido con 🛠️

_Menciona las herramientas que utilizaste para crear tu proyecto_

* [Visual Studio Code](https://code.visualstudio.com/download) - Editor de codigo para el proyecto
* [XAMPP](https://www.apachefriends.org/es/download.html) - Compilador de PHP

## Contribuyendo 🖇️

_Si quieres colaborar en este proyecto, puede realizar su colaboración a través de BIZUM con el siguiente número +34 123456789._


## Versionado 📌

Usamos [SemVer](http://semver.org/) para el versionado. Para todas las versiones disponibles, mira los [tags en este repositorio](https://github.com/easyiom/pr2). _Versión Actual del Proyecto: 0.1.0_

## Autores ✒️

_Menciona a todos aquellos que ayudaron a levantar el proyecto desde sus inicios_

* **IOM** - *Full dev* - [easyiom](https://github.com/easyiom). 

## Licencia 📄

Este proyecto está bajo la Licencia (Tu Licencia) - mira el archivo [LICENSE.md](LICENSE.md) para detalles

## Expresiones de Gratitud 🎁

* Muchas gracias a todo por descargar y probar nuestro proyecto 🤓.
* Cualquier comentario o critica lo recibiremos con los brazos abierto!!!
