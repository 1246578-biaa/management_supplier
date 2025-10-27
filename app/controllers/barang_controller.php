<?php
include_once "./model/barang.php";

class barang_controller {
    private $model;

    public function __construct($db) {
        $this->model = new barang.php($db);
    }

    public function index() {
        $data = $this->model->getAllBarang();
        include "./view/barangView.php";
    }

    public function add($id_barang$nama_barang, $stok, $harga, $kondisi_barang) {
        $this->model->addBarang($id_barang,$nama_barang, $stok, $harga, $kondisi_barang);
        header("Location: landing.php"); // refresh halaman
    }
}
?>

