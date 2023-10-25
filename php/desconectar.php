<?php
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
//Borrar totes les variables de sessió
session_unset();
//Destruir la sessió
session_destroy();
//Redirige al usuario a la página de inicio de sesión.
header("Location: ../templates/login.html");
?>
</body>
</html>

