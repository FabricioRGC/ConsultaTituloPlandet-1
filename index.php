<?php
// public/index.php
// Front controller - punto de entrada

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/services/AuthMiddleware.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/views/templates/main-template.php';

$action = $_GET['action'] ?? '';



$authController = new AuthController();

switch ($action) {
    case 'login':
        $authController->handleLogin();
        break;

    case 'logout':
        $authController->handleLogout();
        break;

    case 'dashboard':
        // Requiere sesión
        AuthMiddleware::requireLogin();
        $rol = $_SESSION['usuario_rol'] ?? null;

        if ($rol === 'admin') {
            render_page(
                __DIR__ . '/views/pages/dash_admin.php',
                'Dashboard Admin',
                ['/styles/dashboard.css'],
                true  // requiere autenticación
            );
        } elseif ($rol === 'locador') {
            render_page(
                __DIR__ . '/views/pages/dash_locador.php',
                'Dashboard Locador',
                ['/styles/dashboard.css'],
                true
            );
        } else {
            // rol desconocido
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            session_destroy();
            header("Location: /index.php");
            exit;
        }
        break;
        
    default:
        // Mostrar login SIN template (login no usa navbar/footer)
        require_once __DIR__ . '/views/login.php';
        break;
}