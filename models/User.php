<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {

     public static function findByName(string $name) {
        $db = Database::connection();
        $sql = "SELECT id, name, password, rol FROM user WHERE name = ? LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name]);
        $user = $stmt->fetch();
        return $user ?: false;
    }
}
