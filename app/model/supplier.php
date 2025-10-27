<?php
class Supplier {
    private $conn;
    private $table = "supplier";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function add($name, $address, $phone) {
        $query = "INSERT INTO " . $this->table . " (nama_supplier, alamat, no_telp) 
                  VALUES ('$name', '$address', '$phone')";
        return mysqli_query($this->conn, $query);
    }
}
?>
