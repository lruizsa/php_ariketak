<?php
session_start(); // Iniciar sesión para acceder al ID del usuario

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    die("Mesedez, logeatu lehenik."); // Mostrar un mensaje si no hay sesión iniciada
}

$zerbitzari = "db";           // Dirección del servidor de base de datos
$erabiltzailea = "root";       // Nombre de usuario de la base de datos
$pasahitza = "root";           // Contraseña de la base de datos
$datuBasesa = "pelikulak_puntuazioa"; // Nombre de la base de datos

// Crear la conexión con la base de datos
$conn = new mysqli($zerbitzari, $erabiltzailea, $pasahitza, $datuBasesa);

// Verificar la conexión
if ($conn->connect_error) {
    die("Errorea konexioa egitean: " . $conn->connect_error);
}

// Procesar los datos enviados por el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isan = $_POST['isan'];           // ISAN de la película
    $filmIzen = $_POST['filmIzen'];   // Nombre de la película
    $urtea = $_POST['urtea'];         // Año de la película
    $puntuazioa = $_POST['combobox']; // Puntuación seleccionada

    // Verificar si todos los campos están completos
    if (empty($isan) || empty($filmIzen) || empty($urtea) || empty($puntuazioa)) {
        echo "Datu guztiak bete behar dira.";
    } else {
        // Obtener el ID del usuario desde la sesión
        $user_id = $_SESSION['user_id'];

        // Consulta SQL para insertar en Pelikulak_puntuazioa
        $sql = "INSERT INTO Pelikulak_puntuazioa (ISAN, Izena, Urtea, id_erabiltzailea, Puntuazioa) VALUES (?, ?, ?, ?, ?)";
        
        // Consulta SQL para insertar en Bozkatu
        $sql2 = "INSERT INTO Bozkatu (ISAN, id_erabiltzailea) VALUES (?, ?)";

        // Preparar la consulta SQL para Pelikulak_puntuazioa
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssii", $isan, $filmIzen, $urtea, $user_id, $puntuazioa);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Puntuazioa ondo sartu da!";

                // Ahora preparar y ejecutar la consulta para Bozkatu
                if ($stmt2 = $conn->prepare($sql2)) {
                    $stmt2->bind_param("si", $isan, $user_id);

                    if ($stmt2->execute()) {
                        echo "Bozkatu ondo sartu da!";
                    } else {
                        echo "Errorea Bozkatu datu-basean sartzerakoan: " . $stmt2->error;
                    }

                    $stmt2->close(); // Cerrar la segunda consulta
                } else {
                    echo "Errorea SQL-a prestatzerakoan (Bozkatu): " . $conn->error;
                }
            } else {
                echo "Errorea datu-basean sartzerakoan: " . $stmt->error;
            }

            $stmt->close(); // Cerrar la primera consulta
        } else {
            echo "Errorea SQL-a prestatzerakoan: " . $conn->error;
        }
    }
}

// Cerrar la conexión con la base de datos
$conn->close();
?>
