<?php
session_start(); 

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

    
    $sql = "SELECT id_erabiltzailea, Pasahitza FROM Erabiltzaileak WHERE Erabiltzaile_izena = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $erabiltzailea);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            
            if (password_verify($pasahitza, $hashed_password)) {
                
                $_SESSION['user_id'] = $user_id;

                header("Location: formularioa.html");
                exit;
            } else {
                echo "Pasahitza ez da zuzena.";
            }
        } else {
            echo "<span style='color: red;'>Erabiltzailea ez da existitzen.<br></span>";
            echo "<input type='button' value='Atzera' onclick=\"window.location.href='login.html';\">";
        }
        $stmt->close();
    } else {
        echo "Errorea SQL prestatzerakoan: " . $conn->error;
    }
}

$conn->close();
?>
