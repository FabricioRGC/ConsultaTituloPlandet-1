<?php

require_once __DIR__ . '/../models/DocumentModel.php';
require_once __DIR__ . '/../services/QRService.php';
require_once __DIR__ . '/../config/urls.php';

class DocumentController
{
    private DocumentModel $model;
    private QRService $qr;

    public function __construct()
    {
        $this->model = new DocumentModel();
        $this->qr    = new QRService();
    }

    /**
     * ÚNICO método que usa el componente
     */
    public function getDocuments()
    {
       $titulo  = $_POST['title']   ?? '';
        $partida = $_POST['partida'] ?? '';
        $fecha   = $_POST['fecha']   ?? '';

        return $this->model->search($titulo, $partida, $fecha);
    }

    public function handleUpdateQRPDF(): array
    {
        // Estados iniciales
        $mode             = 'search';
        $searchResults    = null;
        $selectedDocument = null;
        $success          = null;
        $error            = null;

        /* ==========================
           1️⃣ BUSCAR DOCUMENTO
        ========================== */
        if (isset($_POST['numero'], $_POST['year'])) {
            $results = $this->model->searchDocuments(
                $_POST['numero'],
                $_POST['year']
            );

            $searchResults = is_array($results) ? $results : [];

            if (count($searchResults) === 0) {
                $mode = 'empty';
            } elseif (count($searchResults) === 1) {
                $selectedDocument = $searchResults[0];
                $mode = 'update';
            } else {
                $mode = 'list';
            }
        }

        /* ==========================
           2️⃣ SELECCIONAR DOCUMENTO
        ========================== */
        if (isset($_GET['select_doc'])) {
            $selectedDocument = $this->model->getById((int)$_GET['select_doc']);
            if ($selectedDocument) {
                $mode = 'update';
            }
        }

        /* ==========================
           3️⃣ ACTUALIZAR PDF / QR
        ========================== */
        if (isset($_POST['document_id'], $_FILES['pdf_nuevo'])) {
            try {
                $doc = $this->model->getById((int)$_POST['document_id']);
                if (!$doc) {
                    throw new Exception('Documento no encontrado');
                }

                // Mover PDF
                $newPdfPath = $this->qr->moverPDF($_FILES['pdf_nuevo']);

                $updateType = $_POST['update_type'] ?? 'pdf_only';
                $qrPath     = $doc['qr_code'];

                // 🔁 Regenerar QR si corresponde
                if ($updateType === 'pdf_and_qr') {
                    $uniqueId = uniqid('', true);
                    $url      = URL_VIEW_DOCUMENT . $uniqueId;

                    $qrPath = $this->qr->generarQR($url, $uniqueId);
                }

                // Guardar cambios
                $this->model->updateDocument(
                    $doc['id'],
                    $newPdfPath,
                    $qrPath,
                    $uniqueId ?? $doc['unique_id']
                );

                $success = [
                    'document_id'   => $doc['id'],
                    'new_pdf'       => $newPdfPath,
                    'qr_regenerated' => $updateType === 'pdf_and_qr'
                ];

                $mode = 'success';
            } catch (Throwable $e) {
                $error = $e->getMessage();
                $mode  = 'update';
            }
        }

        return compact(
            'mode',
            'searchResults',
            'selectedDocument',
            'success',
            'error'
        );
    }

    public function viewPdf(string $uniqueId): void
    {
        $document = $this->model->getByUniqueId($uniqueId);

        if (!$document) {
            http_response_code(404);
            echo "Documento no encontrado.";
            exit;
        }

        $pdfPath = $document['pdf_path'];
        $title   = $document['title'];

        if (!file_exists($pdfPath)) {
            http_response_code(404);
            echo "El archivo no existe.";
            exit;
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($title) . '.pdf"');
        header('Content-Length: ' . filesize($pdfPath));

        readfile($pdfPath);
        exit;
    }
}
