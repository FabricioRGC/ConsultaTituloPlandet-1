<?php
function render_page($contentFile, $pageTitle = 'Sistema', $additionalCSS = [], $requireAuth = false) {
    // Si requiere autenticación, verificar
    if ($requireAuth) {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: /index.php");
            exit;
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($pageTitle); ?></title>
        
        <!-- CSS adicionales específicos -->
        <?php foreach ($additionalCSS as $css): ?>
            <link rel="stylesheet" href="<?php echo htmlspecialchars($css); ?>">
        <?php endforeach; ?>
    </head>
    <body>
        <?php 
        // Incluir navbar solo si hay sesión activa
        if (isset($_SESSION['usuario_id'])) {
            require_once __DIR__ . '/../components/navbar.php';
            $rol = $_SESSION['usuario_rol'] ?? '';
            $nombre = $_SESSION['usuario_name'] ?? 'Usuario';
            render_navbar( $rol, $nombre);
        }
        ?>
        
        <main class="main-content">
            <?php 
            // Incluir el contenido de la página
            if (file_exists($contentFile)) {
                require $contentFile;
            } else {
                echo "<h1>Error: Página no encontrada</h1>";
            }
            ?>
        </main>
    </body>
    </html>
    <?php
}
?>