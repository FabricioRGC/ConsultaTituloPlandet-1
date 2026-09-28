<?php

class AuthMiddleware {

    private static function ensureSession() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    public static function requireLogin() {
        self::ensureSession();
        if (empty($_SESSION['usuario_id'])) {
<<<<<<< Updated upstream
            header("Location: /index.php");
=======
            header("Location: /ConsultaTituloPlandet-1/index.php");
>>>>>>> Stashed changes
            exit;
        }
    }

    public static function requireRole($roles) {
        self::ensureSession();

        if (empty($_SESSION['usuario_id'])) {
<<<<<<< Updated upstream
            header("Location: /index.php");
=======
            header("Location: /ConsultaTituloPlandet-1/index.php");
>>>>>>> Stashed changes
            exit;
        }

        $userRole = $_SESSION['usuario_rol'] ?? null;

        if (is_string($roles)) {
            $roles = [$roles];
        }

        if (!in_array($userRole, $roles)) {
<<<<<<< Updated upstream
            header("Location: /index.php?action=dashboard");
=======
            header("Location: /ConsultaTituloPlandet-1/index.php?action=dasboard");
>>>>>>> Stashed changes
            exit;
        }
    }
}
