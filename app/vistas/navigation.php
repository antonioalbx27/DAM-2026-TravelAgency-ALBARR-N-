<nav class="navbar-horizontal">
    <div class="navbar-container">
        <div class="nav-left">
            <a href="/DAM[2026]TravelAgency[ALBARRÁN]/app/public/index.php" class="nav-link">Inicio</a>
            <?php if (!isset($_SESSION['usuario'])): ?>
                <a href="/DAM[2026]TravelAgency[ALBARRÁN]/app/public/registro.php" class="nav-link">Registro</a>
                <a href="/DAM[2026]TravelAgency[ALBARRÁN]/app/admin/login.php" class="nav-link">Iniciar sesión</a>
            <?php else: ?>
                <?php if (isset($_SESSION['usuario']['admin']) && $_SESSION['usuario']['admin'] === 'SI'): ?>
                    <a href="/DAM[2026]TravelAgency[ALBARRÁN]/app/admin/crud.php" class="nav-link">CRUD</a>
                <?php endif; ?>
                <a href="/DAM[2026]TravelAgency[ALBARRÁN]/app/admin/logout.php" class="nav-link">Cerrar sesión</a>
            <?php endif; ?>
        </div>
        <div class="nav-right">
            <input type="text" placeholder="Buscar destinos..." class="search-input">
            <button class="search-button">Buscar</button>
        </div>
    </div>
</nav>

<div id="main-content">
