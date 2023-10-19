<?php
// Incluir el fichero de configuración de la base de datos (dbConf.php)
include 'dbConf.php';
// Crear la conexión a la base de datos
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
// Try catch finally para controlar los errores de conexión a la base de datos
try {
    // Si la conexion es correcta, se recogen los datos del formulario de singIn
    if ($conn) {
        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $rol = $_POST['rol'];
        if (isset($_POST['active'])){
            $active = 1;
        }
        else{
            $active = 0;
        }
        // Se crea la consulta para insertar el usuario en la base de datos
        $query = "INSERT INTO user (user_id, name, surname, password, email, rol, active) VALUES ('$user_id', '$name', '$surname', '$password', '$email', '$rol', '$active')";
        // Se ejecuta la consulta
        $resultado = mysqli_query($conn, $query);
        // Si el INSERT se ejecuta correctamente, se redirige a la página de resultado.php
        if ($resultado) {
            header('Location: resultado.php');
        } else {
            // Si la consulta no se ejecuta correctamente, mostrar un mensaje de error
            header('Location: ../templates/signIn.html');
        }



    }
} catch (Exception $e) {
    echo "Error de connexió a la base de dades: " . $e->getMessage();
} finally {
    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
