<?php
class Pesanan_dikirim {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // GENERATE ID PESANAN
    private function generateKodePesanan() {
        $stmt = $this->conn->prepare("
            SELECT id_pesanan FROM pesanan
            WHERE id_pesanan LIKE 'PSN%'
            ORDER BY CAST(SUBSTRING(id_pesanan,4) AS UNSIGNED) DESC
            LIMIT 1
        ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $next = 1;
        if($row){
            $angka = (int) substr($row['id_pesanan'], 3);
            $next = $angka + 1;
        }
        return 'PSN'.str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    // GENERATE ID DETAIL STABIL: DP001
    private function generateDetailID(){
        $stmt = $this->conn->prepare("
            SELECT id_detail 
            FROM detail_pesanan
            WHERE id_detail LIKE 'DP%'
            ORDER BY CAST(SUBSTRING(id_detail, 3) AS UNSIGNED) DESC
            LIMIT 1
        ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $next = 1;
        if($row){
            $angka = (int) substr($row['id_detail'], 2); // ambil angka setelah "DP"
            $next = $angka + 1;
        }
        return 'DP'.str_pad($next, 3, '0', STR_PAD_LEFT);
    }

    // GET ALL PESANAN
    public function getAll(){
        $stmt = $this->conn->prepare("
            SELECT p.*, s.nama_supplier
            FROM pesanan p
            JOIN supplier s ON s.id_supplier = p.id_supplier
            WHERE p.status='Dikirim' OR p.status='Selesai Dikirim'
            ORDER BY CAST(SUBSTRING(p.id_pesanan,4) AS UNSIGNED) DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // INSERT PESANAN
    public function insertPesanan($id_supplier, $tanggal, $id_barang_arr, $jumlah_arr, $id_toko){
        $id_pesanan = $this->generateKodePesanan();

        try {
            $this->conn->beginTransaction();

            // insert pesanan
            $stmt = $this->conn->prepare("
                INSERT INTO pesanan (id_pesanan, tgl_pesanan, status, id_supplier, id_toko)
                VALUES (?, ?, 'Dikirim', ?, ?)
            ");
            $stmt->execute([$id_pesanan, $tanggal, $id_supplier, $id_toko]);

            // insert detail
            $stmt2 = $this->conn->prepare("
                INSERT INTO detail_pesanan (id_detail, id_pesanan, id_barang, jumlah)
                VALUES (?, ?, ?, ?)
            ");

            foreach($id_barang_arr as $i => $id_barang){
                if(!empty($id_barang) && !empty($jumlah_arr[$i])){
                    $id_detail = $this->generateDetailID();
                    $stmt2->execute([$id_detail, $id_pesanan, $id_barang, $jumlah_arr[$i]]);
                }
            }

            $this->conn->commit();
            return $id_pesanan;

        } catch (Exception $e){
            $this->conn->rollBack();
            echo "Gagal simpan pesanan: ".$e->getMessage();
            return false;
        }
    }

    // GET SINGLE PESANAN
    public function getOne($id_pesanan){
        $stmt = $this->conn->prepare("
            SELECT p.*, s.nama_supplier
            FROM pesanan p
            JOIN supplier s ON s.id_supplier = p.id_supplier
            WHERE p.id_pesanan = ?
        ");
        $stmt->execute([$id_pesanan]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // GET DETAIL PESANAN
    public function getDetail($id_pesanan){
        $stmt = $this->conn->prepare("
            SELECT dp.*, b.nama_barang
            FROM detail_pesanan dp
            JOIN barang b ON b.id_barang = dp.id_barang
            WHERE dp.id_pesanan = ?
        ");
        $stmt->execute([$id_pesanan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE PESANAN
    public function updatePesanan($id_pesanan, $id_supplier, $tanggal, $id_barang_arr, $jumlah_arr, $id_toko){
        try {
            $this->conn->beginTransaction();

            // update data utama pesanan
            $stmt = $this->conn->prepare("
                UPDATE pesanan 
                SET id_supplier = ?, tgl_pesanan = ?, id_toko = ?
                WHERE id_pesanan = ?
            ");
            $stmt->execute([$id_supplier, $tanggal, $id_toko, $id_pesanan]);

            // hapus semua detail lama
            $stmt = $this->conn->prepare("DELETE FROM detail_pesanan WHERE id_pesanan = ?");
            $stmt->execute([$id_pesanan]);

            // masukkan detail baru
            $stmt2 = $this->conn->prepare("
                INSERT INTO detail_pesanan (id_detail, id_pesanan, id_barang, jumlah)
                VALUES (?, ?, ?, ?)
            ");
            foreach($id_barang_arr as $i => $id_barang){
                if(!empty($id_barang) && !empty($jumlah_arr[$i])){
                    $id_detail = $this->generateDetailID();
                    $stmt2->execute([$id_detail, $id_pesanan, $id_barang, $jumlah_arr[$i]]);
                }
            }

            $this->conn->commit();
            return true;

        } catch (Exception $e){
            $this->conn->rollBack();
            echo "Gagal update pesanan: " . $e->getMessage();
            return false;
        }
    }

    // SELESAI PESANAN
    public function selesaiPesanan($id_pesanan){
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("SELECT id_barang, jumlah FROM detail_pesanan WHERE id_pesanan = ?");
            $stmt->execute([$id_pesanan]);
            $details = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $update = $this->conn->prepare("UPDATE barang SET stok = stok + ? WHERE id_barang = ?");
            foreach($details as $d){
                $update->execute([$d['jumlah'], $d['id_barang']]);
            }

            $this->conn->prepare("UPDATE pesanan SET status='Selesai Dikirim' WHERE id_pesanan=?")
                ->execute([$id_pesanan]);

            $this->conn->commit();
            return true;

        } catch (Exception $e){
            $this->conn->rollBack();
            echo "Gagal selesaikan pesanan: ".$e->getMessage();
            return false;
        }
    }

    // HAPUS PESANAN
    public function hapusPesanan($id_pesanan){
        try{
            $this->conn->beginTransaction();
            $this->conn->prepare("DELETE FROM detail_pesanan WHERE id_pesanan=?")->execute([$id_pesanan]);
            $this->conn->prepare("DELETE FROM pesanan WHERE id_pesanan=?")->execute([$id_pesanan]);
            $this->conn->commit();
            return true;
        }catch(Exception $e){
            $this->conn->rollBack();
            echo "Gagal hapus pesanan: ".$e->getMessage();
            return false;
        }
    }
}
?>
