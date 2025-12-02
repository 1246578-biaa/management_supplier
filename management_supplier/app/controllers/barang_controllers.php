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

    // =======================
    // HALAMAN LIST
    // =======================
    public function index()
    {
        $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $barangList = $this->barangModel->paginate($limit, $offset);
        $totalData  = $this->barangModel->countAll();
        $totalPage  = ceil($totalData / $limit);

        $idBaru = $this->barangModel->generateID();
        $suppliers = $this->db->query("SELECT * FROM supplier")->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/barang_views.php';
    }

    // =======================
    // SIMPAN BARANG
    // =======================
    public function simpan()
    {
        $id_barang   = $_POST['id_barang'];
        $id_supplier = $_POST['id_supplier'];
        $nama_barang = $_POST['nama_barang'];
        $stok        = $_POST['stok'];
        $harga       = $_POST['harga'];

        // Upload gambar baru
        $gambar = "";
        if (!empty($_FILES['gambar']['name'])) {
            $gambar = time() . "_" . $_FILES['gambar']['name'];
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

    // =======================
    // HALAMAN EDIT
    // =======================
    public function edit()
    {
        $id = $_GET['id'];
        $barang = $this->barangModel->find($id);
        $suppliers = $this->db->query("SELECT * FROM supplier")->fetchAll(PDO::FETCH_ASSOC);

        include __DIR__ . '/../views/barang_edit.php';
    }

    // =======================
    // PROSES UPDATE
    // =======================
    public function update()
    {
        $id = $_POST['id_barang'];

        // Data default (gambar lama)
        $data = [
            'id_barang'   => $id,
            'id_supplier' => $_POST['id_supplier'],
            'nama_barang' => $_POST['nama_barang'],
            'stok'        => $_POST['stok'],
            'harga'       => $_POST['harga'],
            'gambar'      => $_POST['gambar_lama']
        ];

        // Jika ada upload gambar baru
        if (!empty($_FILES['gambar']['name'])) {

            $gambarBaru = time() . "_" . $_FILES['gambar']['name'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], "landing/assets/images/" . $gambarBaru);

            // Hapus gambar lama
            if (!empty($data['gambar']) && file_exists("landing/assets/images/" . $data['gambar'])) {
                unlink("landing/assets/images/" . $data['gambar']);
            }

            $data['gambar'] = $gambarBaru;
        }

        $this->barangModel->update($data);

        header("Location: index.php?controller=barang&action=index");
        exit;
    }

    // =======================
    // HAPUS
    // =======================
    public function delete()
    {
        $id = $_GET['id'];

        $row = $this->barangModel->find($id);
        if ($row && file_exists("landing/assets/images/" . $row['gambar'])) {
            unlink("landing/assets/images/" . $row['gambar']);
        }

        $this->barangModel->delete($id);

        header("Location: index.php?controller=barang&action=index");
        exit;
    }
}
