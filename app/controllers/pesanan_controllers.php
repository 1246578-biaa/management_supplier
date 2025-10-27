<?php
class Pesanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pesanan_model');
    }

    public function index() {
        $data['pesanan'] = $this->Pesanan_model->getAllPesanan();
        $data['supplier'] = $this->Pesanan_model->getSupplier();
        $data['toko'] = $this->Pesanan_model->getToko();
        $this->load->view('pesanan_view', $data);
    }

    public function tambah() {
        $data = [
            'Tgl_Pesanan' => $this->input->post('tgl_pesanan'),
            'Status' => $this->input->post('status'),
            'Jumlah' => $this->input->post('jumlah'),
            'Id_Supplier' => $this->input->post('supplier'),
            'Id_Toko' => $this->input->post('toko')
        ];
        $this->Pesanan_model->insertPesanan($data);
        redirect('pesanan');
    }
}
?>

