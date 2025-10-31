<?php
// Ambil controller dan action dari URL (default: barang/index)
$controller = $_GET['controller'] ?? 'barang';
$action = $_GET['action'] ?? 'index';

// Path file controller
$controllerFile = __DIR__ . '/app/controllers/' . $controller . '_controllers.php';

// Cek apakah file controller ada
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Bentuk nama class controller (contoh: barang → BarangController)
    $className = ucfirst($controller) . 'Controller';

    // Cek apakah class ada di dalam file controller
    if (class_exists($className)) {
        $instance = new $className();

        // Jalankan method action (contoh: index)
        if (method_exists($instance, $action)) {
            $instance->$action();
        } else {
            echo "<p style='color:red'>❌ Method '$action' tidak ditemukan di controller '$className'.</p>";
        }
    } else {
        echo "<p style='color:red'>❌ Class controller '$className' tidak ditemukan.</p>";
    }
} else {
    echo "<p style='color:red'>❌ File controller '$controllerFile' tidak ditemukan.</p>";
}
?>
