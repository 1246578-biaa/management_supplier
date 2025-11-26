<?php
require_once __DIR__ . '/../models/login.php';

class LoginController {

    public function index() {
        include __DIR__ . '/../views/login_views.php';
    }

    public function process() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $login = new Login();
        $admin = $login->cekLogin($email, $password);

        if ($admin) {

            // SET SESSION
            $_SESSION['admin'] = $admin;

            // Redirect langsung tanpa alert
            header("Location: index.php?controller=dashboard&action=index");
            exit;

        } else {

            // CEK EMAIL ADA ATAU TIDAK
            require_once __DIR__ . '/../config/database.php';
            $db = new Database();
            $conn = $db->getConnection();

            $cekEmail = $conn->prepare("SELECT email FROM admin WHERE email = :email");
            $cekEmail->bindParam(':email', $email);
            $cekEmail->execute();

            if ($cekEmail->rowCount() == 0) {
                header("Location: index.php?controller=login&action=index&error=wrong_email");
            } else {
                header("Location: index.php?controller=login&action=index&error=wrong_password");
            }
            exit;
        }
    }

    public function logout() {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_destroy();

    // Arahkan ke landing page
    header("Location: landing/index.php");
    exit;
}

}
?>

