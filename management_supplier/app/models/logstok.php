<?php
class LogStok {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllLog() {
        $query = "SELECT log_stok.*, barang.nama_barang 
                  FROM log_stok 
                  JOIN barang ON barang.id_barang = log_stok.id_barang
                  ORDER BY tanggal DESC";
        return $this->db->query($query);
    }
}
