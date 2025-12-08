<?php

class BarangController
{
    private $db;
    private $barangModel;

    public function __construct($db)
    {
        $this->db = $db;
        require_once __DIR__ . '/../models/Barang.php';
        $this->barangModel = new Barang($db);
    }

    
    private function requireAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
          
            header("HTTP/1.1 403 Forbidden");
            echo "Akses ditolak: Anda tidak memiliki hak akses.";
            exit;
        }
    }

    
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $barangList = $this->barangModel->paginate($limit, $offset);
        $totalData  = $this->barangModel->countAll();
        $totalPage  = ($totalData > 0) ? ceil($totalData / $limit) : 1;

        $idBaru = $this->barangModel->generateID();
        $suppliers = $this->db->query("SELECT * FROM supplier")->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/barang_views.php';
    }

    public function simpan()
    {
        $this->requireAdmin();

        $id_barang   = $_POST['id_barang'] ?? null;
        $id_supplier = $_POST['id_supplier'] ?? null;
        $nama_barang = $_POST['nama_barang'] ?? null;
        $stok        = $_POST['stok'] ?? 0;
        $harga       = $_POST['harga'] ?? 0;

        $gambar = "";
        if (!empty($_FILES['gambar']['name'])) {
            $gambar = time() . "_" . basename($_FILES['gambar']['name']);
            move_uploaded_file($_FILES['gambar']['tmp_name'], "landing/assets/images/" . $gambar);
        }

        $this->barangModel->create([
            'id_barang'   => $id_barang,
            'id_supplier' => $id_supplier,
            'nama_barang' => $nama_barang,
            'stok'        => $stok,
            'harga'       => $harga,
            'gambar'      => $gambar
        ]);

        header("Location: index.php?controller=barang&action=index");
        exit;
    }

    
    public function edit()
    {
        $this->requireAdmin();

        $id = $_GET['id'] ?? null;
        $barang = $this->barangModel->find($id);
        $suppliers = $this->db->query("SELECT * FROM supplier")->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/barang_edit.php';
    }

   
    public function update()
    {
        $this->requireAdmin();

        $id = $_POST['id_barang'] ?? null;

        $data = [
            'id_barang'   => $id,
            'id_supplier' => $_POST['id_supplier'] ?? null,
            'nama_barang' => $_POST['nama_barang'] ?? null,
            'stok'        => $_POST['stok'] ?? 0,
            'harga'       => $_POST['harga'] ?? 0,
            'gambar'      => $_POST['gambar_lama'] ?? ''
        ];

        if (!empty($_FILES['gambar']['name'])) {

            $gambarBaru = time() . "_" . basename($_FILES['gambar']['name']);
            move_uploaded_file($_FILES['gambar']['tmp_name'], "landing/assets/images/" . $gambarBaru);

            if (!empty($data['gambar']) && file_exists("landing/assets/images/" . $data['gambar'])) {
                unlink("landing/assets/images/" . $data['gambar']);
            }

            $data['gambar'] = $gambarBaru;
        }

        $this->barangModel->update($data);

        header("Location: index.php?controller=barang&action=index");
        exit;
    }

    public function delete()
    {
        $this->requireAdmin();

        $id = $_GET['id'] ?? null;

        $row = $this->barangModel->find($id);
        if ($row && !empty($row['gambar']) && file_exists("landing/assets/images/" . $row['gambar'])) {
            unlink("landing/assets/images/" . $row['gambar']);
        }

        $this->barangModel->delete($id);

        header("Location: index.php?controller=barang&action=index");
        exit;
    }
}
