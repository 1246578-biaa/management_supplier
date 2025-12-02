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

    public function index() {
        $data = $this->model->getall();
        $suppliers = $this->model->getsuppliers();
        $barangs   = $this->model->getbarangs();
        include __DIR__ . '/../views/return_to_views.php';
    }

    public function simpan() {
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
            die("gagal menyimpan return: " . $e->getMessage());
        }
    }

    public function hapus() {
        $id = $_GET['id'] ?? '';
        if(!$id) die("id return tidak valid");

        $this->model->delete($id);
        header("Location: index.php?controller=return_to&action=index");
        exit;
    }

    public function edit() {
        $id = $_GET['id'] ?? '';
        if(!$id) die("id return tidak valid");

        $data = $this->model->getbyid($id);
        $suppliers = $this->model->getsuppliers();
        $barangs   = $this->model->getbarangs();
        include __DIR__ . '/../views/return_to_edit.php';
    }

    public function update() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') die("akses tidak valid");

        $id = $_POST['id_return'] ?? '';
        if(!$id) die("id return tidak valid");

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
