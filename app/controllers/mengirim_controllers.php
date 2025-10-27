<?php
class Mengirim extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pengiriman_model');
    }

    public function index() {
        $data['pengiriman'] = $this->Pengiriman_model->getAllPengiriman();
        $data['supplier'] = $this->Pengiriman_model->getSupplier();
        $data['barang'] = $this->Pengiriman_model->getBarang();
        $this->load->view('mengirim_view', $data);
    }

    public function tambah() {
        $data = [
            'Jumlah' => $this->input->post('jumlah'),
            'Id_Supplier' => $this->input->post('supplier'),
            'Id_Barang' => $this->input->post('barang')
        ];
        $this->Pengiriman_model->insertPengiriman($data);
        redirect('mengirim');
    }
}
?>

