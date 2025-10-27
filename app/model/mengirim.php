<?php
class Pengiriman_model extends CI_Model {

    public function getAllPengiriman() {
        return $this->db->get('pengiriman')->result();
    }

    public function insertPengiriman($data) {
        return $this->db->insert('pengiriman', $data);
    }

    public function getSupplier() {
        return $this->db->get('supplier')->result();
    }

    public function getBarang() {
        return $this->db->get('barang')->result();
    }
}
?>

