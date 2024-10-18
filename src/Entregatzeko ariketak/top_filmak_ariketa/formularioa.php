<?php
session_start(); 


if (!isset($_SESSION['user_id'])) {
    die("Mesedez, logeatu lehenik."); 
}

$zerbitzari = "db"; 
$erabiltzailea = "root"; 
$pasahitza = "root"; 
$datuBasesa = "pelikulak_puntuazioa"; 


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    
    $conn = new mysqli($zerbitzari, $erabiltzailea, $pasahitza, $datuBasesa);

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isan = isset($_POST['isan']) ? $_POST['isan'] : '';
        $filmIzen = isset($_POST['filmIzen']) ? $_POST['filmIzen'] : '';
        $urtea = isset($_POST['urtea']) ? $_POST['urtea'] : '';
        $puntuazioa = isset($_POST['puntuazioa']) ? $_POST['puntuazioa'] : '';
        $user_id = $_SESSION['user_id'];

        
        if (isset($_POST['datuak'])) {
            
            $sql = "SELECT ISAN, Izena, Urtea, Puntuazioa FROM Pelikulak_puntuazioa WHERE id_erabiltzailea = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            echo '<h2>Egindako bozkaketak:</h2>';
            echo '<table border="1">
                    <tr>
                        <th>ISAN</th>
                        <th>Izena</th>
                        <th>Urtea</th>
                        <th>Puntuazioa</th>
                    </tr>';

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['ISAN']) . "</td>
                            <td>" . htmlspecialchars($row['Izena']) . "</td>
                            <td>" . htmlspecialchars($row['Urtea']) . "</td>
                            <td>" . htmlspecialchars($row['Puntuazioa']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Ez da bozkaketarik aurkitu.</td></tr>";
            }
            echo '</table>';
            echo '<br>';
            echo '<button onclick="atzera()">Itzuli</button>';
            
            $stmt->close();
        } 
        elseif (!empty($isan) && !empty($filmIzen) && !empty($urtea) && !empty($puntuazioa)) {
           
            $sql = "UPDATE Pelikulak_puntuazioa SET Izena = ?, Puntuazioa = ? WHERE ISAN = ? AND id_erabiltzailea = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $filmIzen, $puntuazioa, $isan, $user_id);

            if ($stmt->execute()) {
                echo "Pelikulak ondo eguneratu da!";
                echo '<br>';
                echo '<button onclick="atzera()">Itzuli</button>';
            } else {
                echo "Errorea pelikula eguneratzerakoan: " . $stmt->error;
            }

            $stmt->close();
        } 
        elseif(!empty($isan) && empty($filmIzen) && isset($_POST['ezabatu'])) {
            
            $sql_delete_boztatu = "DELETE FROM Bozkatu WHERE ISAN = ? AND id_erabiltzailea = ?";
            $stmt_boztatu = $conn->prepare($sql_delete_boztatu);
            $stmt_boztatu->bind_param("si", $isan, $user_id);
            $stmt_boztatu->execute();
            $stmt_boztatu->close();

            
            $sql = "DELETE FROM Pelikulak_puntuazioa WHERE ISAN = ? AND id_erabiltzailea = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $isan, $user_id);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "Pelikulak ezabatu egin da!";
                } else {
                    echo "Ez da pelikula ezabatu; ISAN edo erabiltzaile ID okerra.";
                }
                echo '<br>';
                echo '<button onclick="atzera()">Itzuli</button>';
            } else {
                echo "Errorea pelikula ezanatzean: " . $stmt->error;
            }
            $stmt->close();
        }
        elseif (empty($isan) && !empty($filmIzen) && isset($_POST['izena'])) {
            // Búsqueda de películas por nombre
            $sql = "SELECT ISAN, Izena, Urtea, Puntuazioa FROM Pelikulak_puntuazioa WHERE LOWER(Izena) = LOWER(?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $filmIzen);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h2>" . htmlspecialchars($filmIzen) . " izenarekin aurkitutako pelikulak:</h2>";
                echo '<table border="1">
                        <tr>
                            <th>ISAN</th>
                            <th>Izena</th>
                            <th>Urtea</th>
                            <th>Puntuazioa</th>
                        </tr>';

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['ISAN']) . "</td>
                            <td>" . htmlspecialchars($row['Izena']) . "</td>
                            <td>" . htmlspecialchars($row['Urtea']) . "</td>
                            <td>" . htmlspecialchars($row['Puntuazioa']) . "</td>
                          </tr>";
                }
                echo "</table><br>";
                echo '<button onclick="atzera()">Itzuli</button>';
            } else {
                echo "Ez da filmik aurkitu izen horrekin.";
            }

            $stmt->close();
        } 
        elseif (empty($isan) || empty($filmIzen) || empty($urtea) || empty($puntuazioa)) {
            echo "Datu guztiak bete behar dira.";
        } else {
            // Insertar nueva puntuación en la base de datos
            $sql = "INSERT INTO Pelikulak_puntuazioa (ISAN, Izena, Urtea, id_erabiltzailea, Puntuazioa) VALUES (?, ?, ?, ?, ?)";
            $sql2 = "INSERT INTO Bozkatu (ISAN, id_erabiltzailea) VALUES (?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssii", $isan, $filmIzen, $urtea, $user_id, $puntuazioa);
            $stmt->execute();
            echo "Puntuazioa ondo sartu da!";

            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("si", $isan, $user_id);
            $stmt2->execute();
            echo "Bozkatu ondo sartu da!";

            $stmt->close();
            $stmt2->close();
        }
    }

    
    $conn->close();

} catch (mysqli_sql_exception $e) {
    echo "Errore bat gertatu da datuak sartzerakoan: " . htmlspecialchars($e->getMessage()) . "<br><br>"; 
    echo '<button onclick="atzera()">Itzuli</button>';
}
?>

<script>
    function atzera() {
        window.history.back();
    }
</script>
