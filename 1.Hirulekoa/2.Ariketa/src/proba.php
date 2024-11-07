<?php
// Crear una matriz de puntos tridimensionales
$puntos3D = [
    [10, 20, 30],
    [100, 20, 30],
    [100, 110, 30],
    [10, 110, 30],
    [10, 20, 120],
    [100, 20, 120],
    [100, 110, 120],
    [10, 110, 120]
];

// Función para rotar un punto alrededor del eje X
function rotarX($punto, $angulo) {
    $rad = deg2rad($angulo);
    $x = $punto[0];
    $y = $punto[1] * cos($rad) - $punto[2] * sin($rad);
    $z = $punto[1] * sin($rad) + $punto[2] * cos($rad);
    return [$x, $y, $z];
}

// Función para rotar un punto alrededor del eje Y
function rotarY($punto, $angulo) {
    $rad = deg2rad($angulo);
    $x = $punto[0] * cos($rad) + $punto[2] * sin($rad);
    $y = $punto[1];
    $z = -$punto[0] * sin($rad) + $punto[2] * cos($rad);
    return [$x, $y, $z];
}

// Función para rotar un punto alrededor del eje Z
function rotarZ($punto, $angulo) {
    $rad = deg2rad($angulo);
    $x = $punto[0] * cos($rad) - $punto[1] * sin($rad);
    $y = $punto[0] * sin($rad) + $punto[1] * cos($rad);
    $z = $punto[2];
    return [$x, $y, $z];
}

// Crear una imagen
$ancho = 800; // Ampliado para una mejor visualización
$alto = 700;  // Ampliado para una mejor visualización
$imagen = imagecreatetruecolor($ancho, $alto);

// Colores
$fondo = imagecolorallocate($imagen, 255, 255, 255); // Blanco
$puntoColor = imagecolorallocate($imagen, 0, 0, 0); // Negro
$lineaColor = imagecolorallocate($imagen, 0, 0, 255); // Azul para las líneas

// Llenar el fondo
imagefill($imagen, 0, 0, $fondo);

// Parámetros de proyección
$distancia = 500; // Distancia de la cámara
$escala = 1000;    // Factor de escala para la proyección

// Ángulos de rotación
$anguloX = 30; // Rotación alrededor del eje X
$anguloY = 45; // Rotación alrededor del eje Y
$anguloZ = 60; // Rotación alrededor del eje Z

// Arreglo para almacenar los puntos proyectados
$puntos2D = [];

// Aplicar rotaciones y proyección
foreach ($puntos3D as $punto) {
    // Aplicar rotación en los ejes X, Y y Z
    $punto = rotarX($punto, $anguloX);
    $punto = rotarY($punto, $anguloY);
    $punto = rotarZ($punto, $anguloZ);

    // Proyección en perspectiva
    $x2D = $ancho / 2 + ($punto[0] * $escala) / ($punto[2] + $distancia);
    $y2D = $alto / 2 - ($punto[1] * $escala) / ($punto[2] + $distancia);

    // Guardar el punto proyectado
    $puntos2D[] = [intval($x2D), intval($y2D)];

    // Dibujar el punto
    imagesetpixel($imagen, intval($x2D), intval($y2D), $puntoColor);
}

// Dibujar líneas entre los puntos (conectando los puntos del cubo)
$conexiones = [
    [0, 1], [1, 2], [2, 3], [3, 0], // Base inferior
    [4, 5], [5, 6], [6, 7], [7, 4], // Base superior
    [0, 4], [1, 5], [2, 6], [3, 7]  // Conectar bases
];

foreach ($conexiones as $conexion) {
    $x1 = $puntos2D[$conexion[0]][0];
    $y1 = $puntos2D[$conexion[0]][1];
    $x2 = $puntos2D[$conexion[1]][0];
    $y2 = $puntos2D[$conexion[1]][1];
    imageline($imagen, $x1, $y1, $x2, $y2, $lineaColor);
}

// Guardar la imagen
header('Content-Type: image/png');
imagepng($imagen);
imagedestroy($imagen);
?>
