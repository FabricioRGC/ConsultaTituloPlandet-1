<?php
require_once __DIR__ . '/../../controllers/QRController.php';

$controller = new QRController();

// 1. Manejo del Formulario de Subida (POST)
// La lógica del controlador solo se ejecuta cuando el formulario se envía.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí se ejecutaría la lógica de subida de PDF y generación de QR
    $controller->generar();
    // NOTA: Si generar() redirige con el path del QR, se capturará a continuación.
}

// 2. Capturar QR (Si el controlador ha redirigido con el path)
// Se utiliza htmlspecialchars para prevenir XSS.
$qrPath = isset($_GET['qr']) ? htmlspecialchars($_GET['qr']) : "";

// 3. Obtener fecha actual en formato YYYY-MM-DD
$fechaActual = date('Y-m-d');
?>

<link rel="stylesheet" href="/styles/tab-generarQR.css">

<div class="main-container">

    <div class="content-wrapper">
        <aside class="left-panel">
            <div class="left-panel-scroll">
                <section class="card">
                    <h2 class="card-title">📤 Subir PDF</h2>

                    <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <button id="clearForm" type="button" class="btn-action btn-clear-form form-clear-btn">
                            <span>🗑️</span> Limpiar Formulario
                        </button>
                        <div class="form-group">
                            <label for="title" class="form-label">Nombre del Título:</label>
                            <input type="text" class="form-control" placeholder="Ingrese el título" id="title" name="title" required>
                            <div class="invalid-feedback">Por favor, proporciona un título.</div>
                        </div>

                        <div class="form-group">
                            <label for="partida" class="form-label">Partida Electrónica:</label>
                            <input type="text" class="form-control" id="partida" name="partida"
                                placeholder="Ingrese la partida electrónica" required>
                            <div class="invalid-feedback">Ingrese la partida.</div>
                        </div>

                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha de Emisión:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha"
                                value="<?= $fechaActual ?>" required>
                            <div class="invalid-feedback">Ingrese la fecha.</div>
                        </div>

                        <div class="form-group">
                            <label for="pdf" class="form-label">Selecciona PDF:</label>
                            <input type="file" class="form-control" id="pdf" name="pdf"
                                accept="application/pdf" required>
                            <div class="invalid-feedback">Por favor, sube un archivo PDF válido.</div>
                        </div>

                        <button type="submit" class="btn btn-submit"
                            onclick="return confirm('¿Seguro que quieres subir este archivo?');">
                            📁 Subir Archivo
                        </button>
                    </form>
                </section>

                <section class="card">
                    <h2 class="card-title">⚙️ Configuración de Posición</h2>

                    <div class="position-grid">
                        <div class="position-group">
                            <h3 class="position-subtitle">Código QR</h3>
                            <div class="input-row">
                                <label for="qr-x">Posición X:</label>
                                <input type="number" id="qr-x" step="0.1" value="0.6" class="input-small">
                            </div>
                            <div class="input-row">
                                <label for="qr-y">Posición Y:</label>
                                <input type="number" id="qr-y" step="0.1" value="2.0" class="input-small">
                            </div>
                        </div>

                        <div class="position-group">
                            <h3 class="position-subtitle">Número de Partida</h3>
                            <div class="input-row">
                                <label for="num-x">Posición X:</label>
                                <input type="number" id="num-x" step="0.1" value="2.15" class="input-small">
                            </div>
                            <div class="input-row">
                                <label for="num-y">Posición Y:</label>
                                <input type="number" id="num-y" step="0.1" value="1.40" class="input-small">
                            </div>
                        </div>
                    </div>

                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="includeQR" checked>
                            <span>Incluir QR</span>
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" id="includePartida" checked>
                            <span>Incluir Partida Electrónica</span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="number-input" class="form-label">Partida (Previsualización):</label>
                        <input type="text" id="number-input" class="form-control"
                            placeholder="Partida Electrónica para el PDF">
                    </div>

                    <div class="form-group">
                        <label for="number-titulo" class="form-label">Título (Previsualización):</label>
                        <input type="text" id="number-titulo" class="form-control"
                            placeholder="Título para el nombre del archivo">
                    </div>

                    <div class="action-buttons-grid">
                        <input type="file" id="qr-code-file" accept="image/*" style="display:none;">
                        <button id="upload-button" class="btn btn-secondary">
                            📷 Cargar QR
                        </button>
                        <button id="preview-button" class="btn btn-preview">
                            👁️ Previsualizar
                        </button>
                        <button id="export-button" class="btn btn-primary">
                            💾 Descargar PDF
                        </button>
                    </div>

                    <div class="qr-preview-container">
                        <p class="preview-label">Vista previa del código QR:</p>
                        <img id="qr-preview" class="qr-preview" alt="Vista previa del QR"
                            src="<?= $qrPath ?>">
                    </div>
                </section>
            </div>
        </aside>

        <main class="right-panel">
            <div class="preview-container">
                <h2 class="preview-title">📄 Vista Previa del Documento</h2>
                <iframe class="pdf-viewer" id="pdfViewer" title="Visor de PDF original"></iframe>
            </div>

            <div class="preview-container">
                <h2 class="preview-title">🔍 Previsualización con QR</h2>
                <iframe class="pdf-viewer" id="pdf-preview" title="Previsualización del PDF con QR"></iframe>
            </div>
        </main>
    </div>
