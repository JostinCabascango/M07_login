# Proyecto de Login y Registro de Usuarios con PHP y MySQL

Este proyecto es la continuación del proyecto "Alta de Usuarios con PHP y MySQL". En este proyecto, se implementa una funcionalidad adicional para permitir a los usuarios iniciar sesión en el sistema.

## Descripción

El objetivo de este proyecto es permitir el registro y la autenticación de usuarios (estudiantes y profesores) mediante formularios PHP. Los datos se almacenan en una base de datos MySQL en una tabla llamada "users". Los formularios recopilan información importante, como el nombre, apellido, contraseña, correo electrónico y rol (estudiante o profesor).

## Estructura del proyecto

El proyecto consta de tres archivos principales:

1. `login.html`: Este es el formulario de inicio de sesión que recoge el correo electrónico y la contraseña del usuario.
2. `validarUsuario.php`: Este archivo se encarga de validar las credenciales del usuario contra la base de datos.
3. `dbConf.php`: Este archivo contiene las constantes para la conexión a la base de datos.
   
## Capturas de Pantalla

- Captura de pantalla que muestra el login.
  ![Ejecucion_en_la_web](img/formularioLogin.png).

- Captura que muestra un mensaje de error si las credenciales son incorrectas.
  ![Ejecucion_en_la_web](img/loginIncorrecte.png).

- Captura del usuario cuando es alumno.
![perfil_usuario](img/perfilUsuario.png)

- Captura del usuario cuando es professor.
![perfil_professor](img/perfilProfessor.png)

- Captura del formulario para insertar usuarios.
   ![crear_usuario](img/insertarUsuario.png)

- Captura que muestra si el usuario se ha creado correctamente.
   ![crear_usuario](img/mensajeConfirmacionInsertarUsuario.png)

## Cómo usar

1. Abre el archivo `login.html` en tu navegador.
2. Introduce tu correo electrónico y contraseña.
3. Haz clic en "Submit".

Si las credenciales son correctas, se te redirigirá a la página correspondiente según tu rol (estudiante o profesor). Si las credenciales son incorrectas, se te redirigirá a la página de inicio de sesión y se mostrará un mensaje de error.

## Notas

Asegúrate de tener una base de datos MySQL en funcionamiento y reemplaza los valores en `dbConf.php` con tus propios valores.

Este código asume que tienes una tabla llamada `users` con las columnas `name`, `surname`, `email`, `password` y `role`. Asegúrate de adaptar el código a tu estructura de base de datos.

## Créditos

- Autor: Jostin Fabian Cabascango Chavez
- Repositorio GitHub: [Enlace a GitHub](https://github.com/JostinCabascango)