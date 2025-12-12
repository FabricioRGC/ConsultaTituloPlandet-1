<?php
require_once __DIR__ . '/../models/DocumentModel.php';
require_once __DIR__ . '/../services/QRService.php';

class QRController {

    public function generar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        if (!isset($_FILES['pdf'])) return;

        $pdf = $_FILES['pdf'];
         $title   = $_POST['title'] ?? '';
        $partida = $_POST['partida'] ?? '';
        $fecha   = $_POST['fecha'] ?? '';

        if ($pdf['type'] !== 'application/pdf') {
            echo "Debe subir un PDF válido.";
            return;
        }
        $model = new DocumentModel();
        $qrService = new QRService();

        // 1. Mover PDF
        $pdfPath = $qrService->moverPDF($pdf);

        // 2. Generar ID único
        $uniqueId = uniqid('', true);

        // 3. URL de consulta
        //$urlConsulta = "http://200.233.44.151:82/ConsultaTituloPlandet/view.php?id=$uniqueId";
        $urlConsulta = "http://localhost/ConsultaTituloPlandet/view.php?id=$uniqueId";
        // 4. Generar QR
        $qrPath = $qrService->generarQR($urlConsulta, $uniqueId);

        // 5. Guardar en BD
        if ($model->insert($partida, $title, $pdfPath, $qrPath, $uniqueId, $fecha)) {
            header("Location: index.php?action=dashboard&qr=" . urlencode($qrPath));
            exit();
        } else {
            echo "Error guardando en la base de datos.";
        }
    }
}
