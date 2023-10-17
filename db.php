
<?php

// Constantes para la configuración de la base de datos
define("DB_HOST", "localhost"); // Host de la base de datos
define("DB_NAME", "users"); // Nombre de la base de datos
define("DB_USER", "root"); // Usuario de la base de datos
define("DB_PSW", ""); // Contraseña de la base de datos
define("DB_PORT", 3306); // Puerto de la base de dato (3306)



// Conexión a la base de datos utilizando las constantes definidas anteriormente
$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);

// Comprobar si la conexión a la base de datos fue exitosa
if (!$conexion) {
    echo "Error de conexión: " . mysqli_connect_error();
} else {
    // Recuperar los datos del formulario a través del método POST
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

    // Ejecutar la consulta SQL y comprobar si la inserción fue exitosa
    if (mysqli_query($conexion, $query)) {
        // Redirigir a la página 'mostrar.php' si la inserción fue exitosa
        header('Location: mostrar.php');
    } else {
        // Mostrar un mensaje de error en caso de fallo en la inserción
        echo "Error al insertar datos " . mysqli_error($conexion);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

?>
