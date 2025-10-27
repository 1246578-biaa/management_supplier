<?php
require_once 'app/config/database.php';

class Etalase {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conn;
    }

    public function tampilkanSemua() {
        $query = "SELECT * FROM etalase";
        $result = $this->conn->query($query);
        return $result;
    }
}
?>
