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
?>