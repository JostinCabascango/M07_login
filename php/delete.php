<?php
// Eliminar la cookie de idioma si existe
if (isset($_COOKIE['idioma'])) {
    // destruye la variable
    unset($_COOKIE['idioma']);
    // Dejar por defecto el idioma catalán (cat)
    setcookie('idioma', '', time() - 3600);
}
// Redireccionar a la página de inicio (index.php)
header("Location: index.php");
?>
