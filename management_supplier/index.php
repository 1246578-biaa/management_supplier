<?php
session_start();

// Tampilkan semua error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ---- Koneksi Database ----
require_once __DIR__ . '/app/config/database.php';
$database = new Database();
$db = $database->getConnection();

// Ambil controller & action dari query string
$controller = $_GET['controller'] ?? '';
$action = $_GET['action'] ?? 'index';

// Jika controller kosong → tampilkan landing
if ($controller == '') {
    include __DIR__ . '/landing/index.php';
    exit;
}

// Path file controller
$controllerFile = __DIR__ . '/app/controllers/' . $controller . '_controllers.php';

// Cek apakah file controller ada
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Nama class controller
    $className = ucfirst($controller) . 'Controller';

    if (class_exists($className)) {

        // ---- Buat instance controller, kirim $db ----
        $instance = new $className($db);

        // Cek apakah method/action ada di controller
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
