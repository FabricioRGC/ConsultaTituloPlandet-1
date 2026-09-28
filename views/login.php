<?php
$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<<<<<<< Updated upstream
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="/styles/login.css">
    <link rel="icon" type="image/x-icon" href="/src/icon.svg">
=======
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plandet - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="/ConsultaTituloPlandet-1/src/icon.svg">
    <style>
        .gradient-bg {
            background: linear-gradient(to bottom right, rgb(37, 99, 235), rgb(29, 78, 216));
        }
    </style>
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
            <button type="submit">Ingresar</button>
        </form>
=======
                <?php if ($error): ?>
                    <div class="mb-4 rounded-lg border border-red-300 bg-red-50 text-red-700 px-4 py-3">
                        Credenciales invalidas. Verifica usuario/correo y contrasena.
                    </div>
                <?php endif; ?>

                <form action="/ConsultaTituloPlandet-1/index.php?action=login" method="POST" class="space-y-5" autocomplete="off">
                    <div>
                        <label for="name" class="block mb-2 text-gray-900 font-medium">
                            Correo o usuario
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
                            placeholder="usuario@plandet.local"
                            required
                        />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="text-gray-900 font-medium">
                                Contrasena
                            </label>
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-700 transition-colors">
                                Olvide mi contrasena
                            </a>
                        </div>
                        <div class="relative">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="w-full px-4 py-3 pr-12 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
                                placeholder="********"
                                required
                            />
                            <button
                                type="button"
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-900 transition-colors"
                                aria-label="Mostrar u ocultar contrasena"
                            >
                                <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-600"
                        />
                        <label for="remember" class="ml-2 text-gray-900 font-medium">
                            Recordar mi sesion
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg transition-colors duration-200 font-medium"
                    >
                        Iniciar sesion
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-center text-gray-500">
                        Necesitas ayuda? <a href="#" class="text-blue-600 hover:text-blue-700 transition-colors">Contacta al soporte</a>
                    </p>
                </div>
            </div>
        </div>
>>>>>>> Stashed changes
    </div>
</body>
</html>
