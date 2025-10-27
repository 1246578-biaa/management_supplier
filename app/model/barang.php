<?php
class Barang.php {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllBarang() {
        $query = "SELECT * FROM barang";
        $result = $this->conn->query($query);
        return $result;
    }

    public function addBarang($id_barang,$nama_barang, $stok, $harga, $kondisi_barang) {
        $stmt = $this->conn->prepare("INSERT INTO barang (id_barang,nama_barang, stok, harga, kondisi_barang) VALUES (?,?, ?, ?, ?)");
        $stmt->bind_param("sids",$id_barang, $nama_barang, $stok, $harga, $kondisi_barang);
        return $stmt->execute();
    }
}
?>


