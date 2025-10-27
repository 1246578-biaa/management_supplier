<?php
require_once 'app/model/Supplier.php';

class SupplierController {
    public function index() {
        $supplier = new Supplier();
        $data = $supplier->tampilkanSemua();
        include 'app/view/supplier_view.php';
    }
}
?>
