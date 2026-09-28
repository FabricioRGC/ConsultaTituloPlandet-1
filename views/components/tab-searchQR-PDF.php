<?php
require_once __DIR__ . '/../../controllers/DocumentController.php';

$currentTab = $_GET['tab'] ?? 'searchQR-PDF';

$controller = new DocumentController();
$documents = $controller->getDocuments();
?>
<link rel="stylesheet" href="/styles/tab-searchQR-PDF.css">
<div class="tab-searchqr sqr-container" id="searchQRTab">

    <!-- LISTADO DE DOCUMENTOS -->
    <?php if (!empty($documents)): ?>
        <div class="sqr-card sqr-documents-card">
            <form method="post" class="sqr-search-bar" action="?action=dashboard&tab=<?= urlencode($currentTab) ?>">
                <input type="text"
                    name="title"
                    class="sqr-input"
                    placeholder="Buscar por título"
                    value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">

                <input type="text"
                    name="partida"
                    class="sqr-input"
                    placeholder="Buscar por partida"
                    value="<?= htmlspecialchars($_POST['partida'] ?? '') ?>">

                <input type="date"
                    name="fecha"
                    class="sqr-input"
                    value="<?= htmlspecialchars($_POST['fecha'] ?? '') ?>">

                <button class="sqr-btn sqr-btn-primary">
                    🔍 Buscar
                </button>
            </form>
            <div class="sqr-card-header">
                <h3 class="sqr-card-title">📄 Documentos Disponibles</h3>
            </div>
            <div class="sqr-table-wrapper">
                <table class="sqr-table">
                    <thead>
                        <tr>
                            <th class="sqr-th-select">Seleccionar</th>
                            <th class="sqr-th-id">ID</th>
                            <th class="sqr-th-title">Título</th>
                            <th class="sqr-th-partida">Partida</th>
                            <th class="sqr-th-fecha">Fecha</th>
                            <th class="sqr-th-actions">PDF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($documents as $row): ?>
                            <tr class="sqr-tr">
                                <td class="sqr-td-center">
                                    <input type="radio"
                                        name="search_selected_doc"
                                        class="sqr-radio search-radio-doc"
                                        data-qr="<?= htmlspecialchars($row['qr_code'], ENT_QUOTES) ?>"
                                        data-title="<?= htmlspecialchars($row['title']) ?>"
                                        data-partida="<?= htmlspecialchars($row['partida']) ?>">
                                </td>
                                <td class="sqr-td-id"><?= (int)$row['id'] ?></td>
                                <td class="sqr-td-title"><?= htmlspecialchars($row['title']) ?></td>
                                <td class="sqr-td-partida"><?= htmlspecialchars($row['partida']) ?></td>
                                <td class="sqr-td-fecha"><?= htmlspecialchars($row['fecha']) ?></td>
                                <td class="sqr-td-center">
                                    <!-- 🔥 MODIFICADO: Mantener tab en URL del PDF -->
                                    <a href="<?= htmlspecialchars($row['pdf_path']) ?>"
                                        target="_blank"
                                        class="sqr-btn sqr-btn-info">
                                        📑 Ver PDF
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="sqr-empty-state">
            <div class="sqr-empty-icon">📭</div>
            <p class="sqr-empty-text">No hay documentos registrados.</p>
        </div>
    <?php endif; ?>

    <!-- VISUALIZACIÓN QR Y PARTIDA -->
    <div class="sqr-card sqr-preview-card">
        <div class="sqr-card-header">
            <h3 class="sqr-card-title">👁️ Previsualización</h3>
        </div>
        <div class="sqr-preview-grid">
            <div class="sqr-qr-section">
                <h4 class="sqr-section-title">Código QR</h4>
                <div class="sqr-qr-display">
                    <img id="search-qrDisplay" src="" alt="Código QR" class="sqr-qr-image">
                    <div class="sqr-qr-placeholder" id="search-qrPlaceholder">
                        <span>🔍</span>
                        <p>Selecciona un documento</p>
                    </div>
                </div>
            </div>

            <div class="sqr-partida-section">

                <h4 class="sqr-section-title">Nombre del Título</h4>
                <input type="text"
                    id="search-number-titulo"
                    maxlength="50"
                    class="sqr-input sqr-input-large"
                    placeholder="Ingrese el nombre del título">

                <h4 class="sqr-section-title">Partida Electrónica</h4>
                <input type="text"
                    id="search-partida-input"
                    class="sqr-input sqr-input-large"
                    placeholder="Ingrese la partida electrónica">

                <div class="sqr-checkboxes">
                    <label class="sqr-checkbox-label">
                        <input type="checkbox" id="search-chkQR" class="sqr-checkbox" checked>
                        <span>Incluir QR</span>
                    </label>
                    <label class="sqr-checkbox-label">
                        <input type="checkbox" id="search-chkPartida" class="sqr-checkbox" checked>
                        <span>Incluir Partida Electrónica</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- CONFIGURACIÓN DE POSICIONES -->
    <div class="sqr-card sqr-position-card">
        <div class="sqr-card-header">
            <h3 class="sqr-card-title">⚙️ Configuración de Posiciones en PDF</h3>
        </div>
        <div class="sqr-position-grid">
            <div class="sqr-position-group">
                <h5 class="sqr-group-title">Posición del QR</h5>
                <div class="sqr-input-row">
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posición X</label>
                        <input type="number" id="search-qr-x" value="0.33" step="0.1" class="sqr-input">
                    </div>
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posición Y</label>
                        <input type="number" id="search-qr-y" value="1.90" step="0.1" class="sqr-input">
                    </div>
                </div>
            </div>

            <div class="sqr-position-group">
                <h5 class="sqr-group-title">Posición del Número</h5>
                <div class="sqr-input-row">
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posición X</label>
                        <input type="number" id="search-num-x" value="2.15" step="0.1" class="sqr-input">
                    </div>
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posición Y</label>
                        <input type="number" id="search-num-y" value="1.30" step="0.1" class="sqr-input">
                    </div>
                </div>
            </div>
            <div class="sqr-export-content">
                <div class="sqr-actions">
                    <button id="search-preview-button" class="sqr-btn sqr-btn-secondary">
                        👁️ Previsualizar PDF
                    </button>
                    <button id="search-export-button" class="sqr-btn sqr-btn-primary">
                        💾 Exportar a PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- PREVIEW PDF -->
    <div class="sqr-preview-wrapper" id="search-previewWrapper" style="display:none;">
        <div class="sqr-preview-header">
            <h3>Vista Previa del PDF</h3>
            <button class="sqr-btn sqr-btn-close" id="search-closePreview">
                ✖ Cerrar
            </button>
        </div>
        <iframe id="search-pdfPreview" class="sqr-pdf-frame"></iframe>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script>
    // 🔥 NUEVO: Pasar tab actual a JavaScript
    const CURRENT_TAB = "<?= $currentTab ?>";

    // Encapsular todo en un namespace único para evitar conflictos
    window.SearchQRModule = (function() {
        'use strict';

        let initialized = false;

        function init() {
            // Evitar inicialización múltiple
            if (initialized) {
                console.log('SearchQR: Ya está inicializado');
                return;
            }

            console.log('SearchQR: Inicializando módulo...');

            // Verificar que el tab esté visible
            const tabElement = document.getElementById('searchQRTab');
            if (!tabElement) {
                console.log('SearchQR: Tab no encontrado');
                return;
            }

            function extractNumber(inputText) {
                let extracted = '';
                let parts = inputText.split('-');
                if (parts.length >= 2) {
                    extracted = parts[1];
                } else {
                    const match = inputText.match(/\d+/);
                    if (match) {
                        extracted = match[0];
                    }
                }
                if (extracted && /^\d+$/.test(extracted)) {
                    extracted = parseInt(extracted, 10).toString();
                }
                return extracted;
            }

            // Evento para radio buttons
            const radios = document.querySelectorAll('.search-radio-doc');
            console.log('SearchQR: Radio buttons encontrados:', radios.length);

            radios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        const qrUrl = this.getAttribute('data-qr');
                        const title = this.getAttribute('data-title');
                        const partida = this.getAttribute('data-partida');
                        seleccionarDocumento(qrUrl, title, partida);
                    }
                });
            });

            const rows = document.querySelectorAll('.sqr-tr');

            rows.forEach(row => {

                // CLICK SIMPLE = SELECCIONAR
                row.addEventListener('click', function(e) {

                    // ❌ No reaccionar si es el botón PDF
                    if (e.target.closest('.sqr-btn')) return;

                    const radio = row.querySelector('.search-radio-doc');
                    if (!radio) return;

                    radio.checked = true;
                    radio.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                });

                // DOBLE CLICK = PREVIEW
                row.addEventListener('dblclick', function(e) {
                    if (e.target.closest('.sqr-btn')) return;

                    const previewBtn = document.getElementById('search-preview-button');
                    if (previewBtn) previewBtn.click();
                });
            });

            // Botón exportar
            const exportButton = document.getElementById('search-export-button');
            if (exportButton) {
                exportButton.addEventListener('click', async function() {
                    console.log('SearchQR: Click en Exportar');
                    try {
                        const titulo = document.getElementById('search-number-titulo').value.trim() || 'SIN-TITULO';
                        const doc = await generatePDF();
                        doc.save(`${titulo}.pdf`);
                        console.log('SearchQR: PDF exportado');
                    } catch (error) {
                        console.error('SearchQR: Error al exportar PDF:', error);
                        alert('Error al exportar el PDF: ' + error.message);
                    }
                });
            }

            // Botón preview
            const previewButton = document.getElementById('search-preview-button');
            if (previewButton) {
                previewButton.addEventListener('click', async function() {
                    console.log('SearchQR: Click en Preview');
                    try {
                        const doc = await generatePDF();
                        const blobUrl = doc.output('bloburl');
                        const iframe = document.getElementById('search-pdfPreview');
                        const wrapper = document.getElementById('search-previewWrapper');

                        iframe.src = blobUrl;
                        wrapper.style.display = 'block';

                        setTimeout(() => {
                            wrapper.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }, 100);

                        console.log('SearchQR: Preview mostrado');
                    } catch (error) {
                        console.error('SearchQR: Error al previsualizar PDF:', error);
                        alert('Error al previsualizar el PDF: ' + error.message);
                    }
                });
            }

            // Botón cerrar preview
            const closePreview = document.getElementById('search-closePreview');
            if (closePreview) {
                closePreview.addEventListener('click', function() {
                    document.getElementById('search-previewWrapper').style.display = 'none';
                });
            }

            initialized = true;
            console.log('SearchQR: Módulo inicializado correctamente');
        }

        function limpiarSeleccionVisual() {
            document.querySelectorAll('.sqr-tr.is-selected')
                .forEach(row => row.classList.remove('is-selected'));
        }

        function seleccionarDocumento(qrUrl, title, partida) {
            console.log('SearchQR: Seleccionando documento:', {
                qrUrl,
                title,
                partida
            });

            const qrDisplay = document.getElementById('search-qrDisplay');
            const qrPlaceholder = document.getElementById('search-qrPlaceholder');
            const tituloInput = document.getElementById('search-number-titulo');
            const partidaInput = document.getElementById('search-partida-input');

            if (qrDisplay && qrPlaceholder) {
                qrDisplay.src = qrUrl;
                qrDisplay.style.display = 'block';
                qrPlaceholder.style.display = 'none';
            }

            if (tituloInput && partidaInput) {
                tituloInput.value = title;
                partidaInput.value = partida;
                console.log('SearchQR: Título y Partida asignados:', title, partida);
            }
        }

        async function getDataUrlFromImage(imageUrl) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                img.crossOrigin = 'Anonymous';
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    canvas.width = img.width;
                    canvas.height = img.height;
                    canvas.getContext('2d').drawImage(img, 0, 0);
                    resolve(canvas.toDataURL('image/png'));
                };
                img.onerror = (error) => {
                    console.error('SearchQR: Error al cargar imagen:', error);
                    reject(error);
                };
                img.src = imageUrl;
            });
        }

        async function generatePDF() {
            console.log('SearchQR: Generando PDF...');

            if (typeof window.jspdf === 'undefined') {
                throw new Error('jsPDF no está cargado');
            }

            const {
                jsPDF
            } = window.jspdf;

            const doc = new jsPDF({
                orientation: 'landscape',
                unit: 'in',
                format: [11.69, 16.54]
            });

            const qrX = parseFloat(document.getElementById('search-qr-x').value);
            const qrY = parseFloat(document.getElementById('search-qr-y').value);
            const numX = parseFloat(document.getElementById('search-num-x').value);
            const numY = parseFloat(document.getElementById('search-num-y').value);

            if (document.getElementById('search-chkQR').checked) {
                const qrUrl = document.getElementById('search-qrDisplay').src;
                if (qrUrl && qrUrl !== '' && !qrUrl.endsWith('/')) {
                    try {
                        const img = await getDataUrlFromImage(qrUrl);
                        doc.addImage(img, 'PNG', qrX, qrY, 1.25, 1.25);
                    } catch (error) {
                        console.error('SearchQR: Error al agregar QR:', error);
                    }
                }
            }

            if (document.getElementById('search-chkPartida').checked) {
                const partida = document.getElementById('search-partida-input').value.trim();
                if (partida) {
                    doc.setFontSize(14);
                    doc.text(partida, numX, numY);
                }
            }

            return doc;
        }

        // Exponer solo la función de inicialización
        return {
            init: init,
            destroy: function() {
                initialized = false;
                console.log('SearchQR: Módulo destruido');
            }
        };
    })();

    // Auto-inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => window.SearchQRModule.init(), 100);
        });
    } else {
        setTimeout(() => window.SearchQRModule.init(), 100);
    }

    // También intentar inicializar cuando el tab se haga visible
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            const tabElement = document.getElementById('searchQRTab');
            if (tabElement && tabElement.offsetParent !== null) {
                window.SearchQRModule.init();
            }
        });
    });

    // Observar cambios en el DOM
    if (document.body) {
        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['style', 'class']
        });
    }
</script>