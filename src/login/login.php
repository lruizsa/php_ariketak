<?php
session_start();

// Iniciar el buffer de salida
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $erabiltzailea = $_POST['erabiltzailea'];
    $pasahitza = $_POST['pasahitza'];

    // Erabiltzailea eta pasahitza dauden fitxategia
    $file_path = 'erabiltzailea.txt'; 

    // Fitxategia existitzen den egiaztatu
    if (!file_exists($file_path)) {
        die('Errorea: erabiltzailea.txt fitxategia ez da existitzen.');
    }

    // Irakurri
    $erabiltzaileak = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($erabiltzaileak === false) {
        die('Errorea: erabiltzailea.txt fitxategia ezin izan da irakurri.');
    }

    $login_success = false;

    foreach ($erabiltzaileak as $user) {
        list($stored_username, $stored_password) = explode(',', $user);

        // Erabiltzaile-izena eta pasahitza egiaztatu
        if ($erabiltzailea === $stored_username && password_verify($pasahitza, $stored_password)) {
            $_SESSION['username'] = $erabiltzailea;
            $login_success = true;
            break;
        }
    }

    if ($login_success) {
        // Limpiar el buffer de salida antes de redirigir
        ob_end_clean();
        header("Location: babesOrri.html"); // Babestutako orrira bideratu
        exit;
    } else {
        echo "Login okerra! Saiatu berriro.";
    }
}

// Limpiar el buffer de salida
ob_end_flush();
?>
