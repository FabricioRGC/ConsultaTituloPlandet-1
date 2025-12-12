<?php
require_once __DIR__ . '/../models/User.php';

class AuthService {

    public function login(string $name, string $password) {
        $user = Usuario::findByName($name);
        if (!$user) return false;

         if (!$user['password'] === $password) {
            return false;
        }

        // Opcional: puedes refrescar datos o verificar estado (activo, etc.)
        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'rol' => $user['rol'],
        ];
    }
}
