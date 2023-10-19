<?php
// Incluir el fichero de configuración de la base de datos (dbConf.php)
include 'dbConf.php';

// Try catch finally para controlar los errores de conexión a la base de datos
try {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

    // Si la conexion es correcta y se ha pasado el email por la URL, se recoge el email
    if ($conn) {
        // Recoger el email desde la URL con GET
        $email = $_GET['email'];
        // Se crea la consulta para comprobar si el usuario existe en la base de datos con el email pasado por la URL
        $query = "SELECT * FROM user WHERE email = '$email'";
        // Se ejecuta la consulta
        $resultado = mysqli_query($conn, $query);
    }
} catch (Exception $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Perfil de Usuari</title>
</head>

<body>
    <h1>Perfil de Usuari</h1>
    <?php
    if (isset($resultado)) {
        // Verificar si se encontraron registros
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_array($resultado); // Obtener 
            $name = $row['name'];
            $email = $row['email'];
            $surname = $row['surname'];
            $rol = $row['rol'];
        }
    }
    ?>
    <?php if (isset($rol) && $rol === 'alumnat') { ?>
        <p>Soc un <?php echo $rol ?></p>
        <p>Nom: <?php echo $name; ?></p>
        <p>Cognom: <?php echo $surname; ?></p>
        <p>Email: <?php echo $email; ?></p>
    <?php } ?>

    <?php if (isset($rol) && $rol === 'professorat') { ?>
        <h2>Lista d'usuaris de la base de dades es :</h2>
        <?php
        $query = "SELECT * FROM user";
        $allUsers = mysqli_query($conn, $query);
        if (mysqli_num_rows($allUsers) > 0) { ?>
            <table border="1">
                <tr>
                    <th>Nom</th>
                    <th>Cognom</th>
                </tr>
                <?php foreach($allUsers as $user) { ?>
                    <tr>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['surname']; ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    <?php }
    ?>


</body>

</html>