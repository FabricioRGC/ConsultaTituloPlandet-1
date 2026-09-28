<?php
require_once __DIR__ . '/../../controllers/DocumentController.php';

<<<<<<< HEAD
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
=======
$tabKey = 'searchQR-PDF';

$controller = new DocumentController();
$documents = $controller->getDocuments();
$hasFilters = !empty($_POST['title'] ?? '') || !empty($_POST['partida'] ?? '') || !empty($_POST['fecha'] ?? '');
?>
<link rel="stylesheet" href="/ConsultaTituloPlandet-1/styles/tab-searchQR-PDF.css">
<div class="tab-searchqr sqr-container" id="searchQRTab">

    <!-- BUSQUEDA + LISTADO DE DOCUMENTOS -->
    <div class="sqr-card sqr-documents-card">
        <form method="post" class="sqr-search-bar" action="?action=dasboard&tab=<?= urlencode($tabKey) ?>">
            <input type="text"
                name="title"
                class="sqr-input"
                placeholder="Buscar por titulo"
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

            <button class="sqr-btn sqr-btn-primary" type="submit">
                Buscar
            </button>
        </form>

        <?php if (!empty($documents)): ?>
            <div class="sqr-card-header">
                <h3 class="sqr-card-title">Documentos Disponibles</h3>
>>>>>>> CalebRomero
            </div>
            <div class="sqr-table-wrapper">
                <table class="sqr-table">
                    <thead>
                        <tr>
                            <th class="sqr-th-select">Seleccionar</th>
                            <th class="sqr-th-id">ID</th>
<<<<<<< HEAD
                            <th class="sqr-th-title">Título</th>
                            <th class="sqr-th-partida">Partida</th>
                            <th class="sqr-th-fecha">Fecha</th>
=======
                            <th class="sqr-th-title sqr-th-sortable" data-sort="title">Titulo</th>
                            <th class="sqr-th-partida sqr-th-sortable" data-sort="partida">Partida</th>
                            <th class="sqr-th-fecha sqr-th-sortable desc" data-sort="fecha">Fecha</th>
>>>>>>> CalebRomero
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
<<<<<<< HEAD
                                        data-partida="<?= htmlspecialchars($row['partida']) ?>">
=======
                                        data-partida="<?= htmlspecialchars($row['partida']) ?>"
                                        data-uid="<?= htmlspecialchars($row['unique_id'] ?? '', ENT_QUOTES) ?>">
>>>>>>> CalebRomero
                                </td>
                                <td class="sqr-td-id"><?= (int)$row['id'] ?></td>
                                <td class="sqr-td-title"><?= htmlspecialchars($row['title']) ?></td>
                                <td class="sqr-td-partida"><?= htmlspecialchars($row['partida']) ?></td>
                                <td class="sqr-td-fecha"><?= htmlspecialchars($row['fecha']) ?></td>
                                <td class="sqr-td-center">
<<<<<<< HEAD
                                    <!-- 🔥 MODIFICADO: Mantener tab en URL del PDF -->
                                    <a href="<?= htmlspecialchars($row['pdf_path']) ?>"
                                        target="_blank"
                                        class="sqr-btn sqr-btn-info">
                                        📑 Ver PDF
=======
                                    <a href="/ConsultaTituloPlandet-1/view.php?id=<?= urlencode($row['unique_id'] ?? '') ?>"
                                        target="_blank"
                                        class="sqr-btn sqr-btn-info">
                                        Ver PDF
>>>>>>> CalebRomero
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
<<<<<<< HEAD
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
=======
        <?php else: ?>
            <div class="sqr-empty-state">
                <div class="sqr-empty-icon">-</div>
                <?php if ($hasFilters): ?>
                    <p class="sqr-empty-text">No se encontraron documentos con esos filtros.</p>
                    <form method="get" action="" style="margin-top: 0.75rem;">
                        <input type="hidden" name="action" value="dasboard">
                        <input type="hidden" name="tab" value="<?= htmlspecialchars($tabKey) ?>">
                        <button type="submit" class="sqr-btn sqr-btn-secondary">Limpiar busqueda</button>
                    </form>
                <?php else: ?>
                    <p class="sqr-empty-text">No hay documentos registrados.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- VISUALIZACION QR Y PARTIDA -->
    <div class="sqr-card sqr-preview-card">
        <div class="sqr-card-header">
            <h3 class="sqr-card-title">Previsualizacion</h3>
        </div>
        <div class="sqr-preview-grid">
            <div class="sqr-qr-section">
                <h4 class="sqr-section-title">Codigo QR</h4>
                <div class="sqr-qr-display">
                    <img id="search-qrDisplay" src="" alt="Codigo QR" class="sqr-qr-image">
                    <div class="sqr-qr-placeholder" id="search-qrPlaceholder">
                        <span>QR</span>
