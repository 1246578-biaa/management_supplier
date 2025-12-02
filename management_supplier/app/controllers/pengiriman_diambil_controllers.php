<?php
require_once __DIR__ . '/../models/pesanan_diambil.php';
require_once __DIR__ . '/../models/supplier.php';
require_once __DIR__ . '/../models/barang.php';

class Pesanan_diambilController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
        if(session_status() === PHP_SESSION_NONE) session_start();
    }

    // INDEX
    public function index() {
        $model = new Pesanan_diambil($this->db);
        $data = $model->getAll();

        $supplierModel = new Supplier($this->db);
        $suppliers = $supplierModel->getAllSupplierDiambil();

        $barangModel = new Barang($this->db);
        $barangs = $barangModel->getAll();

        include __DIR__ . '/../views/pesanan_diambil_views.php';
    }

    // SIMPAN
    public function simpan() {
        $id_supplier = $_POST['id_supplier'] ?? '';
        $tanggal = $_POST['tanggal'] ?? '';
        $id_barang = $_POST['id_barang'] ?? [];
        $jumlah = $_POST['jumlah'] ?? [];

        if (!$id_supplier || !$tanggal) die("Lengkapi semua data.");

        $model = new Pesanan_diambil($this->db);
        $id_pesanan = $model->insertPesanan($id_supplier, $tanggal, $id_barang, $jumlah, 'TOK001');

        if ($id_pesanan) {
            header("Location: index.php?controller=pesanan_diambil&action=index");
            exit;
        } else {
            die("Gagal menyimpan pesanan.");
        }
    }

    // DETAIL
    public function detail() {
        $id = $_GET['id'] ?? '';
        if (!$id) die("ID pesanan tidak valid.");

        $model = new Pesanan_diambil($this->db);
        $pesanan = $model->getOne($id);
        $detail = $model->getDetail($id);

        include __DIR__ . '/../views/pesanan_diambil_detail.php';
    }

    // SELESAI
    public function selesai() {
        $id = $_GET['id'] ?? '';
        if (!$id) die("ID pesanan tidak valid.");

        $model = new Pesanan_diambil($this->db);
        $model->selesaiPesanan($id);

        header("Location: index.php?controller=pesanan_diambil&action=index");
        exit;
    }

    // HAPUS
    public function hapus() {
        $id = $_GET['id'] ?? '';
        if (!$id) die("ID pesanan tidak valid.");

        $model = new Pesanan_diambil($this->db);
        $model->hapusPesanan($id);

        header("Location: index.php?controller=pesanan_diambil&action=index");
        exit;
    }

    // EDIT
    public function edit() {
        $id = $_GET['id'] ?? '';
        if (!$id) die("ID pesanan tidak valid.");

        $model = new Pesanan_diambil($this->db);
        $pesanan = $model->getOne($id);
        $detail = $model->getDetail($id);

        $suppliers = (new Supplier($this->db))->getAllSupplierDiambil();
        $barangs = (new Barang($this->db))->getAll();

        include __DIR__ . '/../views/pesanan_diambil_edit.php';
    }

    // UPDATE
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die("Akses tidak valid.");

        $id_pesanan = $_POST['id_pesanan'];
        $id_supplier = $_POST['id_supplier'];
        $tanggal = $_POST['tanggal'];
        $id_barang = $_POST['id_barang'] ?? [];
        $jumlah = $_POST['jumlah'] ?? [];

        $model = new Pesanan_diambil($this->db);
        $model->updatePesanan($id_pesanan, $id_supplier, $tanggal, $id_barang, $jumlah);

        header("Location: index.php?controller=pesanan_diambil&action=index");
    }
}
?>
