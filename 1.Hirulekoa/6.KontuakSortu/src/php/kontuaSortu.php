<?php
ob_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("config.php");
    // Begiratzen da ea izena ongi dagoen a la ez
    function validateName($userName) {
        return !empty($userName) && preg_match("/^[a-zA-Z\s]+$/", $userName);
    }

    function existUserName($userName) {
        global $conn;
        $userName = mysqli_real_escape_string($conn, $userName);
        $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$userName'");
        return mysqli_num_rows($result) <= 0;
    }

    // Begiratzen da ea gmaila ongi dagoen a la ez
    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    function existEmail($email) {
        global $conn;
        $email = mysqli_real_escape_string($conn, $email);
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        return mysqli_num_rows($result) <= 0;
    }


    

    $userName = htmlspecialchars($_POST["userName"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $hashPassword = hash('sha256', $password);


    // Balidazioa
    $errors = [];
    
    if (!validateName($userName)) {
        $errors[] = "Invalid userName. Only letters and spaces are allowed.";
    }
    if (!existUserName($userName)) {
        $errors[] = "Erabiltzailea existitzen da.";
    }
    if (!existEmail($email)) {
        $errors[] = "Emaila existitzen da.";
    }
    if (!validateEmail($email)) {
        $errors[] = "Invalid email address.";
    }

    // Erroreak dauden a la ez
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else{
        $userName = mysqli_real_escape_string($conn, $userName);
        $email = mysqli_real_escape_string($conn, $email);
        $hashPassword = mysqli_real_escape_string($conn, $hashPassword);
        $result = mysqli_query($conn, "INSERT INTO users (username, email, password, avatar) VALUES ('$userName', '$email', '$hashPassword', 'uploads/$userName')");
    }




    



}



if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
    //echo "kaixoaaaaaaaaaa";
    $target_dir = "../uploads/";  // Ruta absoluta al directorio 'uploads/'
    //echo $target_dir;

    // Obtén la extensión del archivo subido
    $fileType = strtolower(pathinfo($_FILES["fileUpload"]["name"], PATHINFO_EXTENSION));

    // Define el nombre del archivo como el nombre de usuario + la extensión original
    $target_file = $target_dir . $userName . "." . $fileType;

    // Verifica si el archivo ya existe
    if (file_exists($target_file)) {
        //echo "Sorry, the file already exists.<br>";
    } else {
        // Mueve el archivo subido a la carpeta deseada con el nuevo nombre
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            //echo "The file for user " . htmlspecialchars($userName) . " has been uploaded as $target_file.<br>";
        } else {
            //echo "Sorry, there was an error uploading your file.<br>";
        }
    }
} else {
    //echo "No file was uploaded or there was an error during upload.<br>";
}




header('Location: ../index.html');
//exit();


?>
