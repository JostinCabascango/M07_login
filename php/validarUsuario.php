<?php
// Incluir el fichero de configuración de la base de datos (dbConf.php)
include 'dbConf.php';

try {
    // Definir la conexión a la base de datos
    $conn=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    // Si la conexion es correcta, se recogen los datos del formulario del login
    if ($conn) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Se crea la consulta para comprobar si el usuario existe en la base de datos
        $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        // Se ejecuta la consulta
        $resultado = mysqli_query($conn, $query);
        // Si la consulta devuelve un resultado, se redirige a la página de perfil.php
        if (mysqli_num_rows($resultado) > 0) {
            header("Location: perfil.php?email=$email");
        } else {
            // Si la consulta no devuelve un resultado, se redirige a la página de login.html
           include '../templates/login.html';
            echo "Login incorrecte";
        }

    }

} catch (Exception $e) {
    echo "Error de connexió a la base de dades: " . $e->getMessage();
} finally {
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>
