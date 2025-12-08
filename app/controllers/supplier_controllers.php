<?php
require_once __DIR__ . '/../models/Supplier.php';

class SupplierController {
    private $db;
    private $supplierModel;

    public function __construct($db) {
        $this->db = $db;
        $this->supplierModel = new Supplier($db);

        if(session_status() === PHP_SESSION_NONE) session_start();
    }

    // =======================
    // Helper: hanya admin
    // =======================
    private function requireAdmin() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("HTTP/1.1 403 Forbidden");
            echo "Akses ditolak: Anda tidak memiliki hak akses.";
            exit;
        }
    }

    // =======================
    // HALAMAN INDEX
    // =======================
    public function index() {
        $suppliers = $this->supplierModel->getAll();
        $idBaru = $_SESSION['role'] === 'admin' ? $this->supplierModel->generateID() : '';
        include __DIR__ . '/../views/supplier_views.php';
    }

    // =======================
    // SIMPAN SUPPLIER (Admin saja)
    // =======================
    public function simpan() {
        $this->requireAdmin();

        $data = [
            'id_supplier'   => $_POST['id_supplier'] ?? '',
            'nama_supplier' => $_POST['nama_supplier'] ?? '',
            'nama_alias'    => $_POST['nama_alias'] ?? '',
            'no_telp'       => $_POST['no_telp'] ?? '',
            'alamat'        => $_POST['alamat'] ?? '',
            'tipe_supplier' => $_POST['tipe_supplier'] ?? ''
        ];

        $this->supplierModel->create($data);
        header("Location: index.php?controller=supplier&action=index");
        exit;
    }

    // =======================
    // HALAMAN EDIT (Admin saja)
    // =======================
    public function edit() {
        $this->requireAdmin();
        $id = $_GET['id'] ?? '';
        $supplier = $this->supplierModel->find($id);
        include __DIR__ . '/../views/supplier_edit.php';
    }

    // =======================
    // UPDATE SUPPLIER (Admin saja)
    // =======================
    public function update() {
        $this->requireAdmin();

        $data = [
            'id_supplier'   => $_POST['id_supplier'] ?? '',
            'nama_supplier' => $_POST['nama_supplier'] ?? '',
            'nama_alias'    => $_POST['nama_alias'] ?? '',
            'no_telp'       => $_POST['no_telp'] ?? '',
            'alamat'        => $_POST['alamat'] ?? '',
            'tipe_supplier' => $_POST['tipe_supplier'] ?? ''
        ];

        $this->supplierModel->update($data);
        header("Location: index.php?controller=supplier&action=index");
        exit;
    }

    // =======================
    // DELETE SUPPLIER (Admin saja)
    // =======================
    public function delete() {
        $this->requireAdmin();
        $id = $_GET['id'] ?? '';
        $this->supplierModel->delete($id);
        header("Location: index.php?controller=supplier&action=index");
        exit;
    }
}
?>
