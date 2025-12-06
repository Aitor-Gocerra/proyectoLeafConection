<?php
// Archivo de debug para ver errores en el hosting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Debug Admin Section</h1>";

// Test 1: Verificar que PHP funciona
echo "<h2>Test 1: PHP funciona ✓</h2>";

// Test 2: Verificar la ruta de config.php
echo "<h2>Test 2: Verificar archivo config.php</h2>";
$configPath = 'php/config/config.php';
if (file_exists($configPath)) {
    echo "✓ config.php existe en: " . realpath($configPath) . "<br>";
    require_once $configPath;
    echo "✓ config.php cargado correctamente<br>";
    echo "DEF_CONTROLLER: " . DEF_CONTROLLER . "<br>";
    echo "DEF_METHOD: " . DEF_METHOD . "<br>";
} else {
    echo "❌ config.php NO existe en: $configPath<br>";
}

// Test 3: Verificar la ruta del controlador
echo "<h2>Test 3: Verificar controlador por defecto</h2>";
$rutaControlador = RUTA_CONTROLADORES . DEF_CONTROLLER . '.php';
echo "Ruta del controlador: $rutaControlador<br>";

if (file_exists($rutaControlador)) {
    echo "✓ Controlador existe en: " . realpath($rutaControlador) . "<br>";
    require_once $rutaControlador;
    echo "✓ Controlador cargado correctamente<br>";

    // Test 4: Verificar que se puede instanciar
    echo "<h2>Test 4: Instanciar controlador</h2>";
    $controlador = 'C' . DEF_CONTROLLER;
    echo "Nombre de clase: $controlador<br>";

    try {
        $objControlador = new $controlador();
        echo "✓ Controlador instanciado correctamente<br>";

        // Test 5: Verificar método
        echo "<h2>Test 5: Verificar método</h2>";
        if (method_exists($objControlador, DEF_METHOD)) {
            echo "✓ Método '" . DEF_METHOD . "' existe<br>";

            // Test 6: Ejecutar método
            echo "<h2>Test 6: Ejecutar método</h2>";
            try {
                $datos = $objControlador->{DEF_METHOD}();
                echo "✓ Método ejecutado correctamente<br>";
                echo "Vista: " . $objControlador->vista . "<br>";
            } catch (Exception $e) {
                echo "❌ Error al ejecutar método: " . $e->getMessage() . "<br>";
                echo "Stack trace:<br><pre>" . $e->getTraceAsString() . "</pre>";
            }
        } else {
            echo "❌ Método '" . DEF_METHOD . "' NO existe<br>";
        }
    } catch (Exception $e) {
        echo "❌ Error al instanciar controlador: " . $e->getMessage() . "<br>";
        echo "Stack trace:<br><pre>" . $e->getTraceAsString() . "</pre>";
    }
} else {
    echo "❌ Controlador NO existe en: $rutaControlador<br>";
}

echo "<hr><p><strong>Si llegas hasta aquí sin errores, el problema está en otro lado.</strong></p>";
?>