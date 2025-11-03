<?php
require_once __DIR__ . '/../models/Supplier.php';
require_once __DIR__ . '/../config/database.php';

class SupplierController {
    private $db;
    private $supplier;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->supplier = new Supplier($this->db);
    }

    public function index() {
        $stmt = $this->supplier->readAll();
        include __DIR__ . '/../views/supplier_views.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->supplier->nama_supplier = $_POST['nama_supplier'];
            $this->supplier->alamat = $_POST['alamat'];
            $this->supplier->no_telp = $_POST['no_telp'];
            $this->supplier->tipe_supplier = $_POST['tipe_supplier'];
            $this->supplier->create();
            header("Location: ?controller=supplier");
        }
        include __DIR__ . '/../views/supplier_create.php';
    }

    public function edit() {
        $this->supplier->id_supplier = $_GET['id'];
        $data = $this->supplier->readOne();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->supplier->id_supplier = $_POST['id_supplier'];
            $this->supplier->nama_supplier = $_POST['nama_supplier'];
            $this->supplier->alamat = $_POST['alamat'];
            $this->supplier->no_telp = $_POST['no_telp'];
            $this->supplier->tipe_supplier = $_POST['tipe_supplier'];
            $this->supplier->update();
            header("Location: ?controller=supplier");
        }

        include __DIR__ . '/../views/supplier/supplier_edit.php';
    }

    public function delete() {
        $this->supplier->id_supplier = $_GET['id'];
        $this->supplier->delete();
        header("Location: ?controller=supplier");
    }
}
?>
