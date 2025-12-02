<?php
class return_to {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // Generate ID Return otomatis
    private function generateidreturn() {
        $stmt = $this->conn->prepare("
            SELECT id_return FROM return_to
            ORDER BY CAST(SUBSTRING(id_return,4) AS UNSIGNED) DESC
            LIMIT 1
        ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $next = 1;
        if ($row && !empty($row['id_return'])) {
            $angka = (int) substr($row['id_return'], 3);
            $next = $angka + 1;
        }

        return 'RET' . str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    // Ambil semua data return
    public function getall() {
        $stmt = $this->conn->prepare("
            SELECT r.*, s.nama_supplier, b.nama_barang
            FROM return_to r
            JOIN supplier s ON s.id_supplier = r.id_supplier
            JOIN barang b ON b.id_barang = r.id_barang
            ORDER BY CAST(SUBSTRING(r.id_return,4) AS UNSIGNED) DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil data by ID
    public function getbyid($id) {
        $stmt = $this->conn->prepare("SELECT * FROM return_to WHERE id_return = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert return
    public function insert($data) {
        $id_return = $this->generateidreturn();
        $stmt = $this->conn->prepare("
            INSERT INTO return_to (id_return, id_supplier, id_barang, jumlah, alasan, tanggal_return)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $id_return,
            $data['id_supplier'],
            $data['id_barang'],
            $data['jumlah'],
            $data['alasan'] ?? '',
            $data['tanggal_return']
        ]);
        return $id_return;
    }

    // Update return
    public function update($id, $data) {
        $stmt = $this->conn->prepare("
            UPDATE return_to
            SET id_supplier = ?, id_barang = ?, jumlah = ?, alasan = ?, tanggal_return = ?
            WHERE id_return = ?
        ");
        return $stmt->execute([
            $data['id_supplier'],
            $data['id_barang'],
            $data['jumlah'],
            $data['alasan'],
            $data['tanggal_return'],
            $id
        ]);
    }

    // Hapus return
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM return_to WHERE id_return = ?");
        return $stmt->execute([$id]);
    }

    // Supplier & Barang
    public function getsuppliers() {
        return $this->conn->query("SELECT * FROM supplier WHERE tipe_supplier='Datang_Langsung'")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getbarangs() {
        return $this->conn->query("SELECT * FROM barang")->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
