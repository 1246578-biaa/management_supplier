<?php

class Barang
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // ---------------------------------------------
    // Generate ID Barang otomatis BA001, BA002, ...
    // ---------------------------------------------
    public function generateID()
    {
        $stmt = $this->db->query("SELECT id_barang FROM barang ORDER BY id_barang DESC LIMIT 1");
        $last = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$last) return "BA001";

        $num = intval(substr($last['id_barang'], 2)) + 1;
        return "BA" . str_pad($num, 3, "0", STR_PAD_LEFT);
    }

    // ---------------------------------------------
    // Ambil semua barang (+ supplier)
    // ---------------------------------------------
    public function getAll()
    {
        $sql = "SELECT b.*, s.nama_supplier 
                FROM barang b
                JOIN supplier s ON s.id_supplier = b.id_supplier
                ORDER BY b.id_barang ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---------------------------------------------
    // Ambil barang berdasarkan ID Supplier
    // Digunakan untuk modal pilih barang di pesanan
    // ---------------------------------------------
    public function getBySupplier($id_supplier)
    {
        $sql = "SELECT id_barang, nama_barang, harga, stok 
                FROM barang 
                WHERE id_supplier = ?
                ORDER BY id_barang ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_supplier]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---------------------------------------------
    // Ambil barang berdasarkan ID Barang
    // ---------------------------------------------
    public function find($id_barang)
    {
        $sql = "SELECT b.*, s.nama_supplier 
                FROM barang b
                JOIN supplier s ON s.id_supplier = b.id_supplier
                WHERE b.id_barang = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_barang]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ---------------------------------------------
    // Simpan barang baru
    // ---------------------------------------------
    public function create($data)
    {
        $sql = "INSERT INTO barang (id_barang, id_supplier, nama_barang, stok, harga, gambar)
                VALUES (:id_barang, :id_supplier, :nama_barang, :stok, :harga, :gambar)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // ---------------------------------------------
    // Update barang
    // ---------------------------------------------
    public function update($data)
    {
        $sql = "UPDATE barang
                SET id_supplier = :id_supplier,
                    nama_barang = :nama_barang,
                    stok = :stok,
                    harga = :harga,
                    gambar = :gambar
                WHERE id_barang = :id_barang";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    // ---------------------------------------------
    // Hapus barang
    // ---------------------------------------------
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM barang WHERE id_barang = ?");
        return $stmt->execute([$id]);
    }
}
