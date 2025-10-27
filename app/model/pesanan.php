<?php
class Pesanan_model extends CI_Model {

    public function getAllPesanan() {
        $this->db->select('pesanan.*, supplier.Nama_Supplier, toko.Nama_Toko');
        $this->db->from('pesanan');
        $this->db->join('supplier', 'supplier.Id_Supplier = pesanan.Id_Supplier');
        $this->db->join('toko', 'toko.Id_Toko = pesanan.Id_Toko');
        return $this->db->get()->result();
    }

    public function insertPesanan($data) {
        return $this->db->insert('pesanan', $data);
    }

    public function getSupplier() {
        return $this->db->get('supplier')->result();
    }

    public function getToko() {
        return $this->db->get('toko')->result();
    }
}
?>

