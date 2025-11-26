<?php
class PengirimanModel {
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    // Semua pengiriman beserta nama supplier
    public function getAllPengiriman(){
        $sql = "SELECT pg.id_pengiriman, pg.id_pesanan, pg.tgl_pengiriman,
                       s.nama_supplier
                FROM pengiriman pg
                JOIN supplier s ON s.id_supplier = pg.id_supplier
                ORDER BY pg.tgl_pengiriman DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Pesanan yang status = Dikirim
    public function getPesananDikirim(){
        $sql = "SELECT ps.*, s.nama_supplier, s.id_supplier
                FROM pesanan ps
                JOIN supplier s ON ps.id_supplier = s.id_supplier
                WHERE ps.status='Dikirim'
                ORDER BY ps.tgl_pesanan DESC";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Detail barang dari pesanan
    public function getDetailBarangPesanan($id_pesanan){
        $sql = "SELECT dp.id_barang, b.nama_barang, dp.jumlah
                FROM detail_pesanan dp
                JOIN barang b ON dp.id_barang = b.id_barang
                WHERE dp.id_pesanan = :id_pesanan";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_pesanan'=>$id_pesanan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambah pengiriman
    public function addPengiriman($id_pesanan, $id_supplier, $tgl_pengiriman, $keterangan){
        $sql = "INSERT INTO pengiriman (id_pesanan, id_supplier, tgl_pengiriman, keterangan)
                VALUES (:id_pesanan, :id_supplier, :tgl_pengiriman, :keterangan)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_pesanan'=>$id_pesanan,
            ':id_supplier'=>$id_supplier,
            ':tgl_pengiriman'=>$tgl_pengiriman,
            ':keterangan'=>$keterangan
        ]);
        return $this->db->lastInsertId();
    }

    // Tambah detail pengiriman
    public function addDetailPengiriman($id_pengiriman, $id_barang, $jumlah_barang){
        $sql = "INSERT INTO detail_pengiriman (id_pengiriman, id_barang, jumlah_barang)
                VALUES (:id_pengiriman, :id_barang, :jumlah_barang)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_pengiriman'=>$id_pengiriman,
            ':id_barang'=>$id_barang,
            ':jumlah_barang'=>$jumlah_barang
        ]);
    }

    // Ambil detail pengiriman
    public function getDetailPengiriman($id_pengiriman){
        $sql = "SELECT dp.*, b.nama_barang
                FROM detail_pengiriman dp
                JOIN barang b ON dp.id_barang = b.id_barang
                WHERE dp.id_pengiriman = :id_pengiriman";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_pengiriman'=>$id_pengiriman]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
