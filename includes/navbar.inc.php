<nav class="mb-1 navbar navbar-expand-lg navbar-dark shadow">
    <a class="navbar-brand" href="index.php">Ideas</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                <i class="fas fa-user"></i> Profile </a>
            <div class="dropdown-menu dropdown-menu-right" id="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="account.php">My account</a>
                <div class="dropdown-divider"></div>
                <?php
                if ($_SESSION['user_role'] == 'admin') {
                    echo '<a class="dropdown-item" href="administrator/index.php">Dashboard</a>
                    <div class="dropdown-divider"></div>';
                }
                ?>
                <?php
                if ($_SESSION['user_role'] == 'qamanager') {
                    echo '<a class="dropdown-item" href="qamanager/index.php">Dashboard</a>
                    <div class="dropdown-divider"></div>';
                }
                ?>
                <form action="includes/logout.inc.php" method="post">
                    <button class="dropdown-item" name="logout-submit">Log out</button>
                </form>
            </div>
        </li>
    </ul>
</nav>