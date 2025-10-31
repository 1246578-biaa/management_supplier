<?php
require_once __DIR__ . '/../config/koneksi.php';

class barang {
    private $koneksi;

    public function __construct() {
        $this->koneksi = koneksiDatabase();
    }

    public function getAllBarang() {
        $query = "SELECT * FROM barang";
        $result = mysqli_query($this->koneksi, $query);

        if (!$result) {
            die("Query error: " . mysqli_error($this->koneksi));
        }

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        return $data;
    }
}
?>
