<?php
require_once __DIR__ . '/../services/AuthService.php';

class AuthController {

    private $service;

    public function __construct() {
        $this->service = new AuthService();
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: /index.php");
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($name === '' || $password === '') {
            header("Location: /index.php?error=1");
            exit;
        }

        $user = $this->service->login($name, $password);

        if (!$user) {
            header("Location: /index.php?error=1");
            exit;
        }

        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_name'] = $user['name'];
        $_SESSION['usuario_rol'] = $user['rol'];

        header("Location: /index.php?action=dashboard");
        exit;
    }

    public function handleLogout() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();

        header("Location: /index.php");
        exit;
    }
}
