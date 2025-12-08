<?php
require_once __DIR__.'/../models/pesanan_dikirim.php';
require_once __DIR__.'/../models/supplier.php';
require_once __DIR__.'/../models/barang.php';

class Pesanan_dikirimController {
    private $db;
    private $role;

    public function __construct($db){
        $this->db = $db;
        if(session_status()===PHP_SESSION_NONE) session_start();

        if(!isset($_SESSION['admin'])) die("Akses ditolak.");
        $this->role = $_SESSION['admin']['role'] ?? 'owner';
    }

    // ======================
    // INDEX
    // ======================
    public function index(){
        $model = new Pesanan_dikirim($this->db);
        $data = $model->getAll();
        $suppliers = (new Supplier($this->db))->getAllSupplierDikirim();
        $barangs = (new Barang($this->db))->getAll();

        $role = $this->role;
        include __DIR__.'/../views/pesanan_dikirim_views.php';
    }

    // ======================
    // SIMPAN
    // ======================
    public function simpan(){
        if($this->role != 'admin') die("Akses tidak diizinkan.");

        $id_supplier = $_POST['id_supplier'] ?? '';
        $tanggal = $_POST['tanggal'] ?? '';
        $id_toko = $_POST['id_toko'] ?? 'TOK001';
        $id_barang = $_POST['id_barang'] ?? [];
        $jumlah = $_POST['jumlah'] ?? [];

        if(!$id_supplier || !$tanggal) die("Lengkapi semua data.");

        $model = new Pesanan_dikirim($this->db);
        $id_pesanan = $model->insertPesanan($id_supplier, $tanggal, $id_barang, $jumlah, $id_toko);

        if($id_pesanan){
            header("Location:index.php?controller=pesanan_dikirim&action=index");
            exit;
        } else die("Gagal menyimpan pesanan.");
    }

    // ======================
    // DETAIL
    // ======================
    public function detail(){
        $id = $_GET['id'] ?? '';
        if(!$id) die("ID pesanan tidak valid.");

        $model = new Pesanan_dikirim($this->db);
        $pesanan = $model->getOne($id);
        $detail = $model->getDetail($id);

        $role = $this->role;
        include __DIR__.'/../views/pesanan_dikirim_detail.php';
    }

    // ======================
    // SELESAI
    // ======================
    public function selesai(){
        if($this->role != 'admin') die("Akses tidak diizinkan.");

        $id = $_GET['id'] ?? '';
        if(!$id) die("ID pesanan tidak valid.");

        $model = new Pesanan_dikirim($this->db);
        $model->selesaiPesanan($id);

        header("Location:index.php?controller=pesanan_dikirim&action=index");
        exit;
    }

    // ======================
    // HAPUS
    // ======================
    public function hapus(){
        if($this->role != 'admin') die("Akses tidak diizinkan.");

        $id = $_GET['id'] ?? '';
        if(!$id) die("ID pesanan tidak valid.");

        $model = new Pesanan_dikirim($this->db);
        $model->hapusPesanan($id);

        header("Location:index.php?controller=pesanan_dikirim&action=index");
        exit;
    }

    // ======================
    // EDIT
    // ======================
    public function edit(){
        if($this->role != 'admin') die("Akses tidak diizinkan.");

        $id = $_GET['id'] ?? '';
        if(!$id) die("ID pesanan tidak valid.");

        $model = new Pesanan_dikirim($this->db);
        $pesanan = $model->getOne($id);
        $detail = $model->getDetail($id);

        $suppliers = (new Supplier($this->db))->getAllSupplierDikirim();
        $barangs = (new Barang($this->db))->getAll();

        $role = $this->role;
        include __DIR__.'/../views/pesanan_dikirim_edit.php';
    }

    // ======================
    // UPDATE
    // ======================
    public function update(){
        if($this->role != 'admin') die("Akses tidak diizinkan.");
        if($_SERVER['REQUEST_METHOD'] !== 'POST') die("Akses tidak valid.");

        $id_pesanan = $_POST['id_pesanan'];
        $id_supplier = $_POST['id_supplier'];
        $tanggal = $_POST['tanggal'];
        $id_toko = $_POST['id_toko'] ?? 'TOK001';
        $id_barang = $_POST['id_barang'] ?? [];
        $jumlah = $_POST['jumlah'] ?? [];

        $model = new Pesanan_dikirim($this->db);
        $model->updatePesanan($id_pesanan, $id_supplier, $tanggal, $id_barang, $jumlah, $id_toko);

        header("Location:index.php?controller=pesanan_dikirim&action=index");
        exit;
    }
}
?>
