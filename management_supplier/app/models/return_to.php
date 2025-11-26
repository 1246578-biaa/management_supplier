<?php
class Return_to {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Ambil semua return supplier datang langsung
    public function getReturnDatangLangsung() {
        $sql = "
        SELECT r.id_return, s.nama_supplier AS singkat_supplier, b.nama_barang, r.jumlah, r.alasan, r.tanggal_return
        FROM return_to r
        JOIN supplier s ON r.id_supplier = s.id_supplier
        JOIN barang b ON r.id_barang = b.id_barang
        WHERE s.tipe_supplier = 'Datang_langsung'
        ORDER BY r.tanggal_return DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil supplier datang langsung
    public function getSupplierDatangLangsung() {
        $stmt = $this->conn->prepare("SELECT * FROM supplier WHERE tipe_supplier = 'Datang_langsung'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil barang sesuai supplier
    public function getBarangBySupplier($id_supplier) {
        $stmt = $this->conn->prepare("SELECT * FROM barang WHERE id_supplier = :id_supplier");
        $stmt->execute(['id_supplier' => $id_supplier]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Generate ID Return otomatis
    public function generateIdReturn() {
        $stmt = $this->conn->query("SELECT id_return FROM return_to ORDER BY id_return DESC LIMIT 1");
        $last = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($last) {
            $num = (int)substr($last['id_return'], 3) + 1;
            return 'RET' . str_pad($num, 3, '0', STR_PAD_LEFT);
        } else {
            return 'RET001';
        }
    }

    // Simpan return baru
    public function simpan($data) {
        $sql = "INSERT INTO return_to (id_return, id_supplier, id_barang, jumlah, alasan, tanggal_return)
                VALUES (:id_return, :id_supplier, :id_barang, :jumlah, :alasan, :tanggal_return)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
}
?>
