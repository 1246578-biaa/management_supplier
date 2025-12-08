<?php
class Pesanan_diambil {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // ===========================
    // GENERATE KODE PESANAN
    // ===========================
    private function generateKodePesanan() {
        $stmt = $this->conn->prepare("
            SELECT id_pesanan 
            FROM pesanan
            WHERE id_pesanan LIKE 'PSN%'
            ORDER BY CAST(SUBSTRING(id_pesanan,4) AS UNSIGNED) DESC
            LIMIT 1
        ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $next = 1;
        if ($row && !empty($row['id_pesanan'])) {
            $angka = (int) substr($row['id_pesanan'], 3);
            $next = $angka + 1;
        }

        return 'PSN' . str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    private function generateKodeDetail() {
        $stmt = $this->conn->prepare("
            SELECT id_detail 
            FROM detail_pesanan
            ORDER BY CAST(SUBSTRING(id_detail,3) AS UNSIGNED) DESC
            LIMIT 1
        ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $next = 1;
        if ($row && !empty($row['id_detail'])) {
            $angka = (int) substr($row['id_detail'], 2);
            $next = $angka + 1;
        }

        return 'DP' . str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    // ===========================
    // GET DATA
    // ===========================
    public function getAll() {
        $stmt = $this->conn->prepare("
            SELECT p.*, s.nama_supplier
            FROM pesanan p
            JOIN supplier s ON s.id_supplier = p.id_supplier
            WHERE p.status='Diambil' OR p.status='Selesai Diambil'
            ORDER BY 
                CASE WHEN p.status='Diambil' THEN 0 ELSE 1 END ASC,
                CAST(SUBSTRING(p.id_pesanan,4) AS UNSIGNED) DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne($id_pesanan) {
        $stmt = $this->conn->prepare("
            SELECT p.*, s.nama_supplier
            FROM pesanan p
            JOIN supplier s ON s.id_supplier = p.id_supplier
            WHERE p.id_pesanan = ?
        ");
        $stmt->execute([$id_pesanan]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDetail($id_pesanan) {
        $stmt = $this->conn->prepare("
            SELECT 
                dp.*,
                b.nama_barang,
                b.harga,
                (b.harga * dp.jumlah) AS total_harga
            FROM detail_pesanan dp
            JOIN barang b ON b.id_barang = dp.id_barang
            WHERE dp.id_pesanan = ?
        ");
        $stmt->execute([$id_pesanan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===========================
    // INSERT PESANAN
    // ===========================
    public function insertPesanan($id_supplier, $tanggal, $id_barang_arr, $jumlah_arr, $id_toko = 'TOK001', $status = 'Diambil') {
        $id_pesanan = $this->generateKodePesanan();
        try {
            $this->conn->beginTransaction();

            // Insert master
            $stmt = $this->conn->prepare("
                INSERT INTO pesanan (id_pesanan, tgl_pesanan, status, id_supplier, id_toko)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$id_pesanan, $tanggal, $status, $id_supplier, $id_toko]);

            // Insert detail
            $stmt2 = $this->conn->prepare("
                INSERT INTO detail_pesanan (id_detail, id_pesanan, id_barang, jumlah)
                VALUES (?, ?, ?, ?)
            ");
            foreach ($id_barang_arr as $i => $id_barang) {
                if (!empty($id_barang) && !empty($jumlah_arr[$i])) {
                    $id_detail = $this->generateKodeDetail();
                    $stmt2->execute([$id_detail, $id_pesanan, $id_barang, $jumlah_arr[$i]]);
                }
            }

            $this->conn->commit();
            return $id_pesanan;

        } catch (Exception $e) {
            if ($this->conn->inTransaction()) $this->conn->rollBack();
            echo "Gagal simpan pesanan: " . $e->getMessage();
            return false;
        }
    }

    // ===========================
    // UPDATE PESANAN
    // ===========================
    public function updatePesanan($id_pesanan, $id_supplier, $tanggal, $id_barang_arr, $jumlah_arr) {
        try {
            $this->conn->beginTransaction();

            // Update master
            $stmt = $this->conn->prepare("UPDATE pesanan SET tgl_pesanan=?, id_supplier=? WHERE id_pesanan=?");
            $stmt->execute([$tanggal, $id_supplier, $id_pesanan]);

            // Delete detail lama
            $this->conn->prepare("DELETE FROM detail_pesanan WHERE id_pesanan=?")->execute([$id_pesanan]);

            // Insert detail baru
            $stmt2 = $this->conn->prepare("INSERT INTO detail_pesanan (id_detail, id_pesanan, id_barang, jumlah) VALUES (?, ?, ?, ?)");
            foreach ($id_barang_arr as $i => $id_barang) {
                if (!empty($id_barang) && !empty($jumlah_arr[$i])) {
                    $id_detail = $this->generateKodeDetail();
                    $stmt2->execute([$id_detail, $id_pesanan, $id_barang, $jumlah_arr[$i]]);
                }
            }

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            if ($this->conn->inTransaction()) $this->conn->rollBack();
            echo "Gagal update pesanan: " . $e->getMessage();
            return false;
        }
    }

    // ===========================
    // DELETE PESANAN
    // ===========================
    public function hapusPesanan($id_pesanan) {
        try {
            $this->conn->beginTransaction();
            $this->conn->prepare("DELETE FROM detail_pesanan WHERE id_pesanan = ?")->execute([$id_pesanan]);
            $this->conn->prepare("DELETE FROM pesanan WHERE id_pesanan = ?")->execute([$id_pesanan]);
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            if ($this->conn->inTransaction()) $this->conn->rollBack();
            echo "Gagal hapus pesanan: " . $e->getMessage();
            return false;
        }
    }

    // ===========================
    // SELESAI PESANAN
    // ===========================
    public function selesaiPesanan($id_pesanan) {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("SELECT id_barang, jumlah FROM detail_pesanan WHERE id_pesanan = ?");
            $stmt->execute([$id_pesanan]);
            $detail = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $stmt2 = $this->conn->prepare("UPDATE barang SET stok = stok + ? WHERE id_barang = ?");
            foreach ($detail as $d) {
                $stmt2->execute([$d['jumlah'], $d['id_barang']]);
            }

            $stmt3 = $this->conn->prepare("UPDATE pesanan SET status='Selesai Diambil' WHERE id_pesanan=?");
            $stmt3->execute([$id_pesanan]);

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            if ($this->conn->inTransaction()) $this->conn->rollBack();
            echo "Gagal selesaikan pesanan: " . $e->getMessage();
            return false;
        }
    }
}
?>
