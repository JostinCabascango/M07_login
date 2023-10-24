<?php
// Incluir el fichero de configuración de la base de datos (dbConf.php)
include 'dbConf.php';

try {
    //Iniciamos la sesion
    session_start();
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
            //Guardamos el nombre , rol y el user_id en la session
            $row = mysqli_fetch_array($resultado);
            $_SESSION['name'] = $row['name'];
            $_SESSION['rol'] = $row['rol'];
            $_SESSION['user_id'] = $row['user_id'];
            // Guardamos un boolean para identificar que el login es correcto
            $_SESSION['LoggedIn']=true;
            //Redirect a index.php
            header("Location: index.php");


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
