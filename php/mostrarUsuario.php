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
    <h2 class="mt-5">Informacio detallada de l'usuari</h2>
    <?php
    // Guardar el id del usuario en una variable
    $user_id = $_GET['user_id'];
    // Si existe el id del usuario, se muestra la información del usuario
    if (isset($user_id)){
        // Incluir el fichero de configuración de la base de datos (dbConf.php)
        include 'dbConf.php';
        // Crear la conexión a la base de datos
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
        // Try catch finally para controlar los errores de conexión a la base de datos
        try {
            $query="SELECT * FROM user where user_id='$user_id'";
            $resultado=mysqli_query($conn,$query);
            $row=mysqli_fetch_array($resultado);
            ?>
            <p>ID usuario: <?php echo $row['user_id']?></p>
            <p>Nom: <?php echo $row['name']?></p>
            <p>Cognom: <?php echo $row['surname']?></p>
            <p>Email: <?php echo $row['email']?></p>
            <p>Rol: <?php echo $row['rol']?></p>
            <p>Actiu: <?php
                if (isset($row['active'])){
                    $active="Si";
                }
                else{
                    $active="No";

                }
                echo $active ?>
            </p>
            <a class="btn btn-primary" href="index.php">TORNAR</a>
            <?php


        }
        catch (Exception $e){

        } finally {
            mysqli_close($conn);
        }

    }


    ?>
</div>
</body>
</html>
