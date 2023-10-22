<?php

include "dbConfig.php";

try {
    // Establecer una conexión con la base de datos utilizando las constantes definidas
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);

    // Comprobar si la conexión a la base de datos fue exitosa
    if (!$connect) {
        throw new Exception("Error de conexión: " . mysqli_connect_error());
    } else {
        // Comprobar si la conexión a la base de datos fue exitosa
        echo "Conexion establecida correctamente";
        $user_id = $_POST["user_id"];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $rol = $_POST["rol"];

        // Comprobar si la casilla "active" fue marcada en el formulario
        if (isset($_POST["active"])) {
            $active = 1;
        } else {
            $active = 0;
        }

        // Crear la consulta SQL para insertar los datos en la tabla 'user'
        $query = "INSERT INTO user (user_id, name, surname, password, email, rol, active)
        VALUES ('$user_id', '$name', '$surname', '$password', '$email', '$rol', '$active')";

        if (mysqli_query($connect, $query)) {
            // Redirigir a la página 'mostrar.php' si la inserción fue exitosa
            header('Location: mostrar.php');
        } else {
            throw new Exception("Error al insertar datos " . mysqli_error($connect));
        }
    }
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
}

// Cerrar la conexión a la base de datos
if (isset($connect)) {
    mysqli_close($connect);
}
