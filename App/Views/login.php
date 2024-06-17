<?php
if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params(0);
    session_start();

}

if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
    header("Location: inicio.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="/login" method="post">
        <label for="nroDocumento">Número de Documento:</label>
        <input type="text" id="nroDocumento" name="documento" required><br><br>
        <label for="passwd">Contraseña:</label>
        <input type="password" id="passwd" name="passwd" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>