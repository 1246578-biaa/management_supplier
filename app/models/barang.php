<?php
class Barang
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function generateID()
    {
        $last = $this->db->query("SELECT id_barang FROM barang ORDER BY id_barang DESC LIMIT 1")
                         ->fetch(PDO::FETCH_ASSOC);

        if (!$last) return "BA001";

        $num = intval(substr($last['id_barang'], 2)) + 1;
        return "BA" . str_pad($num, 3, "0", STR_PAD_LEFT);
    }

    public function paginate($limit, $offset)
    {
        $sql = "SELECT b.*, s.nama_supplier 
                FROM barang b
                LEFT JOIN supplier s ON s.id_supplier = b.id_supplier
                ORDER BY b.id_barang ASC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $row = $this->db->query("SELECT COUNT(*) AS total FROM barang")->fetch(PDO::FETCH_ASSOC);
        return isset($row['total']) ? (int)$row['total'] : 0;
    }

    public function create($data)
    {
        $sql = "INSERT INTO barang (id_barang, id_supplier, nama_barang, stok, harga, gambar)
                VALUES (:id_barang, :id_supplier, :nama_barang, :stok, :harga, :gambar)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function find($id)
    {
        $sql = "SELECT b.*, s.nama_supplier 
                FROM barang b
                LEFT JOIN supplier s ON s.id_supplier = b.id_supplier
                WHERE b.id_barang = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $sql = "UPDATE barang SET 
                    id_supplier = :id_supplier,
                    nama_barang = :nama_barang,
                    stok = :stok,
                    harga = :harga,
                    gambar = :gambar
                WHERE id_barang = :id_barang";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM barang WHERE id_barang=?");
        return $stmt->execute([$id]);
    }

    public function getAll()
    {
        $sql = "SELECT b.*, s.nama_supplier 
                FROM barang b
                LEFT JOIN supplier s ON s.id_supplier = b.id_supplier
                ORDER BY b.nama_barang ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
