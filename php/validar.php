<?php
// Incluir el fichero de configuración de la base de datos (dbConf.php)
include 'dbConf.php';

try {
    //Iniciamos la sesion
    session_start();
    // Definir la conexión a la base de datos
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    // Si la conexion es correcta, se recogen los datos del formulario de login
    if ($conn) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Se crea la consulta para comprobar si el usuario existe en la base de datos
        $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        // Se ejecuta la consulta
        $resultado = mysqli_query($conn, $query);
        // Si la consulta devuelve un resultado, se redirige a la página de perfil.php
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_array($resultado);
            $_SESSION['LoggedIn'] = true;
            // Si el usuario existe, se crea una variable de sesión con el nombre del usuario
            $_SESSION['name'] = $row['name'];
            $_SESSION['rol'] = $row['rol'];
            $_SESSION['user_id'] = $row['user_id'];
            // Redirigir al usuario a la página de perfil.php
            header("Location: index.php");
        } else {
            // Si el usuario no existe, se muestra un mensaje de error
            include '../templates/login.html';
?>
            <div class="d-flex justify-content-center align-items-center">
                <div class="alert alert-danger" role="alert">
                    Login Incorrecte
                </div>
            </div>

<?php
        }
    }
} catch (Exception $e) {
    echo "Error de connexió a la base de dades: " . $e->getMessage();
} finally {
    // Cierro la conexión a la base de datos
    mysqli_close($conn);
}
?>