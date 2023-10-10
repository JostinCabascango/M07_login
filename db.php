<?php
//Constantes para la conexion a la base de datos MariaDB
define('DB_HOST', 'localhost'); //127.0.0.1
define('DB_NAME', 'users');
define('DB_USER', 'root');
define('DB_PSW', '');
// Puerto de conexion a la base de datos Mysql
define('DB_PORT', '3306');
// Hacemos la conexion a la base de datos
$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);
// Comprobamos si la conexion a la base de datos es correcta
if (!$conexion) {
    echo "La conexion a la base de datos ha fallado" . mysqli_connect_error();
} else {
    echo "Conexion realizada correctamente";
}
// Recogemos los datos del formulario.html y los guardamos en variables
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$password = $_POST['password'];
$email = $_POST['email'];
// Recibimos el rol del usuario (alumno o profesor)
$rol = $_POST['rol'];
//Comprobamos si el usuario está activo o no
if (isset($_POST['active'])) {
    $active = 1; // Si el campo 'active' está marcado, consideramos que el usuario está activo
} else {
    $active = 0; // Si no está marcado, consideramos que el usuario no está activo
}
// Preparamos la consulta para insertar los datos en la tabla 'user'
$query = "INSERT INTO user (user_id, name, surname, password, email, rol, active) VALUES (?, ?, ?, ?, ?, ?, ?)";
$statement = mysqli_prepare($conexion, $query);
// si la consulta se ha preparado correctamente ejecutamos la consulta
if ($statement) {
    // Asociamos los datos a la consulta
    mysqli_stmt_bind_param($statement, 'isssssi', $user_id, $name, $surname, $password, $email, $rol, $active);
    // Ejecutamos la consulta
    mysqli_stmt_execute($statement);
    // Cerramos la consulta
    mysqli_stmt_close($statement);
    // Cerramos la conexion a la base de datos
    mysqli_close($conexion);
} else {
    // Si la consulta no se ha preparado correctamente mostramos un mensaje de error
    echo "Error en la consulta: " . mysqli_error($conexion);
}
?>
