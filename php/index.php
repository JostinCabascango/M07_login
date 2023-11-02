<?php
session_start();
$page_title = obtenerTituloPagina();
include "../templates/header.php";
?>
<body>
<div class="container mt-5">
    <?php
    if (isLoggedIn()) {
        $rol = obtenerRolUsuario();
        mostrarSaludoUsuario($rol);

        if ($rol == 'professorat') {
            mostrarTablaUsuarios();
        }
    } else {
        redireccionarAlLogin();
    }
    ?>
</div>
</body>

</html>

<?php
function obtenerTituloPagina()
{
    return "Index";
}

function isLoggedIn()
{
    return isset($_SESSION['LoggedIn']) && $_SESSION['LoggedIn'];
}

function obtenerRolUsuario()
{
    return $_SESSION['rol'];
}

function mostrarSaludoUsuario($rol)
{
    $name = $_SESSION['name'];
    $user_id = $_SESSION['user_id'];
    $idioma = obtenerIdiomaSeleccionado();

    include "../php/lang/lang_$idioma.php";

    $saludo = $idioma['saludo'];
    $tipoUsuario = ($rol == 'alumnat') ? $idioma['es_alumno'] : $idioma['es_profesor'];
    $btn_de_idiomas = mostrarBotonesIdioma($idioma);
    ?>

    <h2 class='mt-5'><?php echo "$saludo $name, $tipoUsuario"; ?></h2>
    <?php echo $btn_de_idiomas; ?>

    <div class='mt-3'>
        <a class='btn btn-primary' href='mostrarUsuario.php?user_id=<?php echo $user_id; ?>'><?php echo $idioma['mostrar_informacion']; ?></a>
        <a class='btn btn-secondary' href='desconectar.php'><?php echo $idioma['desconectar']; ?></a>
    </div>
    <?php
}

function mostrarTablaUsuarios()
{
    $conn = conectarBaseDeDatos();
    $idioma = obtenerIdiomaSeleccionado();

    include "../php/lang/lang_$idioma.php";

    $query = "SELECT * FROM user";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) > 0) {
        ?>
        <table class='table table-striped table-hover table-bordered mt-5'>
            <thead>
            <tr>
                <th scope='col'><?php echo $idioma['nombre']; ?></th>
                <th scope='col'><?php echo $idioma['apellido']; ?></th>
                <th scope='col'><?php echo $idioma['correo']; ?></th>
                <th scope='col'><?php echo $idioma['accion']; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($resultado as $user) {
                ?>
                <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['surname']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <a class='btn btn-primary btn-sm'
                           href='mostrarUsuario.php?user_id=<?php echo $user['user_id']; ?>'><?php echo $idioma['mostrar_informacion']; ?></a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "Error en la consulta a la base de datos.";
    }

    cerrarConexionBaseDeDatos($conn);
}

function mostrarBotonesIdioma($idioma)
{
    ?>
    <div class='btn-group' role='group' aria-label='Idiomas'>
        <?php
        mostrarEnlaceIdioma("cat", "Cat");
        mostrarEnlaceIdioma("es", "Es");
        mostrarEnlaceIdioma("en", "En");
        mostrarEnlace("delete.php", $idioma['eliminar'], "danger");
        ?>
    </div>
    <?php
}

function mostrarEnlace($url, $label, $class)
{
    ?>
    <a href='<?php echo $url; ?>' class='btn btn-outline-<?php echo $class; ?> mx-2'><?php echo $label; ?></a>
    <?php
}

function mostrarEnlaceIdioma($lang, $label)
{
    $idiomaActual = obtenerIdiomaSeleccionado();
    $isSelected = ($idiomaActual == $lang) ? 'success' : 'info';
    $url = "idioma.php?lang=$lang";
    ?>

    <a href='<?php echo $url; ?>' class='btn btn-outline-<?php echo $isSelected; ?> mx-2' id='<?php echo $lang; ?>'><?php echo $label; ?></a>
    <?php
}

function obtenerIdiomaSeleccionado()
{
    return isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'cat';
}

function conectarBaseDeDatos()
{
    include 'dbConf.php';
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

    if (!$conn) {
        throw new Exception("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    return $conn;
}

function cerrarConexionBaseDeDatos($conn)
{
    if (isset($conn)) {
        mysqli_close($conn);
    }
}

function redireccionarAlLogin()
{
    header("Location: ../templates/login.html");
}
?>