>>>>>>> CalebRomero
                        <p>Selecciona un documento</p>
                    </div>
                </div>
            </div>

            <div class="sqr-partida-section">

<<<<<<< HEAD
                <h4 class="sqr-section-title">Nombre del Título</h4>
=======
                <h4 class="sqr-section-title">Nombre del Titulo</h4>
>>>>>>> CalebRomero
                <input type="text"
                    id="search-number-titulo"
                    maxlength="50"
                    class="sqr-input sqr-input-large"
<<<<<<< HEAD
                    placeholder="Ingrese el nombre del título">

                <h4 class="sqr-section-title">Partida Electrónica</h4>
                <input type="text"
                    id="search-partida-input"
                    class="sqr-input sqr-input-large"
                    placeholder="Ingrese la partida electrónica">
=======
                    placeholder="Ingrese el nombre del titulo">

                <h4 class="sqr-section-title">Partida Electronica</h4>
                <input type="text"
                    id="search-partida-input"
                    class="sqr-input sqr-input-large"
                    placeholder="Ingrese la partida electronica">
>>>>>>> CalebRomero

                <div class="sqr-checkboxes">
                    <label class="sqr-checkbox-label">
                        <input type="checkbox" id="search-chkQR" class="sqr-checkbox" checked>
                        <span>Incluir QR</span>
                    </label>
                    <label class="sqr-checkbox-label">
                        <input type="checkbox" id="search-chkPartida" class="sqr-checkbox" checked>
<<<<<<< HEAD
                        <span>Incluir Partida Electrónica</span>
=======
                        <span>Incluir Partida Electronica</span>
>>>>>>> CalebRomero
                    </label>
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
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
=======
    <!-- CONFIGURACION DE POSICIONES -->
    <div class="sqr-card sqr-position-card">
        <div class="sqr-card-header">
            <h3 class="sqr-card-title">Configuracion de Posiciones en PDF</h3>
        </div>
        <div class="sqr-position-grid">
            <div class="sqr-position-group">
                <h5 class="sqr-group-title">Posicion del QR</h5>
                <div class="sqr-input-row">
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posicion X</label>
                        <input type="number" id="search-qr-x" value="0.75" step="0.1" class="sqr-input">
                    </div>
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posicion Y</label>
                        <input type="number" id="search-qr-y" value="2.1" step="0.1" class="sqr-input">
>>>>>>> CalebRomero
                    </div>
                </div>
            </div>

            <div class="sqr-position-group">
<<<<<<< HEAD
                <h5 class="sqr-group-title">Posición del Número</h5>
                <div class="sqr-input-row">
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posición X</label>
                        <input type="number" id="search-num-x" value="2.15" step="0.1" class="sqr-input">
                    </div>
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posición Y</label>
                        <input type="number" id="search-num-y" value="1.30" step="0.1" class="sqr-input">
=======
                <h5 class="sqr-group-title">Posicion del Numero</h5>
                <div class="sqr-input-row">
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posicion X</label>
                        <input type="number" id="search-num-x" value="2.20" step="0.1" class="sqr-input">
                    </div>
                    <div class="sqr-input-group">
                        <label class="sqr-label">Posicion Y</label>
                        <input type="number" id="search-num-y" value="1.43" step="0.1" class="sqr-input">
>>>>>>> CalebRomero
                    </div>
                </div>
            </div>
            <div class="sqr-export-content">
                <div class="sqr-actions">
                    <button id="search-preview-button" class="sqr-btn sqr-btn-secondary">
<<<<<<< HEAD
                        👁️ Previsualizar PDF
                    </button>
                    <button id="search-export-button" class="sqr-btn sqr-btn-primary">
                        💾 Exportar a PDF
=======
                        Previsualizar PDF
                    </button>
                    <button id="search-export-button" class="sqr-btn sqr-btn-primary">
                        Exportar a PDF
>>>>>>> CalebRomero
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
<<<<<<< HEAD
                ✖ Cerrar
=======
                Cerrar
>>>>>>> CalebRomero
            </button>
        </div>
        <iframe id="search-pdfPreview" class="sqr-pdf-frame"></iframe>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script>
<<<<<<< HEAD
    // 🔥 NUEVO: Pasar tab actual a JavaScript
    const CURRENT_TAB = "<?= $currentTab ?>";

    // Encapsular todo en un namespace único para evitar conflictos
=======
    // ðŸ”¥ NUEVO: Pasar tab actual a JavaScript
    const CURRENT_TAB = "<?= $tabKey ?>";
    function trackEvent(action, module, description, metadata = {}) {
        fetch('/ConsultaTituloPlandet-1/index.php?action=track_event', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action, module, description, metadata })
        }).catch(() => {});
    }

    // Encapsular todo en un namespace Ãºnico para evitar conflictos
