<?php
require_once __DIR__ . '/../services/AuthService.php';

class AuthController {

    private $service;

    public function __construct() {
        $this->service = new AuthService();
    }

    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
<<<<<<< Updated upstream
            header("Location: /index.php");
=======
            header("Location: /ConsultaTituloPlandet-1/index.php");
>>>>>>> Stashed changes
            exit;
        }

        $name = trim($_POST['name'] ?? '');
        $password = $_POST['password'] ?? '';

<<<<<<< Updated upstream
        if ($name === '' || $password === '') {
            header("Location: /index.php?error=1");
=======
        if ($credential === '' || $password === '') {
            header("Location: /ConsultaTituloPlandet-1/index.php?error=1");
>>>>>>> Stashed changes
            exit;
        }

        $user = $this->service->login($name, $password);

        if (!$user) {
<<<<<<< Updated upstream
            header("Location: /index.php?error=1");
=======
            $email = filter_var($credential, FILTER_VALIDATE_EMAIL) ? $credential : null;
            $this->audit->logLogin(null, $email, 'failed', $ip, $userAgent, $sessionToken);
            header("Location: /ConsultaTituloPlandet-1/index.php?error=1");
>>>>>>> Stashed changes
            exit;
        }

        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_name'] = $user['name'];
        $_SESSION['usuario_rol'] = $user['rol'];

<<<<<<< Updated upstream
        header("Location: /index.php?action=dashboard");
=======
        $this->audit->logLogin((int)$user['id'], $user['email'], 'success', $ip, $userAgent, $sessionToken);
        $this->audit->logActivity((int)$user['id'], 'LOGIN', 'AUTH', null, null, 'Inicio de sesion', null, $sessionToken);

        header("Location: /ConsultaTituloPlandet-1/index.php?action=dasboard");
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
        header("Location: /index.php");
=======
        header("Location: /ConsultaTituloPlandet-1/index.php");
>>>>>>> Stashed changes
        exit;
    }
}
