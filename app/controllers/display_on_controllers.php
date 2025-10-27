public function edit() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
$this->model->id_barang = $_POST['id_barang'];
        $this->model->id_etalase = $_POST['id_etalase'];

        if ($this->model->update()) {
            echo "<script>alert('Data berhasil diupdate'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Gagal update data');</script>";
        }
    } else {
        $id_barang = $_GET['id_barang'];
        $query = "SELECT * FROM display_on WHERE id_barang = :id_barang";
        $stmt = $this->model->conn->prepare($query);
        $stmt->bindParam(":id_barang", $id_barang);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        include "view/display_on_edit.php";
    }
}
