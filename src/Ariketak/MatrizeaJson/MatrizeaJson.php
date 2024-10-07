<?php
// Multidimensional array-a definitu
$data = [
    ['Izena' => 'Ane', 'Adina' => 25, 'Hiriburua' => 'Bilbao'],
    ['Izena' => 'Iñaki', 'Adina' => 30, 'Hiriburua' => 'Donostia'],
    ['Izena' => 'Marta', 'Adina' => 22, 'Hiriburua' => 'Gasteiz'],
];

// JSON formatuan konbertitu
$jsonData = json_encode($data, JSON_PRETTY_PRINT);

// JSON-a inprimatu
header('Content-Type: application/json');
echo $jsonData;
?>