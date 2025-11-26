<?php

class Laporan {

    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=management_supplier3", "root", "");
    }

    // Ambil data pesanan
    public function getLaporanPesanan() {
        $sql = "SELECT id_pesanan, tgl_pesanan, status FROM pesanan ORDER BY tgl_pesanan DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil data retur supplier
    public function getLaporanRetur() {
        $sql = "
            SELECT r.id_return, r.id_supplier, r.id_barang, r.jumlah, r.alasan, r.tanggal_return
            FROM return_to r
            JOIN barang b ON b.id_barang = r.id_barang
            JOIN supplier s ON s.id_supplier = r.id_supplier
            ORDER BY r.tanggal_return DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}