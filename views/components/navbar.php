<?php
function render_navbar($rol = '', $nombre = '')
{
?>
    <link rel="stylesheet" href="/styles/navbar.css">
    <nav class="navbar">
        <h1 class="navbar-logo">
            Plandet
        </h1>

        <div class="navbar-user">
            <p class="user-info">
                <?php echo htmlspecialchars($nombre); ?>
                <span class="user-role">(<?php echo htmlspecialchars($rol); ?>)</span>
            </p>

            <a href="/index.php?action=logout" class="btn-logout">
                Logout
            </a>
        </div>
    </nav>
<?php
}
?>