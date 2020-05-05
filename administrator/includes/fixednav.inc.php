        <!-- Navigation Bar -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Admin</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
                <i class="fas fa-bars"></i>
            </button>
            <!-- User dropdown -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="account.php">My Account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../index.php">Ideas Home Page</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../includes/logout.inc.php">Logout</a>
                    </div>
                </li>
            </ul>
            <!-- /.User dropdown -->
        </nav>
        <!-- /.Navigation Bar -->