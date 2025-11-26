<?php
class PengirimanController {
    private $model;

    public function __construct($db){
        require_once __DIR__.'/../models/Pengiriman.php';
        $this->model = new PengirimanModel($db);
    }

    public function index(){
        $data_pengiriman = $this->model->getAllPengiriman();
        $pesanan = $this->model->getPesananDikirim(); // untuk modal tambah
        $action = 'list';
        include __DIR__.'/../views/pengiriman_views.php';
    }

    public function getDetailPesanan(){
        $id_pesanan = $_GET['id_pesanan'] ?? '';
        $detail = $this->model->getDetailBarangPesanan($id_pesanan);
        header('Content-Type: application/json');
        echo json_encode($detail);
    }

    public function add(){
        $id_pesanan = $_POST['id_pesanan'];
        $id_supplier = $_POST['id_supplier'];
        $tgl_pengiriman = $_POST['tgl_pengiriman'];
        $keterangan = $_POST['keterangan'];
        $barang = $_POST['barang'] ?? [];

        $id_pengiriman = $this->model->addPengiriman($id_pesanan, $id_supplier, $tgl_pengiriman, $keterangan);

        foreach($barang as $b){
            if(!empty($b['id_barang'])){
                $this->model->addDetailPengiriman($id_pengiriman, $b['id_barang'], $b['jumlah_barang']);
            }
        }

        header('Location: index.php?controller=pengiriman');
        exit;
    }

    public function detail(){
        $id_pengiriman = $_GET['id'] ?? '';
        $detail = $this->model->getDetailPengiriman($id_pengiriman);

        $no=1;
        echo '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>';
        foreach($detail as $d){
            echo "<tr>
                    <td>{$no}</td>
                    <td>{$d['id_barang']}</td>
                    <td>{$d['nama_barang']}</td>
                    <td>{$d['jumlah_barang']}</td>
                  </tr>";
            $no++;
        }
        echo '</tbody></table>';
    }
}

