<?php
$rol = $_SESSION['usuario_rol'] ?? null;

$tabs = [
    [
        "key" => "generarQR",
        "label" => "Generacion de QRs",
        "color" => "green",
        "roles" => ["admin"]
    ],
    [
        "key" => "proyectos",
        "label" => "Solicitar Insumos",
        "color" => "blue",
        "roles" => ["admin", "locador"]
    ],
    [
        "key" => "tareas",
        "label" => "Asignar Tarea",
        "color" => "purple",
        "roles" => ["admin"]
    ],
];

// Filtrar tabs según el rol
$tabs_permitidos = array_filter($tabs, function($tab) use ($rol) {
    return in_array($rol, $tab["roles"]);
});
?>

<link rel="stylesheet" href="/styles/navtabs.css">

<div class="tabs-container">
    <?php foreach ($tabs_permitidos as $tab): ?>
        <button 
            class="tab-btn" 
            data-tab="<?= $tab["key"] ?>" 
            data-color="<?= $tab["color"] ?>"
        >
            <?= $tab["label"] ?>
        </button>
    <?php endforeach; ?>
</div>

<div id="tab-contenido">

    <?php foreach ($tabs_permitidos as $tab): ?>
        <div class="tab-content" id="tab-<?= $tab["key"] ?>">
            <?php include __DIR__ . "/tab-{$tab['key']}.php"; ?>
        </div>
    <?php endforeach; ?>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".tab-btn");
    const contents = document.querySelectorAll(".tab-content");

    if (buttons.length === 0) return;

    // activar el primer tab permitido
    changeTab(buttons[0].dataset.tab);

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            changeTab(btn.dataset.tab);
        });
    });

    function changeTab(key) {
        contents.forEach(c => c.style.display = "none");
        const visible = document.getElementById("tab-" + key);
        if (visible) visible.style.display = "block";

        buttons.forEach(b => {
            b.classList.remove("active");
            b.style.background = "";
            b.style.color = "";
        });

        const activeBtn = document.querySelector(`[data-tab="${key}"]`);
        if (activeBtn) {
            const color = activeBtn.dataset.color;
            activeBtn.classList.add("active");
            activeBtn.style.background = `var(--${color})`;
            activeBtn.style.color = "white";
        }
    }
});
</script>
