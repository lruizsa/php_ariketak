<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Begiratzen da ea izena ongi dagoen a la ez
    function validateName($name) {
        return !empty($name) && preg_match("/^[a-zA-Z\s]+$/", $name);
    }

    // Begiratzen da ea gmaila ongi dagoen a la ez
    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Begiratzen da ea webgunea ongi dagoen a la ez
    function validateWebsite($website) {
        return filter_var($website, FILTER_VALIDATE_URL);
    }

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $website = htmlspecialchars($_POST["website"]);
    $password = htmlspecialchars($_POST["password"]);
    $comment = htmlspecialchars($_POST["comment"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $taskOption = htmlspecialchars($_POST["taskOption"]);

    // Balidazioa
    $errors = [];
    
    if (!validateName($name)) {
        $errors[] = "Invalid name. Only letters and spaces are allowed.";
    }
    if (!validateEmail($email)) {
        $errors[] = "Invalid email address.";
    }
    if (!validateWebsite($website)) {
        $errors[] = "Invalid website URL.";
    }

    // Erroreak dauden a la ez
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // Guztia ongi egonez gero, erakutsiko du
        echo "Welcome $name <br>";
        echo "Your email address is: $email <br>";
        echo "Your password is: $password <br>";
        echo "Your website is: $website <br>";
        echo "Your comment is: $comment <br>";
        echo "Your gender is: $gender <br>";
        echo "Your option was: $taskOption <br>";
    }
}



if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verifica si el archivo ya existe
    echo "<img src='uploads/" . htmlspecialchars(basename($_FILES["fileUpload"]["name"])) . "'>";


    // Begiratzen ea dagoen 
    if (file_exists($target_file)) {
        //echo "Sorry, the file already exists.<br>";
    } else {
        // Intenta mover el archivo subido al directorio deseado
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". htmlspecialchars(basename($_FILES["fileUpload"]["name"])) . " has been uploaded.<br>";
            
        } else {
            //echo "Sorry, there was an error uploading your file.<br>";
            echo "<img src='uploads/" . htmlspecialchars(basename($_FILES["fileUpload"]["name"])) . "'>";
        }
    }
} else {
    echo "No file was uploaded or there was an error during upload.<br>";
}

?>
