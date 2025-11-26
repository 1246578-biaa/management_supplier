<?php
class dashboard_model
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getTotalPesanan() { return (int)$this->db->query("SELECT COUNT(*) FROM pesanan")->fetchColumn(); }
    public function getTotalDikirim() { return (int)$this->db->query("SELECT COUNT(*) FROM pesanan WHERE status='Dikirim'")->fetchColumn(); }
    public function getTotalDiambil() { return (int)$this->db->query("SELECT COUNT(*) FROM pesanan WHERE status='Diambil'")->fetchColumn(); }
    public function getTotalBarang() { return (int)$this->db->query("SELECT COUNT(*) FROM barang")->fetchColumn(); }
    public function getTotalSupplier() { return (int)$this->db->query("SELECT COUNT(*) FROM supplier")->fetchColumn(); }
    public function getTotalReturn() { return (int)$this->db->query("SELECT COUNT(*) FROM return_to")->fetchColumn(); }

    public function getPesananTerbaru()
    {
        $stmt = $this->db->query("
            SELECT p.id_pesanan, p.tgl_pesanan, p.status, s.nama_supplier
            FROM pesanan p
            LEFT JOIN supplier s ON p.id_supplier = s.id_supplier
            ORDER BY p.tgl_pesanan DESC
            LIMIT 10
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChartPesananPerSupplier()
    {
        $stmt = $this->db->query("
            SELECT s.nama_alias, COUNT(p.id_pesanan) AS total
            FROM pesanan p
            JOIN supplier s ON p.id_supplier = s.id_supplier
            GROUP BY s.nama_alias
            ORDER BY s.nama_alias ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChartPesananPerBulan()
    {
        $stmt = $this->db->query("
            SELECT DATE_FORMAT(tgl_pesanan,'%Y-%m') AS bulan, COUNT(*) AS total
            FROM pesanan
            GROUP BY DATE_FORMAT(tgl_pesanan,'%Y-%m')
            ORDER BY bulan ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fungsi Ajax: filter waktu
    public function getChartPesananPerTime($periode)
    {
        switch($periode){
            case 'minggu':
                $stmt = $this->db->query("
                    SELECT CONCAT(YEARWEEK(tgl_pesanan,1)) AS label, COUNT(*) AS total
                    FROM pesanan
                    GROUP BY YEARWEEK(tgl_pesanan,1)
                    ORDER BY label ASC
                ");
                break;
            case 'bulan':
                $stmt = $this->db->query("
                    SELECT DATE_FORMAT(tgl_pesanan,'%Y-%m') AS label, COUNT(*) AS total
                    FROM pesanan
                    GROUP BY DATE_FORMAT(tgl_pesanan,'%Y-%m')
                    ORDER BY label ASC
                ");
                break;
            case 'tahun':
                $stmt = $this->db->query("
                    SELECT YEAR(tgl_pesanan) AS label, COUNT(*) AS total
                    FROM pesanan
                    GROUP BY YEAR(tgl_pesanan)
                    ORDER BY label ASC
                ");
                break;
            default:
                return [];
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
