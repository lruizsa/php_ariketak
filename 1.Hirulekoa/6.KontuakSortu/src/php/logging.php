<?php
ob_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Begiratzen da ea gmaila ongi dagoen a la ez
    function validateEmail($email) {
        return !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    

   
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $hashPassword = hash('sha256', $password);

    //echo($hashPassword);


    // Balidazioa
    $errors = [];

    if (!validateEmail($email)) {
        $errors[] = "Invalid email address.";
    }
    

    // Erroreak dauden a la ez
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {


        include_once("config.php");
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $hashPassword);
        //echo $email . "<br>";
        //echo $hashPassword . "<br>";
        
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'"); //SQL eskaera


        if (mysqli_num_rows($result) > 0) {
            $erantzuna = "";
            $first = true; // Bandera para el primer elemento
            while($row = mysqli_fetch_assoc($result)) {
                if (!$first) {
                    $erantzuna .= ";"; // Añade `;` solo si no es el primer elemento
                }
                $erantzuna .= json_encode($row); // Convierte la fila a JSON
                $first = false; // Marca que ya hemos añadido el primer elemento
            }

            setcookie("erabiltzailea", $erantzuna, time() + 3600);
            //echo $erantzuna;

            header('Location:admin.php');
            ob_end_flush();
        } else {
            echo "No se encontraron resultados.";
        }
        

        //$hashedPassword = '$2y$10$mVUx2BHbrqssqNW1xp.YauqeQxQeBXDdW8zLnXNDMoJ.4b5HCu6Wi';

        /*if ($email == "admin@admin.com" && password_verify($password, $hashedPassword)){
            // Guztia ongi egonez gero, erakutsiko du
            echo "Welcome $email <br>";

            setcookie("erabiltzailea", $email, 0);
            header('Location:admin.php');
            ob_end_flush();
        }else{
            echo "Emaila edo pasahitza gaizki sartuta";
        }*/
        
        
    }
}
?>