<?php
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    // Asegúrate de que el idioma seleccionado sea uno de los idiomas válidos.
    $idiomasValidos = ['cat', 'es', 'en'];
    if (in_array($lang, $idiomasValidos)) {
        // Establece una cookie para el idioma seleccionado que expira en 30 días.
        setcookie('idioma', $lang, time() + 30 * 24 * 60 * 60);
    }
}
// Redirecciona de vuelta a la página principal (index.php).
header('Location: index.php');
?>
