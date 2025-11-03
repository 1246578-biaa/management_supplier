<?php
class Barang {
    private $conn;
    private $table_name = "barang";

    public $id_barang;
    public $nama_barang;
    public $stok;
    public $harga;
    public $kondisi_barang;
    public $gambar;

    public function __construct($db) {
        $this->conn = $db;
    }

    // READ ALL
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_barang ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // READ ONE
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_barang = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_barang);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nama_barang, stok, harga, kondisi_barang, gambar) 
                  VALUES (:nama_barang, :stok, :harga, :kondisi_barang, :gambar)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama_barang", $this->nama_barang);
        $stmt->bindParam(":stok", $this->stok);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":kondisi_barang", $this->kondisi_barang);
        $stmt->bindParam(":gambar", $this->gambar);

        return $stmt->execute();
    }

    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama_barang = :nama_barang, 
                      stok = :stok, 
                      harga = :harga, 
                      kondisi_barang = :kondisi_barang, 
                      gambar = :gambar
                  WHERE id_barang = :id_barang";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama_barang", $this->nama_barang);
        $stmt->bindParam(":stok", $this->stok);
        $stmt->bindParam(":harga", $this->harga);
        $stmt->bindParam(":kondisi_barang", $this->kondisi_barang);
        $stmt->bindParam(":gambar", $this->gambar);
        $stmt->bindParam(":id_barang", $this->id_barang);

        return $stmt->execute();
    }

    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_barang = :id_barang";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_barang", $this->id_barang);
        return $stmt->execute();
    }
}
?>
