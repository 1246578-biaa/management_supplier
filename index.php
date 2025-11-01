<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$controller = $_GET['controller'] ?? 'barang';
$action = $_GET['action'] ?? 'index';

$controllerFile = __DIR__ . '/app/controllers/' . $controller . '_controllers.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($controller) . 'Controller';

    if (class_exists($className)) {
        $instance = new $className();
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
