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
?>
</body>
</html>

