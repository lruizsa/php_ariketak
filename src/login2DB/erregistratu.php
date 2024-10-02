<?php
// Configuración de la conexión a la base de datos
$servername = "db"; // O 'localhost' si estás usando Docker para la base de datos
$username = "root"; // Cambia esto si tu usuario no es 'root'
$password = "root"; // Cambia esto por tu contraseña de MySQL
$dbname = "DatuBasea"; // El nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica que se haya enviado el formulario correctamente
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener el nombre de usuario y la contraseña del formulario
    $erabiltzailea = $_POST['erabiltzailea'];
    $pasahitza = $_POST['pasahitza'];

    // Verificar que los campos no estén vacíos
    if (empty($erabiltzailea) || empty($pasahitza)) {
        echo "Mesedez, sartu erabiltzaile izena eta pasahitza.";
    } else {
        // Hash de la contraseña para mayor seguridad
        $hashed_password = password_hash($pasahitza, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO Erabiltzaileak (Erabiltzaile_izena, Pasahitza) VALUES (?, ?)"; // Argazkia ya no se incluye

        // Preparar la consulta con parámetros para prevenir inyecciones SQL
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $erabiltzailea, $hashed_password);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "Erregistroa ondo burutu da!";
            } else {
                echo "Errorea datu-basean sartzerakoan: " . $stmt->error;
            }

            // Cerrar la consulta
            $stmt->close();
        } else {
            echo "Errorea SQL-a prestatzerakoan: " . $conn->error;
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
