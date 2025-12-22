<?php
require_once __DIR__ . '/../models/DocumentModel.php';
require_once __DIR__ . '/../services/QRService.php';
require_once __DIR__ . '/../config/urls.php';

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
        $urlConsulta = URL_VIEW_DOCUMENT . $uniqueId;
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

    public function subirMultiples() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;
        if (!isset($_FILES['pdfs'])) return;

        $model = new DocumentModel();
        $qrService = new QRService();

        foreach ($_FILES['pdfs']['tmp_name'] as $i => $tmp) {

            // Construcción manual del sub-arreglo
            $file = [
                "name" => $_FILES['pdfs']['name'][$i],
                "tmp_name" => $tmp,
                "type" => $_FILES['pdfs']['type'][$i]
            ];

            // Validación
            if ($file["type"] !== "application/pdf") {
                echo "El archivo no es un PDF válido";
                continue;
            }

            // 1. Mover PDF
            $pdfPath = $qrService->moverPDF($file);

            // 2. Generar ID único
            $uniqueId = uniqid('', true);

            // 3. URL de consulta (leyendo BASE_URL desde config)
            $urlConsulta = URL_VIEW_DOCUMENT . $uniqueId;

            // 4. Generar QR
            $qrPath = $qrService->generarQR($urlConsulta, $uniqueId);

            // 5. Insertar en BD
            $model->insert(
                "",                 // partida VACÍA (porque no existe en este formulario)
                $file["name"],      // title
                $pdfPath,
                $qrPath,
                $uniqueId,
                date("Y-m-d")       // fecha del día o pon la que quieras
            );
        }

    }

}
