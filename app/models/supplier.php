<?php
class Supplier {
    private $conn;
    private $table_name = "supplier";

    public $id_supplier;
    public $nama_supplier;
    public $nama_alias;
    public $no_telp;
    public $alamat;
    public $tipe_supplier;

    public function __construct($db) {
        $this->conn = $db;
    }

    // ===============================
    // GENERATE ID SUPPLIER OTOMATIS
    // Format: SUP001, SUP002, dst
    // ===============================
    public function generateID() {
        $query = "SELECT id_supplier FROM " . $this->table_name . " ORDER BY id_supplier DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $lastId = $row['id_supplier']; // misal SUP007
            $num = intval(substr($lastId, 3)) + 1;
            return "SUP" . str_pad($num, 3, "0", STR_PAD_LEFT);
        }
        return "SUP001"; // default pertama kali
    }

    // ===============================
    // GET ALL SUPPLIER
    // ===============================
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_supplier ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // GET SUPPLIER TIPE: Mengirim
    // ===============================
    public function getAllSupplierDikirim() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tipe_supplier = 'Mengirim' ORDER BY nama_supplier ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // GET SUPPLIER TIPE: Diambil
    // ===============================
    public function getAllSupplierDiambil() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE tipe_supplier = 'Diambil' ORDER BY nama_supplier ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===============================
    // GET ONE SUPPLIER BY ID
    // ===============================
    public function find($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_supplier = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===============================
    // CREATE SUPPLIER
    // ===============================
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . "
                  (id_supplier, nama_supplier, nama_alias, no_telp, alamat, tipe_supplier)
                  VALUES (:id_supplier, :nama_supplier, :nama_alias, :no_telp, :alamat, :tipe_supplier)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_supplier", $data['id_supplier']);
        $stmt->bindParam(":nama_supplier", $data['nama_supplier']);
        $stmt->bindParam(":nama_alias", $data['nama_alias']);
        $stmt->bindParam(":no_telp", $data['no_telp']);
        $stmt->bindParam(":alamat", $data['alamat']);
        $stmt->bindParam(":tipe_supplier", $data['tipe_supplier']);

        return $stmt->execute();
    }

    // ===============================
    // UPDATE SUPPLIER
    // ===============================
    public function update($data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama_supplier = :nama_supplier,
                      nama_alias = :nama_alias,
                      no_telp = :no_telp,
                      alamat = :alamat,
                      tipe_supplier = :tipe_supplier
                  WHERE id_supplier = :id_supplier";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama_supplier", $data['nama_supplier']);
        $stmt->bindParam(":nama_alias", $data['nama_alias']);
        $stmt->bindParam(":no_telp", $data['no_telp']);
        $stmt->bindParam(":alamat", $data['alamat']);
        $stmt->bindParam(":tipe_supplier", $data['tipe_supplier']);
        $stmt->bindParam(":id_supplier", $data['id_supplier']);

        return $stmt->execute();
    }

    // ===============================
    // DELETE SUPPLIER
    // ===============================
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_supplier = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        return $stmt->execute();
    }
}
?>
