<?php
require_once __DIR__ . '/../config/database.php';

class DocumentModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function insert($partida, $title, $pdfPath, $qrPath, $uniqueId, $fecha)
    {
        $sql = "INSERT INTO documents (partida, title, pdf_path, qr_code, unique_id, fecha)
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt =  $this->db->prepare($sql);
        return $stmt->execute([
            $partida,
            $title,
            $pdfPath,
            $qrPath,
            $uniqueId,
            $fecha
        ]);
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM documents ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function search($titulo = '', $partida = '', $fecha = '')
    {
        // Si no hay ningún criterio, devolver todo
        if (empty($titulo) && empty($partida) && empty($fecha)) {
            return $this->getAll();
        }

        $conditions = [];
        $params = [];

        if (!empty($titulo)) {
            $conditions[] = "title LIKE ?";
            $params[] = "%{$titulo}%";
        }

        if (!empty($partida)) {
            $conditions[] = "partida LIKE ?";
            $params[] = "%{$partida}%";
        }

        if (!empty($fecha)) {
            // fecha completa (YYYY-MM-DD)
            $conditions[] = "DATE(fecha) = ?";
            $params[] = $fecha;
        }

        // ✅ AND dinámico (comportamiento esperado)
        $sql = "SELECT * FROM documents 
                WHERE " . implode(' AND ', $conditions) . " 
                ORDER BY id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchDocuments(string $numero, string $year): array
    {
        $sql = "SELECT * FROM documents
                WHERE title LIKE ?
                AND YEAR(fecha) = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(["%$numero%", $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM documents WHERE id = ?");
        $stmt->execute([$id]);
        $doc = $stmt->fetch(PDO::FETCH_ASSOC);
        return $doc ?: null;
    }

    public function updateDocument(int $id, string $pdf, string $qr, string $uniqueId): void
    {
        $stmt = $this->db->prepare(
            "UPDATE documents SET pdf_path = ?, qr_code = ?, unique_id = ? WHERE id = ?"
        );
        $stmt->execute([$pdf, $qr, $uniqueId, $id]);
    }


    public function delete($id)
    {
        $db = Database::connection();

        $sql = "DELETE FROM documents WHERE id = ?";
        $stmt = $db->prepare($sql);

        return $stmt->execute([$id]);
    }

    public function getByUniqueId($uniqueId)
    {
        $sql = "SELECT * FROM documents WHERE unique_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$uniqueId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
