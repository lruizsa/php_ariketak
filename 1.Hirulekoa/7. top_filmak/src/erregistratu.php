<?php

// Datu baseari konexioa
$servername = "db"; 
$username = "root"; 
$password = "root"; 
$dbname = "pelikulak_puntuazioa"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Errorea konexioan: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $erabiltzailea = $_POST['erabiltzailea'];
    $pasahitza = $_POST['pasahitza'];

    
    if (empty($erabiltzailea) || empty($pasahitza)) {
        echo "Mesedez, sartu erabiltzaile izena eta pasahitza.";
    } else {
        // Hasheatu pasahitza
        $hashed_password = password_hash($pasahitza, PASSWORD_DEFAULT);

        // Kontsulta
        $sql = "INSERT INTO Erabiltzaileak (Erabiltzaile_izena, Pasahitza) VALUES (?, ?)"; // Argazkia ya no se incluye

        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $erabiltzailea, $hashed_password);

            // Kontsulta exekutatu
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->insert_id;
                echo "Erregistroa ondo burutu da!";
               
            } else {
                echo "Errorea datu-basean sartzerakoan: " . $stmt->error;
            }

            
            $stmt->close();
        } else {
            echo "Errorea SQL-a prestatzerakoan: " . $conn->error;
        }
    }
}


$conn->close();
?>
