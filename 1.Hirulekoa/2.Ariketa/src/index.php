<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <?php

    $matriz = array(
        array("Sweet Little Sister", "Skid Row", "Skid Row"),
        array("Symphony Of Destruction", "Countdown to Extinction", "Megadeth"),
        array("The Beautiful People", "Antichrist Superstar", "Marilyn Manson"),
        array("Tainted Love", "Not Another Teen Movie", "Marilyn Manson")
    );

    impForeach($matriz);

    function impFor($matriz) {
        echo("<table border='2'>");
        echo("<tr>");
        echo("<th>Abestia</th>");
        echo("<th>Albuma</th>");
        echo("<th>Taldea</th>");
        echo("</tr>"); 
        $fila = count($matriz);
        $kol = count($matriz[0]);

        for ($i = 0; $i < $fila; $i++) {
            echo("<tr>");
            for ($e = 0; $e < $kol; $e++) {
                echo("<td>" . $matriz[$i][$e] . "</td>"); 
            }
            echo("</tr>"); 
        }

        echo("</table>"); 
    }

    function impForeach($matriz) {
        echo("<table border='2'>");
        echo("<tr>");
        echo("<th>Abestia</th>");
        echo("<th>Albuma</th>");
        echo("<th>Taldea</th>");
        echo("</tr>"); 
        

        foreach ($matriz as $fila) {
            echo("<tr>");
            foreach ($fila as $kol) {
                echo("<td>" . $kol . "</td>"); 
            }
            echo("</tr>"); 
        }

        echo("</table>"); 
    }

    ?>



</body>
</html>

