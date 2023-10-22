<?php

include "dbConfig.php";

try {
    // Intentamos establecer la conexión a la base de datos
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);

    // Comprobar si la conexión a la base de datos fue exitosa
    if ($connect) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Crear una consulta SQL para seleccionar un usuario con el email y contraseña proporcionados
        $query = "SELECT * FROM `user` WHERE email = '$email' AND password = '$password'";
        $resultado = mysqli_query($connect, $query);

        if ($resultado) {
            // Si la consulta se ejecutó correctamente
            $query_usuario = "SELECT * FROM `user`";
            $resultado_usuarios = mysqli_query($connect, $query_usuario);
            $user = mysqli_fetch_array($resultado);

            if ($user['rol'] == 'professorat') {
                // Usuario con rol "professorat"
                echo "Hola " . $user['name'] . " eres profesor !!  ". "<br>";
                echo " " . "<br>";
                echo "La lista de usuarios de la base de datos es: " . "<br>";
                echo " " . "<br>";
                foreach ($resultado_usuarios as $usuario) {
                    echo "Nombre y apellidos: " . $usuario['name'] ."  " . $usuario['surname'] . "<br>";
                }
            } elseif ($user['rol'] == 'alumnat') {
                // Usuario con rol "alumnat"
                echo "Soy un alumno". "<br>";
                echo " Nombre: " . $user['name'] . "<br>";
                echo " Apellido: " . $user['surname']. "<br>";
                echo " Email:   " . $user['email']. "<br>";
            }
        } else {
            // Si la consulta para el usuario no fue exitosa, mostrar un mensaje de error
            include 'login.html';
            echo "Login incorrecto";
        }
    } else {
        // Si la conexión a la base de datos no se estableció con éxito, lanzar una excepción
        throw new Exception("Error de conexión: " . mysqli_connect_error());
    }
} catch (Exception $ex) {
    // Capturar excepciones y mostrar un mensaje de error personalizado
    echo "Error: " . $ex->getMessage();
}

// Cerrar la conexión a la base de datos (si se estableció)
if (isset($connect)) {
    mysqli_close($connect);
}