>>>>>>> CalebRomero
    window.SearchQRModule = (function() {
        'use strict';

        let initialized = false;

        function init() {
<<<<<<< HEAD
            // Evitar inicialización múltiple
            if (initialized) {
                console.log('SearchQR: Ya está inicializado');
                return;
            }

            console.log('SearchQR: Inicializando módulo...');

            // Verificar que el tab esté visible
=======
            // Evitar inicializaciÃ³n mÃºltiple
            if (initialized) {
                console.log('SearchQR: Ya estÃ¡ inicializado');
                return;
            }

            console.log('SearchQR: Inicializando mÃ³dulo...');

            // Verificar que el tab estÃ© visible
>>>>>>> CalebRomero
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
<<<<<<< HEAD
                        seleccionarDocumento(qrUrl, title, partida);
=======
                        const uniqueId = this.getAttribute('data-uid');
                        seleccionarDocumento(qrUrl, title, partida, uniqueId);
>>>>>>> CalebRomero
                    }
                });
            });

            const rows = document.querySelectorAll('.sqr-tr');

            rows.forEach(row => {

                // CLICK SIMPLE = SELECCIONAR
                row.addEventListener('click', function(e) {

<<<<<<< HEAD
                    // ❌ No reaccionar si es el botón PDF
=======
                    // âŒ No reaccionar si es el botÃ³n PDF
>>>>>>> CalebRomero
                    if (e.target.closest('.sqr-btn')) return;

                    const radio = row.querySelector('.search-radio-doc');
                    if (!radio) return;

                    radio.checked = true;
                    radio.dispatchEvent(new Event('change', {
                        bubbles: true
                    }));
                });

<<<<<<< HEAD
                // DOBLE CLICK = PREVIEW
=======
                            // DOBLE CLICK = PREVIEW
>>>>>>> CalebRomero
                row.addEventListener('dblclick', function(e) {
                    if (e.target.closest('.sqr-btn')) return;

                    const previewBtn = document.getElementById('search-preview-button');
                    if (previewBtn) previewBtn.click();
                });
            });

<<<<<<< HEAD
            // Botón exportar
=======
            // --- NUEVO: Ordenamiento de tabla ---
            const sortableHeaders = document.querySelectorAll('.sqr-th-sortable');
            sortableHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const sortKey = header.getAttribute('data-sort');
                    const isAsc = header.classList.contains('asc');
                    
                    // Resetear clases en otros headers
                    sortableHeaders.forEach(h => h.classList.remove('asc', 'desc'));
                    
                    // Alternar orden
                    const newDir = isAsc ? 'desc' : 'asc';
                    header.classList.add(newDir);
                    
                    sortTable(sortKey, newDir);
                });
            });

            function sortTable(key, dir) {
                const tbody = document.querySelector('.sqr-table tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));
                
                const sortedRows = rows.sort((a, b) => {
                    let valA, valB;
                    
                    if (key === 'title') {
                        valA = a.querySelector('.sqr-td-title').textContent.trim().toLowerCase();
                        valB = b.querySelector('.sqr-td-title').textContent.trim().toLowerCase();
                    } else if (key === 'partida') {
                        valA = a.querySelector('.sqr-td-partida').textContent.trim().toLowerCase();
                        valB = b.querySelector('.sqr-td-partida').textContent.trim().toLowerCase();
                    } else if (key === 'fecha') {
                        valA = a.querySelector('.sqr-td-fecha').textContent.trim();
                        valB = b.querySelector('.sqr-td-fecha').textContent.trim();
                    }
                    
                    if (valA < valB) return dir === 'asc' ? -1 : 1;
                    if (valA > valB) return dir === 'asc' ? 1 : -1;
                    return 0;
                });
                
                // Re-insertar filas ordenadas
                sortedRows.forEach(row => tbody.appendChild(row));
            }
            // --- FIN NUEVO ---

            // BotÃ³n exportar
>>>>>>> CalebRomero
            const exportButton = document.getElementById('search-export-button');
            if (exportButton) {
                exportButton.addEventListener('click', async function() {
                    console.log('SearchQR: Click en Exportar');
                    try {
                        const titulo = document.getElementById('search-number-titulo').value.trim() || 'SIN-TITULO';
                        const doc = await generatePDF();
                        doc.save(`${titulo}.pdf`);
<<<<<<< HEAD
=======
                        trackEvent('DOWNLOAD_PDF', 'DOCUMENT', 'Descarga de PDF desde Buscar QR/PDF', { titulo });
>>>>>>> CalebRomero
                        console.log('SearchQR: PDF exportado');
                    } catch (error) {
                        console.error('SearchQR: Error al exportar PDF:', error);
                        alert('Error al exportar el PDF: ' + error.message);
                    }
                });
            }

<<<<<<< HEAD
            // Botón preview
=======
            // BotÃ³n preview
>>>>>>> CalebRomero
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

<<<<<<< HEAD
=======
                        trackEvent('PREVIEW_PDF', 'DOCUMENT', 'Previsualizacion de PDF en Buscar QR/PDF');
>>>>>>> CalebRomero
                        console.log('SearchQR: Preview mostrado');
                    } catch (error) {
                        console.error('SearchQR: Error al previsualizar PDF:', error);
                        alert('Error al previsualizar el PDF: ' + error.message);
                    }
                });
            }

