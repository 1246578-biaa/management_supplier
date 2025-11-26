<?php
class Pesanan {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    /* ====================================================
       GENERATE ID PESANAN
       PSN001, PSN002, dst
    ==================================================== */
    public function generateId(){
        $stmt = $this->conn->query("
            SELECT MAX(CAST(SUBSTRING(id_pesanan, 4) AS UNSIGNED)) AS maxnum 
            FROM pesanan
        ");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $next = ($row['maxnum'] ?? 0) + 1;

        return "PSN" . str_pad($next, 3, "0", STR_PAD_LEFT);
    }

    /* ====================================================
       INSERT PESANAN BARU
    ==================================================== */
    public function create($data){
        $sql = "INSERT INTO pesanan (id_pesanan, tgl_pesanan, status, id_toko, id_supplier)
                VALUES (:id_pesanan, :tgl_pesanan, :status, :id_toko, :id_supplier)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            'id_pesanan'   => $data['id_pesanan'],
            'tgl_pesanan'  => $data['tgl_pesanan'],
            'status'       => $data['status'],
            'id_toko'      => $data['id_toko'],
            'id_supplier'  => $data['id_supplier']
        ]);

        return $data['id_pesanan'];
    }

    /* ====================================================
       TAMPILKAN SEMUA PESANAN + SUPPLIER
       URUTAN: DATA TERBARU DI ATAS
    ==================================================== */
    public function allWithSupplier(){
        $sql = "
            SELECT p.*, s.nama_supplier
            FROM pesanan p
            LEFT JOIN supplier s ON s.id_supplier = p.id_supplier
            ORDER BY p.tgl_pesanan DESC, p.id_pesanan DESC
        ";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ====================================================
       AMBIL SATU DATA PESANAN
    ==================================================== */
    public function find($id){
        $stmt = $this->conn->prepare("SELECT * FROM pesanan WHERE id_pesanan = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ====================================================
       UPDATE PESANAN
    ==================================================== */
    public function update($id, $data){
        $sql = "UPDATE pesanan SET
                tgl_pesanan = :tgl_pesanan,
                status      = :status,
                id_supplier = :id_supplier
                WHERE id_pesanan = :id";

        $stmt = $this->conn->prepare($sql);

        $data['id'] = $id;
        return $stmt->execute($data);
    }

    /* ====================================================
       HAPUS PESANAN
    ==================================================== */
    public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM pesanan WHERE id_pesanan = ?");
        return $stmt->execute([$id]);
    }
}
?>
