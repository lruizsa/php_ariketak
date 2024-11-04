<?php

//Datu baseari konexioa
$zerbitzariIzena = "db";
$erabiltzailea = "root";
$pasahitza = "root";
$dbIzena ="meteorologia";

$conn = new mysqli($zerbitzariIzena,$erabiltzailea,$pasahitza,$dbIzena);

if($conn -> connect_error){
    die("Errorea konexioan".$conn -> connect_error);
}

?>