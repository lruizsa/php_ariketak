<html>
<body>

<?php

$izenErrore = "";
$emailErrore = "";
$izena = "";
$email = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    if (empty($_POST["name"])) {
        $izenErrore = "Izena idatzi behar da";
        echo "<script>alert('Izena idatzi behar da');</script>";
    } else {
        $izena = htmlspecialchars($_POST["name"]);
    }

    
    if (empty($_POST["email"])) {
        $emailErrore = "Emaila idatzi behar da";
        echo "<script>alert('Emaila idatzi behar da');</script>";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErrore = "Emaila ez da zuzena";
        echo "<script>alert('Emaila ez da zuzena');</script>";
    } else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if (empty($_POST["telefonoa"]))

}

?>

Kaixo <?php echo $izena; ?><br><br>

Hauek dira zure datuak:<br>

Izena: <?php echo $izena; ?>
<?php if ($izenErrore): ?>
    <span style="color:red;"><?php echo $izenErrore; ?></span>
<?php endif; ?>
<br>

Zure emaila: <?php echo $email; ?>
<?php if ($emailErrore): ?>
    <span style="color:red;"><?php echo $emailErrore; ?></span><br>
<?php endif; ?>

Telefono zenbakia: <?php echo htmlspecialchars($_POST["telefonoa"] ?? ''); ?><br>

Probintzia: <?php echo htmlspecialchars($_POST["probintzia"] ?? ''); ?><br>

Generoa: <?php echo htmlspecialchars($_POST["generoa"] ?? ''); ?><br>

Iruzkina: <?php echo htmlspecialchars($_POST["iruzkina"] ?? ''); ?><br>

</body>
</html>
