<?php
require_once __DIR__ . '/../models/return_to.php';

class return_toController {
    private $db;
    private $model;

    public function __construct($db) {
        $this->db = $db;
        $this->model = new return_to($db);
        if(session_status() === PHP_SESSION_NONE) session_start();
    }

    // ===============================
    // CEK ROLE ADMIN
    // ===============================
    private function checkAdmin() {
        if(!isset($_SESSION['admin']['role']) || $_SESSION['admin']['role'] !== 'admin') {
            die("Akses ditolak. Hanya admin yang bisa melakukan aksi ini.");
        }
    }

    // ===============================
    // INDEX - UNTUK SEMUA USER
    // ===============================
    public function index() {
        $data = $this->model->getall();
        $suppliers = $this->model->getsuppliers();
        $barangs   = $this->model->getbarangs();
        include __DIR__ . '/../views/return_to_views.php';
    }

    // ===============================
    // SIMPAN - ADMIN
    // ===============================
    public function simpan() {
        $this->checkAdmin(); // batasi akses

        if($_SERVER['REQUEST_METHOD'] !== 'POST') die("akses tidak valid");

        $data = [
            'id_supplier'    => $_POST['id_supplier'] ?? '',
            'id_barang'      => $_POST['id_barang'] ?? '',
            'jumlah'         => $_POST['jumlah'] ?? 0,
            'alasan'         => $_POST['alasan'] ?? '',
            'tanggal_return' => $_POST['tanggal_return']
        ];

        try {
            $this->model->insert($data);
            header("Location: index.php?controller=return_to&action=index");
            exit;
        } catch(Exception $e) {
            die("Gagal menyimpan return: " . $e->getMessage());
        }
    }

    // ===============================
    // HAPUS - ADMIN
    // ===============================
    public function hapus() {
        $this->checkAdmin(); // batasi akses

        $id = $_GET['id'] ?? '';
        if(!$id) die("ID return tidak valid");

        $this->model->delete($id);
        header("Location: index.php?controller=return_to&action=index");
        exit;
    }

    // ===============================
    // EDIT - ADMIN
    // ===============================
    public function edit() {
        $this->checkAdmin(); // batasi akses

        $id = $_GET['id'] ?? '';
        if(!$id) die("ID return tidak valid");

        $data = $this->model->getbyid($id);
        $suppliers = $this->model->getsuppliers();
        $barangs   = $this->model->getbarangs();
        include __DIR__ . '/../views/return_to_edit.php';
    }

    // ===============================
    // UPDATE - ADMIN
    // ===============================
    public function update() {
        $this->checkAdmin(); // batasi akses

        if($_SERVER['REQUEST_METHOD'] !== 'POST') die("akses tidak valid");

        $id = $_POST['id_return'] ?? '';
        if(!$id) die("ID return tidak valid");

        $data = [
            'id_supplier'    => $_POST['id_supplier'] ?? '',
            'id_barang'      => $_POST['id_barang'] ?? '',
            'jumlah'         => $_POST['jumlah'] ?? 0,
            'alasan'         => $_POST['alasan'] ?? '',
            'tanggal_return' => $_POST['tanggal_return']
        ];

        $this->model->update($id, $data);
        header("Location: index.php?controller=return_to&action=index");
        exit;
    }
}
?>
