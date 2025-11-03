<?php
class Supplier {
    private $conn;
    private $table_name = "supplier";

    public $id_supplier;
    public $nama_supplier;
    public $alamat;
    public $no_telp;
    public $tipe_supplier;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_supplier = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_supplier);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (nama_supplier, alamat, no_telp, tipe_supplier) 
                  VALUES (:nama_supplier, :alamat, :no_telp, :tipe_supplier)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nama_supplier', $this->nama_supplier);
        $stmt->bindParam(':alamat', $this->alamat);
        $stmt->bindParam(':no_telp', $this->no_telp);
        $stmt->bindParam(':tipe_supplier', $this->tipe_supplier);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama_supplier = :nama_supplier, 
                      alamat = :alamat, 
                      no_telp = :no_telp, 
                      tipe_supplier = :tipe_supplier
                  WHERE id_supplier = :id_supplier";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':nama_supplier', $this->nama_supplier);
        $stmt->bindParam(':alamat', $this->alamat);
        $stmt->bindParam(':no_telp', $this->no_telp);
        $stmt->bindParam(':tipe_supplier', $this->tipe_supplier);
        $stmt->bindParam(':id_supplier', $this->id_supplier);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_supplier = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_supplier);
        return $stmt->execute();
    }
}
?>
