<?php
session_start();

// Inizializatu
ob_start();

// Configuración de la conexión a la base de datos
$zerbitzariIzen = "db"; // Zerbitzari izena
$erabiltzailea = "root"; // Erabiltzailea
$pasahitza = "root"; // Pasahitza
$dbIzen = "DatuBasea"; // Datu basearen izena

// Konexioa sortu
$conn = new mysqli($zerbitzariIzen, $erabiltzailea, $pasahitza, $dbIzen);

// Konexioa berifikatu
if ($conn->connect_error) { 
    die("Errorea konexioan: " . $conn->connect_error);//"connect_error" badago, errorearen mezua
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['erabiltzailea']) && !empty($_POST['pasahitza'])) {    //!empty = si no está vacío...
        $erabiltzailea = $_POST['erabiltzailea'];  //'erabiltzailea kasillan sartutako balioa' $erabiltzailea aldagaiean gorde.
        $pasahitza = $_POST['pasahitza'];          //'pasahitza kasillan sartutako balioa' $pasahitza aldagaiean gorde.

        // Kontsulta
        $sql = "SELECT Pasahitza FROM Erabiltzaileak WHERE Erabiltzaile_izena = ?";  // erabiltzailearen pasahitza lortu
        
        // Preparar la consulta con parámetros
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $erabiltzailea); // s --> string
            $stmt->execute();
            $stmt->store_result();
            
            // Verificar si el usuario existe
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($stored_pasahitza);
                $stmt->fetch();

                // Verificar la contraseña
                if (password_verify($pasahitza, $stored_pasahitza)) {
                    $_SESSION['erabiltzailea'] = $erabiltzailea;
                    
                    // Limpiar el buffer de salida antes de redirigir
                    ob_end_clean();
                    header("Location: babesOrri.html"); // Babestutako orrira bideratu
                    exit;
                } else {
                    echo "Login okerra! Saiatu berriro.";
                }
            } else {
                echo "Login okerra! Saiatu berriro.";
            }

            // Cerrar la consulta
            $stmt->close();
        } else {
            echo "Errorea SQL-a prestatzerakoan: " . $conn->error;
        }
    } else {
        echo "Errore bat gertatu da: erabiltzaile izena edo pasahitza hutsik dago.";
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Limpiar el buffer de salida
ob_end_flush();
?>
