<?php
function render_navbar($rol = '', $nombre = '')
{
?>
<<<<<<< Updated upstream
    <link rel="stylesheet" href="/styles/navbar.css">
=======
    <link rel="stylesheet" href="/ConsultaTituloPlandet-1/styles/navbar.css">
>>>>>>> Stashed changes
    <nav class="navbar">
        <h1 class="navbar-logo">
            Plandet
        </h1>

        <div class="navbar-user">
            <p class="user-info">
                <?php echo htmlspecialchars($nombre); ?>
                <span class="user-role">(<?php echo htmlspecialchars($rol); ?>)</span>
            </p>

<<<<<<< Updated upstream
            <a href="/index.php?action=logout" class="btn-logout">
=======
            <a href="/ConsultaTituloPlandet-1/index.php?action=logout" class="btn-logout">
>>>>>>> Stashed changes
                Logout
            </a>
        </div>
    </nav>
<?php
}
?>