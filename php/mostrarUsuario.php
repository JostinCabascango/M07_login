<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Informació de l'usuari</title>
    <!-- CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2 class="mt-5">Informació detallada de l'usuari</h2>
    <?php
    try {
        // Comprobar si se ha pasado el ID del usuario en la URL
        if (isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];

            // Incluir el archivo de configuración de la base de datos (dbConf.php)
            include 'dbConf.php';

            // Crear la conexión a la base de datos
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

            if ($conn) {
                // Consulta SQL para obtener la información del usuario
                $query = "SELECT * FROM user WHERE user_id = '$user_id'";
                $resultado = mysqli_query($conn, $query);
                // Si la consulta devuelve un resultado, se muestra la información del usuario
                if ($resultado) {
                    if ($row = mysqli_fetch_array($resultado)) {
                        ?>
                        <p>ID de usuario: <?php echo $row['user_id']; ?></p>
                        <p>Nom: <?php echo $row['name']; ?></p>
                        <p>Cognom: <?php echo $row['surname']; ?></p>
                        <p>Email: <?php echo $row['email']; ?></p>
                        <p>Rol: <?php echo $row['rol']; ?></p>
                        <p>Actiu: <?php echo isset($row['active']) ? 'Si' : 'No'; ?></p>
                        <a class="btn btn-primary" href="index.php">TORNAR</a>
                        <?php
                    } else {
                        echo "L'usuari no existeix.";
                    }
                } else {
                    throw new Exception("Error en la consulta a la base de dades.");
                }
            } else {
                throw new Exception("Error de connexió a la base de dades.");
            }
        } else {
            echo "Falta l'ID de l'usuari en la URL.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Cerrar la conexión a la base de datos
        mysqli_close($conn);
    }
    ?>
</div>
</body>
</html>
