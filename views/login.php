<?php
$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/styles/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <?php if ($error): ?>
            <div class="error">Usuario o contraseña incorrectos.</div>
        <?php endif; ?>

        <form action="/index.php?action=login" method="POST" autocomplete="off">
            <label>Usuario</label>
            <input name="name" type="text" required>

            <label>Contraseña</label>
            <input name="password" type="password" required>

            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>
