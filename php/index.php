<?php
// Iniciamos la sesionç
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<body>
<?php
// Si el rol es estudiante, se muestra el perfil del estudiante
if ($_SESSION['rol'] === 'alumnat') {
    ?>
<h2>Hola <?php echo $_SESSION['name']; ?>
    ets un alumne</h2>
    <a href="mostrarUsuario.php?user_id=<?php echo $_SESSION['user_id']; ?>">Mostrar informació</a>
    <a href="desconectar.php">Desconnectar</a>
<?php

}
// Si el rol es profesor, se muestra todos los usuarios de la base de datos en una tabla
else if ($_SESSION['rol'] === 'professorat') {
    ?>
<h2>Hola <?php echo $_SESSION['name']; ?>ets un professor</h2>
<a href="mostrarUsuario.php?user_id=<?php echo $_SESSION['user_id']; ?>">Mostrar informació</a>
<a href="desconectar.php">Desconnectar</a>
<?php
    // Mostrar la tabla de usuarios de la base de datos
    include 'dbConf.php';
    $conn=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
    $query = "SELECT * FROM user";
    $resultado = mysqli_query($conn, $query);
    if (mysqli_num_rows($resultado) > 0) {
?>
<table>
    <tr>
        <th>Nom</th>
        <th>Cognom</th>
        <th>Email</th>
    </tr>
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

    }

}
?>

</body>
</html>

