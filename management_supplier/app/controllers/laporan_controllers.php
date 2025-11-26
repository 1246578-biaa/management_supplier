<?php

class LaporanController {

    private $model;

    public function __construct() {
        require_once __DIR__ . '/../models/laporan.php';
        $this->model = new Laporan();
    }

    public function index() {
        require __DIR__ . '/../views/laporan_index.php';
    }

    public function laporan_pesanan() {
        $data = $this->model->getLaporanPesanan();
        require __DIR__ . '/../views/laporan_pesanan_views.php';
    }

    public function laporan_retur() {
        $data = $this->model->getLaporanRetur();
        require __DIR__ . '/../views/laporan_return_views.php';
    }
}
