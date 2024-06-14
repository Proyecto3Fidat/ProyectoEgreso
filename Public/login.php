<?php
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
    header("Location: welcome.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.1">
    <link rel="stylesheet" href="style.css">
    <title>Ingresar</title>
</head>
<body>
    <form action="/login" method="post">
        <input type="password" name="passwd" placeholder="Contraseña" style="border: 2px solid black; font-size: 15px;"> <br> <br>
        <input type="text" name="documento" placeholder="Documento" style="border: 2px solid black; font-size: 15px; "> <br> <br>
        <input type="submit" name="Ingresar" value="INGRESAR" style="border: 0.1rem solid black; background-color: blueviolet; border-radius: 10px; padding: 10px 20px; color: black; font-weight: bold; font-size: 15px; cursor: pointer;"> 
    </form>
</body>
</html>