</div>

<div class="toast-container">
    <div id="liveToast" class="toast fade" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-header">
            <strong>⚠️ Aviso</strong> 
        </div>
        <div class="toast-body">
            Mensaje de notificación
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    const serverQrPath = "<?php echo $qrPath; ?>";
    const mainForm = document.querySelector('.needs-validation');

    // ================================
    // VARIABLES GLOBALES
    // ================================
    const pdfInput = document.getElementById("pdf");
    const pdfViewer = document.getElementById("pdfViewer");
    const titleInput = document.getElementById("title");
    const partidaInput = document.getElementById("partida");
    // Inputs de configuración (editables)
    const tituloNumberInput = document.getElementById("number-titulo");
    const numberInput = document.getElementById("number-input");
    
    const qrPreview = document.getElementById("qr-preview");
    const qrFile = document.getElementById("qr-code-file");
    const previewBtn = document.getElementById("preview-button");
    const exportBtn = document.getElementById("export-button");
    const pdfPreview = document.getElementById("pdf-preview");
    const qrX = document.getElementById("qr-x");
    const qrY = document.getElementById("qr-y");
    const numX = document.getElementById("num-x");
    const numY = document.getElementById("num-y");

    let qrCodeImageUrl = null;

    // ================================
    // FUNCIONES DE PERSISTENCIA (LOCALSTORAGE)
    // ================================

    function loadTitleAndPartida() {
        const storedTitle = localStorage.getItem('qr_form_title');
        const storedPartida = localStorage.getItem('qr_form_partida');
        
        // Cargar campos de formulario principal y de configuración (si tienen datos guardados)
        if (storedTitle) {
            titleInput.value = storedTitle;
            tituloNumberInput.value = storedTitle;
        }
        if (storedPartida) {
            partidaInput.value = storedPartida;
            numberInput.value = storedPartida;
        }
    }

    /**
     * Guarda el valor de un campo en localStorage al cambiar.
     * @param {HTMLElement} element - El elemento input.
     * @param {string} key - La clave en localStorage.
     */
    function saveToLocalStorageOnChange(element, key) {
        element.addEventListener('input', function() {
            localStorage.setItem(key, this.value);
        });
    }

    // ================================
    // CARGA INICIAL DE DATOS
    // ================================
    document.addEventListener("DOMContentLoaded", function() {
        // Cargar datos persistentes
        loadTitleAndPartida();

        // Cargar QR desde el servidor si existe
        if (serverQrPath) {
            qrPreview.src = serverQrPath;
            qrCodeImageUrl = serverQrPath;
        }
    });

    // ================================
    // SINCRONIZAR Y PERSISTIR INPUTS
    // ================================

    // Persistencia del Título y Sincronización
    titleInput.addEventListener('input', function() {
        localStorage.setItem('qr_form_title', this.value);
        // Sincronización
        tituloNumberInput.value = this.value;
    });

    // Persistencia de la Partida y Sincronización
    partidaInput.addEventListener('input', function() {
        localStorage.setItem('qr_form_partida', this.value);
        // Sincronización
        numberInput.value = this.value;
    });

    // Persistencia de los inputs de configuración manual (Partida y Título de Previsualización)
    saveToLocalStorageOnChange(tituloNumberInput, 'qr_form_title');
    saveToLocalStorageOnChange(numberInput, 'qr_form_partida');


    // ================================
    // FUNCIONES DE LIMPIEZA
    // ================================
    document.getElementById("clearForm").addEventListener("click", function() {
        mainForm.reset();
        
        // Limpiar inputs de configuración y sincronizados
        tituloNumberInput.value = "";
        numberInput.value = "";
        
        // Limpiar previsualizaciones
        pdfViewer.src = "";
        pdfPreview.src = "";
        qrPreview.src = "";
        qrCodeImageUrl = null;
        
        // Limpiar localStorage SOLO para título y partida
        localStorage.removeItem('qr_form_title');
        localStorage.removeItem('qr_form_partida');

        // Quitar la clase de validación de Bootstrap
        mainForm.classList.remove('was-validated');
        
        window.location.href = "index.php?action=dashboard";
        
        showToast("Formulario y datos persistentes limpiados.", "success");
    });

    // ================================
    // VALIDACIÓN DE FORMULARIOS (Mejorado)
    // ================================
    (function() {
        'use strict';
        Array.prototype.slice.call(document.querySelectorAll('.needs-validation')).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                // Validación básica de campos requeridos antes de la confirmación
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();

    // ================================
    // CARGA Y PREVISUALIZACIÓN DEL PDF (Corrección de persistencia de título)
    // ================================
    pdfInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (file && file.type === 'application/pdf') {
            const fileName = file.name.replace(/\.pdf$/i, '');

            // Si el título principal o el de configuración están vacíos, se llenan con el nombre del archivo
            if (!titleInput.value) {
                titleInput.value = fileName;
                // **CORRECCIÓN:** Guardar en localStorage AQUI cuando se infiere el título.
                localStorage.setItem('qr_form_title', fileName); 
            }
            if (!tituloNumberInput.value) {
                tituloNumberInput.value = fileName;
            }

            const fileURL = URL.createObjectURL(file);
            pdfViewer.src = fileURL;

            showToast("PDF cargado correctamente", "success");
        } else {
            // El navegador ya debería manejar el 'invalid-feedback', pero agregamos un aviso
            showToast('Por favor, selecciona un archivo PDF válido.', "danger");
            pdfInput.value = "";
        }
    });

    // ================================
    // CARGAR QR DESDE SERVIDOR AL INICIO
    // ================================
    // Se mantiene en el DOMContentLoaded
    // ...

    // ================================
    // CARGA MANUAL DE QR
    // ================================
    qrFile.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const imageUrl = URL.createObjectURL(file);
            qrPreview.src = imageUrl;
            qrCodeImageUrl = imageUrl;
            showToast("Código QR cargado correctamente", "success");
        } else {
            showToast("Por favor selecciona una imagen válida", "warning");
        }
    });

    document.getElementById("upload-button").addEventListener('click', function() {
        qrFile.click();
    });

    // ================================
    // OBTENER VALORES DE CONFIGURACIÓN
    // ================================
    function getConfigurationValues() {
        // Lee los valores de los inputs de configuración, que ahora pueden ser editados manualmente
        return {
            partidaValue: numberInput.value.trim(),
            tituloValue: tituloNumberInput.value.trim(),
            includeQR: document.getElementById('includeQR').checked,
            includePartida: document.getElementById('includePartida').checked,
            qrXVal: parseFloat(qrX.value),
            qrYVal: parseFloat(qrY.value),
            numXVal: parseFloat(numX.value),
            numYVal: parseFloat(numY.value),
            qrCodeImageUrl: qrCodeImageUrl
        };
    }

    // ================================
    // GENERACIÓN DE PDF CON JSPDF
    // ================================
    function generatePDF(callback) {
        const config = getConfigurationValues();

        if (config.includeQR && !config.qrCodeImageUrl) {
            showToast("Debes cargar o generar un código QR para incluirlo.", "danger");
            return;
        }

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({
            orientation: 'landscape',
            unit: 'in',
            format: [11.69, 16.54] // Asumiendo formato A3 horizontal para este tamaño
        });

        if (config.includeQR && config.qrCodeImageUrl) {
            const qrImage = new Image();
            qrImage.crossOrigin = "anonymous";
            qrImage.src = config.qrCodeImageUrl;

            qrImage.onload = function() {
                try {
                    doc.addImage(qrImage, 'PNG', config.qrXVal, config.qrYVal, 1.10, 1.10);

                    if (config.includePartida && config.partidaValue) {
                        doc.setFontSize(14);
                        doc.text(config.partidaValue, config.numXVal, config.numYVal);
                    }
                    callback(doc);
                } catch (error) {
                    console.error("Error al agregar imagen QR:", error);
                    showToast("Error al agregar el código QR al PDF", "danger");
                }
            };

            qrImage.onerror = function() {
                console.error("Error al cargar imagen QR");
                showToast("Error al cargar la imagen del código QR", "danger");
            };
        } else {
            if (config.includePartida && config.partidaValue) {
                doc.setFontSize(14);
                doc.text(config.partidaValue, config.numXVal, config.numYVal);
            }
            callback(doc);
        }
    }

    // ================================
    // PREVISUALIZAR PDF
    // ================================
    previewBtn.addEventListener('click', function() {
        const config = getConfigurationValues();

        if (!config.tituloValue) {
            showToast("Por favor ingresa un Título (en Configuración) antes de previsualizar", "warning");
            return;
        }

        generatePDF(function(doc) {
            // Aseguramos que la función generatePDF fue exitosa
            if (doc) {
                pdfPreview.src = doc.output('datauristring');
                showToast("Vista previa generada correctamente", "success");
            }
        });
    });

    // ================================
    // EXPORTAR PDF
    // ================================
    exportBtn.addEventListener('click', function() {
        const config = getConfigurationValues();

        if (!config.tituloValue) {
            showToast("Por favor ingresa un Título (en Configuración) antes de exportar", "warning");
            return;
        }

        generatePDF(function(doc) {
            if (doc) {
                doc.save(config.tituloValue + '.pdf');
                showToast("PDF descargado exitosamente: " + config.tituloValue + ".pdf", "success");
            }
        });
    });

    // ================================
    // SISTEMA DE NOTIFICACIONES (TOAST)
    // ================================
    function showToast(message, type = "warning") {
        const toastEl = document.getElementById("liveToast");
        const toastHeader = toastEl.querySelector(".toast-header strong");
        const toastBody = toastEl.querySelector(".toast-body");

        toastBody.textContent = message;

        // Limpia clases anteriores y asigna la nueva
        toastEl.classList.remove("success", "danger", "warning");
        
        if (type === "success") {
            toastEl.classList.add("success");
            toastHeader.textContent = "✅ Éxito";
        }
        else if (type === "danger") {
            toastEl.classList.add("danger");
            toastHeader.textContent = "❌ Error";
        }
        else {
            toastEl.classList.add("warning");
            toastHeader.textContent = "⚠️ Aviso";
        }

        // Inicializar y mostrar el toast
        // CORRECCIÓN: Se pasa el objeto de configuración con el 'delay' explícitamente.
        const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
    }
</script>