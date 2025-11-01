<?php
require_once __DIR__ . '/../models/supplier.php';
require_once __DIR__ . '/../config/database.php';

class SupplierController {
    public function index() {
        $database = new Database();
        $db = $database->getConnection();

        $supplier = new Supplier($db);
        $stmt = $supplier->readAll();

        include __DIR__ . '/../views/supplier_views.php';
    }
}
