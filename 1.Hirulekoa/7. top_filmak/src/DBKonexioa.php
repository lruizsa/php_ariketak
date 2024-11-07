<?php

$zerbitzaria = "db";
$erabiltzailea = "root";
$pasahitza = "root";

// Konexioa sortu
$conn = new mysqli($zerbitzaria,$erabiltzailea,$pasahitza);

//Konexioa ongi egin den konprobatu
if($conn->connect_error){
    die("Errorea konexioa egitean: ".$conn->connect_error);
}

//Konexioa egin ondoren:

//1.Datuak formulariotik hartu-->
$erabiltzailea = $_POST['erabiltzailea'];
$isan = $_POST['isan'];
$urtea = $_POST['urtea'];
$puntuazioa = $_POST['combobox'];

//2. sql kontsulta egin, kasu onetan insert bat -->
$insert = "INSERT INTO pelikulak_puntuazioa(Isan, Izena, Urtea, Puntuazioa) VALUES (?, ?, ?, ?)";"

?>