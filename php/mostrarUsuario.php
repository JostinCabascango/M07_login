<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Informació de l'usuari</title>
    <!-- CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Informació detallada de l'usuari</h2>
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
                                    <ol class="list-group list-group mb-4">
                                        <li class="list-group-item">
                                            <div class="fw-bold">ID de usuario</div>
                                            <?php echo $row['user_id']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="fw-bold">Nom</div>
                                            <?php echo $row['name']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="fw-bold">Cognom</div>
                                            <?php echo $row['surname']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="fw-bold">Email</div>
                                            <?php echo $row['email']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="fw-bold">Rol</div>
                                            <?php echo $row['rol']; ?>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="fw-bold">Active</div>
                                            <?php echo isset($row['active']) ? 'Si' : 'No'; ?>
                                        </li>
                                    </ol>
                                    <a class="btn btn-primary" href="index.php">Volver</a>
            </div>
        </div>
    </div>
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
</body>

</html>