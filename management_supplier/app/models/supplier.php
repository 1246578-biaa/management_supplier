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
    public $jadwal_pengiriman;

    public function __construct($db) {
        $this->conn = $db;
    }

    // ===============================
    // GET ALL SUPPLIER
    // ===============================
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_supplier ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // ===============================
    // GET SUPPLIER TIPE: DIAMBIL
    // ===============================
    public function getAllSupplierDiambil() {
        $query = "SELECT * FROM " . $this->table_name . "
                  WHERE tipe_supplier = 'Diambil'
                  ORDER BY nama_supplier ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // ===============================
    // GET SUPPLIER TIPE: DIKIRIM
    // ===============================
    public function getAllSupplierDikirim() {
        $query = "SELECT * FROM " . $this->table_name . "
                  WHERE tipe_supplier = 'Mengirim'
                  ORDER BY nama_supplier ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // ===============================
    // GET ONE SUPPLIER
    // ===============================
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_supplier = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_supplier);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===============================
    // CREATE SUPPLIER
    // ===============================
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                  (id_supplier, nama_supplier, nama_alias, no_telp, alamat, tipe_supplier, jadwal_pengiriman)
                  VALUES (:id_supplier, :nama_supplier, :nama_alias, :no_telp, :alamat, :tipe_supplier, :jadwal_pengiriman)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_supplier", $this->id_supplier);
        $stmt->bindParam(":nama_supplier", $this->nama_supplier);
        $stmt->bindParam(":nama_alias", $this->nama_alias);
        $stmt->bindParam(":no_telp", $this->no_telp);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":tipe_supplier", $this->tipe_supplier);
        $stmt->bindParam(":jadwal_pengiriman", $this->jadwal_pengiriman);

        return $stmt->execute();
    }

    // ===============================
    // UPDATE SUPPLIER
    // ===============================
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama_supplier = :nama_supplier,
                      nama_alias = :nama_alias,
                      no_telp = :no_telp,
                      alamat = :alamat,
                      tipe_supplier = :tipe_supplier,
                      jadwal_pengiriman = :jadwal_pengiriman
                  WHERE id_supplier = :id_supplier";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nama_supplier", $this->nama_supplier);
        $stmt->bindParam(":nama_alias", $this->nama_alias);
        $stmt->bindParam(":no_telp", $this->no_telp);
        $stmt->bindParam(":alamat", $this->alamat);
        $stmt->bindParam(":tipe_supplier", $this->tipe_supplier);
        $stmt->bindParam(":jadwal_pengiriman", $this->jadwal_pengiriman);
        $stmt->bindParam(":id_supplier", $this->id_supplier);

        return $stmt->execute();
    }

    // ===============================
    // DELETE SUPPLIER
    // ===============================
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_supplier = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_supplier);
        return $stmt->execute();
    }
}
?>
