<?php
require_once __DIR__ . '/../models/pesanan.php';
require_once __DIR__ . '/../models/detail_pesanan.php';
require_once __DIR__ . '/../models/barang.php';

class PesananController {
    private $db;
    private $model;
    private $detailModel;
    private $barangModel;

    public function __construct($db){
        $this->db = $db;
        $this->model = new Pesanan($db);
        $this->detailModel = new Detail_Pesanan($db);
        $this->barangModel = new Barang($db);
    }

    public function handleRequest(){
        $action = $_REQUEST['action'] ?? 'index';
        switch($action){
            case 'index': $this->index(); break;
            case 'simpan': $this->simpan(); break;
            case 'edit': $this->edit(); break;
            case 'update': $this->update(); break;
            case 'hapus': $this->hapus(); break;
            case 'detail': $this->detail(); break;
            case 'getBarangBySupplier': $this->getBarangBySupplier(); break;
            default: $this->index();
        }
    }

    public function index(){
    $pesanans = $this->model->allWithSupplier();
    $suppliers = $this->db->query("
        SELECT id_supplier, nama_supplier FROM supplier
    ")->fetchAll(PDO::FETCH_ASSOC);

    
    $barang = $this->barangModel->getAll();

    require __DIR__ . '/../views/pesanan_views.php';
}

    public function getBarangBySupplier(){
        $id_supplier = $_GET['id_supplier'] ?? '';
        if(!$id_supplier){ echo json_encode([]); exit; }

        $data = $this->barangModel->getBySupplier($id_supplier);
        echo json_encode($data);
        exit;
    }

    public function simpan(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            try {

                $this->db->beginTransaction();

                $id_pesanan = $this->model->generateId();

                $this->model->create([
                    'id_pesanan'  => $id_pesanan,
                    'tgl_pesanan' => $_POST['tgl_pesanan'],
                    'status'      => $_POST['status'],
                    'id_toko'     => $_POST['id_toko'] ?? 'TOK001',
                    'id_supplier' => $_POST['id_supplier']
                ]);

                $items = $_POST['item_input'] ?? [];
                $jumlahs = $_POST['jumlah'] ?? [];

                for($i = 0; $i < count($items); $i++){
                    $raw = trim($items[$i]);
                    $qty = (int)$jumlahs[$i];

                    if($raw === "" || $qty <= 0) continue;

                    $id_barang = $raw;
                    if(strpos($raw, ' - ') !== false){
                        $id_barang = trim(explode(' - ', $raw, 2)[0]);
                    }

                    $detail = [
                        'id_detail'  => $this->detailModel->generateId(),
                        'id_pesanan' => $id_pesanan,
                        'id_barang'  => $id_barang,
                        'jumlah'     => $qty
                    ];

                    $this->detailModel->create($detail);
                }

                $this->db->commit();
                header("Location: index.php?controller=pesanan&action=index");
                exit;

            } catch(Exception $e){
                if($this->db->inTransaction()) $this->db->rollBack();
                die("Gagal menyimpan pesanan: " . $e->getMessage());
            }
        }
    }

    public function detail(){
        $id = $_GET['id'] ?? null;
        if(!$id){ echo "ID tidak ditemukan"; exit; }

        $dataPesanan = $this->model->find($id);
        $dataDetail = $this->detailModel->getDetailJoin($id);

        require __DIR__ . '/../views/detail_pesanan_views.php';
        exit;
    }

  
    public function edit(){
        $id = $_GET['id'] ?? null;
        if(!$id){
            header("Location:index.php?controller=pesanan&action=index");
            exit;
        }

        $pesanan = $this->model->find($id);
        $detail = $this->detailModel->getDetailJoin($id);

        $suppliers = $this->db->query("
            SELECT id_supplier, nama_supplier FROM supplier
        ")->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/pesanan_edit.php';
    }

    public function update(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id_pesanan = $_POST['id_pesanan'];

            $data = [
                'tgl_pesanan' => $_POST['tgl_pesanan'],
                'status'      => $_POST['status'],
                'id_supplier' => $_POST['id_supplier']
            ];

            try {

                $this->db->beginTransaction();

                $this->model->update($id_pesanan, $data);

                $this->detailModel->deleteByPesanan($id_pesanan);

                $items = $_POST['item_input'] ?? [];
                $jumlahs = $_POST['jumlah'] ?? [];

                for($i = 0; $i < count($items); $i++){
                    $raw = trim($items[$i]);
                    $qty = (int)$jumlahs[$i];

                    if($raw === "" || $qty <= 0) continue;

                    $id_barang = $raw;
                    if(strpos($raw, ' - ') !== false){
                        $id_barang = trim(explode(' - ', $raw, 2)[0]);
                    }

                    $detail = [
                        'id_detail'  => $this->detailModel->generateId(),
                        'id_pesanan' => $id_pesanan,
                        'id_barang'  => $id_barang,
                        'jumlah'     => $qty
                    ];

                    $this->detailModel->create($detail);
                }

                $this->db->commit();
                header("Location:index.php?controller=pesanan&action=index");
                exit;

            } catch(Exception $e){
                if($this->db->inTransaction()) $this->db->rollBack();
                die("Gagal update pesanan: " . $e->getMessage());
            }
        }
    }

   
    public function hapus(){
        $id = $_GET['id'] ?? null;

        if($id){
            try {
                $this->db->beginTransaction();
                $this->detailModel->deleteByPesanan($id);
                $this->model->delete($id);
                $this->db->commit();
            } catch(Exception $e){
                if($this->db->inTransaction()) $this->db->rollBack();
                die("Gagal hapus pesanan: " . $e->getMessage());
            }
        }

        header("Location:index.php?controller=pesanan&action=index");
        exit;
    }
}
?>