<<<<<<< HEAD
            // Botón cerrar preview
=======
            // BotÃ³n cerrar preview
>>>>>>> CalebRomero
            const closePreview = document.getElementById('search-closePreview');
            if (closePreview) {
                closePreview.addEventListener('click', function() {
                    document.getElementById('search-previewWrapper').style.display = 'none';
                });
            }

            initialized = true;
<<<<<<< HEAD
            console.log('SearchQR: Módulo inicializado correctamente');
=======
            console.log('SearchQR: MÃ³dulo inicializado correctamente');
>>>>>>> CalebRomero
        }

        function limpiarSeleccionVisual() {
            document.querySelectorAll('.sqr-tr.is-selected')
                .forEach(row => row.classList.remove('is-selected'));
        }

<<<<<<< HEAD
        function seleccionarDocumento(qrUrl, title, partida) {
            console.log('SearchQR: Seleccionando documento:', {
                qrUrl,
                title,
                partida
=======
        function normalizeQrPath(rawPath) {
            if (!rawPath) return '';
            const normalized = rawPath.replace(/\\/g, '/').trim();
            if (/^https?:\/\//i.test(normalized) || normalized.startsWith('/')) {
                return normalized;
            }
            return '/ConsultaTituloPlandet-1/' + normalized.replace(/^\/+/, '');
        }

        function seleccionarDocumento(qrUrl, title, partida, uniqueId) {
            console.log('SearchQR: Seleccionando documento:', {
                qrUrl,
                title,
                partida,
                uniqueId
>>>>>>> CalebRomero
            });

            const qrDisplay = document.getElementById('search-qrDisplay');
            const qrPlaceholder = document.getElementById('search-qrPlaceholder');
            const tituloInput = document.getElementById('search-number-titulo');
            const partidaInput = document.getElementById('search-partida-input');

            if (qrDisplay && qrPlaceholder) {
<<<<<<< HEAD
                qrDisplay.src = qrUrl;
=======
                qrDisplay.src = normalizeQrPath(qrUrl);
                qrDisplay.onerror = function() {
                    if (uniqueId) {
                        qrDisplay.src = '/ConsultaTituloPlandet-1/qr_preview.php?uid=' + encodeURIComponent(uniqueId) + '&t=' + Date.now();
                    }
                };
>>>>>>> CalebRomero
                qrDisplay.style.display = 'block';
                qrPlaceholder.style.display = 'none';
            }

            if (tituloInput && partidaInput) {
                tituloInput.value = title;
                partidaInput.value = partida;
<<<<<<< HEAD
                console.log('SearchQR: Título y Partida asignados:', title, partida);
=======
                console.log('SearchQR: TÃ­tulo y Partida asignados:', title, partida);
>>>>>>> CalebRomero
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
<<<<<<< HEAD
                throw new Error('jsPDF no está cargado');
=======
                throw new Error('jsPDF no esta¡ cargado');
>>>>>>> CalebRomero
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
<<<<<<< HEAD
                        doc.addImage(img, 'PNG', qrX, qrY, 1.25, 1.25);
=======
                        doc.addImage(img, 'PNG', qrX, qrY, 1.10, 1.10);
>>>>>>> CalebRomero
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

<<<<<<< HEAD
        // Exponer solo la función de inicialización
=======
        // Exponer solo la funciÃ³n de inicializaciÃ³n
>>>>>>> CalebRomero
        return {
            init: init,
            destroy: function() {
                initialized = false;
<<<<<<< HEAD
                console.log('SearchQR: Módulo destruido');
=======
                console.log('SearchQR: Modulo destruido');
>>>>>>> CalebRomero
            }
        };
    })();

<<<<<<< HEAD
    // Auto-inicializar cuando el DOM esté listo
=======
    // Auto-inicializar cuando el DOM estÃ© listo
>>>>>>> CalebRomero
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => window.SearchQRModule.init(), 100);
        });
    } else {
        setTimeout(() => window.SearchQRModule.init(), 100);
    }

<<<<<<< HEAD
    // También intentar inicializar cuando el tab se haga visible
=======
    // TambiÃ©n intentar inicializar cuando el tab se haga visible
>>>>>>> CalebRomero
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
<<<<<<< HEAD
</script>
=======
</script>
>>>>>>> CalebRomero
