<?php
<<<<<<< HEAD
function render_page($contentFile, $pageTitle = 'Sistema', $additionalCSS = [], $requireAuth = false)
{
=======
function render_page($contentFile, $pageTitle = 'Sistema', $additionalCSS = [], $requireAuth = false) {
>>>>>>> CalebRomero
    // Si requiere autenticación, verificar
    if ($requireAuth) {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (!isset($_SESSION['usuario_id'])) {
<<<<<<< HEAD
            header("Location: /index.php");
            exit;
        }
    }
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <!-- 1. SweetAlert2 Estilos y Script -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="/src/icon.svg">
        <title><?php echo htmlspecialchars($pageTitle); ?></title>

=======
            header("Location: /ConsultaTituloPlandet-1/index.php");
            exit;
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="/ConsultaTituloPlandet-1/src/icon.svg">
        <title><?php echo htmlspecialchars($pageTitle); ?></title>
        
>>>>>>> CalebRomero
        <!-- CSS adicionales específicos -->
        <?php foreach ($additionalCSS as $css): ?>
            <link rel="stylesheet" href="<?php echo htmlspecialchars($css); ?>">
        <?php endforeach; ?>
    </head>
<<<<<<< HEAD

    <body>
        <?php
=======
    <body>
        <?php 
>>>>>>> CalebRomero
        // Incluir navbar solo si hay sesión activa
        if (isset($_SESSION['usuario_id'])) {
            require_once __DIR__ . '/../components/navbar.php';
            $rol = $_SESSION['usuario_rol'] ?? '';
            $nombre = $_SESSION['usuario_name'] ?? 'Usuario';
<<<<<<< HEAD
            render_navbar($rol, $nombre);
=======
            render_navbar( $rol, $nombre);
>>>>>>> CalebRomero
        }
        ?>

        <main class="main-content" style="background-color: #e3e4e1ff ; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; min-height: 100vh; padding: 1rem;  flex-direction: column; flex: 1;">
<<<<<<< HEAD
            <?php
=======
            <?php 
>>>>>>> CalebRomero
            // Incluir el contenido de la página
            if (file_exists($contentFile)) {
                require $contentFile;
            } else {
                echo "<h1>Error: Página no encontrada</h1>";
            }
            ?>
        </main>
    </body>
<<<<<<< HEAD

    </html>
<?php
=======
    </html>
    <?php
>>>>>>> CalebRomero
}
?>