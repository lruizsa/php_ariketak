<?php
session_start(); // Inicia la sesión

$servername = "db";
$username = "root"; 
$password = "root"; 
$dbname = "pelikulak_puntuazioa";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $erabiltzailea = $_POST['erabiltzailea'];  // Nombre de usuario
    $pasahitza = $_POST['pasahitza'];          // Contraseña

    // Consulta para obtener el id y la contraseña almacenada del usuario
    $sql = "SELECT id_erabiltzailea, Pasahitza FROM Erabiltzaileak WHERE Erabiltzaile_izena = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $erabiltzailea);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            // Verificar la contraseña
            if (password_verify($pasahitza, $hashed_password)) {
                // Si la contraseña es correcta, guardar el ID del usuario en la sesión
                $_SESSION['user_id'] = $user_id;

                // Redirigir al formulario
                header("Location: formularioa.html");
                exit;
            } else {
                echo "Pasahitza ez da zuzena.";
            }
        } else {
            echo "Erabiltzailea ez da existitzen.";
        }
        $stmt->close();
    } else {
        echo "Errorea SQL prestatzerakoan: " . $conn->error;
    }
}

$conn->close();
?>
