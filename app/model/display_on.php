public function update() {
    $query = "UPDATE display_on 
              SET id_etalase = :id_etalase 
              WHERE id_barang = :id_barang";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id_etalase", $this->id_etalase);
    $stmt->bindParam(":id_barang", $this->id_barang);
    return $stmt->execute();
}
