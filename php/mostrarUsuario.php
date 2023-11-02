<?php
// mostrarUsuario.php - Muestra la información del usuario seleccionado según su ID recibido por el método GET

// Incluir el archivo de configuración de la base de datos (dbConf.php)
include 'dbConf.php';

// Incluir el archivo de cabecera (header.php)
include "../templates/header.php";

// Definir las constantes para los idiomas (lang_en.php, lang_es.php, lang_ca.php)
const CATALAN = 'cat';
const SPANISH = 'es';
const ENGLISH = 'en';

// Obtener el idioma seleccionado por el usuario (por defecto, catalán)
$idioma = obtenerIdiomaSeleccionado();

// Incluir el archivo de idioma seleccionado por el usuario
include "../php/lang/lang_$idioma.php";
?>

<body>
<div class="container mt-5">
    <div class="card-body">
        <h2 class="card-title"><?php echo $idioma['h2']; ?></h2>
        <?php
        // Comprobar si se ha recibido el id del usuario por GET
        if (isset($_GET['user_id'])) {
            // Obtener el id del usuario
            $user_id = $_GET['user_id'];
            // Mostrar la información del usuario según el id
            mostrarInformacionUsuario($user_id, $idioma);
        } else {
            // Si no se ha recibido el id del usuario por GET, mostrar un mensaje de error
            mostrarMensajeError($idioma['error']);
        }
        ?>
    </div>
</div>
</body>

<?php
// Función para obtener el idioma seleccionado por el usuario
function obtenerIdiomaSeleccionado()
{
    // Si existe la cookie 'idioma', devolver el valor de la cookie
    if (isset($_COOKIE['idioma'])) {
        return $_COOKIE['idioma'];
    } else {
        // Si no existe la cookie 'idioma', devolver el idioma por defecto (catalán)
        return CATALAN;
    }
}

// Función para mostrar la información del usuario según su ID
function mostrarInformacionUsuario($user_id, $idioma)
{
    $conn = conectarBaseDeDatos();

    if ($conn) {
        $user = obtenerUsuarioPorID($user_id, $conn);

        if ($user) {
            mostrarInformacionUsuarioEnLista($user, $idioma);
        } else {
            // Si no se ha encontrado el usuario, mostrar un mensaje de error
            mostrarMensajeError("No se ha encontrado el usuario con el ID $user_id");
        }

        cerrarConexionBaseDeDatos($conn);
    } else {
        mostrarMensajeError("Error de conexión a la base de datos");
    }
}

// Función para obtener un usuario por su ID
function obtenerUsuarioPorID($user_id, $conn)
{
    // Consulta para obtener la información del usuario según su ID
    $query = "SELECT * FROM user WHERE user_id ='$user_id'";
    // Ejecutar la consulta
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) > 0) {
        // Guardar la información del usuario en un array $user
        return mysqli_fetch_array($resultado);
    } else {
        return false;
    }
}

// Función para mostrar la información del usuario en una lista
function mostrarInformacionUsuarioEnLista($user, $idioma)
{
    ?>
    <ol class="list-group list-group mb-4">
        <li class="list-group-item">
            <div class="fw-bold"> <?php echo $idioma['user_id']; ?></div>
            <?php echo $user['user_id']; ?>
        </li>
        <li class="list-group-item">
            <div class="fw-bold"><?php echo $idioma['name']; ?></div>
            <?php echo $user['name']; ?>
        </li>
        <li class="list-group-item">
            <div class="fw-bold"><?php echo $idioma['surname']; ?></div>
            <?php echo $user['surname']; ?>
        </li>
        <li class="list-group-item">
            <div class="fw-bold"><?php echo $idioma['email']; ?></div>
            <?php echo $user['email']; ?>
        </li>
        <li class="list-group-item">
            <div class="fw-bold"><?php echo $idioma['rol']; ?></div>
            <?php echo $user['rol']; ?>
        </li>
        <li class="list-group-item">
            <div class="fw-bold">Active</div>
            <?php echo obtenerEstadoActive($user['active'], $idioma); ?>
        </li>
    </ol>
    <!--Mostrar un botón para volver a la página principal-->
    <a href="index.php" class="btn btn-primary"><?php echo $idioma['regresar']; ?></a>
    <?php
}

// Función para conectar a la base de datos
function conectarBaseDeDatos()
{
    // Crear la conexión a la base de datos
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

    // Comprobar si la conexión a la base de datos es correcta
    if (!$conn) {
        // Si la conexión a la base de datos no es correcta, mostrar un mensaje de error
        mostrarMensajeError("Error en la conexión a la base de datos: " . mysqli_connect_error());
    } else {
        // Si la conexión a la base de datos es correcta, devolver la conexión
        return $conn;
    }
}

// Función para cerrar la conexión a la base de datos
function cerrarConexionBaseDeDatos($conn)
{
    // Cerrar la conexión a la base de datos si está abierta
    if (isset($conn)) {
        mysqli_close($conn);
    }
}

// Función para mostrar un mensaje de error
function mostrarMensajeError($mensaje)
{
    ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $mensaje; ?>
    </div>
    <?php
}

// Función para obtener el estado de 'active' del usuario
function obtenerEstadoActive($active, $idioma)
{
    // Switch para mostrar el valor de la columna 'active' según el idioma seleccionado por el usuario
    $lang = obtenerIdiomaSeleccionado();
    switch ($lang) {
        case CATALAN:
            return isset($active) ? 'Si' : 'No';
        case ENGLISH:
            return isset($active) ? 'Yes' : 'No';
        case SPANISH:
            return isset($active) ? 'Sí' : 'No';
    }
}
?>
