<?php
class Detail_Pesanan {

    private $conn;
    private $table = "detail_pesanan";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    /* =============================
       0. GENERATE ID DETAIL
       ============================= */
    public function generateId()
    {
        $sql = "SELECT MAX(id_detail) AS maxid FROM {$this->table}";
        $stmt = $this->conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['maxid']) {
            $num = (int)substr($row['maxid'], 3) + 1; 
        } else {
            $num = 1;
        }

        return "DTL" . str_pad($num, 3, "0", STR_PAD_LEFT);
    }

    /* =============================
       1. Ambil semua detail pesanan + nama + harga + total
       ============================= */
    public function getDetailJoin($id_pesanan)
    {
        $sql = "
            SELECT 
                dp.*, 
                b.nama_barang,
                b.harga,
                (dp.jumlah * b.harga) AS total_harga
            FROM detail_pesanan dp
            JOIN barang b ON dp.id_barang = b.id_barang
            WHERE dp.id_pesanan = :id_pesanan
            ORDER BY dp.id_detail ASC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_pesanan' => $id_pesanan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =============================
       2. Tambah detail
       ============================= */
    public function create($data)
    {
        $sql = "
            INSERT INTO {$this->table} 
            (id_detail, id_pesanan, id_barang, jumlah)
            VALUES (:id_detail, :id_pesanan, :id_barang, :jumlah)
        ";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    /* =============================
       3. Hapus semua detail pesanan
       ============================= */
    public function deleteByPesanan($id_pesanan)
    {
        $sql = "DELETE FROM {$this->table} WHERE id_pesanan = :id_pesanan";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id_pesanan' => $id_pesanan]);
    }

    /* =============================
       4. Hapus salah satu detail
       ============================= */
    public function delete($id_detail)
    {
        $sql = "DELETE FROM {$this->table} WHERE id_detail = :id_detail";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id_detail' => $id_detail]);
    }
}
?>
