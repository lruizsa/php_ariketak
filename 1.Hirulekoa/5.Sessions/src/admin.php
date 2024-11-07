<?php 
//ob_start();






if (isset($_COOKIE["erabiltzailea"])) {
    $jsonString = $_COOKIE["erabiltzailea"]; // Obtén el valor de la cookie
    $data = json_decode($jsonString, true); // Decodifica el JSON

    // Comprobar si hay errores en la decodificación
    if (json_last_error() !== JSON_ERROR_NONE) {
        header('Location: index.html');
        exit();
    }

    // Asegúrate de que estás accediendo al campo correcto
    if (isset($data["username"]) && $data["username"] !== "admin") { // Cambia a "nombre" si ese es el campo correcto
        header('Location: index.html');
        exit();
    }
} else {
    header('Location: index.html');
    exit();
}



//echo "Hellow ".$_COOKIE["erabiltzailea"];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
   
    setcookie("erabiltzailea", "", time() - 3600, "/");
    header('Location: index.html');
    exit();
}


echo("<h1>Kaixo ".$data["username"]."</h1>");
echo('<img style="width: 10%; height: auto;" src="'.$data["img"].'">');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manex Aranzadi Egaña</title>
</head>
<body>



    <!--<h1>Ongi etorri admin horrialdera</h1>-->
    <form method="POST">
        <button type="submit" name="logout">Saioa itxi</button>
    </form>




</body>
</html>