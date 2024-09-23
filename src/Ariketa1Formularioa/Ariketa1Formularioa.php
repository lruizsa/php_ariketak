<html>
<body>

<?php

$izenErrore = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["name"])) {
        $izenErrore = "Izena idatzi behar da";
        
        echo "<script>alert('Izena idatzi behar da');</script>";
    } else {
        $name = htmlspecialchars($_GET["name"]);
    }
}

?>

Kaixo <?php echo htmlspecialchars($_GET["name"] ?? ''); ?><br><br>

Hauek dira zure datuak:<br>

Izena: <?php echo htmlspecialchars($_GET["name"] ?? ''); ?>

<?php if ($izenErrore): ?>
    <span style="color:red;"><?php echo $izenErrore; ?></span>
<?php endif; ?>
<br>

Zure emaila: <?php echo htmlspecialchars($_GET["email"] ?? ''); ?><br>

Telefono zenbakia: <?php echo htmlspecialchars($_GET["telefonoa"] ?? ''); ?><br>

Probintzia: <?php echo htmlspecialchars($_GET["probintzia"] ?? ''); ?><br>

Generoa: <?php echo htmlspecialchars($_GET["generoa"] ?? ''); ?><br>

Iruzkina: <?php echo htmlspecialchars($_GET["iruzkina"] ?? ''); ?><br>

Fitxategia igo: 

</body>
</html>
