<?php
class Detail_Pengiriman {

    private $conn;
    private $table = "detail_pengiriman";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (id_pengiriman, id_barang, jumlah_barang)
                VALUES (:id_pengiriman, :id_barang, :jumlah_barang)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getByPengiriman($id_pengiriman)
    {
        $sql = "
            SELECT dp.*, b.nama_barang, b.harga,
                (b.harga * dp.jumlah_barang) AS total_harga
            FROM detail_pengiriman dp
            JOIN barang b ON b.id_barang = dp.id_barang
            WHERE dp.id_pengiriman = :id_pengiriman
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_pengiriman' => $id_pengiriman]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteByPengiriman($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id_pengiriman = ?");
        return $stmt->execute([$id]);
    }
}
