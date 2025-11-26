<?php
require_once __DIR__ . '/../config/database.php';

class Login {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function cekLogin($email, $password) {

        // 🔍 Ambil admin berdasarkan email
        $query = "SELECT * FROM admin WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // ❌ Tidak ada email
        if (!$admin) {
            return false;
        }

        // ✔ Cocokkan password biasa / tanpa hashing
        if ($password === $admin['password']) {
            return $admin;   // MENGEMBALIKAN NAMA ADMIN!
        }

        return false; // ❌ Password salah
    }
}
?>
