<?php

class Barang
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Generate ID Barang otomatis
    public function generateID()
    {
        $last = $this->db->query("SELECT id_barang FROM barang ORDER BY id_barang DESC LIMIT 1")
                         ->fetch(PDO::FETCH_ASSOC);

        if (!$last) return "BA001";

        $num = intval(substr($last['id_barang'], 2)) + 1;
        return "BA" . str_pad($num, 3, "0", STR_PAD_LEFT);
    }

    // Tampilkan data barang dengan pagination (halaman Barang)
    public function paginate($limit, $offset)
    {
        $sql = "SELECT b.*, s.nama_supplier 
                FROM barang b
                LEFT JOIN supplier s ON s.id_supplier = b.id_supplier
                LIMIT $limit OFFSET $offset";

        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hitung total data barang
    public function countAll()
    {
        return $this->db->query("SELECT COUNT(*) AS total FROM barang")->fetch()['total'];
    }

    // Tambah barang
    public function create($data)
    {
        $sql = "INSERT INTO barang (id_barang, id_supplier, nama_barang, stok, harga, gambar)
                VALUES (:id_barang, :id_supplier, :nama_barang, :stok, :harga, :gambar)";
        return $this->db->prepare($sql)->execute($data);
    }

    // Cari 1 barang berdasarkan ID
    public function find($id)
    {
        $sql = "SELECT b.*, s.nama_supplier 
                FROM barang b
                LEFT JOIN supplier s ON s.id_supplier = b.id_supplier
                WHERE b.id_barang = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update barang
    public function update($data)
    {
        $sql = "UPDATE barang SET 
                    id_supplier = :id_supplier,
                    nama_barang = :nama_barang,
                    stok = :stok,
                    harga = :harga,
                    gambar = :gambar
                WHERE id_barang = :id_barang";

        return $this->db->prepare($sql)->execute($data);
    }

    // Hapus barang
    public function delete($id)
    {
        return $this->db->prepare("DELETE FROM barang WHERE id_barang=?")->execute([$id]);
    }

    // =============================
    // AMBIL SEMUA BARANG (untuk Pesanan Dikirim)
    // =============================
    public function getAll()
    {
        $sql = "SELECT b.*, s.nama_supplier 
                FROM barang b
                LEFT JOIN supplier s ON s.id_supplier = b.id_supplier
                ORDER BY b.nama_barang ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
