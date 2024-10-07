<?php
$password = 'leire123'; // La contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hashear la contraseña
echo $hashed_password; // Muestra el hash
?>
