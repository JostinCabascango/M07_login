
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <!-- CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    // Iniciar la sesión
    session_start();
    // Si el rol es estudiante, se muestra el perfil del estudiante
    if ($_SESSION['rol'] === 'alumnat') {
        ?>
        <h2 class="mt-5">Hola <?php echo $_SESSION['name']; ?>, ets un alumne</h2>
        <a class="btn btn-primary" href="mostrarUsuario.php?user_id=<?php echo $_SESSION['user_id']; ?>">Mostrar informació</a>
        <a class="btn btn-secondary" href="desconectar.php">Desconnectar</a>
        <?php
    }
    // Si el rol es profesor, se muestra todos los usuarios de la base de datos en una tabla
    else if ($_SESSION['rol'] === 'professorat') {
        ?>
        <h2 class="mt-5">Hola <?php echo $_SESSION['name']; ?>, ets un professor</h2>
        <a class="btn btn-primary" href="mostrarUsuario.php?user_id=<?php echo $_SESSION['user_id']; ?>">Mostrar informació</a>
        <a class="btn btn-secondary" href="desconectar.php">Desconnectar</a>
        <?php
        // Mostrar la tabla de usuarios de la base de datos
        include 'dbConf.php';
        // Bloque try-catch para capturar excepciones
        try{
            $conn=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
            // Comprobar si la conexión es correcta
            if (!$conn) {
                throw new Exception("Error de connexió a la base de dades.");
            }
            // Consulta SQL para obtener todos los usuarios de la base de datos
            $query = "SELECT * FROM user";
            $resultado = mysqli_query($conn, $query);
            // Comprobar si la consulta es correcta
            if (!$resultado) {
                throw new Exception("Error en la consulta a la base de dades.");
            }
            // Si la consulta devuelve un resultado, se muestra la tabla con los usuarios
            if (mysqli_num_rows($resultado) > 0) {
                ?>
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Cognom</th>
                        <th>Email</th>
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
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Cerrar la conexión a la base de datos
            mysqli_close($conn);

        }
    }

    ?>
</div>
</body>
</html>
