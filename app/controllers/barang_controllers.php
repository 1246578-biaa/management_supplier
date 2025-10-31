<?php
require_once __DIR__ . '/../models/barang.php';

class barang_controllers {
    private $model;

    public function __construct() {
        $this->model = new barang();
    }

    public function tampilBarang() {
        return $this->model->getAllBarang();
    }
}
?>

