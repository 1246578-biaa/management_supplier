<?php
require_once __DIR__ . '/../models/supplier.php';
require_once __DIR__ . '/../config/database.php';

class SupplierController {
    private $db;
    private $supplier;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->supplier = new Supplier($this->db);
    }

    /**
     * Generate ID Supplier otomatis
     * Format: SUP001, SUP002, dst
     */
    private function generateId() {
        $query = "SELECT id_supplier FROM supplier ORDER BY id_supplier DESC LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $lastId = $row['id_supplier'];
            $num = intval(substr($lastId, 3)) + 1;
            return "SUP" . str_pad($num, 3, "0", STR_PAD_LEFT);
        }
        return "SUP001";
    }

    /**
     * INDEX — tampilkan form tambah + tabel supplier
     */
    public function index() {
        $idBaru = $this->generateId(); // kirim ke view
        $stmt = $this->supplier->readAll();
        include __DIR__ . '/../views/supplier_views.php';
    }

    /**
     * SIMPAN DATA SUPPLIER
     */
    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->supplier->id_supplier = $_POST['id_supplier'];
            $this->supplier->nama_supplier = $_POST['nama_supplier'];
            $this->supplier->nama_alias = $_POST['nama_alias'];
            $this->supplier->no_telp = $_POST['no_telp'];
            $this->supplier->alamat = $_POST['alamat'];
            $this->supplier->tipe_supplier = $_POST['tipe_supplier'];
            $this->supplier->jadwal_pengiriman = $_POST['jadwal_pengiriman'];

            $this->supplier->create();
        }
        header("Location: ?controller=supplier");
    }

    /**
     * EDIT SUPPLIER
     */
    public function edit() {
        $this->supplier->id_supplier = $_GET['id'];
        $data = $this->supplier->readOne();
        include __DIR__ . '/../views/supplier_edit.php';
    }

    /**
     * UPDATE SUPPLIER
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->supplier->id_supplier = $_POST['id_supplier'];
            $this->supplier->nama_supplier = $_POST['nama_supplier'];
            $this->supplier->nama_alias = $_POST['nama_alias'];
            $this->supplier->no_telp = $_POST['no_telp'];
            $this->supplier->alamat = $_POST['alamat'];
            $this->supplier->tipe_supplier = $_POST['tipe_supplier'];
            $this->supplier->jadwal_pengiriman = $_POST['jadwal_pengiriman'];

            $this->supplier->update();
        }
        header("Location: ?controller=supplier");
    }

    /**
     * DELETE SUPPLIER
     */
    public function delete() {
        $this->supplier->id_supplier = $_GET['id'];
        $this->supplier->delete();
        header("Location: ?controller=supplier");
    }
}

