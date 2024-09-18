
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./cssmatrizea.css">
    </head>
<body>
    <table>
        <tr>
            <th>Izena</th>
            <th>Urtea</th>
            <th>Kolorea</th>
        </tr>
        <?php

            $kotxe = array (
                array("Volvo",2000,"Urdina"),
                array("BMW",2012,"Berdea"),
                array("Saab",2023,"Gorria"),
                array("Land Rover",2017,"Berdea")
            );

            for ($erren = 0; $erren < 4; $erren++) {
                echo "<tr>";

                for ($zutabe = 0; $zutabe < 3; $zutabe++) {
                echo "<td>";
                    echo $kotxe[$erren][$zutabe];
                echo "</td>";

                }
                echo "</tr>";
            }

        ?>
    </table>
</body>
</html>