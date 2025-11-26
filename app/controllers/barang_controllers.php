<?php
class BarangController{
    
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        // Ambil supplier
        $suppliers = $this->db->query("SELECT * FROM supplier")->fetchAll(PDO::FETCH_ASSOC);

        // Auto ID Barang
        $cek = $this->db->query("SELECT MAX(id_barang) AS maxID FROM barang")->fetch(PDO::FETCH_ASSOC);

        $idBaru = "BRG001";
        if ($cek && $cek['maxID']) {
            $num = (int) substr($cek['maxID'], 3);
            $idBaru = "BRG" . str_pad($num + 1, 3, "0", STR_PAD_LEFT);
        }

        // Ambil barang
        $stmt = $this->db->query("
            SELECT b.*, s.nama_supplier 
            FROM barang b
            LEFT JOIN supplier s ON b.id_supplier = s.id_supplier
        ");
        $barangList = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/barang_views.php';
    }

    public function store()
    {
        $id_barang   = $_POST['id_barang'];
        $id_supplier = $_POST['id_supplier'];
        $nama_barang = $_POST['nama_barang'];
        $stok        = $_POST['stok'];
        $harga       = $_POST['harga'];

        $gambar = "";
        if (!empty($_FILES['gambar']['name'])) {
            $gambar = time() . "_" . $_FILES['gambar']['name'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/images/" . $gambar);
        }

        $stmt = $this->db->prepare("
            INSERT INTO barang(id_barang, id_supplier, nama_barang, stok, harga, gambar)
            VALUES(?,?,?,?,?,?)
        ");

        $stmt->execute([$id_barang, $id_supplier, $nama_barang, $stok, $harga, $gambar]);

        header("Location: index.php?controller=barang&action=index");
    }

    public function edit()
    {
        $id = $_GET['id'];

        $stmt = $this->db->prepare("SELECT * FROM barang WHERE id_barang = ?");
        $stmt->execute([$id]);
        $barang = $stmt->fetch(PDO::FETCH_ASSOC);

        $suppliers = $this->db->query("SELECT * FROM supplier")->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/barang_edit.php';
    }

    public function update()
    {
        $id = $_POST['id_barang'];
        $supplier = $_POST['id_supplier'];
        $nama = $_POST['nama_barang'];
        $stok = $_POST['stok'];
        $harga = $_POST['harga'];
        $gambar_lama = $_POST['gambar_lama'];

        $gambar = $gambar_lama;

        if (!empty($_FILES['gambar']['name'])) {
            $gambar = time() . "_" . $_FILES['gambar']['name'];

            if (file_exists("assets/images/" . $gambar_lama)) {
                unlink("assets/images/" . $gambar_lama);
            }

            move_uploaded_file($_FILES['gambar']['tmp_name'], "assets/images/" . $gambar);
        }

        $stmt = $this->db->prepare("
            UPDATE barang SET 
            id_supplier=?,
            nama_barang=?,
            stok=?,
            harga=?,
            gambar=?
            WHERE id_barang=?
        ");

        $stmt->execute([$supplier, $nama, $stok, $harga, $gambar, $id]);

        header("Location: index.php?controller=barang&action=index");
    }

    public function delete()
    {
        $id = $_GET['id'];

        $cek = $this->db->prepare("SELECT gambar FROM barang WHERE id_barang=?");
        $cek->execute([$id]);
        $row = $cek->fetch(PDO::FETCH_ASSOC);

        if ($row && file_exists("assets/images/" . $row['gambar'])) {
            unlink("assets/images/" . $row['gambar']);
        }

        $stmt = $this->db->prepare("DELETE FROM barang WHERE id_barang=?");
        $stmt->execute([$id]);

        header("Location: index.php?controller=barang&action=index");
    }
}
