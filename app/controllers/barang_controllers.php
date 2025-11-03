<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/barang.php';

class BarangController {
    private $db;
    private $barang;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->barang = new Barang($this->db);
    }

    public function index() {
        $stmt = $this->barang->readAll();
        include __DIR__ . '/../views/barang_views.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->barang->nama_barang = $_POST['nama_barang'];
            $this->barang->stok = $_POST['stok'];
            $this->barang->harga = $_POST['harga'];
            $this->barang->kondisi_barang = $_POST['kondisi_barang'];
            $this->barang->gambar = $_POST['gambar'];
            $this->barang->create();
            header("Location: ?controller=barang");
        }
        include __DIR__ . '/../views/barang_create.php';
    }

    public function edit() {
        $this->barang->id_barang = $_GET['id'];
        $data = $this->barang->readOne();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->barang->id_barang = $_POST['id_barang'];
            $this->barang->nama_barang = $_POST['nama_barang'];
            $this->barang->stok = $_POST['stok'];
            $this->barang->harga = $_POST['harga'];
            $this->barang->kondisi_barang = $_POST['kondisi_barang'];
            $this->barang->gambar = $_POST['gambar'];
            $this->barang->update();
            header("Location: ?controller=barang");
        }

        include __DIR__ . '/../views/barang_edit.php';
    }

    public function delete() {
        $this->barang->id_barang = $_GET['id'];
        $this->barang->delete();
        header("Location: ?controller=barang");
    }
}
?>
