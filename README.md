# Proyecto de Login y Registro de Usuarios con PHP y MySQL

Este proyecto es la continuación del proyecto "Alta de Usuarios con PHP y MySQL". En este proyecto, se implementa una funcionalidad adicional para permitir a los usuarios iniciar sesión en el sistema.

## Descripción

El objetivo de este proyecto es permitir el registro y la autenticación de usuarios (estudiantes y profesores) mediante formularios PHP. Los datos se almacenan en una base de datos MySQL en una tabla llamada "users". Los formularios recopilan información importante, como el nombre, apellido, contraseña, correo electrónico y rol (estudiante o profesor).

## Estructura del proyecto

El proyecto consta de tres archivos principales:

1. `login.html`: Este es el formulario de inicio de sesión que recoge el correo electrónico y la contraseña del usuario.
2. `validar.php`: Este archivo se encarga de validar las credenciales del usuario contra la base de datos.
3. `dbConf.php`: Este archivo contiene las constantes para la conexión a la base de datos.
4. `index.php`: Este archivo se encarga de mostrar la información del usuario que se encuentra en la base de datos.
   
## Capturas de Pantalla

- Ejemplo de un usuario que su rol es profesor.
  ![Ejecucion_en_la_web](img/perfilProfessor.png).

- Ejemplo de un usuario que su rol es alumno.
  ![Ejecucion_en_la_web](img/perfilAlumno.png).

- Ejemplo de la descripción de un usuario.
  ![Ejecucion_en_la_web](img/descripcionUsuario.png).
- Ejemplo de la url cuando se pasa por parametro el id del usuario a traves de un metodo GET.
  ![Ejecucion_en_la_web](img/idPorMetodoGet.png).

## Cómo usar

1. Abre el archivo `templates/login.html` en tu navegador.
2. Introducir el correo electrónico y la contraseña del usuario en el formulario de inicio de sesión.
3. Hacer clic en "Enviar".
5. Si las credenciales son correctas, se redirige al usuario a la página correspondiente según su rol (estudiante o profesor).
5. Si las credenciales son incorrectas, se redirige al usuario a la página de inicio de sesión y se muestra un mensaje de error.
6. En la página correspondiente según el rol, se muestra un saludo con el nombre y el rol del usuario, y se ofrecen dos enlaces: uno para mostrar la información detallada del usuario y otro para desconectarse.
7. Si se hace clic en el enlace para mostrar la información detallada del usuario, se redirige al usuario a una página donde se consultan a la base de datos todos los campos del usuario. Este enlace se hace a través del método GET pasando el valor de ID del usuario.
8. Si se hace clic en el enlace para desconectarse, se redirige al usuario a un archivo PHP donde se cierra la sesión. Una vez hecho esto, se redirige al usuario a la página de inicio de sesión.


## Notas

Asegúrate de tener una base de datos MySQL en funcionamiento y reemplaza los valores en `dbConf.php` con tus propios valores.

Este código asume que tienes una tabla llamada `users` con las columnas `name`, `surname`, `email`, `password` y `role`. Asegúrate de adaptar el código a tu estructura de base de datos.

## Créditos

- Autor: Jostin Fabian Cabascango Chavez
- Repositorio GitHub: [Enlace a GitHub](https://github.com/JostinCabascango)
