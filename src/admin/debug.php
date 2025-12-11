<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Step 1: PHP funciona ✓<br><br>";

// Step 2: Verificar ruta actual
echo "Step 2: Directorio actual<br>";
echo "getcwd(): " . getcwd() . "<br>";
echo "__DIR__: " . __DIR__ . "<br>";
echo "__FILE__: " . __FILE__ . "<br><br>";

// Step 3: Verificar si existe config.php
echo "Step 3: Verificar config.php<br>";
$configFile = 'php/config/config.php';
echo "Buscando: $configFile<br>";
echo "file_exists(): " . (file_exists($configFile) ? 'SÍ' : 'NO') . "<br>";

if (file_exists($configFile)) {
    echo "realpath(): " . realpath($configFile) . "<br>";
} else {
    echo "❌ NO EXISTE. Listando archivos en php/:<br>";
    if (is_dir('php')) {
        $files = scandir('php');
        echo "<pre>" . print_r($files, true) . "</pre>";

        if (is_dir('php/config')) {
            echo "Listando archivos en php/config/:<br>";
            $configFiles = scandir('php/config');
            echo "<pre>" . print_r($configFiles, true) . "</pre>";
        } else {
            echo "❌ El directorio php/config NO EXISTE<br>";
        }
    } else {
        echo "❌ El directorio php NO EXISTE<br>";
    }
}

echo "<br>Step 4: Intentar cargar config.php<br>";
if (file_exists($configFile)) {
    try {
        require_once $configFile;
        echo "✓ config.php cargado<br>";
        echo "RUTA_CONTROLADORES: " . RUTA_CONTROLADORES . "<br>";
        echo "DEF_CONTROLLER: " . DEF_CONTROLLER . "<br>";
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ Saltando carga porque no existe<br>";
}
?>



