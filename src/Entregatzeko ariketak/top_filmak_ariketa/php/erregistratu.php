<?php
// Iniciar la sesión
session_start();

// Configuración de la conexión a la base de datos
$servername = "db"; // O 'localhost' si estás usando Docker para la base de datos
$username = "root"; // Cambia esto si tu usuario no es 'root'
$password = "root"; // Cambia esto por tu contraseña de MySQL
$dbname = "pelikulak_puntuazioa"; // El nombre de tu base de datos

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
        // Verificar si se ha subido una imagen
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
            // Obtener información del archivo
            $fileTmpPath = $_FILES['foto']['tmp_name'];
            $fileName = $_FILES['foto']['name'];
            $fileSize = $_FILES['foto']['size'];
            $fileType = $_FILES['foto']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Validar el tipo de archivo (solo imágenes)
            $allowedExts = array("jpg", "jpeg", "png", "gif");
            if (in_array($fileExtension, $allowedExts)) {
                // Mover el archivo a la carpeta de destino
                $uploadFileDir = '/home/ubuntu/workspace/php_ariketak/src/Entregatzeko ariketak/top_filmak_ariketa/irudiak'; // Asegúrate de que esta carpeta exista
                $dest_path = $uploadFileDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Hash de la contraseña para mayor seguridad
                    $hashed_password = password_hash($pasahitza, PASSWORD_DEFAULT);

                    // Preparar la consulta SQL para insertar los datos
                    $sql = "INSERT INTO Erabiltzaileak (Erabiltzaile_izena, Pasahitza, Argazkia) VALUES (?, ?, ?)";

                    // Preparar la consulta con parámetros para prevenir inyecciones SQL
                    if ($stmt = $conn->prepare($sql)) {
                        $stmt->bind_param("sss", $erabiltzailea, $hashed_password, $fileName); // Almacena el nombre del archivo

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
                } else {
                    echo "Errorea irudia kargatzerakoan.";
                }
            } else {
                echo "Mesedez, hautatu irudi bat (jpg, jpeg, png, gif).";
            }
        } else {
            echo "Mesedez, hautatu irudia.";
        }
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
