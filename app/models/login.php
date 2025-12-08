<?php
require_once __DIR__ . '/../config/database.php';

class Login {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function cekLogin($email, $password) {

        // Ambil admin berdasarkan email
        $query = "SELECT * FROM admin WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Tidak ada email
        if (!$admin) {
            return false;
        }

        // NOTE: Saat ini password tersimpan plain-text.
        // Untuk produksi sebaiknya gunakan password_hash() dan password_verify().
        if ($password === $admin['password']) {
            return $admin;
        }

        return false; // Password salah
    }
}
?>
