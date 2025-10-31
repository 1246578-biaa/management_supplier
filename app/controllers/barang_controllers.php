<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/barang.php';

class BarangController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();

        $barang = new Barang($db);
        $stmt = $barang->readAll();

        include __DIR__ . '/../views/barang_views.php';
    }
}
?>
