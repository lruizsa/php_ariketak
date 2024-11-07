<?php
$servername = "10.14.0.2:8306";  // Nombre del contenedor MariaDB en Docker
$username = "root";
$password = "root";
$dbname = "mydatabase";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully to MariaDB!";
?>
