<?php
// public/index.php
// Front controller - punto de entrada

require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/AuditController.php';
require_once __DIR__ . '/services/AuthMiddleware.php';
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/AuditModel.php';
require_once __DIR__ . '/views/templates/main-template.php';

$action = $_GET['action'] ?? '';

$authController = new AuthController();
$auditController = new AuditController();

switch ($action) {
    case 'login':
        $authController->handleLogin();
        break;

    case 'logout':
        $authController->handleLogout();
        break;

    case 'track_event':
        AuthMiddleware::requireLogin();
        $auditController->trackEvent();
        break;

    case 'dasboard':
        AuthMiddleware::requireLogin();
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $audit = new AuditModel();
        $audit->logActivity(
            (int)($_SESSION['usuario_id'] ?? 0),
            'OPEN_DASHBOARD',
            'SYSTEM',
            null,
            null,
            'Ingreso al dashboard',
            ['tab' => $_GET['tab'] ?? null],
            $_SESSION['audit_session_token'] ?? session_id()
        );
        $rol = $_SESSION['usuario_rol'] ?? null;

        if ($rol === 'admin') {
            render_page(
                __DIR__ . '/views/pages/dash_admin.php',
                'Dashboard Admin',
                ['/ConsultaTituloPlandet/styles/dasboard.css'],
                true
            );
        } elseif ($rol === 'user') {
            render_page(
                __DIR__ . '/views/pages/dash_locador.php',
                'Dashboard User',
                ['/ConsultaTituloPlandet/styles/dasboard.css'],
                true
            );
        } else {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            session_destroy();
            header("Location: /ConsultaTituloPlandet/index.php");
            exit;
        }
        break;

    default:
        // Mostrar login SIN templateee (login no usa navbar/footer)
        require_once __DIR__ . '/views/login.php';
        break;
}
