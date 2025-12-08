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

            
            session_regenerate_id(true);

            $_SESSION['admin'] = $admin;                
            $_SESSION['id_toko'] = $admin['id_toko'] ?? null;   
            $_SESSION['role'] = $admin['role'] ?? 'guest';     

            header("Location: index.php?controller=dashboard&action=index");
            exit;

        } else {

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

        unset($_SESSION['admin'], $_SESSION['id_toko'], $_SESSION['role']);
        session_destroy();

        header("Location: landing/index.php");
        exit;
    }
}
?>
