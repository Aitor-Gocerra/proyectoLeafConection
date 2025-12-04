<?php
// API para obtener la palabra correcta del día
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../modelos/mPalabra.php';

try {
    $palabraMod = new Palabra();
    $palabra = $palabraMod->mostrarPalabra();

    if ($palabra) {
        $idPalabra = $palabra['idPalabra'];
        $correcta = $palabraMod->palabraCorrecta($idPalabra);

        // Devolvemos solo la palabra correcta (sin la definición para no hacer trampa)
        echo json_encode([
            'success' => true,
            'palabra' => $correcta['palabra'] ?? null,
            'idPalabra' => $idPalabra
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'No hay palabra programada para hoy'
        ]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Error al obtener la palabra: ' . $e->getMessage()
    ]);
}
?>