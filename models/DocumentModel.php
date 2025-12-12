<?php
require_once __DIR__ . '/../config/database.php';

class DocumentModel {

    public function insert($partida, $title, $pdfPath, $qrPath, $uniqueId, $fecha) {
        $db = Database::connection();
        $sql = "INSERT INTO documents (partida, title, pdf_path, qr_code, unique_id, fecha)
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
         return $stmt->execute([
        $partida,
        $title,
        $pdfPath,
        $qrPath,
        $uniqueId,
        $fecha
    ]);
    }   
}
