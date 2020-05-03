            <!-- Side Navigation -->
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <!-- Side Navigation Menu -->
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="manageusers.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Manage Users</a
                            >
                            <a class="nav-link" href="manageideas.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Manage Ideas</a
                            >
                            <a class="nav-link" href="managecomments.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-comments"></i></div>
                                Manage Comments</a
                            >
                            <a class="nav-link" href="detailed_reports.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Detailed Reports</a
                            >
                            <a class="nav-link" href="../index.php"
                                ><div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Ideas Home Page</a
                            >
                        </div>
                    </div>
                    <!-- /.Side Navigation Menu -->
                    <!-- Side Navigation Footer -->
                    <div class="sb-sidenav-footer">
                        <?php $username = $_SESSION['first_name'].' '.$_SESSION['last_name']; ?>
                        <div class="small">Logged in as: <?php echo $username ?> </div>
                    </div>
                    <!-- /.Side Navigation Footer -->
                </nav>
            </div>
            <!-- /.Side Navigation -->